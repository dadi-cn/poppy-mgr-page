@extends('lemon.template.default')
@section('head-css')
	<link rel="stylesheet" type="text/css" href="{!! assets('css/3rd/bt3.css') !!}" media="all" />
	<link rel="stylesheet" type="text/css" href="{!! assets('css/3rd/font-awesome.css') !!}" media="all" />
@endsection
@section('body-main')
    <div class="container">
        @yield('bootstrap-main')
    </div>
@endsection
@section('script-cp')
	<script>
	require(['lemon/doc', 'bt3'], function (doc) {
		doc.fill_and_highlight('J_script_source', 'J_script', 'script');
		doc.highlight();
		doc.trim_content('J_html');
	})
	</script>
@endsection