<?php

namespace App\Services;

use App\Enums\AppRole;
use App\Mail\NewTicket;
use App\Mail\NewTicketClient;
use App\Mail\TicketAnswer;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function creationNewTicket(Ticket $ticket)
    {
        $agentRole = Role::where("name", AppRole::Agent)->first();
        $agentsEmails = $agentRole->users()->get()->map(function (User $u) {
            return $u->email;
        });

        Mail::to($agentsEmails)->send(new NewTicket($ticket));

        Mail::to($ticket->email)->send(new NewTicketClient($ticket));
    }

    public function answerToTicket(Ticket $ticket, User $user, string $text)
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
    }
}
