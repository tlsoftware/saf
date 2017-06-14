@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div id="exTab3" class="container-fluid">
                <ul  class="nav nav-pills">
                    <li class="active">
                        <a  href="#home" data-toggle="tab">Home</a>
                    </li>
                    <li>
                        <a href="#potenciales" data-toggle="tab">Potenciales</a>
                    </li>
                    <li>
                        <a href="#muestras" data-toggle="tab">Muestras</a>
                    </li>
                    <li>
                        <a href="#activos" data-toggle="tab">Activos</a>
                    </li>
                    <li>
                        <a href="#rechazos" data-toggle="tab">Rechazos</a>
                    </li>
                    <li>
                        <a href="#bajas" data-toggle="tab">Bajas</a>
                    </li>
                    <li>
                        <a href="#todos" data-toggle="tab">Todos</a>
                    </li>
                </ul>
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="home">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                <div id="left">
                                    <span id="left-heading"><strong>Clientes Pendientes por Gestionar </strong> </span>
                                </div>
                                <div class="pull-right">
                                    <span class="label label-danger" id="right-heading">Total Pendientes: {{ $customers->count() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <a href="{{ route('customers.create') }}" class="btn btn-info" id="new_customer">Nuevo Cliente</a>
                        </div>
                        <hr>

                        <table class="table table-striped table-bordered table-hover table-condensed dataTable" id="home_table">
                            <thead>
                            <tr>
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
                                @if($status == 'Todos los Clientes')
                                    <th>Estatus General</th>
                                @endif
                                <th>Estatus Detallado</th>
                            </tr>
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
                                    @if($status == 'Todos los Clientes')
                                        <td> {{ $customer->status_detail->status->name }}</td>
                                    @endif
                                    <td> {{ $customer->status_detail->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection