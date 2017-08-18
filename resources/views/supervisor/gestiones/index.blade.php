@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div id="left">
                                <span id="left-heading"><strong>Gestiones</strong> / <small>Desde: {{$date_from}} - Hasta: {{$date_to}}</small></span>
                            </div>
                            <div class="pull-right">
                                <span class="label label-danger" id="right-heading">Total Gestiones: {{ $managements->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            {!! Form::open(array('route' => 'gestiones', 'method' => 'get', 'class' => 'navbar-form navbar-left pull-left', 'role' => 'search')) !!}
                            <div class="form-group">
                                    {{ Form::label('date_from', 'Fecha desde:', ['class' => 'control-label']) }}
                                    {{ Form::text('date_from', $date_from, array_merge(['class' => 'form-control datepickerfilter'])) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('date_to', 'Fecha hasta:', ['class' => 'control-label']) }}
                                    {{ Form::text('date_to', $date_from, array_merge(['class' => 'form-control datepickerfilter'])) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('vendor', 'Vendedor:', ['class' => 'control-label']) }}
                                    {{ Form::select('vendor', $users, 0, array_merge( ['class' => 'form-control'])) }}
                                </div>
                                <button type="submit" class="btn btn-info" id="managements-filters">Filtrar</button>
                            {!! Form::close() !!}
                        </div>
                        <hr>
                    </div>
                    @include('layouts.partials.table_managements')
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection