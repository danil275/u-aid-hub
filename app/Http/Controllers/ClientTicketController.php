<?php

namespace App\Http\Controllers;

use App\Http\Requests\client\ticket\CreateTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ClientTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("client.index", [
            'tickets' => Ticket::where("owner_id", auth()->user()->id)->paginate(10)
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
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

}
