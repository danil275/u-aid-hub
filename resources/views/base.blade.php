<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script type="text/javascript" src="{{ asset('assets/bootstrap/5.3.3/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/5.3.3/css/bootstrap.min.css') }}">
</head>

<body>
    @include('header')
    @yield('content')
    @include('footer')
</body>

</html>