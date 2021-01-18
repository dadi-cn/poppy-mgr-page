@extends('daniu.template.main')
@section('body-start')
    <body class="bg-grey">@stop
    @section('daniu-main')
        @include('front.inc.nav')
        <div class="container user-min-box">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    {!! Form::open(['method'=>'post','id' => 'forgot-password',  'class' => 'form-daniu']) !!}
                    <h4 class="form-title text-center">找回密码</h4>
                    <div class="form-group">
                        <label>邮箱<span class="font-red">*</span></label>
                        {!! Form::text('email',null,['placeholder'=>'例如：cedar_xi@qq.com', 'class'=> 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>验证码<span class="font-red">*</span></label>
                        {!! Form::text('captcha',null,['placeholder'=>'请输入验证码', 'class'=> 'form-control']) !!}
                        <p><img id="captcha" src="{!! route('front_user.captcha') !!}"></p>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success J_submit form-control" type="submit"  value="提交">
                    </div>
                    {!!Form::close()!!}
                    <script>
                        require(['jquery'], function ($) {
                            $('#captcha').on('click', function () {
                                $(this).attr('src', $(this).attr('src') + '?_time' + Math.random())
                            })
                        })
                    </script>
                </div>
            </div>
        </div>
    @include('front.inc.footer')
@endsection