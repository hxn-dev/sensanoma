@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <div class="row">
        <div class="form-group">
            <label id="head_label" class="col-md-6 col-sm-6 col-xs-12">Area Settings</label>

            <div class="col-md-6 col-sm-6 hidden-xs">

                {{ html()->form('DELETE', route('area.destroy', $area->id))->open() }}

                {{ html()->submit('Delete')->class('btn btn-flat custom btn-danger')->style('float:right; margin-left:2px') }}

                {{ html()->form()->close() }}

                {{ html()->form('GET', route('area.edit', $area->id))->open() }}

                {{ html()->submit('Edit')->class('btn btn-flat custom btn-info')->style('float:right') }}

                {{ html()->form()->close() }}

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')

    @include('layouts.showPolygon')
    <div class='row'>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="info-box">
                <a href="{{ route('area.show', $area) }}">
                    <span class="info-box-icon bg-aqua"><img id="iconmap" src="" style="margin-bottom: 10px;" alt=""></span>
                </a>
                <div class="info-box-content">
                    <span>
                        <h4><a href="{{ route('area.show', $area) }}">{{ $area->name }}</a></h4>
                    </span>
                    <span class="progress-description"> Address:
                        {{ $area->address }}
                    </span>
                    <span class="progress-description"> Created by:
                       <a href="{{ route('account.show', $area->account->id) }}">{{ $area->account->name }}</a>
                    </span>
                </div>


                <div id="area"></div>


                <br>
                <div class="row">
                    <div class="hidden-lg hidden-md hidden-sm col-xs-6">
                        {{ html()->form('GET', route('area.edit', $area->id))->open() }}

                        {{ html()->submit('Edit')->class('btn btn-flat btn-block btn-info') }}

                        {{ html()->form()->close() }}
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-6">


                        {{ html()->form('DELETE', route('area.destroy', $area->id))->open() }}

                        {{ html()->submit('Delete')->class('btn btn-flat btn-block btn-danger') }}

                        {{ html()->form()->close() }}

                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

@stop
