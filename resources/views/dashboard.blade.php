@extends('layouts.app')

@section('title')
    Sensanoma
@stop

@section('content_header')
    @include('layouts.flash')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Daily Average</h1>
            @foreach($sensors as $sensor)
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box" style="background-color: {{$sensor->getColor()}}">
                    <div class="inner">
                        <h3>12<sup>{{$sensor->getUnit()}}</sup></h3>

                        <p>{{$sensor->getName()}} ({{$sensor->sensorNode()->name}})</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-{{$sensor->getIcon()}}"></i>
                    </div>

                    <a href="{{ url('/sensor_node/'. $sensor->sensorNode()->id . '/' . $sensor->getName()) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endforeach

        </div>
    </div>

@stop