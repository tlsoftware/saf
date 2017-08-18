<li ><a href="{{ action('HomeController@index') }}">Pendientes<span class="sr-only"></span></a></li>
<li ><a href="{{ action('CobranzasController@index') }}">Cobranzas<span class="sr-only"></span></a></li>
@if(Auth::user()->isAdmin())
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Administración <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('users.index') }}">Usuarios</a></li>
            <li><a href="{{ route('products.index') }}">Productos</a></li>
            <li><a href="{{ route('statuses') }}">Estatus</a></li>
            <li><a href="{{ route('bstypes.index') }}">Clasificación de Clientes</a></li>
            <li><a href="{{ route('carga_masiva') }}">Carga Masiva</a></li>
        </ul>
    </li>
@endif

@if(Auth::user()->isAdmin() or Auth::user()->isSupervisor())
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Supervisión <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('gestiones') }}">Gestiones</a></li>
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
            <li><a href="{{ action('RechazoCustomerController@show') }}">Rechazos</a></li>
            <li><a href="{{ action('BajaCustomerController@show') }}">Bajas</a></li>
            <li><a href="{{ action('TodosCustomerController@show') }}">Todos</a></li>
        </ul>
    </li>


