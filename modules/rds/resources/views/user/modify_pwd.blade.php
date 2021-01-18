@extends('daniu.template.main')
@section('daniu-main')
	@include('front.inc.nav')
	<div class="container mb20 mt20">
		<div class="col-sm-2">
            <div class="user-side">
                <h4>账号设置</h4>
                @include('front.inc.user_my_side')
            </div>
		</div>
		<div class="col-sm-10">
            <div class="user-content input-box">
                {!! Form::open(['route' => 'front_user.modify_pwd','id' => 'modify_pwd']) !!}
                <h4>修改密码</h4>
                <div class="clearfix content-item content-email">
                    <p><b>当前密码<i class="font-red">*</i></b>
                        {!! Form::password('password',['min-width'=>'460px']) !!}
                    </p>
                </div>
                <div class="clearfix content-item content-email">
                    <p><b>新密码<i class="font-red">*</i></b>
                        {!! Form::password('new_password',['min-width'=>'460px']) !!}
                    </p>
                </div>
                <div class="clearfix content-item content-email">
                    <p><b>确认新密码<i class="font-red">*</i></b>
                        {!! Form::password('confirm_password',['min-width'=>'460px']) !!}
                    </p>
                    <p style="padding-left: 125px;">
                        {!! Form::button('修改', ['class'=>'btn btn-success fl J_submit']) !!}
                    </p>
                </div>
                {!! Form::close() !!}
            </div>
		</div>
	</div>
	@include('front.inc.footer')
@endsection