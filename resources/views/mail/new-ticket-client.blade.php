<h1>Заявка зарегистрирована №{{ $ticket->id }}</h1>

@if($ticket->is_anon)
<a href="{{ route('show-anonymous-ticket', $ticket) }}">{{ $ticket->title }}</a>
@else
<a href="{{ route('client-show-ticket', $ticket) }}">{{ $ticket->title }}</a>
@endif