@extends('base')

@section('title', 'Главная')


@section('content')

<div class="accordion md-3" id="accordion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Заявки в работе
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
            <div class="accordion-body">
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
                        @foreach($ticketsInWork as $t)
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
                <div class="d-flex justify-content-center">{{ $ticketsInWork->links() }}</div>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Заявки в очереди
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
            <div class="accordion-body">
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
                        @foreach($ticketsInQueue as $t)
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
                <div class="d-flex justify-content-center">{{ $ticketsInQueue->links() }}</div>
            </div>
        </div>
    </div>

</div>


@endsection