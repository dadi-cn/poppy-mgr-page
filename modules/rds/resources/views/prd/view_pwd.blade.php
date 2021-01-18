@extends('daniu.template.main')
@section('body-start')
	<body style="background-color: rgba(245, 246, 247, 1);">@stop
	@section('daniu-main')
		@include('front.inc.nav')
		<div class="daniu-message daniu-access container">
			{!! Form::open(['class'=>'form-group-sm']) !!}
			{!! Form::hidden('id', $id_crypt) !!}
			<div class="input-box">
				<label>您即将访问文档： {!! $item->prd_title !!}</label>
			</div>
			<div class="input-box">
				<label>请输入访问密码：
					@if($item->role_status)
						{!! Form::password('password', null) !!}
					@endif
					<input class="ml15 w120 btn btn-success J_submit" style="width: 120px !important;min-width:inherit!important;" type="submit" value="访问">
				</label>
			</div>
			{!! Form::close() !!}
		</div>
	@include('front.inc.footer')
@endsection