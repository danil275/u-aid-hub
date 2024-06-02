<?php

namespace App\Http\Controllers;

use App\Http\Requests\client\ticket\CreateTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Services\PaginationService;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientTicketController extends Controller
{

    public function __construct(
        protected TicketService $ticketService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("client.index", [
            'tickets' => Ticket::where("client_id", auth()->user()->id)->paginate(PaginationService::getPerPage())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.ticket.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTicketRequest $request)
    {
        $validated = $request->validated();

        try {
            $user = Auth::user();
            $ticket =  $this->ticketService->createTicket($user, $validated['title'], $validated['text']);
            return redirect()->route('client-show-ticket', ['ticket' => $ticket])
                ->with('success', 'Заявка принята в работу');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {

        return view('client.ticket.show', ['ticket' => $ticket]);
    }
}
