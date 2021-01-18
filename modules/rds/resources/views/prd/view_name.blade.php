@extends('daniu.template.main')
@section('body-start')
	<body class="bg-grey">@endsection
	@section('daniu-main')
        <div class="prd-header prd-view-header">
            <div class="container clearfix">
                <div class="prd-header-left pull-left clearfix">
                    @if (isset($parent_id) && $parent_id)
                        <a class="pull-left" href="{!! $parent_url !!}">
                            {!! Html::image('project/daniu/images/prd/return.png', '返回上一页', ['width' => 20]) !!}
                            返回上一页
                        </a>
                    @else
                        <span style="color:#BCBCBC">文档编写于 产品大牛</span>
                    @endif
                </div>
                <div class="prd-header-right pull-right">
                    <a id="J_full_screen" class="prd-header-full-screen">
                        {!! Html::image('project/daniu/images/prd/full_screen.png', '全屏浏览', ['width' => 20, 'height'=>20]) !!}
                        全屏浏览
                    </a>
                </div>
            </div>
        </div>
        <script>
			require(['jquery', 'lemon/util'], function ($, util) {
				$(function () {
					$('#J_full_screen').on('click', function () {
						util.full_screen();
					});
					$('body').css('min-height', (util.get_viewport().height - 40) + 'px');
				})
			})
        </script>
		<div class="container markdown prd-detail">
			<div class="prd-detail-title">
				<h3 class="clearfix">
					@if (count($level_titles))
						@foreach($level_titles as $num => $prd)
							@if ($num == 0)
								<a class="prd-title-first" href="{!! $prd->crypt_url !!}">
									{!! $prd->prd_title !!}
								</a>
							@else
								&gt;
								<a class="prd-title-small" href="{!! $prd->crypt_url !!}">
									{!! $prd->prd_title !!}
								</a>
							@endif
						@endforeach
						@if ($item)
							&gt;
							<small>
								{!! $item->prd_title !!}
							</small>
						@else
							&gt;
							<span class="prd-title-small">
									{!! $title !!}
								</span>
						@endif

					@else
						@if ($item)
							{!! $item->prd_title !!}
						@else
							&gt;
							<span class="prd-title-small">
									{!! $title !!}
								</span>
						@endif
					@endif
				</h3>
			</div>
			<div class="markdown-body">
				@if ($item)
					{!! $item->prd_content !!}
				@else
					无内容
				@endif
			</div>
		</div>
@endsection