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

        $this->sendMailAboutCreationNewTicket($ticket);

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

        $this->sendMailAboutCreationNewTicket($ticket);

        return $ticket;
    }

    private function sendMailAboutCreationNewTicket(Ticket $ticket)
    {
        $agentRole = Role::where("name", AppRole::Agent)->first();
        $agentsEmails = $agentRole->users()->get()->map(function (User $u) {
            return $u->email;
        });

        Mail::to($agentsEmails)->send(new NewTicket($ticket));

        Mail::to($ticket->email)->send(new NewTicketClient($ticket));
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
        // Сообщение отправил владелец
        if ($ticket->email == $user->email) {
            // Заявки назначен владелец
            if ($ticket->owner() != null) {
                Mail::to($ticket->owner()->get()->email)->send(new TicketAnswer($ticket, $text));
            }
        }
        // Сообщение отправил агент
        else {
            Mail::to($ticket->email)->send(new TicketAnswer($ticket, $text));
        }

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
