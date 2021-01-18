@extends('py-mgr-page::tpl.default')
@section('head-css')
    @include('py-mgr-page::backend.tpl._style')
    <style>
        body {
            font-size : 14px;
        }
    </style>
@endsection
@section('head-script')
    @include('py-mgr-page::backend.tpl._script')
@endsection
@section('body-main')
    @include('py-mgr-page::tpl._toastr')
    <div class="container">
        @yield('dialog-main')
    </div>
@endsection