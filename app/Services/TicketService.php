<?php

namespace App\Services;

use App\Enums\AppRole;
use App\Enums\TicketStatus;
use App\Mail\CloseTicket;
use App\Mail\NewAnonTicketClient;
use App\Mail\NewTicket;
use App\Mail\NewTicketClient;
use App\Mail\TicketAnswer;
use App\Models\Message;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Mail;

class TicketService
{

    public function __construct(protected MailService $mailService)
    {
    }

    public function createAnonymousTicket(string $email, string $title, string $text): Ticket
    {
        $ticket = new Ticket();
        $ticket->email = $email;
        $ticket->title = $title;
        $ticket->text = $text;
        $ticket->escalation_time = new DateTime();
        $ticket->is_anon = true;
        $ticket->status = TicketStatus::New;
        $ticket->save();

        $this->mailService->creationNewTicket($ticket);

        return $ticket;
    }

    public function createTicket(User $user, string $title, string $text): Ticket
    {
        $ticket = new Ticket();
        $ticket->email = $user->email;
        $ticket->client_id = $user->id;
        $ticket->title = $title;
        $ticket->text = $text;
        $ticket->escalation_time = new DateTime();
        $ticket->status = TicketStatus::New;
        $ticket->save();

        $this->mailService->creationNewTicket($ticket);

        return $ticket;
    }

    public function closeTicket(User $user, Ticket $ticket, ?string $text): void
    {
        $ticket->status = TicketStatus::Close;
        $ticket->escalation_solution_time = new DateTime();
        $ticket->solution_notes = $text;
        $ticket->save();

        Mail::to($ticket->email)->send(new CloseTicket($ticket, $text));
    }

    public function answerToTicket(User $user, Ticket $ticket, string $text): void
    {
        $this->mailService->answerToTicket($ticket, $user, $text);

        $message = new Message();
        $message->text = $text;
        $message->user_id = $user->id;
        $message->ticket_id = $ticket->id;
        $message->save();
    }

    public function acceptInWork(User $user, Ticket $ticket): void
    {
        $ticket->owner_id = $user->id;
        $ticket->status = TicketStatus::Open;
        $ticket->escalation_update_time = new DateTime();
        $ticket->save();
    }
}
