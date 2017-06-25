<li ><a href="{{ action('HomeController@index') }}">Home<span class="sr-only"></span></a></li>
@if(Auth::user()->isAdmin())
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Administracion <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('users.index') }}">Usuarios</a></li>
            <li><a href="{{ route('products.index') }}">Productos</a></li>
            <li><a href="{{ route('statuses') }}">Estatus</a></li>
            <li><a href="{{ route('carga_masiva') }}">Carga Masiva</a></li>
            <li><a href="{{ route('gestiones') }}">Gestiones</a></li>
        </ul>
    </li>
@endif

@if(Auth::user()->isAdmin() or Auth::user()->isSupervisor())
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Supervision <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('gestiones') }}">Gestiones del Dia</a></li>
        </ul>
    </li>
@endif

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Clientes <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ action('PotencialCustomerController@show') }}">Potenciales</a></li>
            <li><a href="{{ action('MuestraCustomerController@show') }}">Muestras</a></li>
            <li><a href="{{ action('ActivoCustomerController@show') }}">Activos</a></li>
            @if(Auth::user()->isAdmin() or Auth::user()->isSupervisor())
                <li><a href="{{ action('RechazoCustomerController@show') }}">Rechazos</a></li>
                <li><a href="{{ action('BajaCustomerController@show') }}">Bajas</a></li>
            @endif
            <li><a href="{{ action('TodosCustomerController@show') }}">Todos</a></li>
        </ul>
    </li>


