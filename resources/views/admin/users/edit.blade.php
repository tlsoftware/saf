@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Editar Usuario <strong>{{ $user->name }}</strong></div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['users.update', $user], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre') }}
                            {{ Form::text('name', $user->name, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre Completo']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Correo Electrónico') }}
                            {{ Form::email('email', $user->email, ['class' => 'form-control', 'required', 'placeholder' => 'ejemplo@gmail.com']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Contraseña') }}
                            {{ Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => '********']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('role', 'Perfil de Usuario') }}
                            {{ Form::select('role', $roles, $user->role, ['class' => 'form-control', 'required']) }}
                        </div>
                        <hr>
                        <div class="form-group" align="center">
                            {{ Form::submit('Aceptar', ['class' => 'btn btn-primary']) }}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection