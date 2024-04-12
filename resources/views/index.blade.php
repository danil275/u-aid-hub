@extends('base')

@section('title', 'Главная')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<a href="{{ route('new-anonymous-ticket') }}">
    <button type="button" class="btn btn-outline-dark">Оставить заявку без входа</button>
</a>

@endsection