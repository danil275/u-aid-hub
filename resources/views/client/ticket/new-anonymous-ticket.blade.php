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
<h2>Новая заявка</h2>
<div class="container py-3">
    <form>
        <div class="mb-3">
            <label for="email" class="form-label">Электронная почта</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="theme" class="form-label">Тема</label>
            <input class="form-control" list="themeDatalist" id="theme" placeholder="">
            <datalist id="themeDatalist">
                <option value="">
            </datalist>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Опишите проблему</label>
            <textarea class="form-control" id="text" name="text" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>

@endsection