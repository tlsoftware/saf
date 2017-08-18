$(document).ready(function() {
    $('select').select2();

    $('body').bind('copy',function(e) {
        e.preventDefault();
        return false;
    });

    $.fn.populateSelect = function (values) {
        var options = '';
        $.each(values, function (key, row) {
            options += '<option value="' + row.value + '">' + row.text + '</option>';
        });
        $(this).html(options);
    }

    $('#status_id').change(function() {
        $('#status_detail_id').empty().change();

        var status_id= $(this).val();

        if (status_id == "") {
            $('#status_detail_id').empty().change();
        } else if (status_id == "3" || status_id == "5") {
            $('#field_next_mng').css('display', 'none');
        } else
        {
            $('#field_next_mng').css('display', 'block');
        }
        $.getJSON('/details-statuses/' + status_id, function(values) {
            $('#status_detail_id').populateSelect(values);
        });
    });


    $.extend( true, $.fn.dataTable.defaults, {
        "oLanguage": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    $.fn.dataTable.moment( 'DD-MM-YYYY' );

    $('#home_table').DataTable();
    $('#migrate_table').DataTable();

    $('#btn-addVenta').click(function (e) {
        var rut = $('#rut').val();
        var bs_name = $('#bs_name').val();
        var address = $('#address').val();
        var commune = $('#commune').val();
        var city = $('#city').val();
        var phone1 = $('#phone1').val();
        var email1 = $('#email1').val();

        e.preventDefault();

        if (rut === '' || bs_name === ''  || address === '' || commune === '' || city === '' || phone1 === '' || email1 === '') {
            swal(
                'Oops...',
                'Debe completar toda la Información del Cliente para Ingresar Venta!',
                'error'
            );
            return false;
        }
    });


    var startDate = new Date();
    var endDate = new Date();
    startDate.setDate(startDate.getDate() + 1);
    endDate.setDate(endDate.getDate() + 8);
    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        startDate: startDate,
        endDate: endDate,
        todayBtn: true,
        language: "es",
        daysOfWeekDisabled: "0,6",
        todayHighlight: true,
        autoclose: true
    }).css('width', '200px');

    var startDateVenta = new Date();
    var endDateVenta = new Date();
    startDateVenta.setDate(startDateVenta.getDate() + 0);
    endDateVenta.setDate(endDateVenta.getDate() + 8);
    $('.datepickerventa').datepicker({
        format: "dd/mm/yyyy",
        startDate: startDateVenta,
        endDate: endDateVenta,
        todayBtn: true,
        language: "es",
        daysOfWeekDisabled: "0,6",
        todayHighlight: true,
        autoclose: true
    }).css('width', '200px');

    $('.datepickerfilter').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: true,
        language: "es",
        daysOfWeekDisabled: "0,6",
        todayHighlight: true,
        autoclose: true
    }).css('width', '200px');

    $('#loadFile').click(function () {
        $('#loadingModal').modal('show');
    });

    $('#select_all').click(function() {
        var c = this.checked;
        $(':checkbox').prop('checked',c);
    });

    $('#managements-filters').click(function (e) {
        var date_from = $('#date_from').val();
        var date_to = $('#date_to').val();
        if (date_from == '' || date_to == '') {
            e.preventDefault();
            swal(
                'Oops...',
                'Debe seleccionar ambas fechas!',
                'error'
            );
        return false;
        }
    });

});

function confirmDelete(e)
{
    e.preventDefault();
    swal({
        title: 'Esta seguro?',
        text: "No sera posible revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Borrar!'
    }).then(function () {
        swal(
            'Eliminado!',
            'El usuario fue eliminado',
            'success'
        )
    })
}

