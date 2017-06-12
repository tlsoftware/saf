@if($customer->status == 0)
    Sin Gestión
@elseif($customer->status == 1)
    Potencial
@elseif($customer->status == 2)
    Muestra Entregada
@elseif($customer->status == 3)
    Activo
@elseif($customer->status == 4)
    Rechazado
@elseif($customer->status == 5)
    Baja
@else()
    STATUS ERROR
@endif