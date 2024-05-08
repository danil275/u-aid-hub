@extends('base')


@section('content')
<h2>Новая заявка</h2>

<form class="md-3" action="{{ route('client-create-ticket') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Тема</label>
        <input class="form-control @error('title') is-invalid @enderror" list="titleDatalist" id="title" name="title" placeholder="" value="{{ old('title') }}">
        <datalist id="titleDatalist">
            <option value="">
        </datalist>
        @error('title')
        <div class="invalid-feedback display: block;">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Опишите проблему</label>
        <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text" rows="3">{{ old('text') }}</textarea>
        @error('text')
        <div class="invalid-feedback display: block;">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>

@endsection