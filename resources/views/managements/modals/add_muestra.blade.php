<div class="modal fade" id="addMuestra" role="dialog">
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
                {!! Form::open(['route' => ['managements.store', $customer->id], 'method' => 'POST']) !!}
                {!! Field::hidden('status_detail_id', 17)  !!}
                {!! Field::hidden('quantity', 0)  !!}
                {!! Field::hidden('price', 0)  !!}
                {!! Field::textarea('description', null, ['class' => 'form-control', 'rows' => '6', 'cols' => '40', 'style' => 'resize:none', 'required']) !!}
                {!! Field::selectMultiple('product_id[]', \App\Product::pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'style' => 'width:500px', 'required']) !!}
                {!! Field::text('dispatch_date', null, ['class' => 'form-control datepicker', 'required', 'readonly', 'placeholder' => 'Indique Fecha'])  !!}
                {!! Field::time('dispatch_time', null, ['class' => 'form-control']) !!}
                {!! Field::text('next_mng', null, ['class' => 'form-control datepicker', 'required', 'readonly', 'placeholder' => 'Indique Fecha'])  !!}
                <div class="form-group">
                    {!! Field::select('ctype', array('Llamada telefónica' => 'Llamada telefónica', 'Vía mail' => 'Vía mail', 'Vía WhatsApp' => 'Vía WhatsApp', 'Otros' => 'Otros'), array('class' => 'form-control', 'style' => 'width:200px', 'required')) !!}
                </div>
            </div>
            <hr>
            <div class="form-group" align="center">
                {{ Form::submit('Agregar', ['class' => 'btn btn-primary']) }}
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
