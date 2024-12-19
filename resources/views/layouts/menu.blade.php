<li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('dashboard') !!}">
        <i class="nav-icon fa fa-dashboard"></i>
        <span>Dashboard</span>
    </a>
</li>

<li class="nav-item {{ Request::is('banners*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('banners.index') !!}">
        <i class="nav-icon fa fa-image"></i>
        <span>Banner</span>
    </a>
</li>

<li class="nav-item {{ Request::is('lugar*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('lugar.index') }}">
        <i class="nav-icon fa fa-map-signs"></i>
        <span>Lugares</span>
    </a>
</li>

<li class="nav-item {{ Request::is('posts*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('posts.index') !!}">
        <i class="nav-icon fa fa-newspaper-o"></i>
        <span>Posts</span>
    </a>
</li>

<li class="nav-item {{ Request::is('acontecimientos*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('acontecimientos.index') !!}">
        <i class="nav-icon fa fa-calendar"></i>
        <span>Acontecimientos</span>
    </a>
</li>

<li class="nav-item {{ Request::is('equipo*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('equipo.index') !!}">
        <i class="nav-icon fa fa-users"></i>
        <span>Equipo</span>
    </a>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon fa fa-cogs"></i> Parámetros</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item {{ Request::is('parametros/posts/categorias*') ? 'active' : '' }}">
        <a class="nav-link" href="{!! route('posts.categorias.index') !!}">
            <i class="nav-icon fa fa-tag"></i> Cat. de Post</a>
        </li>
        <li class="nav-item {{ Request::is('parametros/posts/tags*') ? 'active' : '' }}">
        <a class="nav-link" href="{!! route('posts.tags.index') !!}">
            <i class="nav-icon fa fa-tags"></i> Tags de Post</a>
        </li>
        @if (Auth::user()->isSuperAdmin())
        <li class="nav-item {{ Request::is('parametros/redes*') ? 'active' : '' }}">
        <a class="nav-link" href="{!! route('redes.index') !!}">
            <i class="nav-icon fa fa-at"></i> Redes sociales</a>
        </li>
        @endif
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon fa fa-cogs"></i> Servicios</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item {{ Request::is('service-providers*') ? 'active' : '' }}">
        <a class="nav-link" href="{!! route('service-providers.index') !!}">
            <i class="nav-icon fa fa-tag"></i> Proveedores de servicios </a>
        </li>
        {{-- <li class="nav-item {{ Request::is('parametros/posts/tags*') ? 'active' : '' }}">
        <a class="nav-link" href="{!! route('posts.tags.index') !!}">
            <i class="nav-icon fa fa-tags"></i> Amenities </a>
        </li>
        @if (Auth::user()->isSuperAdmin())
        <li class="nav-item {{ Request::is('parametros/redes*') ? 'active' : '' }}">
        <a class="nav-link" href="{!! route('redes.index') !!}">
            <i class="nav-icon fa fa-at"></i> Tipos de proveedores </a>
        </li>
        @endif --}}
    </ul>
</li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon fa fa-wrench"></i> Configuraciones</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item {{ Request::is('configuraciones/sitio/redes*') ? 'active' : '' }}">
        <a class="nav-link" href="{!! route('sitio.redes.index') !!}">
            <i class="nav-icon fa fa-cog"></i> Redes sociales sitio</a>
        </li>

        <li class="nav-item {{ Request::is('configuraciones-del-sitio*') ? 'active' : '' }}">
        <a class="nav-link" href="{!! route('siteConfigurations.edit') !!}">
            <i class="nav-icon fa fa-cog"></i> Configuraciones</a>
        </li>

        @if (Auth::user()->isSuperAdmin())
            <li class="nav-item {{ Request::is('usuarios*') ? 'active' : '' }}">
            <a class="nav-link" href="{!! route('usuarios.index') !!}">
                <i class="nav-icon fa fa-users"></i> Usuarios</a>
            </li>
        @endif
    </ul>
</li>

{{--<li class="nav-item {{ Request::is('parametros/posts/categorias*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('posts.categorias.index') !!}">
        <i class="nav-icon fa fa-tag"></i>
        <span>Cat. de Post</span>
    </a>
</li>
<li class="nav-item {{ Request::is('parametros/posts/tags*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('posts.tags.index') !!}">
        <i class="nav-icon fa fa-tags"></i>
        <span>Tags de Post</span>
    </a>
</li>
<li class="nav-item {{ Request::is('parametros/redes*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('redes.index') !!}">
        <i class="nav-icon fa fa-at"></i>
        <span>Redes sociales</span>
    </a>
</li>

<li class="nav-item {{ Request::is('postGaleryImages*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('postGaleryImages.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Post Galery Images</span>
    </a>
</li>

<li class="nav-item {{ Request::is('siteSocialNetworks*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('sitio.redes.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Site Social Networks</span>
    </a>
</li>

<li class="nav-item {{ Request::is('siteConfigurations*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('siteConfigurations.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Site Configurations</span>
    </a>
</li>--}}
