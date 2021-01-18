@extends('front.user.layout_account')
@section('ibox')
	@if ($items->total())
	<table class="table table-striped table-bordered table-hover dataTables-example">
		<thead>
		<tr>
			<th>状态</th>
			<th>账户</th>
			<th>账户类型</th>
			<th>说明</th>
			<th>IP</th>
			<th>登陆地区</th>
			<th>时间</th>
		</tr>
		</thead>
		<tbody>
		@foreach($items as $item)
			<tr>
				<td>{{$item['log_type']}}</td>
				<td>{{$item['account_name']}}</td>
				<td>
					{!! \App\Models\PamAccount::userTypeDesc($item->account_type) !!}
				</td>
				<td>{{$item['log_content']}}</td>
				<td>{{$item['log_ip']}}</td>
				<td>{{$item['log_area_text']}}</td>
				<td class="center">{{$item['created_at']}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	@if ($items->hasPages())
		<div class="pull-right">{!!$items->render()!!}</div>
	@endif
	@else
		@include('front.inc.empty')
	@endif
@endsection