@extends('base')

@section('title', 'Главная')


@section('content')
<div class="rounded border p-3 mb-3">
    <form method="GET" class="d-flex align-items-center">
        <label for="ticket_id" class="me-1">№ заявки</label>
        <input style="width: 200px;" class="form-control me-2" type="number" name="ticket_id" id="ticket_id" value="{{ request()->input('id') }}">

        <label for="status" class="me-1">Статус</label>
        <select class="me-2" name="status" id="status">
            <option @if(request()->input('status') === null) selected="selected" @endif disabled>Выберите статус...</option>
            @foreach(App\Enums\TicketStatus::cases() as $s)
            <option value="{{$s}}" @if(request()->input('status') == $s->value) selected="selected" @endif>{{$s}}</option>
            @endforeach
        </select>
        <label for="inWork" class="me-1">В работе</label>
        <input type="checkbox" class="me-2" name="inWork" id="inWork" value="1" @if(request()->input('inWork') == '1') checked @endif>

        <input type="submit" class="btn btn-sm btn-primary me-2" value="Поиск">
    </form>
</div>
<div class="">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Время создания</th>
                <th scope="col">Статус</th>
                <th scope="col">Владелец</th>
                <th scope="col">Создатель</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $t)
            <tr>
                <th scope="row">{{ $t->id }}</th>
                <td>{{ $t->title }}</td>
                <td>{{ $t->escalation_time->format('d.m.Y H:i') }}</td>
                <td>{{ $t->status }}</td>
                <td>@if($t->owner) {{ $t->owner->email }} @endif</td>
                <td>{{ $t->email }}</td>
                <td><a href="{{ route('agent-show-ticket', $t) }}">Открыть</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">{{ $tickets->links() }}</div>
</div>


@endsection