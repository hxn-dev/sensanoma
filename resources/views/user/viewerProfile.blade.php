@extends('adminlte::pageUser')

@section('content_header')
    @include('layouts.flash')
    <div class="row">
        <div class="form-group">
            <label id="head_label" class="col-md-4 col-sm-5 col-xs-12 col-md-offset-2 col-sm-offset-1">User Settings</label>

            <div class="col-md-4 col-sm-5 hidden-xs">

                @if(Auth::user()->hasRole('admin'))

                    {{ html()->form('DELETE', route('user.destroy', Auth::user() ))->open() }}

                    {{ html()->submit('Delete')->class('btn btn-flat custom btn-danger')->style('float:right; margin-left:2px') }}

                    {{ html()->form()->close() }}

                @endif
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')

<div class='row'>
    
    <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1">
            <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
                <h5 class="widget-user-desc">E-mail: {{ Auth::user()->email }}</h5>
                <h5 class="widget-user-desc">Created: {{ Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle user-img" src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="User Avatar">
            </div>
            <div class="box-footer">
                <br>
                <div class="row">

                    <div class="col-md-12">

                        {{ html()->form('PUT', url('user'))->acceptsFiles()->open() }}

                        <div class="form-group">
                            {{ html()->label('User name','name')}}

                            {{ html()->text('name')->class('form-control')->value( Auth::user()->name ) }}


                            {{ html()->label('Current password','current_password')}}

                            {{ html()->password('current_password')->class('form-control') }}


                            {{ html()->label('New password','password')}}

                            {{ html()->password('password')->class('form-control') }}


                            {{ html()->label('Confirm New Password','password_confirmation')}}

                            {{ html()->password('password_confirmation')->class('form-control') }}



                            {{ html()->label('User Avatar','avatar')}}

                            {{ html()->file('avatar') }}
                        </div>

                        {{ html()->submit('Update')->class('btn btn-primary pull-right') }}

                        {{ html()->form()->close() }}
                    </div>

                    <div class="hidden-lg hidden-md hidden-sm col-xs-6">
                        @if(Auth::user()->hasRole('admin'))
                            {{ html()->form('DELETE', Route('user.destroy', Auth::user()->id ))->open() }}

                            {{ html()->submit('Delete')->class('btn btn-danger')->style('float:left;') }}

                            {{ html()->form()->close() }}
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>

@stop