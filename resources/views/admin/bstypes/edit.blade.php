@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Editar Clasificación<strong>{{ $type->type }}</strong></div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['bstypes.update', $type], 'method' => 'PUT']) !!}

                        <div class="form-group">
                            {{ Form::label('type', 'Clasificación') }}
                            {{ Form::text('type', $type->type, ['class' => 'form-control', 'required']) }}
                        </div>
                        <hr>
                        <div class="form-group" align="center">
                            {{ Form::submit('Aceptar', ['class' => 'btn btn-primary']) }}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection