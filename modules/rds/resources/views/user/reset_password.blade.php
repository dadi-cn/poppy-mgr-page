@extends('daniu.template.main')
@section('body-start')
	<body style="background-color: rgba(245, 246, 247, 1);">@stop
	@section('daniu-main')
		@include('front.inc.nav')
		<div class="daniu-message findPwd container">
			@if (isset($item))
				{!! Form::model($item,['route' => ['front_user.reset_password', $item->account_id], 'id' => 'reset-password', 'method' => 'post', 'class'=>'min-form' ]) !!}
				<h4 class="form-title text-center">重置密码</h4>
				<div class="input-box">
					<label>邮箱账户<span class="font-red">*</span>
						{!! Form::label('account_name',$item->account_name) !!}
					</label>
				</div>
				<div class="input-box">
					<label>密码<span class="font-red">*</span></label>
					{!! Form::password('password',null) !!}
				</div>
				<div class="input-box">
					<label>确认密码<span class="font-red">*</span></label>
					{!! Form::password('confirm_password',null) !!}
				</div>
				<div class="input-box">
					<input class="button" type="submit" name="submit" value="提交">
				</div>
				{!!Form::close()!!}
			@endif
		</div>
	@include('front.inc.footer')
@endsection