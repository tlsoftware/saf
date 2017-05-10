@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include('layouts.clientinfo')
                <div class="panel panel-primary">
                    <div class="panel-heading">Agrregar Nueva Gestión (Venta) -> <strong>{{ $customer->name }}</strong></div>
                    @include('layouts.errors')
                    <div class="panel-body">
                        {!! Form::open(['route' => ['managements.store', $customer->id], 'method' => 'POST']) !!}
                        {{ Form::hidden('status', '4') }}
                        <div class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('description', 'Nueva Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2', 'cols' => '40', 'style' => 'resize:none', 'required']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('product_id', 'Producto', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-4">
                                    {{ Form::select('product_id', $products, null, ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('quantity', 'Cantidad', ['class' => 'col-sm-1 control-label']) }}
                                <div class="col-sm-1">
                                    {{ Form::number('quantity', 1, ['class' => 'form-control']) }}
                                </div>
                                    {{ Form::label('price', 'Precio', ['class' => 'col-sm-1 control-label']) }}
                                    <div class="col-sm-2">
                                        {{ Form::number('price', 0, ['class' => 'form-control']) }}
                                    </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('dispatch_date', 'Fecha Despacho', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::date('dispatch_date', null, ['class' => 'form-control datepicker', 'onkeypress' => 'return false', 'required']) }}
                                    
                                </div>
                                    {{ Form::label('dispatch_time', 'Hora Despacho', ['class' => 'col-sm-3 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::time('dispatch_time', null, ['class' => 'form-control']) }}
                                    </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('next_mng', 'Próxima Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::date('next_mng', null, ['class' => 'form-control', 'required', 'onkeypress' => 'return false', 'required']) }}
                                </div>
                                <div class="form-group">
                                        {{ Form::label('st_status', 'Estatus', ['class' => 'col-sm-2 control-label']) }}
                                        <div class="col-sm-3">
                                             {{ Form::select('st_details', ['En Gestión', 'Baja' ,'Promesa de Compra', 'Venta'], 0, ['class' => 'form-control']) }}
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
    <script>
    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true
    });
</script>
@endsection