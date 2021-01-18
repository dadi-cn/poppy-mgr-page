@extends('daniu.template.main')
@section('body-start')
    <body class="prd-detail">@endsection
    @section('daniu-main')
        @include('front.inc.nav')
        <div class="common--detail_top pb25">
            <div class="container">
                <div class="pull-left">
                    <h3>{!! $item->prd_title !!}</h3>
                    <p class="detail_top-desc">分类 : 产品文档 日期:{!! $item->created_at->format('Y-m-d') !!}</p>
                </div>
                <div class="pull-right pt35">
                    <p class="detail_top-download">&nbsp;</p>
                    <div class="detail_top-view">
                        <div class="btn-group">
                            <a data-url="{!! route('web:prd.good', [$item->id]) !!}"
                               class="btn  {!! $has_good ? 'btn-success' : 'btn-default btn-grey ' !!} J_good_view">
                                <span class="J_good iconfont icon-good"> </span> 赞
                            </a>
                            <span id="good_num" class="btn btn-default btn-static">{!! $item->good_num !!}</span>
                        </div>
                        <div class="btn-group">
                            <a data-url="{!! route('web:prd.bad', [$item->id]) !!}"
                               class="btn  {!! $has_bad ? 'btn-danger' : 'btn-default btn-grey ' !!} J_bad_view"><span
                                        class="J_bad iconfont icon-bad"> </span> 踩
                            </a>
                            <span id="bad_num" class="btn btn-default btn-static">{!! $item->bad_num !!}</span>
                        </div>
                        <div class="btn-group">
                            <a data-url="{!! route('web:prd.transfer', [$item->id]) !!}"
                               class="btn  {!! $has_transfer ? 'btn-success' : 'btn-default btn-grey J_transfer' !!} ">
                                <i class="iconfont icon-cloud-disk"></i> 转存
                            </a>
                            <span id="transfer_num"
                                  class="btn btn-default btn-static">{!! $item->transfer_num !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt35">
            <div class="row">
                <div class="col-md-9">
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
                    <p class="alert alert-warning">
                        建议大家针对这个资源的疑问、意见和建议，都可以在这里留言给贡献者，以促进交流、解决问题
                    </p>
                     @include('daniu.template.comment', [
                        'key' => 'prd_'.$item->id,
                        'title' => $item->title,
                        'user' => $item->front,
                        'comment' => $comment,
                    ])
                </div>
                <div class="col-md-3">
                    @include('front.inc.user_chip', [
                        'user'  => $item->front,
                        'front' => $_front,
                    ])
                    <div class="common--box-radius_light_grey mt15">
                        <h4>推荐信息</h4>
                        <div class="mt15 pd8">
                            {!! ad(4, "<div class=\"mt15\">", '</div>') !!}
                            {!! ad(5, "<div class=\"mt15\">", '</div>') !!}
                            {!! ad(6, "<div class=\"mt15\">", '</div>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
			require(['jquery', 'lemon/util', 'lemon/cp'], function ($, util) {
				function judge(good_num, bad_num, type) {
					$('#good_num').text(good_num);
					$('#bad_num').text(bad_num);
					var $good_view = $('.J_good_view');
					var $bad_view  = $('.J_bad_view');
					if (type == 'good') {
						// light good
						$good_view.addClass('btn-success').removeClass('btn-grey btn-default');

						// dark bad
						$bad_view.removeClass('btn-danger').addClass('btn-grey btn-default')

					} else {
						// light bad
						$bad_view.addClass('btn-danger').removeClass('btn-grey btn-default');

						// dark good
						$good_view.removeClass('btn-success').addClass('btn-grey btn-default');
					}
				}

				$(function () {
					$('.J_good').on('click', function () {
						util.animate($(this), 'bounceIn');
					});
					$('.J_good_view').on('click', function (e) {
						var $this = $(this);
						util.request_event($this, function (data) {
							util.splash(data, function (response_obj) {
								if (response_obj.status != 'error') {
									judge(response_obj.good_num, response_obj.bad_num, 'good');
								}
							})
						});
						e.preventDefault();
					});
					$('.J_bad').on('click', function () {
						util.animate($(this), 'bounceIn');
					});
					$('.J_bad_view').on('click', function (e) {
						var $this = $(this);
						util.request_event($this, function (data) {
							util.splash(data, function (response_obj) {
								if (response_obj.status == 'success') {
									judge(response_obj.good_num, response_obj.bad_num, 'bad');
								}
							})
						});
						e.preventDefault();
					});
					@if (!$has_transfer)
                    $('.J_transfer').on('click', function (e) {
						var $this = $(this);
						util.request_event($this, function (data) {
							util.splash(data, function (response_obj) {
								if (response_obj.status != 'error') {
									var $transfer_num = $('#transfer_num');
									$transfer_num.text(parseInt($transfer_num.text()) + 1);

									// 点赞成功, 移除句柄
									$this.addClass('btn-success')
										.removeClass('btn-grey')
										.removeClass('btn-default');
								}
							})
						});
						e.preventDefault();
					});
					@endif
				})
			})
        </script>
    @include('front.inc.footer')


@endsection