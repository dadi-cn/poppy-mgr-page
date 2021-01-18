@extends('system::tpl.default')
@section('head-css')
    @include('site::tpl._style')
@endsection
@section('head-script')
    @include('site::tpl._script')
@endsection
@section('body-class') wuli--dialog @yield('body-dialog_class') @endsection
@section('body-main')
    @include('system::tpl._toastr')
    @yield('tpl-main')
@endsection