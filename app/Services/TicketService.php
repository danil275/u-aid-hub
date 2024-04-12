<?php

namespace App\Services;

use App\Enums\TicketStatus;
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
        $ticket->client = $user;
        $ticket->title = $title;
        $ticket->text = $text;
        $ticket->escalation_time = new DateTime();
        $ticket->status = TicketStatus::New;
        $ticket->save();

        return $ticket;
    }
}
