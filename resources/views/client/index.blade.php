@extends('base')

@section('title', 'Главная')

@section('content')


<h2>
    Заявки
</h2>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Заголовок</th>
            <th scope="col">Время создания</th>
            <th scope="col">Статус</th>
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
            <td><a href="{{ route('client-show-ticket', $t) }}">Открыть</a></td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection