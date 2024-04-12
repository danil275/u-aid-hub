<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AgentTicketController extends Controller
{
    const PAGINATE_PER_PAGE = 10;

    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('agent.ticket.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
