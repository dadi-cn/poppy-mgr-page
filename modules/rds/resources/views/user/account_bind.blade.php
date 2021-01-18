@extends('front.user.layout_account')
@section('ibox')
	<div class="form-group clearfix">
		<div class="col-sm-2 control-label">已绑定:</div>
		<div class="col-sm-5">
			@if($bind['qq_key'])
				<a class="btn btn-info btn-sm" title="取消绑定!" href="{!! route_url('user.account_unbind', '', ['type'=> 'qq']) !!}">腾讯QQ <i class="fa fa-close text-danger"></i></a>
			@endif
		</div>
	</div>
	<div class="form-group clearfix">
		<div class="col-sm-2 control-label">未绑定:</div>
		<div class="col-sm-5">
			@if(!$bind['qq_key'])
				<a class="btn btn-info btn-sm" href="{!! route('user.socialite', ['type'=> 'qq']) !!}">腾讯QQ</a>
			@endif
		</div>
	</div>
@endsection