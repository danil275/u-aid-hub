@extends('base')

@section('title', 'Главная')


@section('content')

<div class="accordion" id="ticket_queue">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Заявки в очереди
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#ticket_queue">
            <div class="accordion-body">
                
            </div>
        </div>
    </div>
</div>
@endsection