@extends('errors::layout')

@section('title', 'Page Not Found')
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop
@section('message')

    <h1>Error 404</h1>
    <h4>Sorry, the page you are looking for could not be found or does no longer exist.</h4>
    <h3><a href="/" style="text-decoration: none;">Back to homepage</a></h3>


@endsection