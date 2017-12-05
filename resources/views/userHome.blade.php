@extends('adminlte::pageUser')

@section('title')
    Sensanoma
@stop
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop
@section('content_header')
    @include('layouts.flash')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Daily Average</h1>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>12<sup style="font-size: 20px">°</sup><i class="fa fa-exclamation-triangle"></i></h3>

                        <p>Air temperature</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-thermometer-2"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>15<sup style="font-size: 20px">%</sup></h3>

                        <p>Air humidity</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-waterdrop"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box soil-colors">
                    <div class="inner">
                        <h3>18<sup style="font-size: 20px">°</sup><i class="fa fa-exclamation-triangle"></i></h3>

                        <p>Soil temperature</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-thermometer-2"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box soil-colors">
                    <div class="inner">
                        <h3>31<sup style="font-size: 20px">%</sup></h3>

                        <p>Soil humidity</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-waterdrop"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <!-- small box -->
                <div class="small-box lumen-color">
                    <div class="inner">
                        <h3>6<sup style="font-size: 20px">lm</sup></h3>

                        <p>Sensor lumens </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-sunny"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-6">
                <!-- small box -->
                <div class="small-box voltage-color">
                    <div class="inner">
                        <h3>31<sup style="font-size: 20px">v</sup><i class="fa fa-exclamation-triangle warnings-danger"></i></h3>

                        <p>Sensor voltage</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bolt"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>31<sup style="font-size: 20px">°</sup></h3>

                        <p>Sensor temperature</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-thermometer-2"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-12 col-xs-12">
                <img style="width: 100%;" src="https://i.imgur.com/sUt6wAy.png" alt="">
            </div>
        </div>
    </div>

@stop

