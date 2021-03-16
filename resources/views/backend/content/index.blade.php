@extends('py-mgr-page::backend.tpl.dialog')
@section('backend-main')

	<table class="layui-table">
		<tr>
			<th class="w84 text-center">广告ID</th>
			<th>广告名称</th>
			<th>排序</th>
			<th>开始时间</th>
			<th>结束时间</th>
			<th class="w96">操作</th>
		</tr>
		@if ($items->total())
			@foreach($items as $item)
				<tr>
					<th class="text-center">{{ $item->id }}</th>
					<th>{{ $item->title }}</th>
					<th>{{ $item->list_order }}</th>
					<th>{{ $item->start_at }}</th>
					<th>{{ $item->end_at }}</th>
					<td>
						@if($item->status)
							<a class="J_request J_tooltip" title="点击关闭"
								href="{{route_url('py-ad:backend.content.toggle', [$item->id])}}">
								<i class="fa fa-check-circle text-info"></i>
							</a>
						@else
							<a class="J_request J_tooltip" title="点击开启"
								href="{{route_url('py-ad:backend.content.toggle', [$item->id])}}">
								<i class="fa fa-ban text-danger"></i>
							</a>
						@endif
						<a class="J_tooltip" title="编辑"
							href="{{route_url('py-ad:backend.content.establish', $item->id,['place_id'=>$item->place_id])}}">
							<i class="fa fa-edit text-info"></i>
						</a>
						<a title="删除" class="J_request J_tooltip"
							data-confirm="确认删除此广告`{!! $item->title !!}`?"
							href="{{route('ad:backend.content.delete', [$item->id])}}">
							<i class="fa fa-times text-danger"></i>
						</a>
					</td>
				</tr>
			@endforeach
		@else
			<tr>
				<td colspan="23">
					@include('py-mgr-page::backend.tpl._empty')
				</td>
			</tr>
		@endif
	</table>
	{!! $items->render() !!}
@endsection