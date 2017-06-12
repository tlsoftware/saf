@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
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
                        <div class="pull-right">
                            <span class="glyphicon glyphicon-tag" style="font-size: larger" aria-hidden="true"> <strong> {{ $status }} </strong> </span>
                        </div>
                    </div>
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
                            @if($status == 'Todos los Clientes')
                                <th>Estatus General</th>
                            @endif
                            <th>Estatus Detallado</th>
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
@endsection