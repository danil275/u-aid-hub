@extends('base')

@section('title', 'Главная')

@section('content')

@guest
<a href="{{ route('new-anonymous-ticket') }}">
    <button type="button" class="btn btn-outline-dark">Оставить заявку без входа</button>
</a>
@endguest

@endsection