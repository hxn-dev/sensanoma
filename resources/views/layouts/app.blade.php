@extends('adminlte::page')


@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
{!! Charts::styles() !!}

@stop