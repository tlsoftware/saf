<table class="table table-striped table-bordered table-hover table-condensed dataTable" id="home_table">
    <thead>
        <th>Gestión</th>
        <th>Nombre Comercial</th>
        <th>Persona de Contacto</th>
        <th>Teléfono</th>
        <!-- Solo mostrar en case de que sea Administrador -->
        @if(Auth::user()->isAdmin() or Auth::user()->isSupervisor())
            <th>Responsable</th>
        @endif
        <th>Fecha Última Gestión</th>
        <th>Fecha Próxima Gestión</th>
        @if(Route::current()->getName() == 'home' or Route::current()->getName('todos.show'))
            <th>Estatus General</th>
        @endif
        <th>Estatus Detallado</th>
        <th>Última Gestión</th>
    </thead>
    <tbody>
        @foreach($customers as $customer)
            <tr>
                <td class="text-center">
                    <a href="{{ route('managements', $customer->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span></a>
                </td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->contact->name }}</td>
                <td>{{ $customer->contact->phone->phone1 }}</td>
                <!-- Solo mostrar en case de que sea Administrador -->
                @if(Auth::user()->isAdmin() or Auth::user()->isSupervisor())
                    <td>{{ $customer->user->name }}</td>
                @endif

            <!-- Validar si el Cliente Posee Gestiones -->
                <td class="text-center"> {{ $customer->last_mng }}</td>

            <!-- PROXIMA GESTION -->
                <td class="text-center"> {{ $customer->next_mng }}</td>
                <!-- STATUS -->
                @if(Route::current()->getName() == 'home' or Route::current()->getName('todos.show'))
                    <td> {{ $customer->status_detail->status->name }}</td>
                @endif
                <td> {{ $customer->status_detail->name }}</td>
                <td> {{ $customer->lastManagement() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>