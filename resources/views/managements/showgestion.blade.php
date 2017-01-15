@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include('layouts.clientinfo')
                <div class="panel panel-primary">
                    <div class="panel-heading">Agregar Nueva Gestión -> <strong>{{ $customer->name }}</strong></div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['managements.store', $customer->id], 'method' => 'POST']) !!}
                        {{ Form::hidden('status', 1) }}
                        <div class="form-horizontal">
                                <div class="form-group">
                                    {{ Form::label('description', 'Nueva Gestión', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-9">
                                        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2', 'cols' => '40', 'style' => 'resize:none']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('next_mng', 'Próxima Gestión', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-3">
                                        {{ Form::date('next_mng', null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('st_status', 'Estatus', ['class' => 'col-sm-2 control-label']) }}
                                        @include('layouts.stmenu')
                                    </div>
                                </div>
                                <div class="form-group" align="center">
                                    {{ Form::submit('Agregar', ['class' => 'btn btn-primary']) }}
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection