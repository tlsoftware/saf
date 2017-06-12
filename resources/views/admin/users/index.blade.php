@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-primary">
                    <div class="panel-heading">Usuarios Registrados</div>
                    <div class="panel-body">
                        <a href="{{ route('users.create') }}" class="btn btn-info"> Agregar Usuario</a>
                        <hr>
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Tipo</th>
                            <th>Acción</th>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->admin)
                                            <span class="label label-danger">Administrador</span>
                                        @else
                                            <span class="label label-primary">Vendedor</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                                        <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar al Usuario? {{ $user->name }}')"><span class="glyphicon glyphicon-remove"></span></a>
                                        <a href="{{ route('migrate', $user->id) }}" class="btn btn-default"><span class="glyphicon glyphicon-transfer"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $users->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection