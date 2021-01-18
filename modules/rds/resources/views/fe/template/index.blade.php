@extends('lemon.template.default')
@section('head-css')
	<link rel="stylesheet" type="text/css" href="{!! assets('css/3rd/bt3.css') !!}" media="all" />
	<link rel="stylesheet" type="text/css" href="{!! assets('css/3rd/font-awesome.css') !!}" media="all" />
	<link rel="stylesheet" type="text/css" href="{!! project('lemon/css/plugin.css') !!}" media="all" />
@endsection
@section('body-main')
	@yield('index-main')
@endsection
@section('script-cp')
	<script>
		require(['jquery', 'bt3'])
	</script>
@endsection