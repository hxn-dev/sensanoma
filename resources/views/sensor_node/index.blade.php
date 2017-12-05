@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <div class="row">
        <div class="col-md-12">
            <h2>All SensorNodes
                <a href="{{ route('sensor_node.create') }}"><button type="button" class="btn btn-flat btn-primary pull-right">Add a SensorNode</button></a>
            </h2>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')
    <div class='row'>
        @foreach($sensorNodes as $node)
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="info-box">
                <a href="{{ route('sensor_node.show', $node) }}">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-fw fa-microchip "></i></span>
                </a>
                <div class="info-box-content">
                <span>
                    <h4><a href="{{ route('sensor_node.show', $node) }}">{{ $node->name }}</a></h4>
                </span>
                <span class="progress-description"> Zone:
                    <a href="{{ route('zone.show', $node->zone->id) }}">{{ $node->zone->name }}</a>
                    / Created by: <a href="{{ route('account.show', $node->account->id) }}">{{ $node->account->name }}</a>
                </span>
                <span class="progress-description"> Sensornode type:
                    {{ $node->type['name'] }}
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <br>
        </div>
        @endforeach
    </div>
@stop



