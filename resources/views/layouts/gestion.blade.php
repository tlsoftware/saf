@if(count($managements) != 0)
    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <th class="active">Usuario</th>
            <th class="active">Gestión</th>
            <th class="active">Fecha</th>
        </thead>
        <tbody>
        @foreach($managements as $management)
            <tr>
                <td>{{ $management->user->name }}</td>
                <td>
                    <div class="col-sm-12">
                        {{ Form::textarea('description', $management->description, ['class' => 'form-control', 'rows' => '6', 'cols' => '50', 'style' => 'resize:none', 'disabled']) }}
                    </div>
                </td>
                <td>{{ \Carbon\Carbon::parse($management->created_at)->format('d-m-Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-danger">
        <strong> El Cliente no posee Gestiones!! </strong>
    </div>
@endif