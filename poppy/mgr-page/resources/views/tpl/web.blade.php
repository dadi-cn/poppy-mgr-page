@extends('py-mgr-page::tpl.default')
@section('title', $_title ?? sys_setting('py-system::site.title'))
@section('keywords', $_keyword ?? sys_setting('py-system::site.keywords'))
@section('description', $_description ?? sys_setting('py-system::site.description'))
@section('head-css')
    {!! Html::style(mix('assets/css/web.css')) !!}
@endsection
@section('head-script')
    {!! Html::script(mix('assets/js/web.js')) !!}
@endsection