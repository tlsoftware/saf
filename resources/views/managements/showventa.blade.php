@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include('layouts.clientinfo')
                <div class="panel panel-primary">
                    <div class="panel-heading">Agrregar Nueva Gestión (Venta) -> <strong>{{ $customer->name }}</strong></div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['managements.store', $customer->id], 'method' => 'POST']) !!}
                        {{ Form::hidden('status', 3) }}
                        <div class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('description', 'Nueva Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2', 'cols' => '40', 'style' => 'resize:none']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('product_id', 'Producto', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-4">
                                    {{ Form::select('product_id', $products, null, ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('quantity', 'Cantidad', ['class' => 'col-sm-1 control-label']) }}
                                <div class="col-sm-1">
                                    {{ Form::text('quantity', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                    {{ Form::label('price', 'Precio', ['class' => 'col-sm-1 control-label']) }}
                                    <div class="col-sm-2">
                                        {{ Form::text('price', null, ['class' => 'form-control', 'required']) }}
                                    </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('dispatch_date', 'Fecha Despacho', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::date('dispatch_date', null, ['class' => 'form-control']) }}
                                </div>
                                    {{ Form::label('dispatch_time', 'Hora Despacho', ['class' => 'col-sm-3 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::time('dispatch_time', null, ['class' => 'form-control']) }}
                                    </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('next_mng', 'Próxima Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::date('next_mng', null, ['class' => 'form-control']) }}
                                </div>
                                    {{ Form::label('st_status', 'Estatus', ['class' => 'col-sm-3 control-label']) }}
                                    @include('layouts.stmenu')
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