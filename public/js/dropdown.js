<script>
$('#state').on('change', function(e){
    console.log(e);
    var state_id = e.target.value;

    $.get('{{ url('information') }}/create/ajax-state?state_id=' + state_id, function(data) {
        console.log(data);
        $('#city').empty();
        $.each(data, function(index,subCatObj){
            $('#city').append(''+subCatObj.name+'');
        });
    });
});
</script>