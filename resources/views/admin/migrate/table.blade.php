<table class="table table-striped table-bordered table-hover table-condensed dataTable" id="migrate_table">
    <thead>
        <th>
            <div class="checkbox">
                <label><input type="checkbox" name="customer[]" value="" id="select_all"></label>
            </div>
        </th>
        <th>Nombre Comercial</th>
        <th>Persona de Contacto</th>
        <th>Teléfono</th>
        <th>Estatus General</th>
        <th>Estatus Detallado</th>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td class="text-center">
                <div class="checkbox">
                    <label><input type="checkbox" name="customer[]" value="{{ $customer->id }}"></label>
                </div>
            </td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->contact->name }}</td>
            <td>{{ $customer->contact->phone->phone1 }}</td>
        <!-- Validar si el Cliente Posee Gestiones -->
            <!-- STATUS -->
            <td> {{ $customer->status_detail->status->name }}</td>
            <td> {{ $customer->status_detail->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>