@extends('site::tpl.layout-basic')
@section('body-class', 'essay--detail')
@section('layout-side')
    <div class="wuli--box detail-scroll_spy">
        <h3>目录</h3>
        <div class="panel panel-default">
            <div class="panel-body" id="markdown_nav">
                <ul class="nav">
                    {!! $titles !!}
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('layout-main')
    <div class="wuli--box">
        <h1 class="clearfix detail-title">
            {!! $item->title !!}
        </h1>
        <div class="detail-markdown_body">
            @if ($item)
                {!! $html !!}
            @else
                无内容
            @endif
        </div>
    </div>
    <script>
	$(function() {
		$('body').scrollspy({
			target : '#markdown_nav'
		});
	})
    </script>
@endsection