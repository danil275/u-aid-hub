<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Services\PaginationService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    const PAGINATE_PER_PAGE = 10;
    function home()
    {
        if (Auth::check()) {
            /** @var User */
            $user = Auth::user();
            if ($user->isClient()) {
                return view("client.index", [
                    'tickets' => Ticket::where("client_id", auth()->user()->id)->paginate(PaginationService::getPerPage())
                ]);
            }
            if ($user->isAgent() || $user->isAdmin()) {
                $ticketsInWork = Ticket::where("owner_id", auth()->user()->id)
                    ->whereNot('status', TicketStatus::Close)
                    ->paginate(PaginationService::getPerPage(), ["*"], 'ticketsInWorkPage');
                $ticketsInQueue = Ticket::where('status', TicketStatus::New)
                    ->paginate(PaginationService::getPerPage(), ['*'], 'ticketsInQueuePage');
                return view("agent.index", [
                    'ticketsInWork' => $ticketsInWork,
                    'ticketsInQueue' => $ticketsInQueue
                ]);
            }
        }
        return view('index');
    }
}
