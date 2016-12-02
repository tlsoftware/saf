@extends('layouts.app')

@section('content')
    <h1>Administrador</h1>
    <h3>Mostrar todos los Clientes Pendientes por Gestionar</h3>
    <table>
    @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->bs_name }}</td>
            <td>{{ $customer->contact_name }}</td>
            <td>{{ $customer->phone1 }}</td>
            <td>{{ $customer->user()->first()->name }}</td>
            <td>{{ $customer->next_mng }}</td>
            @if($customer->status == 0)
                <td>SIN GESTION</td>
            @else
                <td>{{ $customer->managements->last()->title }}</td>
            @endif
            <td>
                @if($customer->status == 0)
                    <span class="label label-danger">SIN GESTION</span>
                @elseif($customer->status == 1)
                    <span class="label label-primary">POTENCIAL</span>
                @else
                    <span class="label label-success">ACTIVO</span>
                @endif
            </td>
        </tr>
    @endforeach
    </table>

@endsection
