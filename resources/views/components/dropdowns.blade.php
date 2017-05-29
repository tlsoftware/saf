@extends('layouts.app')

@section('content')
    <h1>Dynamic Dropdowns</h1>
<div class="container">
    {!! Form::open(['class' => 'form']) !!}
    {!! Field::select('status_id', \App\Status::pluck('name', 'id')->toArray()) !!}
    {!! Field::select('status_detail_id', \App\Detail::pluck('name', 'id')->toArray()) !!}

    {!! Form::close() !!}
</div>


@endsection