<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@if (isset($_title) && $_title) {!! $_title !!} @endif</title>
    @section('head-meta') @show
    @section('head-css') @show
    @include('slt::inc.requirejs')
</head>

<body class="@yield("body-class")">

@yield('body-main')

@yield('script-cp')
</body>
</html>