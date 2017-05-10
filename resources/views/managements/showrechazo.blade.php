@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include('layouts.clientinfo')
                <div class="panel panel-primary">
                    <div class="panel-heading">Agregar Nueva Gestión (Rechazo)-> <strong>{{ $customer->name }}</strong></div>
                    @include('layouts.errors')
                    <div class="panel-body">
                        {!! Form::open(['route' => ['managements.store', $customer->id], 'method' => 'POST']) !!}
                        {{ Form::hidden('status', '3') }}
                        <div class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('description', 'Nueva Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2', 'cols' => '40', 'style' => 'resize:none', 'required']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                    {{ Form::label('st_status', 'Estatus', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::select('st_details', ['Usan Tomates Naturales' , 'Precio', 'Usan Salsa para Pizza','Usan Concentrado', 'Usan otro Producto', 'Presentación'],0, ['class' => 'form-control']) }}
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