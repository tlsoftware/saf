@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Migrar Clientes del Usuario: <strong>{{ $user->name }}</strong></div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'migrate', 'method' => 'PUT']) !!}
                        <hr>
                        Seleccione Usuario al cual se asignaran los Clientes de <strong>{{ $user->name }}</strong>
                        <div class="form-group">
                            <br>
                            {{ Form::label('user_id', 'Responsable', ['class' => 'col-sm-2 control-label']) }}
                            <div class="col-sm-3">
                                {{ Form::select('user2_id', $users2, null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <br>
                        <hr>
                        @include('admin.migrate.table')
                        <br>
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