<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>@if (isset($_title) && $_title) {!! $_title !!} - @endif 酸柠檬前端平台</title>
	@section('head-meta') @show
	@section('head-css') @show
	@section('head-script') @show
	@yield('head-appends')
	@include('lemon.inc.requirejs')
	<!--[if lt IE 9]>
	<script>requirejs(['h5shiv'])</script>
	<![endif]-->
</head>
@section('body-start')<body>@show

	@yield('body-main')

	@section('script-cp') @show
</body>
</html>