@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-primary">
                    <div class="panel-heading"><strong>Tipos de Restaurantes</strong></div>
                    <div class="panel-body">
                        <a href="{{ route('bstypes.create') }}" class="btn btn-info"> Agregar Tipo</a>
                        <hr>
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <th>Producto</th>
                                <th>Acción</th>
                            </thead>
                            <tbody>
                            @foreach($bstypes as $bstype)
                                <tr>
                                    <td>{{ $bstype->type }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('bstypes.edit', $bstype->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $bstypes->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection