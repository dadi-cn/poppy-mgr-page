@extends('lemon.template.index')
@section('index-main')
	<div class="container">
		@include('lemon.inc.header')
	</div>
	<div class="container">
		<h3>酸柠檬项目平台</h3>
		<p class="alert alert-info">酸柠檬静态页面</p>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h4>邮件样式</h4>
				<ul class="list-group">
					<li class="list-group-item"><a href="{!! route('p', 'lemon.email.coding') !!}">Coding</a></li>
					<li class="list-group-item"><a href="{!! route('p', 'lemon.email.linkin') !!}">LinkIn</a></li>
					<li class="list-group-item"><a href="{!! route('p', 'lemon.email.daniu') !!}">产品大牛</a></li>
					<li class="list-group-item"><a href="{!! route('p', 'lemon.email.twitter') !!}">Twitter</a></li>
					<li class="list-group-item"><a href="{!! route('p', 'lemon.email.tb_dynamic') !!}">Tb - 动态</a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<h4>趣味</h4>
				<ul class="list-group">
					<li class="list-group-item"><a href="{!! route('p', 'lemon.js.mouse_track') !!}">鼠标追踪</a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<h4>shopnc样式</h4>
				<ul class="list-group">
					<li class="list-group-item"><a href="{!! route('p', 'lemon.shopnc.table') !!}">Shop Nc 样式</a></li>
					<li class="list-group-item"><a href="{!! route('p', 'lemon.js.cp') !!}">控制面板</a></li>
					<li class="list-group-item"><a href="{!! route('p', 'lemon.js.daohang') !!}">大牛导航</a></li>
				</ul>
			</div>
		</div>
	</div>
@endsection