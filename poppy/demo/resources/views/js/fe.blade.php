@extends('py-mgr-page::backend.tpl.default')
@section('backend-main')
	<div class="layui-container">
		<div class="layui-row layui-col-space15 mt15">
			<div class="layui-col-xs3" style="line-height: 2;">
				@include('py-demo::js._side')
			</div>
			<div class="layui-col-xs9">
				@if(if_query('type', ''))
					@include('py-demo::js.fe-index')
				@else
					@include('py-demo::js.fe-'.input('type'))
				@endif
			</div>
		</div>
	</div>
@endsection