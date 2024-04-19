@extends('base')

@section('title', 'Главная')

@section('content')

<h1>Заявка №{{ $ticket->id }}</h1>

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
                <p class="mb-0"></p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $ticket->escalation_time->format('d.m.Y H:m') }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0"></p>
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
                <p class="text-muted mb-0">
                    @if ($ticket->owner)
                    {{ $ticket->owner->name }}
                    @else
                <form action="" method="post">
                    @csrf
                    <button type="button" class="btn btn-sm btn-outline-dark">Принять в работу</button>
                </form>
                <hr>
                <form action="" method="post">
                    @csrf
                    <select name="" id="">
                        <option selected disabled>Выберите сотрудника</option>
                        @foreach ($agents as $a)
                        <option value="{{ $a->id }}">{{$a->name}}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-sm btn-outline-dark">Назначить</button>
                </form>
                @endif
                </p>
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
                <p class="fw-bold mb-0">{{ $ticket->email }}</p>
                <p class="text-muted small mb-0"><i class="far fa-clock"></i>{{$m->created_at->format('d.m.Y H:m')}}</p>
            </div>
            <div class="card-body">
                <p class="mb-0">
                    {{ $ticket->text }}
                </p>
            </div>
        </div>
    </li>
    @endforeach
</ul>

<div class="form-outline">
    <form class="mb-3" method="post">
        @csrf
        <textarea class="form-control mb-3" rows="4"></textarea>
        <button type="button" class="btn btn-outline-dark">Отправить</button>
    </form>
</div>

@endsection