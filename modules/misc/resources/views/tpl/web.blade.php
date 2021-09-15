@extends('py-mgr-page::tpl.default')
@section('title', $_title)
@section('description', $_description)
@section('head-script')
    {!! Html::script('app/js/libs/jquery-3.6.0.min.js') !!}
    {!! Html::script('app/js/libs/bootstrap.min.js') !!}
    {!! Html::script('assets/libs/vue/vue.js') !!}
@endsection
@section('head-meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endsection
@section('head-css')
    @if(sys_setting('misc::site.icon_url'))
        {!! Html::style(sys_setting('misc::site.icon_url')) !!}
    @endif
    {!! Html::style('app/css/libs/bootstrap.min.css') !!}
    {!! Html::style('app/css/libs/vue-animate.css') !!}
    {!! Html::style('app/css/web.css') !!}
@endsection