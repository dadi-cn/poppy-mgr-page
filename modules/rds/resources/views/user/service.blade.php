@extends('daniu.template.main')
@section('body-start')
    <body class="user_service">@stop
@section('daniu-main')
    @include('front.inc.nav')
    <div class="container mb20 mt20">
        <div class="col-sm-2">
            <div class="user-side">
                <h4>财务中心</h4>
                @include('front.inc.user_finance_side')
            </div>
        </div>
        <div class="col-sm-10">
            <div class="user-content">
                <h4>财务总览</h4>
                <div class="user_service-content">
                    <h5 class="user_service-title">PMDANIU个人专业版服务 <a href="{!! route('front_home.price') !!}">[查看收费及服务介绍]</a></h5>
                    <table class="user_service-service_table">
                        <tr class="thead">
                            <th>服务状态</th>
                            <th>到期时间</th>
                            <th>操作</th>
                        </tr>
                        @if ($is_at_service)
                        <tr>
                            <td>已购买</td>
                            <td>{!! $_front->service_end_at !!}</td>
                            <td><a href="{!! route('front_prototype.pay', 1) !!}" class="btn btn-success">续费</a></td>
                        </tr>
                        @else
                        <tr>
                            <td>未购买</td>
                            <td> - </td>
                            <td><a href="{!! route('front_home.price') !!}" class="btn btn-success">开通</a></td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        require(['jquery', 'lemon/cp'], function ($) {

        });
    </script>
    @include('front.inc.footer')
@endsection