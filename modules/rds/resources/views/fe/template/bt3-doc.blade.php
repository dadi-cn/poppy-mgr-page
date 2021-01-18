@extends('slt::tpl.default')
@section('head-css')
    @parent
    {!! Html::script('resources/css/slt-doc.css') !!}
@endsection
@section('body-main')
	@yield('bt3-doc-main')
@endsection
@section('script-cp')
	<script>requirejs(['jquery', 'bt3'])</script>
@endsection