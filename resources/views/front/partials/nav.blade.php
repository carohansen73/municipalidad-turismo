<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{!! url('/') !!}">
            <img src="{!! url('imagenes/logo-main/' . $siteConfiguration->logo_main) !!}" alt="Turismo Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
            <ul class="navbar-nav">
                @if (Request::is('/'))
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#circuitos">Circuitos</a></li>
                    <li><a href="#lugares">Lugares</a></li>
                    <li><a href="#noticias">Noticias</a></li>
                    <li><a href="#eventos">Eventos</a></li>
                    <li><a href="#equipo">Equipo</a></li>
                    <li><a href="{!! route('servicios') !!}">Servicios</a></li>
                @else
                    <li><a href="{!! url('/') !!}">Inicio</a></li>
                    <li><a href="{!! route('news') !!}">Noticias</a></li>
                    <li><a href="{!! route('events') !!}">Eventos</a></li>
                    <li><a href="{!! route('servicios') !!}">Servicios</a></li>
                @endif
                @auth
                    <li><a href="{!! route('dashboard') !!}">Panel</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
