@extends('base')

@section('title', 'Главная')

@section('content')

<h1>Заявка №{{ $ticket->id }}</h1>
@if($ticket->status != app\Enums\TicketStatus::Close && $ticket->solution_notes)
<div class="callout">{{$ticket->solution_notes}}</div>
@endif

<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Тема</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $ticket->title }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Время создания</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $ticket->escalation_time->format('d.m.Y H:m') }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Статус</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $ticket->status }}</p>
            </div>
        </div>
        <hr>
    </div>
</div>

<ul class="list-unstyled">
    <li class="d-flex justify-content-between mb-4">
        <div class="card w-100">
            <div class="card-header d-flex justify-content-between p-3">
                <p class="fw-bold mb-0">Клиент</p>
                <p class="text-muted small mb-0"><i class="far fa-clock"></i>{{ $ticket->escalation_time->format('d.m.Y H:m') }}</p>
            </div>
            <div class="card-body">
                <p class="mb-0">
                    {{ $ticket->text }}
                </p>
            </div>
        </div>
    </li>
    @foreach($ticket->messages as $m)
    <li class="d-flex justify-content-between mb-4">
        <div class="card w-100">
            <div class="card-header d-flex justify-content-between p-3">
                @if(isset($m->user->email))
                <p class="fw-bold mb-0">{{ $m->user->email }}</p>
                @else
                <p class="fw-bold mb-0">Клиент</p>
                @endif
                <p class="text-muted small mb-0"><i class="far fa-clock"></i>{{$m->created_at->format('d.m.Y H:m')}}</p>
            </div>
            <div class="card-body">
                <p class="mb-0">
                    {{ $m->text }}
                </p>
            </div>
        </div>
    </li>
    @endforeach
</ul>

@endsection