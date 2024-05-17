<h1>Заявка закрыта №{{ $ticket->id }}</h1>

@if($ticket->is_anon)
<a href="{{ route('show-anonymous-ticket', $ticket) }}">{{ $ticket->title }}</a>
@else
<a href="{{ route('client-show-ticket', $ticket) }}">{{ $ticket->title }}</a>
@endif

@if($text)
<p>{{ $text }}</p>
@endif