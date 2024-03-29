@extends('base')

<style>
    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
</style>

@section('content')

    <div class="text-center">
        <form class="form-signin" method="POST">
            @csrf
            <label for="login" class="sr-only">Почта (Email)</label>
            <input type="email" id="login" name="login" class="form-control" placeholder="Почта (Email)" value="{{ old('login') }}" required=""
                autofocus="">
            <label for="password" class="sr-only">Пароль</label>
            <input type="password" name="password" id="password" class="form-control mb-3" placeholder="Пароль"
                required="">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled" style="margin: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>
        </form>
    </div>
@endsection
