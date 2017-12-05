@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}"/>
@stop
@section('content_header')
    @include('layouts.flash')
    <h1>Sensor Node settings</h1>
@stop

@section('content')
    {{ html()->form('POST', route('sensor_node.store'))->open() }}

    <div class="col-md-12">
        <div class="form-group">
            {{ html()->label('Sensor node name','name')}}

            {{ html()->text('name')->class('form-control')->placeholder('Sensor Node Name') }}
        </div>
        <div class="form-group">
            {{ html()->label('Sensor node type','type') }}

            {{ html()->select('type', $zones)->class('form-control') }}
        </div>

        <div class="form-group">
            {{ html()->label('Zone name','zone_id') }}

            {{ html()->select('zone_id', $zones)->class('form-control') }}
        </div>


        <div class="form-group">

            {{ html()->submit('Create Sensor Node')->class('btn btn-primary pull-right') }}
        </div>
    </div>

    {{ html()->form()->close() }}

@stop




