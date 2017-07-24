<div class="modal fade" id="addDatos" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <!--
            <div class="modal-header" style="padding:40px 50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar Nueva Gestión</h4>
            </div>
            -->
            <div class="modal-body" style="padding:40px 50px;">
                {{ Form::hidden('status_detail_id', $customer->status_detail_id) }}

                {!! Form::open(['route' => ['managements.storeDatos', $customer->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                {!! Field::text('rut', $customer->rut, ['class' => 'form-control'])  !!}
                {!! Field::text('bs_name', $customer->bs_name, ['class' => 'form-control']) !!}
                {!! Field::text('address', $customer->address, ['class' => 'form-control']) !!}
                {!! Field::text('commune', $customer->commune, ['class' => 'form-control']) !!}
                {!! Field::text('city', $customer->city, ['class' => 'form-control']) !!}
                {!! Field::text('phone1', $customer->contact->phone->phone1, ['class' => 'form-control']) !!}
                {!! Field::text('phone2', $customer->contact->phone->phone2, ['class' => 'form-control', 'placeholder' => '+56912341234']) !!}
                {!! Field::text('phone3', $customer->contact->phone->phone3, ['class' => 'form-control', 'placeholder' => '+56912341234']) !!}
                {!! Field::email('email1', $customer->contact->email->email1, ['class' => 'form-control']) !!}
                {!! Field::email('email2', $customer->contact->email->email2, ['class' => 'form-control', 'placeholder' => 'example@gmail.com']) !!}
                {!! Field::email('email3', $customer->contact->email->email3, ['class' => 'form-control', 'placeholder' => 'example@gmail.com']) !!}

            </div>
                <hr>
                <div class="form-group" align="center">
                    {{ Form::submit('Agregar', ['class' => 'btn btn-primary']) }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
    </div>
</div>
{!! Form::close() !!}