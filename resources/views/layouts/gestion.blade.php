@if(count($managements) != 0)
    <div class="container">
        <div class="page-header">
            <h1>Gestiones <small> - {{ $customer->name }}</small></h1>
            <hr>
            <br>
        @foreach($managements as $management)
                    <h4><span class="glyphicon glyphicon-user"></span> <strong>{{ $management->user->name }}</strong></h4>
                    <h5><span class="glyphicon glyphicon-time"></span> <strong>{{ \Carbon\Carbon::parse($management->created_at)->format('d-m-Y h:i') }}</strong></h5>
                    <h5><span class="glyphicon glyphicon-star"></span><strong>{{ $management->getStatus() }}</strong></h5>
                <p align="justify" style="font-size: medium; margin-left: 15px">
                        {{ $management->description }}
                    </p>
                    <hr>
                @endforeach
        </div>
        <!--
            <h3>
            <button type="button" id="btn-showmanagements" class="btn btn-info" aria-label="Left Align">
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"> Todas</span>
            </button>
        </h3>
        -->
    </div>
@else
    <div class="alert alert-danger">
        <strong> El Cliente no posee Gestiones!! </strong>
    </div>
@endif