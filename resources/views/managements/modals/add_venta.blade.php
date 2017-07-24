<div class="modal fade" id="addVenta" role="dialog">
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

                {{ Field::hidden('status_detail_id', 27) }}
                {!! Field::textarea('description', null, ['class' => 'form-control', 'rows' => '6', 'cols' => '40', 'style' => 'resize:none', 'required']) !!}
                <div id="add_product_div">
                    {!! Field::selectMultiple('product_id[]', \App\Product::pluck('name', 'id')->toArray(), null, ['class' => 'add_product_select', 'required', 'style' => 'width:500px']) !!}
                </div>
                {!! Field::number('quantity', 1, ['class' => 'form-control', 'required']) !!}
                {!! Field::number('price', 0, ['class' => 'form-control', 'required']) !!}
                {!! Field::text('dispatch_date', null, ['class' => 'datepickerventa', 'required', 'readonly']) !!}
                {!! Field::time('dispatch_time', null, ['class' => 'form-control']) !!}
                {!! Field::text('next_mng', null, ['class' => 'datepicker', 'required', 'readonly']) !!}
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
