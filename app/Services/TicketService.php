<?php

namespace App\Services;

use App\Enums\TicketStatus;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use DateTime;

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

        return $ticket;
    }

    public function closeTicket(User $user, Ticket $ticket, ?string $text): void
    {
        $ticket->status = TicketStatus::Close;
        $ticket->escalation_solution_time = new DateTime();
        $ticket->solution_notes = $text;
        $ticket->save();
    }

    public function answerToTicket(User $user, Ticket $ticket, string $text): void
    {
        $message = new Message();
        $message->text = $text;
        $message->user_id = $user;
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
