@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-primary">
                    <div class="panel-heading">Mantenedor de Estatus</div>
                    <div class="panel-body">
                        <a href="{{ route('statuses.create') }}" class="btn btn-info"> Agregar Estatus</a>
                        <hr>
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <th>Estatus General</th>
                                <th>Estatus Detallado</th>
                                <th>Acción</th>
                            </thead>
                            <tbody>
                            @foreach($statuses as $status)
                                <tr>
                                    <td>{{ $status->status->name }}</td>
                                    <td>{{ $status->name }}</td>
                                    <td>
                                        <a href="{{ route('statuses.edit', $status->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $statuses->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection