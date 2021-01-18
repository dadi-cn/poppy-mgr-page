@extends('lemon.template.default')
@section('head-css')
	<link rel="stylesheet" type="text/css" href="{!! assets('css/screen.css') !!}" media="all" />
	<link rel="stylesheet" type="text/css" href="{!! assets('css/3rd/font-awesome.css') !!}" media="all" />
@endsection
@section('body-main')
	<div class="container">
		@yield('screen-main')
	</div>
@endsection