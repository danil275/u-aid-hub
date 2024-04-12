@extends('base')


@section('content')
<h2>Новая заявка</h2>

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

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection