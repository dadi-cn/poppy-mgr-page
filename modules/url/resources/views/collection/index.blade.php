@extends('site::tpl.default')
@section('body-class', 'url--home')
@section('tpl-main')
    <div class="row">
        <div class="col-3">
            <div class="home-description wuli--box mt15">
                <h3>收藏工具
                    <a class="J_iframe pull-right" data-width="600" data-height="480" data-title="收藏"
                       data-toggle="tooltip" title="收藏链接"
                       href="{!! route('url:web.collection.establish') !!}">
                        <i class="fa fa-plus"></i></a>
                </h3>
                <div>
                    把这个工具
                    <a href="javascript:@include('url::collection._quick')" title="保存链接" class="layui-btn layui-btn-sm">
                        <i class="fa fa-anchor"></i>
                        保存到 {!! sys_setting('system::site.name') !!}
                    </a>

                    拖动到书签栏, 点击就可以快速保存到网站了
                </div>
            </div>
            <div class="home-description wuli--box mt15">
                <h3>标签</h3>
                <div class="home-labels">
                    @if(isset($tags))
                        @foreach($tags as $tag)
                            <a href="?tag={!! $fun_remove($tag) !!}" class="layui-badge">
                                <i class="fa fa-times text-danger"></i> {!! $tag !!}
                            </a>
                        @endforeach
                        @if(isset($rel_tags))
                            @foreach($rel_tags as $tag)
                                <a href="?tag={!! $fun_add($tag['title']) !!}" class="layui-badge layui-bg-blue">
                                    <i class="fa fa-plus"></i> {!! $tag['title'] !!}
                                </a>
                            @endforeach
                        @endif
                    @else
                        @foreach($user_tags as $tag)
                            <a class="layui-badge-rim" href="?tag={!! $tag['title'] !!}">{!! $tag['title'] !!}</a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="home-display">
                <div class="home-infinite" id="infinite_scroll">
                    <div class="home-display_head clearfix">
                        {!! Form::open(['method'=> 'get', 'class'=> 'form-inline']) !!}
                        <div class="form-group">
                            {!! Form::text('kw', input('kw'), ['placeholder'=> '搜索内容...', 'class'=> 'form-control']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="home-display_content">
                        @if(!empty($items))
                            @foreach($items as $item)
                                <div class="clearfix display_content-ctr">
                                    <h4>
                                        <a target="_blank" class="display_content-title text-ellipsis" href="{!! $item->url !!} ">
                                            {!! $item->title !!}
                                        </a>
                                    </h4>
                                    @if ($item->tag_ids || $item->description)
                                        <p class="display_content-desc">
                                            <span class="display_content-tag">
                                                {!! \Url\Models\UrlRelTag::translate($item->tag_ids) !!}
                                            </span>
                                            {!!  $item->description !!}

                                        </p>
                                    @endif
                                    <div class="display_content-handle">
                                        @if ($_pam->can('edit', $item))
                                            <a href="{!! route('url:web.collection.establish', $item->id) !!}"
                                               data-toggle="tooltip" title="编辑" class="J_iframe">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @if ($items->hasMorePages())
                            <div class="home-empty_content">
                                <a class="j_next" href="{!! $items->nextPageUrl() !!}">下一页</a>
                            </div>
                        @else
                            <div class="home-empty_content">
                                我是有底线的
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
	$(function() {
		$('#infinite_scroll').jscroll({
			autoTrigger     : true,
			loadingHtml     : '<div class="home-empty_content text-center"><i class="fa fa-circle-notch fa-spin"></i> 加载中...</div>',
			padding         : 20,
			nextSelector    : 'a.j_next:last',
			contentSelector : '#infinite_scroll .home-display_content'
		});
	})
    </script>
@endsection