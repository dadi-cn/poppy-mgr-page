{{-- 给 Form/Content 使用 --}}
@extends('py-mgr-page::tpl.default')
@section('title', $_title ?? '')
@section('description', $_description ?? '')
@section('head-meta')
	{!! Html::favicon('assets/images/favicon.png') !!}
@endsection
@section('head-css')
	@include('py-mgr-page::backend.tpl._style')
@endsection
@section('head-script')
	@include('py-mgr-page::backend.tpl._script')
@endsection
@section('body-class')
	{!! input('_iframe') === 'poppy' ? 'layui-iframe' : '' !!}
@endsection
@section('body-main')
	@include('py-mgr-page::tpl._toastr')
	<div class="layui-fluid system--page" data-pjax pjax-ctr="#main" id="main">
		@if ($title)
			<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
				<legend>
					{!! $title !!}
					@if ($description) <small>{!! $description !!}</small> @endif
				</legend>
			</fieldset>
		@endif
		{!! $content !!}
	</div>
@endsection