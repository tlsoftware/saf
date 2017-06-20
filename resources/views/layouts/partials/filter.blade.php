{!! Form::open(['route' => 'home', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right', 'role' => 'search']) !!}
<div>
    <div class="col-md-5">
        <div class="input-group">
            <input type="text" name="dateFrom" id="dateFrom" class="form-control datepicker" placeholder="Fecha Desde...">
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
    <div class="col-md-5">
        <div class="input-group">
            <input type="text" name="dateTo" id="dateTo" class="form-control datepicker" placeholder="Fecha Hasta...">
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
    <div class="col-md-2">
        <button type="submit" class="btn btn-info" id="filterButton">Filtrar</button>
    </div>
</div><!-- /.row -->
{!! Form::close() !!}