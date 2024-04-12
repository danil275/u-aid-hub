<?php

namespace App\Http\Controllers;

use App\Http\Requests\client\ticket\CreateAnonymousTicketRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AnonymousTicketController extends Controller
{

    public function __construct(
        protected TicketService $ticketService
    ) {
    }

    public function create()
    {
        return view('client.ticket.new-anonymous-ticket');
    }

    public function store(CreateAnonymousTicketRequest $r)
    {
        $v = $r->validated();
        $ticket = $this->ticketService->createAnonymousTicket($v['email'], $v['title'], $v['text']);
        return redirect()->route('home')
            ->with('success', "Заявка создана. Номер вашей заявки {$ticket->id}.");
    }

}
