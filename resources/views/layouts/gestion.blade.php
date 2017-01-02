@if(count($managements) != 0)
    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
        <th class="active">Ultima Gestión</th>
        <th class="active">Fecha</th>
        </thead>
        <tbody>
        @foreach($managements as $management)
            <tr>
                <td>
                    <div class="col-sm-10">
                        {{ Form::textarea('description', $management->description, ['class' => 'form-control', 'rows' => '2', 'cols' => '50', 'style' => 'resize:none', 'disabled']) }}
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