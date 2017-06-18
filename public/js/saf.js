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

    $.fn.dataTable.moment( 'DD-MM-YYYY' );
    $('#home_table, #muestra_table').DataTable({
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

    /*
    $("#addManagement").click(function () {
        var customerId = $(this).data('id');
        console.log(customerId);
        alert('Enviar Formulario');
    });
    */

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

    $('#loadFile').click(function () {
        $('#loadingModal').modal('show');
    });

});

