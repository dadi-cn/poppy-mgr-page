@extends('site::tpl.dialog')
@section('body-dialog_class', 'wuli--login')
@section('tpl-main')
    <div class="login-box">
        <div class="login-logo">
            {!! Html::image('res/icons/256x256.png') !!}
        </div>
        {!! Form::open() !!}
        {!! Form::hidden('_go', Url::previous()) !!}
        <div class="form-group">
            {!! Form::text('passport', null, [
                'placeholder' => '请输入手机号/邮箱/用户名',
                'class'=> 'form-control','autocomplete' => 'username'
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password', [
               'placeholder' => '请输入密码',  'autocomplete'=> 'current-password',
               'class'=> 'form-control', 'id'=> 'password']) !!}
        </div>
        <div class="form-group">
            {!! Form::button('登录', ['class'=> 'btn btn-primary btn-block J_submit','type'=> 'submit']) !!}
        </div>
        <div class="form-group ">
            <a href="{!! route('site:user.register') !!}" class="btn btn-info btn-block">
                注册
            </a>
        </div>
        <div class="form-group ">
            <a href="{!! route('slt:user.forgot_password') !!}" class="btn-block text-center">
                忘记密码?
            </a>
        </div>
        {!! Form::close() !!}
    </div>
@endsection