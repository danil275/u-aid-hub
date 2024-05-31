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
    function home()
    {
        if (Auth::check()) {
            /** @var User */
            $user = Auth::user();
            if ($user->isClient()) {
                return redirect()->route('tickets');
            }
            if ($user->isAgent() || $user->isAdmin()) {
                return redirect()->route('agent-tickets');
            }
        }
        return view('index');
    }
}
