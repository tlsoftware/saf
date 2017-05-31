@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Formulario de Gestión (Clientes con Muestras Entregadas)</div>

                    <div class="panel-body">
                        {!! Form::open(['route' => ['managements.store', $customer->id], 'method' => 'POST']) !!}
                            <div class="form-horizontal">
                                <fieldset disabled>
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
                                </fieldset>
                        <div class="form-group">
                                    {{ Form::label('contact_name', 'Persona de Contacto', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-4">
                                        {{ Form::text('contact_name', $customer->contact_name, ['class' => 'form-control']) }}
                                    </div>
                                    {{ Form::label('position', 'Cargo', ['class' => 'col-sm-1 control-label']) }}
                                    <div class="col-sm-4">
                                        {{ Form::text('position', $customer->position, ['class' => 'form-control', 'disabled']) }}
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
                                <div class="form-group">
                                    {{ Form::label('web', 'Página Web', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-9">
                                        {{ Form::text('web', $customer->web, ['class' => 'form-control', 'disabled']) }}
                                    </div>
                                </div>
                                @if(Auth::user()->admin)
                                    <div class="form-group">
                                        {{ Form::label('user_id', 'Responsable', ['class' => 'col-sm-2 control-label']) }}
                                        <div class="col-sm-9">
                                            {{ Form::text('user_id', $customer->user->name, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    {{ Form::label('next_mng', 'Próxima Gestión', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::text('next_mng', Carbon\Carbon::parse($customer->next_mng)->format('d-m-Y'), ['class' => 'form-control', 'disabled']) }}
                                    </div>
                                    {{ Form::label('dias', 'Días en Gestión', ['class' => 'col-sm-3 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::text('dias', Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($customer->created_at)), ['class' => 'form-control', 'disabled']) }}
                                    </div>
                                </div>
                                <hr>
                            </div>
                        @if(count($managements) != 0)
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                </thead>
                                <tbody>
                                @foreach($managements as $management)
                                    <tr>
                                        <td>
                                            <div class="col-sm-10">
                                                {{ Form::textarea('description', $management->description, ['class' => 'form-control', 'rows' => '2', 'cols' => '50', 'style' => 'resize:none', 'disabled']) }}
                                            </div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($management->created_at)->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger">
                                <strong> El Cliente no posee Gestiones!! </strong>
                            </div>
                        @endif
                        <hr>
                        <h4>Agregar Nueva Gestión</h4>
                        <hr>
                        <div class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('description', 'Nueva Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2', 'cols' => '40', 'style' => 'resize:none']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('next_mng', 'Próxima Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::date('next_mng', null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('status', 'Estatus', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::select('status', ['1' => 'Potencial Cliente' , '2' => 'Muestra Entregada', '3' => 'Cliente Activo', '4' => 'Cliente Rechazado' ], '2', ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" align="center">
                                {{ Form::submit('Agregar', ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection