<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">

            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('home') }}" class="nav-link px-2 {{ Route::currentRouteNamed('home') ? 'text-secondary' : 'text-white' }}">Главная</a></li>
                @can('admin')<li><a href="{{ route('admin') }}" class="nav-link px-2 {{ Route::currentRouteNamed('admin') ? 'text-secondary' : 'text-white' }}">Администрирование</a></li>@endcan
            </ul>

            @guest
            <div class="text-end">
                <a href="{{ route('login') }}"><button type="button" class="btn btn-outline-light me-2">Войти</button></a>
            </div>
            @endguest

            @auth
            <div class="dropdown text-end">
                <a href="#" class="d-block text-decoration-none dropdown-toggle link-light" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ auth()->user()->email }}
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{ route('user') }}">Настройки</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Выход</a></li>
                </ul>
            </div>
            @endauth
        </div>
    </div>
</header>