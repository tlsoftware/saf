<li ><a href="{{ action('HomeController@index') }}">Home<span class="sr-only"></span></a></li>
@if(Auth::user()->admin)
    <li><a href="{{ route('users.index') }}">Usuarios</a></li>
    <li><a href="{{ route('customers.index') }}">Clientes</a></li>
@else
    <li><a href="#">Clientes</a></li>
@endif