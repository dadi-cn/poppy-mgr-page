@extends('lemon.template.dialog')
@section('lemon_dialog-main')
	{!! Form::open(['route' => ['user.payword'], 'id' => 'form_account', 'method' => 'post', 'class'=>'form-horizontal' ]) !!}
	@if ($_front->payword)
	<div class="form-group">
		{!!Form::label('old_payword', '原支付密码', ['class'=> 'col-sm-2 validation control-label'])!!}
		<div class="col-sm-5">
			{!!Form::password('old_payword', ['class'=> 'form-control'])!!}
		</div>
	</div>
	@endif
	<div class="form-group">
		{!!Form::label('payword', '新支付密码', ['class'=> 'col-sm-2 validation control-label'])!!}
		<div class="col-sm-5">
			{!!Form::password('payword', ['class'=> 'form-control'])!!}
		</div>
	</div>
	<div class="form-group">
		{!!Form::label('payword_confirmation', '再次输入', ['class'=> 'col-sm-2 validation control-label'])!!}
		<div class="col-sm-5">
			{!!Form::password('payword_confirmation', ['class'=> 'form-control'])!!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-5">
			{!! Form::button('保存', ['type'=> 'submit', 'class' => 'btn btn-sm btn-white']) !!}
		</div>
	</div>
	{!! Form::close() !!}
	<script>
	require(['jquery', 'jquery.validate', 'lemon/util'], function ($) {
		var conf = util.validate_conf({
			rules : {
				old_payword : {
					required : true
				},
				payword : {
					required : true
				},
				payword_confirmation : {
					required : true,
					equalTo : '#payword'
				}
			}
		}, 'bt3');
		$('#form_account').validate(conf);
	});
	</script>
@endsection