@if($status == 1)
    <div class="col-sm-3">
        {{ Form::select('st_details', ['En Gestión', 'Positivo con Correo' ,'Positivo sin Correo', 'No Contesta', 'Envio Catalogo', 'Solicitud de Muestras' ],0, ['class' => 'form-control']) }}
    </div>
@elseif($status == 2)
    <div class="col-sm-3">
        {{ Form::select('st_details', ['Sin Contactar', 'Por Concretar Venta','En Seguimiento', 'Venta', 'Rechazado' ],0, ['class' => 'form-control']) }}
    </div>
@elseif($status == 3)
    <div class="col-sm-3">
        {{ Form::select('st_details', ['En Gestión' ,'Baja', 'Promesa de Compra'],0, ['class' => 'form-control']) }}
    </div>
@elseif($status == 4)
    <div class="col-sm-3">
        {{ Form::select('st_details', ['Usan Tomates Naturales' , 'Precio', 'Usan Salsa para Pizza','Usan Concentrado', 'Usan otro Producto', 'Presentación'],0, ['class' => 'form-control']) }}
    </div>
@elseif($status == 5)
    <div class="col-sm-3">
        {{ Form::select('st_details', ['Precio' , 'Motivos Administrativos', 'Falta de Seguimiento', 'Calidad del Producto', 'Otras'],0, ['class' => 'form-control']) }}
    </div>
@endif