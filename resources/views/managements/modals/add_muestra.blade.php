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
                <div class="form-group">
                    {!! Field::textarea('description', null, ['class' => 'form-control', 'rows' => '6', 'cols' => '40', 'style' => 'resize:none', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Field::select('product_id', \App\Product::pluck('name', 'id')->toArray(), null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Field::text('dispatch_date', null, ['class' => 'form-control datepicker', 'required', 'readonly', 'placeholder' => 'Indique Fecha'])  !!}
                    {!! Field::time('dispatch_time', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Field::text('next_mng', null, ['class' => 'form-control datepicker', 'required', 'readonly', 'placeholder' => 'Indique Fecha'])  !!}
                </div>
                <div class="form-group">
                    {!! Field::select('status_detail_id', \App\Detail::pluck('name', 'id')->toArray(), null, ['class' => 'form-control'])  !!}
                </div>
            </div>

            <hr>
            <div class="form-group" align="center">
                {{ Form::submit('Agregar', ['class' => 'btn btn-primary']) }}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>