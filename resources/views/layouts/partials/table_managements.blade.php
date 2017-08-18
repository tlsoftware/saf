<table class="table table-striped table-bordered table-hover table-condensed dataTable" id="home_table">
    <thead>
        <th>Ver Gestiones</th>
        <th>Cliente</th>
        <th>Contacto</th>
        <th>Teléfono</th>
        <th>Vendedor</th>
        <th>Responsable Actual</th>
        <th>Fecha</th>
        <th>Estatus General</th>
        <th>Estatus Detallado</th>
    </thead>
    <tbody>
    @foreach($managements as $management)
        <tr>
            <td class="text-center">
                <a href="{{ route('managements', $management->customer->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span></a>
            </td>
            <td>{{ $management->customer->name }}</td>
            <td>{{ $management->customer->contact->name }}</td>
            <td>{{ $management->customer->contact->phone->phone1 }}</td>
            <td>{{ $management->user->name }}
            <td>{{ $management->customer->user()->first()->name }}</td>
            <td>{{ Carbon\Carbon::parse($management->created_at)->format('d-m-Y') }}</td>
            <td> {{ $management->customer->status_detail->status->name }}</td>
            <td> {{ $management->customer->status_detail->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>