@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include('layouts.clientinfo')
                <div class="panel panel-primary">
                    <div class="panel-heading">Nueva Gestión (Muestras) -> <strong>{{ $customer->name }}</strong></div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['managements.storeDatos', $customer], 'method' => 'PUT']) !!}
                        {{ Form::hidden('status', $customer->status) }}
                        <div class="form-horizontal">
                                <div class="form-group">
                                    {{ Form::label('rut', 'Rut', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-9">
                                        {{ Form::text('rut', $customer->rut, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('bs_name', 'Razon Social', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-9">
                                        {{ Form::text('bs_name', $customer->bs_name, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('phone1', 'Teléfonos', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::text('phone1', $customer->phone1, ['class' => 'form-control', 'disabled']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('phone2', $customer->phone2, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('phone3', $customer->phone3, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('email1', 'Correo', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::text('email1', $customer->email1, ['class' => 'form-control', 'disabled']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('email2', $customer->email2, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('email3', $customer->email3, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                        </div>
                    </div>
                            <hr>
                            <div class="form-group" align="center">
                                {{ Form::submit('Agregar', ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection