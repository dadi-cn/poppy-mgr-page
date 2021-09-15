@extends('misc::tpl.default')
@section('body-class', 'wuli--login')
@section('tpl-main')
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-10">
            <div class="login-box">
                <div class="login-logo">
                    {!! Html::image('res/icons/256x256.png') !!}
                </div>
                {!! Form::open(['route' => ['misc:user.register', $type], 'class'=> 'layui-form']) !!}
                <div class="form-group row">
                    {!!Form::label('type_'.$type, \Poppy\System\Models\PamAccount::kvRegType($type), ['class'=> 'col-xl-2 col-form-label'])!!}
                    <div class="col-xl-10">
                        {!! Form::text($type, null, [
                           'placeholder' => '请输入'.\Poppy\System\Models\PamAccount::kvRegType($type),
                           'class'=> 'form-control', 'id' => 'type_'.$type,
                           'autocomplete' => 'username'
                       ]) !!}
                    </div>
                </div>

                <div class="form-group row">
                    {!!Form::label('password', '密码', ['class'=> 'col-xl-2 col-form-label'])!!}
                    <div class="col-xl-10">
                        {!!Form::password('password', [
                            'placeholder' => '请设置密码','class'=> 'form-control' , 'autocomplete'=> 'new-password'
                        ])!!}
                        {!!Form::password('password_confirmation', [
                            'placeholder' => '请确认密码','class'=> 'form-control mt5' , 'autocomplete'=> 'new-password'
                        ])!!}
                    </div>
                </div>
                <div class="form-group row">
                    {!!Form::label('captcha', '验证码', ['class'=> 'col-xl-2 col-form-label'])!!}
                    <div class="col-xl-10">
                        {!! Form::text('captcha', null, [
                            'placeholder' => '请输入验证码',
                            'class'=> 'form-control w120 pull-left',
                        ]) !!}
                        {!! Html::image(captcha_src(), '点击刷新验证码', ['id'=> 'send_captcha', 'class'=> 'pull-left ml8', 'height'=> 38]) !!}
                        <script>
						$(function() {
							var $captcha = $('#send_captcha');
							$captcha.on('click', function() {
								$(this).attr('src', '{!! captcha_src() !!}' + (new Date()).getMilliseconds());
							});
						});
                        </script>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xl-12">
                        {!! Form::button('注册', ['class'=> 'btn btn-primary btn-block J_submit', 'type'=> 'submit']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xl-12">
                        <a href="{!! route('misc:user.login') !!}" class="btn btn-info btn-block">
                            登录
                        </a>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
@endsection