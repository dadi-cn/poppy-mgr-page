@extends('slt::tpl.default')
@section('body-class', 'user_profile')
@section('tpl-main')
    <div class="row">
        <div class="col-2">
            <div class="user-side">
                <h4>账号设置</h4>
                @include('slt::user.profile_side')
            </div>
        </div>
        <div class="col-10">
            <div class="user-content">
                <h4>个人资料</h4>
                <div class="user-content_area">
                    <div class="user_profile-group">
                        <h5>基本信息</h5>
                        <div class="user_profile-group_area pl45 mt30">
                            <p class="clearfix pr100">
                                <span class="w60">昵称</span>

                                <a class="J_iframe btn btn-success btn-xs pull-right"
                                   href="{!! route('slt:user.nickname') !!}" data-title="修改昵称" data-width="400"
                                   data-height="400">修改昵称</a>
                            </p>
                            <p class="clearfix pr100">
                                <span class="w60">头像</span>

                                <a class="btn btn-success btn-xs pull-right J_iframe" id="edit-avatar"
                                   href="{!! route('slt:user.avatar') !!}" data-title="修改头像" data-width="400"
                                   data-height="400">修改头像</a>
                            </p>
                        </div>
                    </div>
                    {!! Form::model([], ['class'=> 'form-horizontal form-daniu']) !!}
                    <div class="user_profile-group">
                        <h5>个性信息</h5>
                        <div class="user_profile-group_area pl45 mt30">
                            <div class="form-group">
                                <label class="col-sm-2 pt8 text-right">个人主页地址 </label>
                                <div class="col-sm-10">

                                </div>
                            </div>
                            <div class="form-group">
                                <label id="description" class="col-sm-2 pt8 text-right">个人简介 <br>(100字以内)</label>
                                <div class="col-sm-7">
                                    {!! Form::textarea('description', null, ['class'=> 'form-control ', 'style'=> 'height: 150px;']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="user_profile-group">
                        <h5>详细信息</h5>
                        <div class="user_profile-group_area pl45 mt30">
                            <div class="form-group">
                                <label class="col-sm-2 pt8 text-right">性别</label>
                                <div class="col-sm-3">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 pt8 text-right">所在城市</label>
                                <div class="col-sm-2"> {!! Form::text('area_name', null, ['class'=> 'form-control']) !!}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 pt8 text-right">博客地址</label>
                                <div class="col-sm-4"> {!! Form::text('blog_url', null, ['class'=> 'form-control']) !!}</div>
                            </div>
                        </div>
                    </div>
                    <div class="user_profile-group">
                        <h5>社交信息</h5>
                        <div class="user_profile-group_area pl45 mt30 user_profile-group_social">
                            <div class="form-group">
                                <label class="col-sm-2 pt8 text-right">
                                    <span class="font-weibo iconfont icon-weibo"></span>
                                    微博地址
                                </label>
                                <div class="col-sm-4"> {!! Form::text('weibo_url', null, ['class'=> 'form-control']) !!}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 pt8 text-right">
                                    <span class="font-twitter iconfont icon-twitter"></span>
                                    Twitter 地址</label>
                                <div class="col-sm-4"> {!! Form::text('twitter_url', null, ['class'=> 'form-control']) !!}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 pt8 text-right">
                                    <span class="font-zhihu iconfont icon-zhihu"></span>
                                    知乎地址</label>
                                <div class="col-sm-4"> {!! Form::text('zhihu_url', null, ['class'=> 'form-control']) !!}</div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-2">
                                    {!! Form::button('保存', ['class'=> 'J_submit form-control btn btn-success']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @include('slt::tpl.inc_footer')
@endsection