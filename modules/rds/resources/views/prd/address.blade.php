@extends('daniu.template.main')
@section('body-start')
    <body class="page-dialog">@endsection
    @section('daniu-main')
        <div class="container">
            <div class="row">
                <div class="col-xs-2 pt8">
                    地址
                </div>
                <div class="col-xs-7">
                    <input type="text" name="view_url"  id="view_url" class="form-control" value="{!! $url !!}">
                </div>
                <div class="col-xs-3">
                    <input class="btn btn-success form-control" id="copy_button" type="button" value="复制地址">
                </div>
            </div>
            @if (site('short_url_is_open'))
                <div class="row mt15">
                    <div class="col-xs-2 pt8">
                        短地址
                    </div>
                    <div class="col-xs-7">
                        <input class="form-control" type="text" name="short_url" id="view_short_url" value="{!! $short_url !!}">
                    </div>
                    <div class="col-xs-3">
                        <input class="btn btn-success  form-control" id="copy_short_button" type="button" value="复制地址">
                    </div>
                </div>
            @endif
            <div class="row mt15">
                <div class="col-xs-2 pt8">
                    权限
                </div>
                <div class="col-xs-10 pt8">
                    权限状态：{!! \App\Models\Prototype::kvRoleStatus($item->role_status) !!}
                    @if($item->role_status)
                        <span class="mr30">加密密码：{!! $item->password !!}</span>
                    @endif
                </div>
            </div>
            <div class="row mt15">
                <div class="col-xs-2 pt8">
                    二维码
                </div>
                <div class="col-xs-10 pt8">
                    <img src="{!! $code_url !!}" height="250">
                </div>
            </div>
        </div>


        <script>
            require(['jquery', 'zero-clipboard', 'lemon/util'], function ($, ZeroClipboard, util) {
                var client = new ZeroClipboard(document.getElementById("copy_button"));
                client.on("ready", function (readyEvent) {
                    client.on("copy", function (event) {
                        var clipboard = event.clipboardData;
                        clipboard.setData("text/plain", $('#view_url').val());
                    });
                    client.on("aftercopy", function (event) {
                        util.splash({
                            status: 'success',
                            msg   : '复制到粘贴板'
                        });
                    });
                });
                @if (site('short_url_is_open'))
                var client_short = new ZeroClipboard(document.getElementById("copy_short_button"));
                client_short.on("ready", function (readyEvent) {
                    client_short.on("copy", function (event) {
                        var clipboard = event.clipboardData;
                        clipboard.setData("text/plain", $('#view_short_url').val());
                    });
                    client_short.on("aftercopy", function (event) {
                        util.splash({
                            status: 'success',
                            msg   : '复制短地址到粘贴板'
                        });
                    });
                });
                @endif
            })
        </script>
@endsection