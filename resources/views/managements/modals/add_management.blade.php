{!! Form::open(['route' => ['managements.store', $customer->id], 'method' => 'POST']) !!}
<!-- Modal -->
    <div class="modal fade" id="addManagement" role="dialog">
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
                            {!! Field::textarea('description', array('class' => 'form-control', 'required', 'style' => 'resize:none', 'rows' => '6', 'cols' => '30')) !!}
                        </div>
                        <div class="form-group">
                            {!! Field::text('next_mng', null, ['class' => 'form-control datepicker', 'required', 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Field::select('status_id', \App\Status::pluck('name', 'id')->toArray(), array('class' => 'form-control', 'style' => 'width:200px', 'required')) !!}
                            {!! Field::select('status_detail_id', null, array('class' => 'form-control', 'style' => 'width:200px', 'required')) !!}
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" align="center">
                        {{ Form::submit('Agregar', ['class' => 'btn btn-primary', 'id' => 'addManagement']) }}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>

        </div>
    </div>
{!! Form::close() !!}