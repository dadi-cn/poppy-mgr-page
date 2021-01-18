@extends('site::tpl.default')
@section('tpl-main')
    <style>
        html {
            width  : 100%;
            height : 100%;
        }
    </style>
    {!! Form::model($item ?? null,[
        'route' => ['essay:article.establish', $item->id ?? null ],
        'id' => 'form_md', 'style'=> 'height:100%', 'class'=> 'mt10']) !!}
    {!! Form::hidden('book_id', $book_id) !!}
    {!! Form::hidden('title', isset($item) ? null : input('title')) !!}
    <div class="clearfix">
        <span class="layui-breadcrumb">
            <a href="">编辑文档</a>
            <a><cite>{!! $item->title !!}</cite></a>
        </span>
    </div>
    <div>
        {!! Form::simplemde('content', null, ['pam'=> $pam]) !!}
    </div>
    {!! Form::close() !!}
    <script>
    $(function(){
	    $('#form_md').ajaxForm({
		    success:    function(data) {
			    Util.splash(data)
		    }
	    })
    })
    </script>
    @include('site::tpl._footer')
@endsection