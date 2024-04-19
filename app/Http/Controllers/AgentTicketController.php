<?php

namespace App\Http\Controllers;

use App\Enums\AppRole;
use App\Enums\TicketStatus;
use App\Http\Requests\agent\ticket\AnswerTicketRequest;
use App\Http\Requests\agent\ticket\CloseTicketRequest;
use App\Models\Role;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentTicketController extends Controller
{
    const PAGINATE_PER_PAGE = 10;

    public function __construct(
        protected TicketService $ticketService
    ) {
    }
    public function index()
    {
        $ticketsInWork = Ticket::where("owner_id", auth()->user()->id)
            ->paginate(self::PAGINATE_PER_PAGE, ["*"], 'ticketsInWorkPage');
        $ticketsInQueue = Ticket::where('status', TicketStatus::New)
            ->paginate(self::PAGINATE_PER_PAGE, ['*'], 'ticketsInQueuePage');
        return view("agent.index", [
            'ticketsInWork' => $ticketsInWork,
            'ticketsInQueue' => $ticketsInQueue
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Ticket $ticket)
    {
        $agents = Role::where('name', AppRole::Agent)->first()->users;
        return view('agent.ticket.show', ['ticket' => $ticket, 'agents' => $agents]);
    }

    public function close(CloseTicketRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();

        $this->ticketService->closeTicket($request->user(), $ticket, $validated['text']);
    }

    public function answer(AnswerTicketRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();

        $this->ticketService->answerToTicket($request->user(), $ticket, $validated['text']);
    }
}
