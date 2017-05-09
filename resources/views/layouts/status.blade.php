@if($customer->status == '0')
    <td> Sin Gestión </td>
@elseif($customer->status == '1')
    <td> Potencial </td>
@elseif($customer->status == '2')
    <td> Muestra Entregada </td>
@elseif($customer->status == '3')
    <td> Rechazado </td>
@elseif($customer->status == '4')
    <td> Cliente Activo </td>
@elseif($customer->status == '5')
    <td> Bajas </td>
@else()
    <td> STATUS ERROR </td>
@endif