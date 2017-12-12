@extends('layouts.app')
@section('content_header')
    @include('layouts.flash')
    <h1>{{$sensor->getName()}}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-4 col-xs-6 disabled">
            <!-- small box -->
            <div class="small-box" style="background-color: {{$sensor->getColor()}}">
                <div class="inner">
                    @if(is_null($sensor->getLastDay()))
                        <h3>Need more data</h3>
                    @else
                        <h3>{{$sensor->getLastDay()}}<sup>{{$sensor->getUnit()}}</sup></h3>
                    @endif
                    <p>Last 24 hours</p>
                </div>
                <div class="icon">
                    <i class="fa fa-{{$sensor->getIcon()}}"></i>
                </div>
                <a href="{{ 'day' }}" class="small-box-footer">Last 24 hours  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box" style="background-color: {{$sensor->getColor()}}">
                <div class="inner">
                    @if(is_null($sensor->getLastWeek()))
                        <h3>Need more data</h3>
                    @else
                        <h3>{{$sensor->getLastWeek()}}<sup>{{$sensor->getUnit()}}</sup></h3>
                    @endif
                    <p>Last 7 days</p>
                </div>
                <div class="icon">
                    <i class="fa fa-{{$sensor->getIcon()}}"></i>
                </div>
                <a href="{{ 'day' }}" class="small-box-footer">Last 7 days  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box" style="background-color: {{$sensor->getColor()}}">
                <div class="inner">

                    @if(is_null($sensor->getLastMonth()))
                        <h3>Need more data</h3>
                    @else
                    <h3>{{$sensor->getLastMonth()}}<sup>{{$sensor->getUnit()}}</sup></h3>
                    @endif
                    <p>Last 30 days</p>
                </div>
                <div class="icon">
                    <i class="fa fa-{{$sensor->getIcon()}}"></i>
                </div>
                <a href="{{ 'day' }}" class="small-box-footer">Last 30 days  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="app">
                {!! $chart->html() !!}
        </div>
        <!-- End Of Main Application -->
        {!! Charts::scripts() !!}
        {!! $chart->script() !!}


    </div>

@stop