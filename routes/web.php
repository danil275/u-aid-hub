<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/new', function () {
    return view('client.ticket.new-anonymous-ticket');
})->name('new-anonymous-ticket');

Route::prefix('agent')->group(function () {
    Route::get('/', function () {
        return view('agent.index');
    })->name('');
    Route::prefix('tickets')->group(function () {
        Route::get('/', function () {
            return view('agent.ticket.list', [
                'tickets' => []
            ]);
        })->name('tickets');
        Route::get('/{id}', function ($id) {
            return view('agent.ticket.new');
        });
        Route::get('/new', function () {
            return view('agent.ticket.new');
        });
    });
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('agent.admin.index', []);
        })->name('admin');
    });
});

Route::prefix('client')->group(function () {
    Route::prefix('ticket')->group(function () {
        Route::get('/', function () {
            return view('client.ticket.list', [
                'tickets' => []
            ]);
        })->name('tickets');
        Route::get('/{id}', function ($id) {
            return view('client.ticket.new');
        });
        Route::get('/new', function () {
            return view('client.ticket.new');
        });
    });
});

Route::prefix('user')->group(function () {
    Route::get('/', function () {
        return view('user.ticket.list', [
            'tickets' => []
        ]);
    })->name('tickets');
});