@extends('py-mgr-page::tpl.default')
@section('title', $_title ?? '')
@section('description', $_description ?? '')
@section('head-meta')
    {!! Html::favicon('assets/images/favicon.png') !!}
@endsection
@section('head-content')
    @include('py-mgr-page::tpl._js_css', [
        '_type' => ['layui', 'easy-web']
    ])
@endsection
@section('body-main')
    @include('py-mgr-page::tpl._toastr')
    <div class="layui-fluid" data-pjax pjax-ctr="#main" id="main">
        <div class="layui-card">
            @yield('backend-main')
        </div>
    </div>
    <script>
    layui.use(['form'], function() {
        layui.form.render();
    })
    </script>
@endsection