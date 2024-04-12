@extends('base')

@section('content')
<h1>Заявки</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Заголовок</th>
            <th scope="col">Время создания</th>
            <th scope="col">Статус</th>
            <th scope="col">Группа</th>
            <th scope="col">Владелец</th>
            <th scope="col">Создатель</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $t)
        <tr>
            <th scope="row">1</th>
            <td></td>
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