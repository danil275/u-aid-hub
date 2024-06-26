<?php

namespace App\Http\Controllers;

use App\Enums\AppRole;
use App\Enums\TicketStatus;
use App\Http\Requests\agent\ticket\AcceptInWorkRequest;
use App\Http\Requests\agent\ticket\AnswerTicketRequest;
use App\Http\Requests\agent\ticket\CloseTicketRequest;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use App\Services\PaginationService;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AgentTicketController extends Controller
{
    public function __construct(
        protected TicketService $ticketService
    ) {
    }
    public function index(Request $request)
    {

        $validated = $request->validate([
            'id' => 'numeric',
            'inWork' => 'boolean',
            'status' => 'string'
        ]);

        $builder = Ticket::query();

        if (isset($validated['id'])) {
            $builder->where('id', '=', $validated['id']);
        }

        if (isset($validated['inWork'])) {
            $builder->where("owner_id", auth()->user()->id);
        }

        if (isset($validated['status'])) {
            $builder->where("status", $validated['status']);
        } else {
            $builder->whereNot('status', TicketStatus::Close);
        }

        $tickets = $builder->paginate(PaginationService::getPerPage());

        return view("agent.index", [
            'tickets' => $tickets
        ]);
    }

    public function acceptInWork(Ticket $ticket, AcceptInWorkRequest $request)
    {
        if ($ticket->status == TicketStatus::Close || $ticket->owner_id != null) {
            return redirect()->route('agent-show-ticket', ['ticket' => $ticket, 'agents' => []])
                ->with('error', 'Заявка закрыта или уже в работе');
        }

        $validated = $request->validated();
        $agents = Role::where('name', AppRole::Agent)->first()->users;

        try {
            if (isset($validated['agent'])) {
                $agent = User::find($validated['agent']);

                $this->ticketService->acceptInWork($agent, $ticket);

                return redirect()->route('agent-show-ticket', ['ticket' => $ticket, 'agents' => $agents])
                    ->with('success', "Заявка назначена $agent->name");
            }

            $user = Auth::user();
            $this->ticketService->acceptInWork($user, $ticket);

            return redirect()->route('agent-show-ticket', ['ticket' => $ticket, 'agents' => $agents])
                ->with('success', 'Заявка принята в работу');
        } catch (Throwable $th) {
            throw $th;
        }
    }

    public function show(Ticket $ticket)
    {
        $agents = Role::where('name', AppRole::Agent)->first()->users;
        $ticket->load('messages.user');
        return view('agent.ticket.show', ['ticket' => $ticket, 'agents' => $agents]);
    }

    public function close(CloseTicketRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();
        $agents = Role::where('name', AppRole::Agent)->first()->users;

        try {
            $this->ticketService->closeTicket($request->user(), $ticket, $validated['text']);
            return redirect()->route('agent-show-ticket', ['ticket' => $ticket, 'agents' => $agents])
                ->with('success', "");
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function answer(AnswerTicketRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();
        $agents = Role::where('name', AppRole::Agent)->first()->users;

        try {
            $this->ticketService->answerToTicket($request->user(), $ticket, $validated['text']);
            return redirect()->route('agent-show-ticket', ['ticket' => $ticket, 'agents' => $agents]);
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
