<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">

            </a>

            @auth

            @if(auth()->user()->roles()->where('name', App\Enums\AppRole::Agent)->count() > 0)
            @include('layouts.agent-nav')
            @endif

            @if(auth()->user()->roles()->where('name', App\Enums\AppRole::Client)->count() > 0)
            @include('layouts.client-nav')
            @endif

            @endauth


            @guest
            @include('layouts.default-nav')
            @endguest

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