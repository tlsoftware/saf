<li ><a href="{{ action('HomeController@index') }}">Home<span class="sr-only"></span></a></li>
@if(Auth::user()->admin)
    <li><a href="{{ route('users.index') }}">Usuarios</a></li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Clientes <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('customers.index') }}">Potenciales</a></li>
            <li><a href="#">Muestras Entregadas</a></li>
            <li><a href="#">Activos</a></li>

        </ul>
    </li>
@else
    <li><a href="#">Clientes</a></li>
@endif


