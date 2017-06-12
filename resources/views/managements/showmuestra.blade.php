@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include('layouts.clientinfo')
                <div class="panel panel-primary">
                    <div class="panel-heading">Agrregar Nueva Gestión (Muestras) -> <strong>{{ $customer->name }}</strong></div>
                    @include('layouts.errors')
                    <div class="panel-body">
                        {!! Form::open(['route' => ['managements.store', $customer->id], 'method' => 'POST']) !!}
                        <div class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('description', 'Nueva Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-8">
                                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '6', 'cols' => '40', 'style' => 'resize:none', 'required']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('product_id', 'Producto', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-5">
                                    {{ Form::select('product_id', $products, null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('dispatch_date', 'Fecha Despacho', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::text('dispatch_date', null, ['class' => 'form-control datepicker', 'required', 'readonly', 'placeholder' => 'Indique Fecha']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('dispatch_time', 'Hora Despacho', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::time('dispatch_time', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('next_mng', 'Próxima Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::text('next_mng', null, ['class' => 'form-control datepicker', 'required', 'readonly', 'placeholder' => 'Indique Fecha']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('status_detail_id', 'Estatus', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::select('status_detail_id', $statuses_detail, null, ['class' => 'form-control']) }}
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