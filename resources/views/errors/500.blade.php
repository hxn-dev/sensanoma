@extends('errors::layout')

@section('title', 'Error')
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop
@section('message')

    <h1>Error 500</h1>
    <h3>Whoops, looks like something went wrong.</h3>
    <h3><a href="/" style="text-decoration: none;">Back to homepage</a></h3>

@endsection