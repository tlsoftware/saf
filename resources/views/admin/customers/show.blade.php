@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <a href="{{ action('ManagementController@create', $customer->id) }}" class="btn btn-info">Agregar Gestion</a>
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-info">Editar Cliente</a>
                        <hr>
                        {!! Form::open(['route' => ['customers.show', $customer], 'method' => 'POST']) !!}
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
                                {{ Form::label('contact_name', 'Persona de Contacto', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('contact_name', $customer->contact_name, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('position', 'Cargo', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
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
                                {{ Form::label('web', 'Pagina Web', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('web', $customer->web, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('user_id', 'Responsable', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('user_id', $customer->user->name, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('next_mng', 'Próxima Gestión', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-3">
                                    {{ Form::text('next_mng', $customer->next_mng, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <hr>
                            <hr>
                        </div>
                        </fieldset>
                        {!! Form::close() !!}

                        @if(count($managements) != 0)
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                <th>ID</th>
                                <th>Descripcion</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Fecha</th>
                                </thead>
                                <tbody>
                                    @foreach($managements as $management)
                                        <tr>
                                            <td>{{ $management->id }}</td>
                                            <td>{{ $management->description }}</td>
                                            <td>{{ $management->product }}</td>
                                            <td>{{ $management->quantity }}</td>
                                            <td>{{ $management->price }}</td>
                                            <td>{{ $management->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger">
                                <strong> El Cliente no posee Gestiones!! </strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection