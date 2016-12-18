@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Cliente "<strong>{{ $customer->name }}"</strong></div>

                    <div class="panel-body">
                        {!! Form::open(['route' => ['customers.update', $customer], 'method' => 'PUT']) !!}
                        <div class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('rut', 'Rut', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('rut', $customer->rut, ['class' => 'form-control', 'placeholder' => 'Escriba Rut del Cliente']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('bs_name', 'Razon Social', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('bs_name', $customer->bs_name, ['class' => 'form-control', 'required', 'placeholder' => 'Escriba Razon Social del Cliente']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('name', 'Nombre Comercial', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('name', $customer->name, ['class' => 'form-control', 'placeholder' => 'Escriba Nombre Comercial del Cliente']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('contact_name', 'Persona de Contacto', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('contact_name', $customer->contact_name, ['class' => 'form-control', 'required',  'placeholder' => 'Nombre de Persona de Contacto']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('position', 'Cargo', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('position', $customer->position, ['class' => 'form-control', 'placeholder' => 'Cargo de Persona de Contacto']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('phone1', 'Teléfonos', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::text('phone1', $customer->phone1, ['class' => 'form-control', 'required', 'placeholder' => 'Telefono Principal']) }}
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::text('phone2', $customer->phone2, ['class' => 'form-control', 'placeholder' => 'Telefono Adicional 1']) }}
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::text('phone3', $customer->phone3, ['class' => 'form-control', 'placeholder' => 'Telefono Adicional 2']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('email1', 'Correo', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::text('email1', $customer->email1, ['class' => 'form-control', 'placeholder' => 'Correo Principal']) }}
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::text('email2', $customer->email2, ['class' => 'form-control', 'placeholder' => 'Correo Adicional 1']) }}
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::text('email3', $customer->email3, ['class' => 'form-control', 'placeholder' => 'Correo Adicional 2']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('web', 'Pagina Web', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('web', $customer->web, ['class' => 'form-control', 'placeholder' => 'Pagina Web del Cliente']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('user_id', 'Responsable', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::select('user_id', $users, $customer->user_id, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('next_mng', 'Próxima Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::date('next_mng', Carbon\Carbon::parse($customer->next_mng)->format('d-m-Y'), ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-6 col-sm-11">
                                    {{ Form::submit('Editar', ['class' => 'btn btn-primary']) }}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection