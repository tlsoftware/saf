@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-primary">
                    <div class="panel-heading"><strong>Productos Registrados</strong></div>
                    <div class="panel-body">
                        <a href="{{ route('products.create') }}" class="btn btn-info"> Agregar Producto</a>
                        <hr>
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <th>Código</th>
                                <th>Producto</th>
                                <th>Acción</th>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $products->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection