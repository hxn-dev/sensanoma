@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <div class="row">
        <div class="col-md-12">
            <h2>All zones
                <a href="{{ route('zone.create') }}"><button type="button" class="btn btn-flat btn-primary pull-right">Add a zone</button></a>
            </h2>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')
    <div class="row">
    @foreach($zones as $zone)
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="info-box">
                    <a href="{{ route('zone.show', $zone) }}">
                        <span class="info-box-icon bg-aqua"><img id="iconmap" src="" style="margin-bottom: 10px;" alt=""></span>
                    </a>
                    <div class="info-box-content">
                        <h4><a href="{{ route('zone.show', $zone) }}">{{ $zone->name }}</a></h4>
                        <span class="progress-description"> Crop:
                            {{ $zone->crop }}
                        </span>
                        <span class="progress-description"> Area:
                        <a href="{{ route('area.show', $zone->area->id) }}">{{ $zone->area->name }}</a>
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <br>
            </div>
    @endforeach
    </div>
@stop



