@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content_header')
    @include('layouts.flash')
    <div class="row">
        <div class="form-group">
            <label id="head_label" class="col-md-6 col-sm-6 col-xs-12">Zone Settings</label>

            <div class="col-md-6 col-sm-6 hidden-xs">

                {{ html()->form('DELETE', route('zone.destroy', $zone->id))->open() }}

                {{ html()->submit('Delete')->class('btn btn-flat custom btn-danger')->style('float:right; margin-left:2px') }}

                {{ html()->form()->close() }}

                {{ html()->form('GET', route('zone.edit', $zone->id))->open() }}

                {{ html()->submit('Edit')->class('btn btn-flat custom btn-info')->style('float:right') }}

                {{ html()->form()->close() }}

            </div>
        </div>
    </div>
@stop


@section('content')
    @include('layouts.showPolygon')
    <div class='row'>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="info-box">
                <a href="{{ route('zone.show', $zone) }}">
                    <span class="info-box-icon bg-aqua"><img id="iconmap" src="" style="margin-bottom: 10px;" alt=""></span>
                </a>
                <div class="info-box-content">
                    <span>
                        <h4><a href="{{ route('zone.show', $zone) }}">{{ $zone->name }}</a></h4>
                    </span>
                    <span class="progress-description"> Crop:
                                    {{ $zone->crop }}
                    </span>
                    <span class="progress-description"> Area:
                       <a href="{{ route('area.show', $zone->area->id) }}">{{ $zone->area->name }}</a>
                    </span>
                </div>
                <div id="area"></div>
                <br>
                <div class="row">
                    <div class="hidden-lg hidden-md hidden-sm col-xs-6">
                        {{ html()->form('GET', route('zone.edit', $zone->id))->open() }}

                        {{ html()->submit('Edit')->class('btn btn-flat btn-block btn-info') }}

                        {{ html()->form()->close() }}
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-6">


                        {{ html()->form('DELETE', route('zone.destroy', $zone->id))->open() }}

                        {{ html()->submit('Delete')->class('btn btn-flat btn-block btn-danger') }}

                        {{ html()->form()->close() }}

                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

@stop





