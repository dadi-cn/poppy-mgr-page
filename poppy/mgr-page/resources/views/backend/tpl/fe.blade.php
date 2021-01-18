@extends('py-mgr-page::tpl.default')
@section('title', $_title ?? '')
@section('description', $_description ?? '')
@section('head-css')
    @include('py-mgr-page::backend.tpl._style')
@endsection
@section('head-script')
    @include('py-mgr-page::backend.tpl._script')
@endsection
@section('body-main')
    @yield('backend-fe')
@endsection