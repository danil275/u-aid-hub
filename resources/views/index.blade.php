@extends('base')

@section('title', 'Главная')

@section('content')

@guest
<a href="{{ route('new-anonymous-ticket') }}">
    <button type="button" class="btn btn-outline-dark">Оставить заявку без входа</button>
</a>
@endguest

@auth

@if(auth()->user()->roles()->where('name', App\Enums\AppRole::Agent)->count() > 0)
<a href="{{ route('new-anonymous-ticket') }}">
    <button type="button" class="btn btn-outline-dark">Внести заявку</button>
</a>
@endif

@if(auth()->user()->roles()->where('name', App\Enums\AppRole::Client)->count() > 0)
<a href="{{ route('client-create-ticket') }}">
    <button type="button" class="btn btn-outline-dark">Оставить заявку</button>
</a>
@endif

@endauth

@endsection