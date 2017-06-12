@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Editar Información de Producto <strong>{{ $product->name }}</strong></div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['products.update', $product], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{ Form::label('code', 'Código') }}
                            {{ Form::text('code', $product->code, ['class' => 'form-control', 'required']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('name', 'Nombre del Producto') }}
                            {{ Form::text('name', $product->name, ['class' => 'form-control', 'required']) }}
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