@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-0">
                <div class="panel panel-primary">
                    <div class="panel-heading"><strong> Formulario de Gestión </strong></div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'home', 'method' => 'POST']) !!}
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
                                {{ Form::label('contact_name', 'Persona de Contacto', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('contact_name', $customer->contact_name, ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('position', 'Cargo', ['class' => 'col-sm-1 control-label']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('position', $customer->position, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('phone1', 'Teléfonos', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::text('phone1', $customer->phone1, ['class' => 'form-control']) }}
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
                                    {{ Form::text('email1', $customer->email1, ['class' => 'form-control']) }}
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
                                    {{ Form::text('web', $customer->web, ['class' => 'form-control']) }}
                                </div>
                            </div>
                                <div class="form-group">
                                    {{ Form::label('type', 'Tipo', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-2">
                                        {{ Form::text('type', $customer->bstype->type, ['class' => 'form-control']) }}
                                    </div>
                                    {{ Form::label('size', 'Tamaño', ['class' => 'col-sm-1 control-label']) }}
                                    <div class="col-sm-2">
                                        {{ Form::text('size', $customer->bstype->size, ['class' => 'form-control']) }}
                                    </div>
                                    {{ Form::label('quantity', 'N° Locales', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-2">
                                        {{ Form::text('quantity', $customer->bstype->quantity, ['class' => 'form-control']) }}
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
                            <hr>
                            @if(count($managements) != 0)
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                    <th>Gestiones</th>
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
                            <div class="group-form" align="center">
                                <a href="{{ URL::to( 'managements/' . $previous ) }}" class="btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></a>
                                <a href="{{ URL::to( 'managements/' . $next ) }}" class="btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></a>
                            </div>
                        </div>
                        {{form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection