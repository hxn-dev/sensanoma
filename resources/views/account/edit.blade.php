@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Edit account</h1>
@stop
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')
    {{ html()->form('PUT', route('account.update', $account))->open() }}
    <div class="col-md-12">
        <div class="form-group">
            {{ html()->label('Account name','name')}}

            {{ html()->text('name')->class('form-control')->value( $account->name ) }}
        </div>
        {{ html()->submit('Update')->class('btn btn-primary pull-right') }}
    </div>

    {{ html()->form()->close() }}

@stop
