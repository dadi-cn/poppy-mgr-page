@extends('lemon.template.default')
@section('head-css')
    {!! Html::style('project/sour/css/bt3.css') !!}
    {!! Html::style('assets/css/3rd/animate.css') !!}
    {!! Html::style('assets/css/font/font-awesome.css') !!}
    {!! Html::style('project/sour/css/app.css') !!}
@endsection
@section('body-main')
    @if(isset($input))
        {!!  Session::flashInput($input) !!}
    @endif
    <div class="sour--message">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="hpanel
                        @if (Session::get('end.level') == 'success' ) hgreen  @endif
                        @if (Session::get('end.level') == 'error' ) hred  @endif
                        ">
                    <div class="panel-body">
                        <h3>
                            @if (Session::get('end.level') == 'success' )
                                <i class="fa fa-check-circle-o"></i>
                            @endif
                            @if (Session::get('end.level') == 'danger' )
                                <i class="fa fa-times-circle-o"></i>
                            @endif
                            {!! Session::get('end.message') !!}
                        </h3>
                        <div class="text-muted font-bold m-b-xs"><ul>
                                <li>Full version</li>
                                <li>Seed Project</li>
                            </ul></div>
                        <p>
                        @if (isset($location))
                            @if ($location == 'back' || $time == 0)
                                @if ($location != 'message')
                                    <a href="javascript:window.history.go(-1);">返回上级</a>
                                @endif
                            @else
                                您将在 <span id="clock">0</span>秒内跳转至目标页面, 如果不想等待, <a href="{!! $location !!}">点此立即跳转</a>!
                                <script>
                                    requirejs(['jquery'], function ($) {
                                        $(function () {
                                            var t = {!! $time !!};//设定跳转的时间
                                            setInterval(refer(), 1000); //启动1秒定时
                                            function refer() {
                                                if (t == 0) {
                                                    window.location.href = "{!! $location !!}"; //设定跳转的链接地址
                                                }
                                                $('#clock').text(Math.ceil(t / 1000)); // 显示倒计时
                                                t -= 1000;
                                            }
                                        })
                                    })
                                </script>
                            @endif
                        @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection