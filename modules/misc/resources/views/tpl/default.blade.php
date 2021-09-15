@extends('system::tpl.default')
@section('title', $_title ?? '')
@section('head-css')
    @include('misc::tpl._style')
@endsection
@section('head-script')
    @include('misc::tpl._script')
@endsection
@section('head-meta')
    {!! Html::favicon('res/icons/256x256.png') !!}
@endsection
@section('body-main')
    @include('system::tpl._toastr')
    @include('misc::tpl._nav')
    <div class="container" id="main" data-pjax pjax-ctr="#main">
        @yield('tpl-main')
    </div>
    @include('misc::tpl._footer')
@endsection