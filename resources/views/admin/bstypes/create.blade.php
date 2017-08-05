@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Agregar Nueva Clasificación de Restaurant</div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'BstypeController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{ Form::label('type', 'Clasificación') }}
                            {{ Form::text('type', null, ['class' => 'form-control', 'required', 'placeholder' => 'Indique nueva Clasificación']) }}
                        </div>

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

