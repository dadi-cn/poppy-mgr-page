@extends('py-mgr-page::tpl.default')
@section('head-css')
    @include('py-mgr-page::backend.tpl._style', [
        '_type' => ['!easy-web']
    ])
@endsection
@section('head-script')
    @include('py-mgr-page::backend.tpl._script', [
        '_type' => ['!easy-web']
    ])
@endsection
@section('body-main')
    @include('py-mgr-page::tpl._toastr')
    <div class="container">
        @yield('dialog-main')
    </div>
@endsection