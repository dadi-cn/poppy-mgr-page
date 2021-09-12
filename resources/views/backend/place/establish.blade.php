@extends('py-mgr-page::backend.tpl.dialog')
@section('backend-main')

	{!! Form::model($item ?? null,['route' => [$_route, $id ?? ''],'class' => 'layui-form']) !!}
	<div class="layui-form-item">
		{!! Form::label('title', '广告位名称', ['class' => 'validation']) !!}
		{!! Form::text('title',null, ['class' => 'layui-input']) !!}
	</div>

	<div class="layui-form-item">
		{!! Form::label('width', '广告位宽度', ['class' => 'validation']) !!}
		{!! Form::text('width',null, ['class' => 'layui-input']) !!}
	</div>

	<div class="layui-form-item">
		{!! Form::label('height', '广告位高度', ['class' => 'validation']) !!}
		{!! Form::text('height',null, ['class' => 'layui-input']) !!}
	</div>

	<div class="layui-form-item">
		{!! Form::label('thumb', '广告位示意图', ['class' => 'validation']) !!}
		{!! Form::thumb('thumb', null,['pam' => $_pam]) !!}
	</div>

	<div class="layui-form-item">
		{!! Form::label('introduce', '广告位介绍', ['class' => 'validation']) !!}
		{!! Form::textarea('introduce',null, ['class' => 'layui-textarea', 'rows'=> 3]) !!}
	</div>

	{!! Form::button(isset($item) ? '编辑' : '添加', ['class'=>'layui-btn J_submit', 'type'=> 'submit']) !!}
	{!! Form::close() !!}
@endsection