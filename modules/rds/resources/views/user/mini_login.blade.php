@extends('daniu.template.main')
@section('body-start')
    <body class="page-dialog">@endsection
@section('daniu-main')
	{!! Form::open(['route' => ['front_user.login','mini'], 'id' => 'form_login', 'method' => 'post', 'class'=>'form-daniu' ]) !!}
    <div class="form-group">
        <label>邮箱</label>
        {!! Form::text('email', null, ['placeholder' => '例如：cedar_xi@qq.com', 'class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <label>密码</label>
        {!!Form::password('password', ['placeholder' => '请输入密码', 'class'=>'form-control'])!!}
    </div>
    <div class="form-group clearfix">
        <label class="pull-left">
            {!!Form::checkbox('remember_me', 1, null, ['id'=> 'remember_me'])!!}
            记住登录状态
        </label>
        <a class="pull-right font-green" href="{!! route('front_user.forgot_password') !!}" target="_blank">找回密码</a>
    </div>
    <div class="form-group clearfix">
        {!! Form::button('登录', ['type'=> 'submit', 'class' => 'btn btn-success J_submit']) !!}
    </div>
	{!! Form::close() !!}
@endsection