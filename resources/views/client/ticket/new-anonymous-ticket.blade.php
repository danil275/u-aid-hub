@extends('base')

@section('header')
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('home') }}" class="nav-link px-2 text-secondary">Главная</a></li>
            </ul>
        </div>
    </div>
</header>
@endsection

@section('content')
<h1>Новая заявка</h1>
<div class="container py-3">
    <form class="mb-3" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Электронная почта</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" maxlength="50" value="{{ old('email') }}">
            @error('email')
            <div class="invalid-feedback display: block;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Тема</label>
            <input class="form-control @error('title') is-invalid @enderror" list="titleDatalist" id="title" name="title" placeholder="" maxlength="50" value="{{ old('title') }}">
            @error('title')
            <div class="invalid-feedback display: block;">
                {{ $message }}
            </div>
            @enderror
            <datalist id="titleDatalist">
                <option value="">
            </datalist>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Опишите проблему</label>
            <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text" rows="3" maxlength="300">{{ old('text') }}</textarea>
            @error('text')
            <div class="invalid-feedback display: block;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection