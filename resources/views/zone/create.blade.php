@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content_header')
    @include('layouts.flash')
    <h1>Zone settings</h1>
@stop

@section('content')
<div class="row">

    {{ html()->form('POST', route('zone.store'))->open() }}
    <div class="col-md-12">
        {{ html()->submit('Add zone')->class('btn btn-primary pull-right hidden-lg hidden-md hidden-sm') }}

        <div class="form-group">
            {{ html()->label('Zone name','name')}}

            {{ html()->text('name')->class('form-control')->placeholder('Zone Name') }}
        </div>
        <div class="form-group">
            {{ html()->label('Crop','crop')}}

            {{ html()->text('crop')->class('form-control')->placeholder('Crop') }}
        </div>

        <div class="form-group">
            {{ html()->label('Area name','area_id') }}

            {{ html()->select('area_id', $areas)->class('form-control') }}
        </div>

        <div class="form-group">

            {{ html()->hidden('coordinates')->placeholder('Zone coordinates')->id('coordinates') }}
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">How to select the desired zone</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Steps</th>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Find the zone you want to select</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Click on each edge of the desired zone</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Connect the last line to the first one to close the selected zone</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            <div id="area">

                {!! Mapper::render() !!}

            </div>

        </div>
        <div class="form-group">

            {{ html()->submit('Add zone')->class('btn btn-primary pull-right') }}
        </div>
    </div>
    {{ html()->form()->close() }}
</div>
@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/polygon/make.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=drawing" async
            defer></script>
@stop



