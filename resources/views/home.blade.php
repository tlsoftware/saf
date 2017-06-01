@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-primary">
                <div class="panel-heading">
                        <div class="row">
                            <div id="left">
                                <span id="left-heading"><strong>Clientes Pendientes por Gestionar</strong></span>
                            </div>
                            <div class="pull-right">
                                <span class="label label-danger" id="right-heading">Total Pendientes: {{ $customers->total() }}</span>
                            </div>
                        </div>
                </div>
                    <div class="panel-body">
                        <a href="{{ route('customers.create') }}" class="btn btn-info" id="new_customer">Nuevo Cliente</a>
                        <!-- BUSCAR CLIENTES -->
                        {!! Form::open(['route' => 'home', 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
                        <!--
                        <div class="input-group">
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar Cliente..', 'aria-describedby' => 'search']) !!}
                                <span class="input-group-addon" id="search">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </span>
                            </div>
                        -->
                        {!! Form::close() !!}
                        <!-- FIN DEL BUSCADOR -->
                        <hr>
                        <table class="table table-striped table-bordered table-hover table-condensed dataTable" id="home_table">
                            <thead>
                            <th>Gestión</th>
                            <th>Nombre Comercial</th>
                            <th>Persona de Contacto</th>
                            <th>Teléfono</th>
                            <!-- Solo mostrar en case de que sea Administrador -->
                            @if(Auth::user()->admin)
                                <th>Responsable</th>
                            @endif
                            <th>Última Gestión</th>
                            <th>Próxima Gestión</th>
                            <th>Estatus</th>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('managements', $customer->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span></a>
                                    </td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->contact_name }}</td>
                                    <td>{{ $customer->phone1 }}</td>
                                    <!-- Solo mostrar en case de que sea Administrador -->
                                    @if(Auth::user()->admin)
                                        <td>{{ $customer->user()->first()->name }}</td>
                                    @endif

                                    <!-- Validar si el Cliente Posee Gestiones -->
                                    @if($customer->managements->count())
                                        <td>{{ \Carbon\Carbon::parse($customer->managements->last()->created_at)->format('d-m-Y') }}</td>
                                    @else
                                        <td> N/A </td>
                                    @endif
                                    <!-- PROXIMA GESTION -->
                                    <td>{{ Carbon\Carbon::parse($customer->next_mng)->format('d-m-Y') }}</td>
                                    <!-- STATUS -->
                                    <td> {{ $customer->status_detail->name }}</td>
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