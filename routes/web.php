<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentTicketController;
use App\Http\Controllers\AnonymousTicketController;
use App\Http\Controllers\ClientTicketController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::controller(LoginController::class)
    ->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate')->name('authenticate');
        Route::get('/logout', 'logout')->name('logout');
    });

Route::controller(AnonymousTicketController::class)
    ->prefix('new')
    ->group(function () {
        Route::get('/', 'create')->name('new-anonymous-ticket');
        Route::post('/', 'store');
    });

Route::prefix('agent')
    ->group(function () {
        Route::get('/', function () {
            return view('agent.index');
        })->name('agent-index');
        Route::controller(AgentTicketController::class)
            ->prefix('tickets')
            ->group(function () {
                Route::get('/', 'index')->name('agent-tickets');
                Route::get('/{id}', 'show')->name('agent-show-ticket');
                Route::get('/new', 'create')->name('agent-create-ticket');
            });
    });

Route::prefix('client')
    ->group(function () {
        Route::controller(ClientTicketController::class)
            ->prefix('tickets')
            ->group(function () {
                Route::get('/', 'index')->name('tickets');
                Route::get('/{id}', 'show');
                Route::get('/new', 'create');
            });
    });

Route::controller(UserController::class)
    ->prefix('user')
    ->group(function () {
        Route::get('/', 'index')->name('user');
    });

Route::controller(AdminController::class)
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'index')->name('admin');
    });
