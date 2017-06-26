@extends('layouts.app')

@section('content')
    @include('modals.loading')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Cargar Base de Datos en masa</div>
                    <div class="panel-body">
                        @if (session('error'))
                            <div class="alert alert-success">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('import') }}" accept-charset="UTF-8" enctype="multipart/form-data">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Seleccione Archivo (CSV)</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="file" required>
                                </div>
                            </div>
                            <br><br><br><br>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" id="loadFile">Cargar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection