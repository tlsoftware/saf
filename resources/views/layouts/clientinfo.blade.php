<!--
    Se Utiliza el Layouts de Gestion
    layouts.gestion
-->

<div class="panel panel-primary">
    <div class="panel-heading">Información del Cliente: <strong>{{ $customer->name }}</strong>
        <span class="label label-danger col-md-offset-8">@include('layouts.status2')</span>
    </div>
        <div class="panel-body">
            <div class="form-horizontal">
                <fieldset disabled>
                    <div class="form-group">
                        {{ Form::label('contact_name', 'Persona de Contacto', ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-4">
                            {{ Form::text('contact_name', $customer->contact_name, ['class' => 'form-control']) }}
                        </div>
                        {{ Form::label('position', 'Cargo', ['class' => 'col-sm-1 control-label']) }}
                        <div class="col-sm-4">
                            {{ Form::text('position', $customer->position, ['class' => 'form-control', 'disabled']) }}
                        </div>
                    </div>
                <div class="form-group">
                    {{ Form::label('phone1', 'Teléfonos', ['class' => 'col-sm-2 control-label']) }}
                    <div class="col-sm-3">
                        {{ Form::text('phone1', $customer->phone1, ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="col-sm-3">
                        {{ Form::text('phone2', $customer->phone2, ['class' => 'form-control']) }}
                    </div>
                    <div class="col-sm-3">
                        {{ Form::text('phone3', $customer->phone3, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('email1', 'Correo', ['class' => 'col-sm-2 control-label']) }}
                    <div class="col-sm-3">
                        {{ Form::text('email1', $customer->email1, ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="col-sm-3">
                        {{ Form::text('email2', $customer->email2, ['class' => 'form-control']) }}
                    </div>
                    <div class="col-sm-3">
                        {{ Form::text('email3', $customer->email3, ['class' => 'form-control']) }}
                    </div>
                </div>
                @if(Auth::user()->admin)
                    <div class="form-group">
                        {{ Form::label('user_id', 'Responsable', ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('user_id', $customer->user->name, ['class' => 'form-control']) }}
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    {{ Form::label('next_mng', 'Próxima Gestión', ['class' => 'col-sm-2 control-label']) }}
                    <div class="col-sm-3">
                        {{ Form::text('next_mng', Carbon\Carbon::parse($customer->next_mng)->format('d-m-Y'), ['class' => 'form-control', 'disabled']) }}
                    </div>
                    {{ Form::label('dias', 'Días en Gestión', ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-sm-3">
                        {{ Form::text('dias', Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($customer->created_at)), ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>
                <hr>
                    <div class="col-md-11 col-md-offset-0">
                           @include('layouts.gestion')
                    </div>
                </fieldset>
        </div>
    </div>
</div>