@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading"> Pagina Principal </div>
                    <div class="panel-body">
                        <a href="{{ route('customers.create') }}" class="btn btn-info">Nuevo Cliente</a>
                        <!-- BUSCAR CLIENTES -->
                        {!! Form::open(['action' => 'CustomerController@index', 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
                        <div class="input-group">
                            {!! Form::text('bs_name', null, ['class' => 'form-control', 'placeholder' => 'Buscar Cliente..', 'aria-describedby' => 'search']) !!}
                            <span class="input-group-addon" id="search">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    </span>
                        </div>
                    {!! Form::close() !!}
                    <!-- FIN DEL BUSCADOR -->
                        <hr>
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                            <th>ID</th>
                            <th>Razon Social</th>
                            <th>Persona de Contacto</th>
                            <th>Telefono Principal</th>
                            <th>Responsable</th>
                            <th>Ultima Gestion</th>
                            <th>Gestion</th>
                            <th>Proxima Gestion</th>
                            <th>Estatus</th>
                            <th>Accion</th>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->bs_name }}</td>
                                    <td>{{ $customer->contact_name }}</td>
                                    <td>{{ $customer->phone1 }}</td>
                                    <td>{{ $customer->user()->first()->name }}</td>
                                    <td> Agregar </td> <!-- $customer->managements->last()->title -->
                                    <td> Agregar </td> <!--$customer->managements->last()->created_at -->
                                    <td>{{ $customer->next_mng }}</td>
                                    <td>
                                        @if($customer->status == 0)
                                            <span class="label label-danger">SIN GESTION</span>
                                        @elseif($customer->status == 1)
                                            <span class="label label-primary">POTENCIAL</span>
                                        @else
                                            <span class="label label-success">ACTIVO</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
                                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $customers->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
