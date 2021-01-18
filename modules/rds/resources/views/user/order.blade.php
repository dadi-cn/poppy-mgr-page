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
                        @if(!empty($items))
                            <table class="user_service-service_table">
                                <tr class="thead">
                                    <th>流水号</th>
                                    <th>购买服务</th>
                                    <th>购买日期</th>
                                    <th>详细</th>
                                    <th>消费金额</th>
                                </tr>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{!! $item->order_no !!}</td>
                                        <td>{!! $item->title !!}</td>
                                        <td>{!! $item->over_at !!}</td>
                                        <td>{!! $item->note !!}</td>
                                        <td>{!! $item->amount !!}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
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