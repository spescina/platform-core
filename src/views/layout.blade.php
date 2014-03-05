@extends('platform-core::base')

@section('header.styles')
{{ Asset::container('header.common')->styles() }}
@stop

@section('header.scripts')
{{ Asset::container('header.common')->scripts() }}
@stop

@section('footer.styles')
{{ Asset::container('footer.common')->styles() }}
@stop

@section('footer.scripts')
{{ Asset::container('footer.common')->scripts() }}
@stop

@section('header')
@include('platform-core::partials.header')
@stop

@section('footer')
@include('platform-core::partials.footer')
@stop
