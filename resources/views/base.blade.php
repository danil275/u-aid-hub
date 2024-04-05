<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script type="text/javascript" src="{{ asset('assets/bootstrap/5.3.3/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/5.3.3/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    @yield('head')
</head>

<body>
    @yield('header', View::make('layouts.header'))

    <div class="container py-3">
        @yield('content')
    </div>
    
    @include('layouts.footer')
</body>

</html>