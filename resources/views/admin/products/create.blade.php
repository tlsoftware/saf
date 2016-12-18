@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Agragar Nuevo Producto</div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'ProductController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{ Form::label('code', 'Código') }}
                            {{ Form::text('code', null, ['class' => 'form-control', 'required', 'placeholder' => 'Código de Producto']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('name', 'Nombre del Producto') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre de Producto']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::submit('Aceptar', ['class' => 'btn btn-primary']) }}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

