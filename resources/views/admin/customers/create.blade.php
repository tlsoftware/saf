@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-primary">
                    <div class="panel-heading">Agregar Nuevo Cliente</div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @if ($errors->has('phone1'))
                                <li>{{ "Numero de telefono Principal no valido" }}</li>
                            @endif
                            @if ($errors->has('phone2'))
                               <li>{{ "Numero de telefono Adicional 1 no valido" }}</li>
                            @endif
                            @if ($errors->has('phone2'))
                                <li>{{ "Numero de telefono Adicional 2 no valido" }}</li>
                            @endif
                        </div>
                    @endif
                    <div class="panel-body">
                        {!! Form::open(['route' => 'customers.store', 'method' => 'POST']) !!}
                        <div class="form-horizontal">
                            <div class="form-group">
                                    {{ Form::label('rut', 'Rut', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('rut', null, ['class' => 'form-control', 'placeholder' => 'Escriba Rut del Cliente']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                    {{ Form::label('bs_name', 'Razon Social', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('bs_name', null, ['class' => 'form-control', 'placeholder' => 'Escriba Razon Social del Cliente']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('name', 'Nombre Comercial', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Escriba Nombre Comercial del Cliente']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('contact_name', 'Persona de Contacto', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('contact_name', null, ['class' => 'form-control', 'required',  'placeholder' => 'Nombre de Persona de Contacto']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('position', 'Cargo', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('position', null, ['class' => 'form-control', 'placeholder' => 'Cargo de Persona de Contacto']) }}
                                </div>
                                {{ Form::label('bstype_id', 'Tipo de Empresa', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::select('bstype_id', $bstypes, null, ['class' => 'form-control']) }}
                                </div>
                            </div>

                                <div class="form-group">
                                    {{ Form::label('phone1', 'Teléfonos', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::text('phone1', null, ['class' => 'form-control', 'required', 'placeholder' => '+56912341234']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('phone2', null, ['class' => 'form-control', 'placeholder' => '+56912341234']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('phone3', null, ['class' => 'form-control', 'placeholder' => '+56912341234']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('email1', 'Correo', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::email('email1', null, ['class' => 'form-control', 'required','placeholder' => 'example@gmail.com']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::email('email2', null, ['class' => 'form-control', 'placeholder' => 'example@gmail.com']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::email('email3', null, ['class' => 'form-control', 'placeholder' => 'example@gmail.com']) }}
                                    </div>
                                </div>
                            <div class="form-group">
                                {{ Form::label('web', 'Pagina Web', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('web', null, ['class' => 'form-control', 'placeholder' => 'Pagina Web del Cliente']) }}
                                </div>
                            </div>
                            @if(Auth::user()->admin)
                                <div class="form-group">
                                    {{ Form::label('user_id', 'Responsable', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::select('user_id', $users, null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            @endif
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-6 col-sm-11">
                                    {{ Form::submit('Agregar', ['class' => 'btn btn-primary']) }}
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