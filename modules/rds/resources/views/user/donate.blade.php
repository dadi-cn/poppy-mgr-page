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
        <div class="col-sm-10">
            <div class="user-content">
                <h4>捐赠设置</h4>
                {!! Form::open(['class'=> 'form-horizontal mt15']) !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label">微信捐赠</label>
                    <div class="col-sm-10">
                        {!! Form::radios('is_weixinpay', ['关闭', '开启'], $_front->is_weixinpay, ['inline'=> true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">微信支付二维码</label>
                    <div class="col-sm-10">
                        {!! Form::webUploader('weixinpay_qrcode', $_front->weixinpay_qrcode, ['ext'=> 'image',]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">支付宝捐赠</label>
                    <div class="col-sm-10">
                        {!! Form::radios('is_alipay', ['关闭', '开启'], $_front->is_alipay, ['inline'=> true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">支付宝二维码</label>
                    <div class="col-sm-10">
                        {!! Form::webUploader('alipay_qrcode', $_front->alipay_qrcode, ['ext'=> 'image']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        {!! Form::button('保存', ['type'=>'submit','class'=> 'btn btn-success J_submit']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>
        require(['jquery', 'lemon/cp'], function ($) {

        });
    </script>
    @include('front.inc.footer')
@endsection