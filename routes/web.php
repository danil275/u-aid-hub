<?php

use App\Enums\AppRole;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentTicketController;
use App\Http\Controllers\AnonymousTicketController;
use App\Http\Controllers\ClientTicketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::controller(LoginController::class)
    ->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate')->name('authenticate');
        Route::get('/logout', 'logout')->name('logout')->middleware('auth');
    });

Route::controller(AnonymousTicketController::class)
    ->prefix('ticket')
    ->group(function () {
        Route::prefix('new')->group(
            function () {
                Route::get('/', 'create')->name('new-anonymous-ticket');
                Route::post('/', 'store');
            }
        );

        Route::get('/{ticket}', 'show')->name('show-anonymous-ticket');
    });

Route::group(['middleware' => 'auth'], function () {

    Route::prefix('agent')
        ->middleware([EnsureUserHasRole::class . ':' . AppRole::Agent->value])
        ->group(function () {
            Route::get('/', function () {
                return view('agent.index');
            })->name('agent-index');
            Route::controller(AgentTicketController::class)
                ->prefix('tickets')
                ->group(function () {
                    Route::get('/', 'index')->name('agent-tickets');
                    Route::get('/{ticket}', 'show')->name('agent-show-ticket');
                    Route::post('/{ticket}/answer', 'answer')->name('agent-answer-ticket');
                    Route::post('/{ticket}/close', 'close')->name('agent-close-ticket');
                    Route::post('/{ticket}/accept', 'acceptInWork')->name('agent-accept-ticket-in-work');
                    Route::get('/new', 'create')->name('agent-create-ticket');
                });
        });

    Route::prefix('client')
        ->middleware([EnsureUserHasRole::class . ':' . AppRole::Client->value])
        ->group(function () {
            Route::controller(ClientTicketController::class)
                ->prefix('tickets')
                ->group(function () {
                    Route::get('/', 'index')->name('tickets');
                    Route::get('/new', 'create')->name('client-create-ticket');
                    Route::post('/new', 'store')->name('client-create-ticket');
                    Route::get('/{ticket}', 'show')->name('client-show-ticket');
                });
        });

    Route::controller(UserController::class)
        ->prefix('user')
        ->group(function () {
            Route::get('/', 'index')->name('user');
        });

    Route::controller(AdminController::class)
        ->middleware([EnsureUserHasRole::class . ':' . AppRole::Admin->value])
        ->prefix('admin')
        ->group(function () {
            Route::get('/', 'index')->name('admin');
        });
});
