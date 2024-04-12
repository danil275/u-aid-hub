@extends('base')

@section('title', 'Пользователь')

@section('content')
<h1>Мой профиль</h1>
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Email</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->email }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Пароль</p>
            </div>
            <div class="col-sm-9">
                <a href=""><button class="btn btn-sm btn-outline-dark">Сменить пароль</button></a>
            </div>
        </div>
    </div>
</div>
@endsection