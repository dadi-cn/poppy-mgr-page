@extends('lemon.template.dialog')
@section('lemon_dialog-main')
	{!! Form::open(['route' => ['user.password'], 'id' => 'form_account', 'method' => 'post', 'class'=>'form-horizontal' ]) !!}
	<div class="form-group">
		{!!Form::label('old_password', '原密码', ['class'=> 'col-sm-2 validation control-label'])!!}
		<div class="col-sm-5">
			{!!Form::password('old_password', ['class'=> 'form-control'])!!}
		</div>
	</div>
	<div class="form-group">
		{!!Form::label('password', '新密码', ['class'=> 'col-sm-2 validation control-label'])!!}
		<div class="col-sm-5">
			{!!Form::password('password', ['class'=> 'form-control'])!!}
		</div>
	</div>
	<div class="form-group">
		{!!Form::label('password_confirmation', '再次输入', ['class'=> 'col-sm-2 validation control-label'])!!}
		<div class="col-sm-5">
			{!!Form::password('password_confirmation', ['class'=> 'form-control'])!!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-5">
			{!! Form::button('更改密码', ['type'=> 'submit', 'class' => 'btn btn-sm btn-white']) !!}
		</div>
	</div>
	{!! Form::close() !!}

	<script>
	require(['jquery', 'lemon/util', 'jquery.validate', 'jquery.form'], function ($, util) {
		var conf = util.validate_conf({
			submitHandler : function (form) {
				$(form).ajaxSubmit({
					success : util.splash_front
				});
			},
			rules : {
				old_password : {
					required : true
				},
				password : {
					required : true
				},
				password_confirmation : {
					required : true,
					equalTo : '#password'
				}
			}
		}, 'bt3');
		$('#form_account').validate(conf);
	});
	</script>

@endsection