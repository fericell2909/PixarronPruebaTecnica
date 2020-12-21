<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard',['token' => $uuid]) }}">
      <i class="ni ni-tv-2 text-primary"></i> {{ __('Tablero') }}
    </a>
  </li><li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard.admin.usuarios',['token' => $uuid]) }}">
      <i class="ni ni-basket text-orange"></i> {{ __('L. de Usuarios') }}
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard.admin.misordenes',['token' => $uuid]) }}">
      <i class="ni ni-ungroup text-green"></i> {{ __('L. de Ordenes') }}
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard.admin.users.direcciones',['token' => $uuid]) }}">
      <i class="ni ni-map-big text-green"></i> {{ __('L. de Usuarios - Direcciones') }}
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard.admin.orders.user',['token' => $uuid]) }}">
      <i class="ni ni-map-big text-green"></i> {{ __('L. de Ordenes - Usuario') }}
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard.admin.products',['token' => $uuid]) }}">
      <i class="ni ni-map-big text-green"></i> {{ __('L. de Productos') }}
    </a>
  </li>
</ul>
