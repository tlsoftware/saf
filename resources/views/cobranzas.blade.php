@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-primary">
                <div class="panel-heading">
                        <div class="row">
                            <div id="left">
                                <span id="left-heading"><strong>Clientes Pendientes Por Cobrar</strong> </span>
                            </div>
                            <div class="pull-right">
                                <span class="label label-danger" id="right-heading">Total Pendientes: {{ count($customers) }}</span>
                            </div>
                        </div>
                </div>
                    <div class="panel-body">
                        <div class="row">
                            <a href="{{ route('customers.create') }}" class="btn btn-info" id="new_customer">Nuevo Cliente</a>
                        </div>
                    </div>
                        @include('layouts.partials.table')
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection