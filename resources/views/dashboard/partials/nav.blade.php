<nav class="navbar navbar-top navbar-expand-md  navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="/">Bienvenido {{$user->name}}</a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">

            <li class="nav-item dropdown">
                <a class="nav-link pr-0"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;"  onclick="localStorage.removeItem('userInfo'); localStorage.removeItem('uuid'); localStorage.removeItem('accessToken'); location.href='/';">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img id="profile-image-nav" alt="..." src="https://www.gravatar.com/avatar/owner@example.com"  onclick="localStorage.removeItem('userInfo'); localStorage.removeItem('uuid'); localStorage.removeItem('accessToken'); location.href='/';">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                        <span class="mb-0 text-sm  font-weight-bold">Cerrar Sesión</span>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</nav>
