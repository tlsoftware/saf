@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div id="left">
                                <span id="left-heading"><strong>Gestiones del Dia</strong> </span>
                            </div>
                            <div class="pull-right">
                                <span class="label label-danger" id="right-heading">Total Gestiones: {{ $managements->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <hr>
                        </div>
                    </div>
                    @include('layouts.partials.table_managements')
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection