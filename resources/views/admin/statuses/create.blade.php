@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Crear Nuevo Estaus Detallado</div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'StatusController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{ Form::label('status_id', 'Estatus General') }}
                            {{ Form::select('status_id', $statuses, null, ['class' => 'form-control', 'required']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('name', 'Estatus Detallado') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
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

