<table class="table table-striped table-bordered table-hover table-condensed dataTable" id="home_table">
    <thead>
        <th>Nombre Comercial</th>
        <th>Persona de Contacto</th>
        <th>Teléfono</th>
        <th>Responsable</th>
        <th>Próxima Gestión</th>
        <th>Estatus General</th>
        <th>Estatus Detallado</th>
    </thead>
    <tbody>
    @foreach($managements as $management)
        <tr>
            <td>{{ $management->customer->name }}</td>
            <td>{{ $management->customer->contact_name }}</td>
            <td>{{ $management->customer->phone1 }}</td>
            <td>{{ $management->customer->user()->first()->name }}</td>
            <td>{{ Carbon\Carbon::parse($management->customer->next_mng)->format('d-m-Y') }}</td>
            <td> {{ $management->customer->status_detail->status->name }}</td>
            <td> {{ $management->customer->status_detail->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>