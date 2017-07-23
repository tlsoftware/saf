@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-primary">
                    <div class="panel-heading"><strong> Formulario de Gestión </strong>
                         <span class="label label-danger pull-right">{{ $customer->status_detail->status->name }} ({{ $customer->status_detail->name }})</span>
                    </div>
                    <div class="panel-body">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addManagement" data-id="{{ $customer->id }}">Nueva Gestion</button>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMuestra" data-id="{{ $customer->id }}">Entrega de Muestra</button>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addVenta" data-id="{{ $customer->id }}" id="btn-addVenta">Agregar Venta</button>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addDatos" data-id="{{ $customer->id }}">Datos Adicionales</button>
                        <hr>
                        <fieldset disabled>
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
                                    {{ Form::label('name', 'Nombre Comercial', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-9">
                                        {{ Form::text('name', $customer->name, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            <div class="form-group">
                                {{ Form::label('contact_name', 'Contacto', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('contact_name', $customer->contact->name, ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('position', 'Cargo', ['class' => 'col-sm-1 control-label']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('position', $customer->contact->position, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('address', 'Direccion', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::text('address', $customer->address, ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('commune', 'Comuna', ['class' => 'col-sm-1 control-label']) }}
                                <div class="col-sm-2">
                                    {{ Form::text('commune', $customer->commune, ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('city', 'Ciudad', ['class' => 'col-sm-1 control-label']) }}
                                <div class="col-sm-2">
                                    {{ Form::text('city', $customer->city, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('phone1', 'Teléfonos', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::text('phone1', $customer->contact->phone->phone1, ['class' => 'form-control']) }}
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::text('phone2', $customer->contact->phone->phone2, ['class' => 'form-control']) }}
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::text('phone3', $customer->contact->phone->phone3, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('email1', 'Correo', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-2">
                                    {{ Form::text('email1', $customer->contact->email->email1, ['class' => 'form-control']) }}
                                </div>
                                <div class="col-sm-2">
                                    {{ Form::text('email2', $customer->contact->email->email2, ['class' => 'form-control']) }}
                                </div>
                                <div class="col-sm-2">
                                    {{ Form::text('email3', $customer->contact->email->email3, ['class' => 'form-control']) }}
                                </div>

                                <div class="col-sm-2">
                                    <button class="btn btn-info" id="btn-email"><span class="glyphicon glyphicon-envelope"></span></button>
                                    <a href="mailto:{{$customer->contact->email->email1}}">Enviar Correo</a>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('web', 'Página Web', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('web', $customer->web, ['class' => 'form-control']) }}
                                </div>
                                <div class="col-sm-2">
                                    <h4><span class="label label-warning">{{ $customer->status_detail->status->name }} ({{ $customer->status_detail->name }})</span></h4>
                                </div>
                                <div class="col-sm-2">
                                    @if($sale)
                                        <h4><span class="label label-danger">Ultima Venta: {{ Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($sale->created_at)) > 0 ? Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($sale->created_at)) . ' dias.' : 'Hoy' }}</span></h4>
                                    @else
                                        <h4><span class="label label-danger">Ultima Venta: Sin Venta </span></h4>
                                    @endif
                                </div>
                            </div>
                                <div class="form-group">
                                    {{ Form::label('type', 'Tipo', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-2">
                                        {{ Form::text('type', $customer->bstype->type, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            <div class="form-group">
                                {{ Form::label('next_mng', 'Próxima Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::text('next_mng', Carbon\Carbon::parse($customer->next_mng)->format('d-m-Y'), ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('dias', 'Días en Gestión', ['class' => 'col-sm-3 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::text('dias', Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($customer->created_at)), ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        </fieldset>
                        <hr>
                        @include('layouts.gestion')
                        @include('managements.modals.add_management')
                        @include('managements.modals.add_muestra')
                        @include('managements.modals.add_venta')
                        @include('managements.modals.add_datos')
                        <hr>
                        <div class="group-form" align="center">
                            <a href="{{ URL::to( 'managements/' . $previous ) }}" class="btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></a>
                            <a href="{{ URL::to( 'managements/' . $next ) }}" class="btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection