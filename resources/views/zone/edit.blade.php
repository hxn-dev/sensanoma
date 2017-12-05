@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content_header')
    @include('layouts.flash')
    <h1>Zone settings</h1>
@stop

@section('content')
    @include('layouts.editPolygon')
    <div class="row">
    {{ html()->form('PUT', route('zone.update', $zone))->open() }}
    <div class="col-md-12">
        {{ html()->submit('Update')->class('btn btn-primary pull-right hidden-lg hidden-md hidden-sm') }}

        <div class="form-group">
            {{ html()->label('Zone name','name')}}
            {{ html()->text('name')->class('form-control')->placeholder('Zone Name')->value($zone->name) }}
        </div>
        <div class="form-group">
            {{ html()->label('Zone crop','crop')}}
            {{ html()->text('crop')->class('form-control')->placeholder('Zone Crop')->value($zone->crop) }}
        </div>

        <div class="form-group">
            {{ html()->label('Area name','area_id') }}

            {{ html()->select('area_id', $areas)->class('form-control') }}
        </div>

        <div class="form-group">
            {{ html()->hidden('coordinates')->placeholder('Zone coordinates')->value( json_encode($zone->coordinates))->id('coordinates') }}
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
                                <td>Move each bound to each edge of the desired zone</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Click on the grey bounds to create a new bound if necessary</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <div id="area"></div>
        </div>
        <div class="form-group">
            {{ html()->submit('Update')->class('btn btn-primary pull-right') }}
        </div>
    </div>
    {{ html()->form()->close() }}
</div>
@stop

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY') }}&libraries=drawing" async
            defer></script>

@stop

