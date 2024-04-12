<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
    <li><a href="{{ route('home') }}" class="nav-link px-2 {{ Route::currentRouteNamed('home') ? 'text-secondary' : 'text-white' }}">Главная</a></li>
    <li><a href="{{ route('agent-tickets') }}" class="nav-link px-2 {{ Route::currentRouteNamed('agent-tickets') ? 'text-secondary' : 'text-white' }}">Заявки</a></li>
    <li><a href="{{ route('admin') }}" class="nav-link px-2 {{ Route::currentRouteNamed('admin') ? 'text-secondary' : 'text-white' }}">Администрирование</a></li>
</ul>