    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
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
                            {!! Field::date('next_mng', null, ['class' => 'form-control', 'required', 'style' => 'width:200px']) !!}
                        </div>
                        <div class="form-group">
                            {!! Field::select('status_id', \App\Status::pluck('name', 'id')->toArray(), array('class' => 'form-control', 'style' => 'width:200px')) !!}
                            {!! Field::select('status_detail_id', \App\Detail::pluck('name', 'id')->toArray(), array('class' => 'form-control', 'style' => 'width:200px')) !!}
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" align="center">
                        {{ Form::submit('Agregar', ['class' => 'btn btn-primary', 'id' => 'addManagement']) }}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>

        </div>
    </div>
