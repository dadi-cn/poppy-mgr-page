@extends('daniu.template.main')
@section('daniu-main')
	@include('front.inc.nav')
	<div class="container mb20 mt20">
		<div class="col-sm-2">
            <div class="user-side">
                <h4>账号设置</h4>
                @include('front.inc.user_my_side')
            </div>
		</div>
		<div class="col-sm-9">
            <div class="user-content content-email">
                <h4>修改邮箱</h4>
                {!! Form::open(['class'=> 'form-horizontal pt15 form-daniu']) !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label">当前Email地址</label>
                    <div class="col-sm-9 pt8">
                        {!! \App\Lemon\Repositories\Sour\LmStr::hide_vemail($_pam->account_name) !!}
                        <span class="pull-right font-green">
                             @if ($_front->v_email == 'Y')
                                已经验证
                            @else
                                邮箱未验证
                                <a href="{!! route('front_user.verify_email') !!}" class="J_request">马上验证</a>
                            @endif
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">新Email地址</label>
                    <div class="col-sm-10 pt2">
                        <input name="email" type="email" class="form-control w480"> <br>
                        <p class="w480 pb6">
                            提交之后新邮箱将收到激活邮件，激活邮件里的链接才能修改成功
                        </p>
                        <button class="btn btn-success J_submit" data-ajax="true">修改</button>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>

		</div>
	</div>
	@include('front.inc.footer')
@endsection