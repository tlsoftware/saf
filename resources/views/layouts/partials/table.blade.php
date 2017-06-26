<table class="table table-striped table-bordered table-hover table-condensed dataTable" id="home_table">
    <thead>
        <th>Gestión</th>
        <th>Nombre Comercial</th>
        <th>Persona de Contacto</th>
        <th>Teléfono</th>
        <!-- Solo mostrar en case de que sea Administrador -->
        @if(Auth::user()->isAdmin())
            <th>Responsable</th>
        @endif
        <th>Última Gestión</th>
        <th>Próxima Gestión</th>
        @if(Route::current()->getName() == 'home')
            <th>Estatus General</th>
        @endif
        <th>Estatus Detallado</th>
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
                @if(Auth::user()->isAdmin())
                    <td>{{ $customer->user->name }}</td>
                @endif

            <!-- Validar si el Cliente Posee Gestiones -->
                @if($customer->managements->count())
                    <td>{{ \Carbon\Carbon::parse($customer->managements->last()->created_at)->format('d-m-Y') }}</td>
                @else
                    <td class="text-center"> -- -- --</td>
                @endif
            <!-- PROXIMA GESTION -->
                <td>{{ Carbon\Carbon::parse($customer->next_mng)->format('d-m-Y') }}</td>
                <!-- STATUS -->
                @if(Route::current()->getName() == 'home')
                    <td> {{ $customer->status_detail->status->name }}</td>
                @endif
                <td> {{ $customer->status_detail->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>