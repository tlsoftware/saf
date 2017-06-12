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
                {!! Field::textarea('description', null, ['class' => 'form-control', 'rows' => '6', 'cols' => '40', 'style' => 'resize:none', 'required']) !!}
                {!! Field::select('product_id', \App\Product::pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'style' => 'width:500px', 'required']) !!}
                {!! Field::text('dispatch_date', null, ['class' => 'form-control datepicker', 'required', 'readonly', 'placeholder' => 'Indique Fecha'])  !!}
                {!! Field::time('dispatch_time', null, ['class' => 'form-control']) !!}
                {!! Field::text('next_mng', null, ['class' => 'form-control datepicker', 'required', 'readonly', 'placeholder' => 'Indique Fecha'])  !!}
            </div>
            <hr>
            <div class="form-group" align="center">
                {{ Form::submit('Agregar', ['class' => 'btn btn-primary']) }}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
