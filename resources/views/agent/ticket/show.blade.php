@extends('base')

@section('title', 'Главная')

@section('content')

<h1>Заявка №{{ $ticket->id }}</h1>
@if($ticket->status != app\Enums\TicketStatus::Close)
<div class="mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable">
        Закрыть
    </button>
</div>
@elseif($ticket->solution_notes)
<div class="callout">{{$ticket->solution_notes}}</div>
@endif

<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Почта</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $ticket->email }}</p>
            </div>
        </div>
        <hr>
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
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Исполнитель</p>
            </div>
            <div class="col-sm-9">
                @if ( $ticket->owner_id)
                {{ $ticket->owner->name }}
                @else
                <form action="{{ route('agent-accept-ticket-in-work', $ticket) }}" method="post">
                    @csrf
                    <input type="submit" class="btn btn-sm btn-outline-dark" value="Принять в работу">
                </form>
                <hr>
                <form action="{{ route('agent-accept-ticket-in-work', $ticket) }}" method="post">
                    @csrf
                    <select name="agent" id="agent">
                        <option selected disabled>Выберите сотрудника</option>
                        @foreach ($agents as $a)
                        <option value="{{ $a->id }}">{{$a->name}}</option>
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-sm btn-outline-dark" value="Назначить">
                </form>
                @endif
            </div>
        </div>
        <hr>
    </div>
</div>

<ul class="list-unstyled">
    <li class="d-flex justify-content-between mb-4">
        <div class="card w-100">
            <div class="card-header d-flex justify-content-between p-3">
                <p class="fw-bold mb-0">{{ $ticket->email }}</p>
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
                <p class="fw-bold mb-0">{{ $ticket->email }}</p>
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

@if($ticket->status != app\Enums\TicketStatus::Close)
<div class="form-outline">
    <form class="mb-3" action="{{ route('agent-answer-ticket', $ticket) }}" method="post">
        @csrf
        <textarea name="text" class="form-control mb-3" rows="4"></textarea>
        <input type="submit" class="btn btn-outline-dark" value="Отправить">
    </form>
</div>
@endif

<div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Закрыть заявку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agent-close-ticket', $ticket) }}" method="post">
                    @csrf
                    <textarea class="form-control mb-3" rows="4" name="text"></textarea>
                    <input class="btn btn-primary" type="submit" value="Закрыть заявку">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection