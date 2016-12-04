@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"> Potenciales Clientes pendientes de Gestion </div>
                    <div class="panel-body">
                        @if(Auth::user()->admin)
                            <a href="{{ route('customers.create') }}" class="btn btn-info">Nuevo Cliente</a>
                        @else
                            <a href="#" class="btn btn-info">Nuevo Cliente</a>
                        @endif
                        <!-- BUSCAR CLIENTES -->
                        {!! Form::open(['action' => 'HomeController@index', 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
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
                            <th>Gestion</th>
                            <th>Razon Social</th>
                            <th>Persona de Contacto</th>
                            <th>Telefono</th>
                            <!-- Solo mostrar en case de que sea Administrador -->
                            @if(Auth::user()->admin)
                                <th>Responsable</th>
                            @endif
                            <th>Ultima Gestion</th>
                            <th>Dias sin Gestion</th>
                            <th>Proxima Gestion</th>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td><a href="{{ route('potencial', $customer->id) }}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a></td>
                                    <td>{{ $customer->bs_name }}</td>
                                    <td>{{ $customer->contact_name }}</td>
                                    <td>{{ $customer->phone1 }}</td>
                                    <!-- Solo mostrar en case de que sea Administrador -->
                                    @if(Auth::user()->admin)
                                        <td>{{ $customer->user()->first()->name }}</td>
                                    @endif

                                    <!-- Validar si el Cliente Posee Gestiones -->
                                    @if($customer->managements->count()))
                                        <td>{{ $customer->managements->last()->created_at }}</td>
                                    @else
                                        <td> SIN GESTION </td>
                                    @endif
                                        <td>{{ Carbon\Carbon::parse($customer->last_mng)->diffInDays(Carbon\Carbon::now()) }}</td>
                                        <td>{{ Carbon\Carbon::parse($customer->next_mng)->format('d-m-Y') }}</td>
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
