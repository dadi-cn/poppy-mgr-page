@extends('system::tpl.default')
@section('title', $_title ?? '')
@section('head-css')
    @include('site::tpl._style')
@endsection
@section('head-script')
    @include('site::tpl._script')
@endsection
@section('head-meta')
    {!! Html::favicon('res/icons/256x256.png') !!}
@endsection
@section('body-main')
    @include('system::tpl._toastr')
    @include('site::tpl._nav')
    <div class="container" id="main" data-pjax pjax-ctr="#main">
        @yield('tpl-main')
    </div>
    @include('site::tpl._footer')
@endsection