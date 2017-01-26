<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
        $('#status').on('change', function(e){
            console.log(e);
            var status_id = e.target.value;

            $.get('{{ url('information') }}/create/ajax-status?status_id=' + state_id, function(data) {
                console.log(data);
                $('#detail').empty();
                $.each(data, function(index,subCatObj){
                    $('#detail').append(''+subCatObj.name+'');
                });
            });
        });
    </script>
</head>
<h1> Albums and Songs Ajax dropdown</h1>

<div class="col-lg-12">

    <div class="form-group">
        <label>Status</label>
        <select class="form-control" name="status" id="status">
            @foreach($statuses as $status)
                <option value="{{$status->id}}"class="form-control">{{$status->name}}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Detail Status</label>
        <select class="form-control input-sm" name="details" id="details">
            <option value="">
            </option>
        </select>
    </div>

</div>

<script>
    $('#status').on('change', function(e) {
        console.log(e);
        var status_id = e.target.value;
        //ajax
        $.getJSON("/ajax-call?status_id="+status_id, function (data) {
//console.log(data);
            $('#details').empty();
            $.each(data, function(index, songsObj){
                $('#details').append('<option value="'+songsObj.id+'">'+songsObj.name+'</option>');
            });
        });
    });
</script>
@endsection
</body>
</html>