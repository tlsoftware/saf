@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Migrar Clientes del Usuario: <strong>{{ $user->name }}</strong></div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['migrate', $user->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre') }}
                            {{ Form::text('name', $user->name, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre Completo']) }}
                        </div>
                        <hr>
                        Seleccione Usuarios donde se Migraran los Clientes
                        <div class="form-group">
                            {{ Form::label('user_id', 'Responsable', ['class' => 'col-sm-2 control-label']) }}
                            <div class="col-sm-3">
                                {{ Form::select('user2_id', $users2, null, ['class' => 'form-control']) }}
                            </div>
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