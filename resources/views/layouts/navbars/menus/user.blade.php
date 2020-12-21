<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard',['token' => $uuid]) }}">
          <i class="ni ni-tv-2 text-primary"></i> {{ __('Tablero') }}
        </a>
      </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard.user.perfil',['token' => $uuid]) }}">
      <i class="ni ni-basket text-orange"></i> {{ __('Mi Perfil') }}
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard.user.misordenes',['token' => $uuid]) }}">
      <i class="ni ni-ungroup text-green"></i> {{ __('Mis Ordenes') }}
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard.user.misdirecciones',['token' => $uuid]) }}">
      <i class="ni ni-map-big text-green"></i> {{ __('Mis Direcciones') }}
    </a>
  </li>
</ul>
