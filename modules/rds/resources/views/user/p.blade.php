@extends('daniu.template.main')
@section('body-start')
    <body class="user_p">
    @endsection
    @section('daniu-main')
        @include('front.inc.nav')
        <div class="user_p-main-info">
            <div class="container">
                @if ($_front && $_front->account_id == $user->account_id)
                    <div class="user_p-tips clearfix mt8">
                        <p class="pull-left">
                            你在PMdaniu里的信息、上传公开作品所获得同行点赞和认可，将在个人主页里展示 <br>
                            在求职简历加上PMdaniu的个人主页地址，将有助于你的工作求职和猎头招聘
                        </p>
                        <p class="pull-right text-right">
                            @if (!$user->url_address)
                                @can('edit', $user)
                                    <a class="font-green" href="{!! route('front_user.profile') !!}">
                                        <i class="iconfont icon-setting"></i> 设置主页地址
                                    </a>
                                    <br>
                                @endcan
                            @endif
                            主页地址
                            <a href="{!! \App\Models\AccountFront::shortUrl($user) !!}">{!! \App\Models\AccountFront::shortUrl($user) !!}</a>
                        </p>
                    </div>
                @endif
                <div class="row mt20">
                    <div class="col-sm-5">
                        <div class="user_p-avatar pt25">
                            <img src="{!! avatar($user->head_pic) !!}" alt="{!! $user->nickname !!}" class="img-circle">
                        </div>
                        <div class="user_p-info pt25">
                            <h5>
                                {!! $user->nickname !!}
                                @if($user->gender == \App\Models\AccountFront::GENDER_SECRET)
                                    <i class="user_p-gender iconfont icon-gender"></i>
                                @endif
                                @if($user->gender == \App\Models\AccountFront::GENDER_MALE)
                                    <i class="user_p-gender iconfont icon-male font-blue"></i>
                                @endif
                                @if($user->gender == \App\Models\AccountFront::GENDER_FEMALE)
                                    <i class="user_p-gender iconfont icon-female font-pink"></i>
                                @endif
                            </h5>
                            <p>所在城市: {!! $user->area_name ?: '暂无信息' !!}</p>
                            <p>博客地址:
                                @if($user->blog_url)
                                    <a target="_blank" href="{!! $user->blog_url !!}">{!! $user->blog_url !!}</a>
                                @else
                                    暂无信息
                                @endif
                            </p>
                            <div class="user_p-society">
                                @if($user->twitter_url)
                                    <a href="{!! $user->twitter_url !!}" target="_blank"
                                       class="font-twitter iconfont icon-twitter"></a>
                                @endif
                                @if($user->zhihu_url)
                                    <a href="{!! $user->zhihu_url !!}" target="_blank"
                                       class="font-zhihu iconfont icon-zhihu"></a>
                                @endif
                                @if($user->weibo_url)
                                    <a href="{!! $user->weibo_url !!}" target="_blank"
                                       class="font-weibo iconfont icon-weibo"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="user_p-attention pt25">
                            <p class="clearfix">
                                <span>
                                    <a href="{!! route('front_user.collection', ['attention', $user->account_id]) !!}">
                                    关注<br>
                                    <em>{!! $user->attention_num !!}人</em>
                                    </a>
                                </span>
                                <span class="user_p-attention_split"></span>
                                <span>
                                    <a href="{!! route('front_user.collection',['fans', $user->account_id]) !!}">
                                    粉丝 <br>
                                    <em>{!! $user->fans_num !!}人</em>
                                    </a>
                                </span>
                            </p>
                            @if ($_front && $_front->account_id != $user->account_id)
                                @can('follow', $user)
                                    <a href="{!! route('front_user.attention', $user->account_id) !!}"
                                       class="J_request btn btn-success">+ 关注</a>
                                @endcan
                                @can('un_follow', $user)
                                    <a href="{!! route('front_user.attention', [$user->account_id, 'cancel']) !!}"
                                       class="J_request btn btn-success">取消关注</a>
                                @endcan
                            @else
                                @if (!$_front || ($_front && $_front->account_id != $user->account_id))
                                    <a href="{!! route('front_user.login', 'mini') !!}"
                                       class="btn btn-success J_iframe">关注</a>
                                @endif
                            @endif

                            @can('edit', $user)
                                <a class="btn btn-success btn-sm" target="_blank"
                                   href="{!! route('front_user.profile') !!}">编辑我的基本信息</a>
                            @endcan
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="user_p-introduction">
                            <h5>&nbsp;
                                @can('edit', $user)
                                    <a target="_blank"
                                       href="{!! route('front_user.profile') !!}#description">
                                        <i class="fa fa-pencil"></i>
                                        编辑
                                    </a>
                                @endcan
                            </h5>
                            <div>
                                @if ($user->description)
                                    {!! $user->description !!}
                                @else
                                    暂时没有个人介绍
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt20">
            <div class="row">
                <div class="col-sm-5">
                    <div class="user_p-box">
                        <h4>
                            TA 作品收获的认可
                            <span class="pull-right user_p-total_num">
                                <i class="iconfont icon-good"> {!! $zan_num !!}</i>
                                <i class="iconfont icon-download"> {!! $download_num !!}</i>
                            </span>
                        </h4>
                        <div class="user_p-box-content">
                            <div id="person_statics" style="height: 200px"></div>
                            <script>
								require(['echarts'], function (echarts) {
									var myChart  = echarts.init(document.getElementById('person_statics'));
									var dataAxis = ['点赞', '下载'];
									var data     = [{!! $zan_num !!}, {!! $download_num !!}];
//									var yMax       = 100;
//									var dataShadow = [];
//
//									for (var i = 0; i < data.length; i++) {
//										dataShadow.push(yMax);
//									}

									var option = {
										xAxis   : {
											data     : dataAxis,
											axisLabel: {
												inside   : false,
												textStyle: {
													color: '#000'
												}
											},
											axisTick : {
												show: false
											},
											axisLine : {
												show: false
											},
											z        : 10
										},
										yAxis   : {
											axisLine : {
												show: false
											},
											axisTick : {
												show: false
											},
											axisLabel: {
												textStyle: {
													color: '#999'
												}
											}
										},
										dataZoom: [
											{
												type: 'inside'
											}
										],
										series  : [
											{ // For shadow
												type          : 'bar',
												itemStyle     : {
													normal: {color: 'rgba(0,0,0,0.05)'}
												},
												barGap        : '-100%',
												barCategoryGap: '40%',
//												data          : dataShadow,
												animation     : false
											},
											{
												type     : 'bar',
												itemStyle: {
													normal  : {
														color: new echarts.graphic.LinearGradient(
															0, 0, 0, 1,
															[
																{offset: 0, color: '#83bff6'},
																{offset: 0.5, color: '#188df0'},
																{offset: 1, color: '#188df0'}
															]
														)
													},
													emphasis: {
														color: new echarts.graphic.LinearGradient(
															0, 0, 0, 1,
															[
																{offset: 0, color: '#2378f7'},
																{offset: 0.7, color: '#2378f7'},
																{offset: 1, color: '#83bff6'}
															]
														)
													}
												},
												data     : data
											}
										]
									};
									myChart.setOption(option);
								})
                            </script>
                        </div>
                    </div>
                    <div class="user_p-box mt20">
                        <h4 class="user_p-store_status">
                            <span>原型私有仓状态</span>
                            |
                            <span>PRD状态</span>
                        </h4>
                        <div class="user_p-box-content">
                            <div class="user_p-store_status">
                                <span>
                                    @if ($is_private)
                                        使用中
                                    @else
                                        --
                                    @endif
                                </span>
                                <span>
                                    @if ($is_prd)
                                        使用中
                                    @else
                                        --
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="user_p-box">
                        <h4>TA的活跃度</h4>
                        <div class="user_p-box-content user_p-heatmap">
                            <div id="cal-heatmap" style="height: 150px;"></div>
                            <script>
								require(['d3', 'calendar-heatmap'], function (d3, calendarHeatmap) {
									// chart data example
									var chartData = {!! $heat_map !!};
									var chart1    = calendarHeatmap()
										.data(chartData)
										.selector('#cal-heatmap')
										.colorRange(['#4ba15e', '#afec91'])
										.tooltipEnabled(true)
										.legendEnabled(false);
									chart1();  // render the chart
								})
                            </script>
                            <p>
                                活跃度分为1-5个等级，每升一级需要2分，颜色越深代表活跃度越高<br>
                                每日登录＋2分，点赞或转存＋2分，编写文档＋4分，上传或更新原型+4分 每日不重复记录
                            </p>
                            <p class="user_p-heatmap_legend">
                                <span>&nbsp;</span>
                                <span>&nbsp;</span>
                                <span>&nbsp;</span>
                                <span>&nbsp;</span>
                                <span>&nbsp;</span>
                            </p>
                        </div>
                    </div>
                    <div class="user_p-box mt20">
                        <h4>TA 的公开原型作品（共{!! count($rp_items) !!}个）</h4>
                        <div class="user_p-box-content clearfix pd15">
                            @if ($rp_items)
                                <div id="rp_nav">
                                    @foreach($rp_items as $rp)
                                        <div class="row user_p-rp_item mt8" style="display: none;">
                                            <div class="col-md-3">
                                                <span class="user_p-rp_item_num mr17">
                                                    <span>{!! $rp->download_num !!}</span>
                                                <br> 下载
                                                </span>
                                                <span class="user_p-rp_item_num block_num @if ($rp->good_num != 0) active @endif">
                                                    <span>{!! $rp->good_num !!}</span>
                                                    <br> 被赞
                                                </span>
                                            </div>
                                            <div class="col-md-8">
                                                <h4><a href="{!! route('front_rp.detail', [$rp->id]) !!}"
                                                       target="_blank">{!! $rp->title !!}</a>
                                                </h4>
                                                <p>{!! $rp->front->nickname !!} 分享于 <span
                                                            class="J_timeago">{!! $rp->created_at !!}</span></p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="clearfix">
                                    <ul class="pagination pagination-sm pull-right" id="rp_pagination"></ul>
                                </div>
                                @if (ceil(count($rp_items)/4))
                                    <script>
										require(['jquery', 'jquery.bt3', 'jquery.bt3.twbs-pagination'], function () {
											$(function () {
												$('#rp_pagination').twbsPagination({
													totalPages : {!! ceil(count($rp_items)/4) !!},
                                                    visiblePages : 4,
													onPageClick: function (event, page) {
														$('#rp_nav>div').hide();
														$('#rp_nav>div:eq(' + ((page - 1) * 4) + ')').show();
														$('#rp_nav>div:eq(' + ((page - 1) * 4) + 1 + ')').show();
														$('#rp_nav>div:eq(' + ((page - 1) * 4 + 2) + ')').show();
														$('#rp_nav>div:eq(' + ((page - 1) * 4 + 3) + ')').show();
													}
												});
											})
										})
                                    </script>
                                @endif
                            @else
                                暂无公开原型作品
                            @endif

                        </div>
                    </div>
                    <div class="user_p-box mt20">
                        <h4>TA 分享的组件（共{!! count($rplib_items) !!}个）</h4>
                        <div class="user_p-box-content clearfix pd15">
                            @if ($rplib_items)
                                <div id="rplib_nav">
                                    @foreach($rplib_items as $rplib)
                                        <div class="row user_p-rplib_item mt8" style="display: none;">
                                            <div class="col-md-1">
                                                <span class="user_p-rplib_item_num mb6 block_num @if ($rplib->good_num != 0) active @endif">
                                                    <span> {!! $rplib->good_num !!} </span>
                                                    <br> 被赞
                                                </span>
                                                <span class="user_p-rplib_item_num">
                                                    <span> {!! $rplib->download_num !!} </span>
                                                   <br> 下载
                                                </span>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="{!! route('front_rplib.detail', [$rplib->id]) !!}" class="user_p-rplib_img_wrap"
                                                   target="_blank">
                                                    {!! Html::image($rplib->thumb ?: 'project/daniu/images/default/pmdaniu.gif', $rplib->title, ['class'=> 'user_p-rplib_thumb']) !!}
                                                </a>
                                            </div>
                                            <div class="col-md-8">
                                                <h4><a href="{!! route('front_rplib.detail', [$rplib->id]) !!}"
                                                       target="_blank">{!! $rplib->title !!}</a></h4>
                                                <p>{!! $rplib->front->nickname !!} 分享于 <span
                                                            class="J_timeago">{!! $rplib->created_at !!}</span></p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="clearfix">
                                    <ul class="pagination pagination-sm pull-right" id="rplib_pagination"></ul>
                                </div>
                                @if (ceil(count($rplib_items)/4))
                                    <script>
										require(['jquery', 'jquery.bt3', 'jquery.bt3.twbs-pagination'], function () {
											$(function () {
												$('#rplib_pagination').twbsPagination({
													totalPages : {!! ceil(count($rplib_items)/4) !!},
													onPageClick: function (event, page) {
														$('#rplib_nav>div').hide();
														$('#rplib_nav>div:eq(' + ((page - 1) * 4) + ')').show();
														$('#rplib_nav>div:eq(' + ((page - 1) * 4) + 1 + ')').show();
														$('#rplib_nav>div:eq(' + ((page - 1) * 4 + 2) + ')').show();
														$('#rplib_nav>div:eq(' + ((page - 1) * 4 + 3) + ')').show();
													}
												});
											})
										})
                                    </script>
                                @endif
                            @else
                                暂无公开组件
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @include('front.inc.footer')
@endsection