@extends('base')

@section('title', 'Главная')

@section('content')


<h2>
    Ваши заявки
</h2>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Заголовок</th>
            <th scope="col">Время создания</th>
            <th scope="col">Статус</th>
            <th scope="col">Группа</th>
            <th scope="col">Ответственный</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $t)
        <tr>
            <th scope="row"></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection