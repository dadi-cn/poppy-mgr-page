@extends('lemon.template.default')
@section('head-css')
    {!! Html::style('project/sour/css/bt3.css') !!}
    {!! Html::style('assets/css/3rd/animate.css') !!}
    {!! Html::style('assets/css/font/font-awesome.css') !!}
    {!! Html::style('project/sour/css/app.css') !!}
@endsection
@section('head-js')

    {!! Html::script("/assets/js/libs/react/15.5.4/react.min.js") !!}
    {!! Html::script("/assets/js/libs/react/15.5.4/react-dom.min.js") !!}
    {{--
    {!! Html::script("/assets/js/libs/react/15.5.4/react.js") !!}
    {!! Html::script("/assets/js/libs/react/15.5.4/react-dom.js") !!}
    --}}
@endsection
@section('body-main')
    @yield('tpl-main')
@endsection