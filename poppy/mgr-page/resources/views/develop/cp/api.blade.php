@extends('py-mgr-page::tpl.develop')
@section('develop-main')
    @include('py-mgr-page::develop.inc.header')
    <div class="row">
        <div class="col-sm-12" style="word-break: break-all;">
            <p class="alert alert-info">
                <a target="_blank" class="layui-btn" href="{!! route('py-mgr-page:develop.cp.graphql', 'default') !!}">
                    默认访问
                </a>
                <a target="_blank" class="layui-btn-primary J_iframe"
                   href="{!! route_url('py-system:develop.cp.set_token', [], ['type'=> 'default']) !!}">
                    手工设置 Token
                </a>
                token :
                @if ($token_default)
                    {!! $token_default !!}
                @else
                    无
                @endif
            </p>
            <p class="alert alert-warning">
                <a target="_blank" class="layui-btn" href="{!! route('py-mgr-page:develop.cp.graphql', 'web') !!}">
                    前台访问
                </a>
                <a target="_blank" class="layui-btn J_iframe"
                   href="{!! route_url('py-system:develop.cp.api_login', [], ['type'=> 'web']) !!}">
                    登录获取 Token
                </a>
                token :
                @if ($token_web)
                    {!! $token_web !!}
                @else
                    无
                @endif
            </p>
            <p class="alert alert-danger">
                <a target="_blank" class="layui-btn" href="{!! route('py-mgr-page:develop.cp.graphql', 'backend') !!}">
                    后台访问
                </a>
                <a target="_blank" class="layui-btn-primary J_iframe"
                   href="{!! route_url('py-system:develop.cp.api_login', [], ['type'=> 'backend']) !!}">
                    登录获取 Token
                </a>
                token :
                @if ($token_backend)
                    {!! $token_backend !!}
                @else
                    无
                @endif
            </p>
        </div>
    </div>
@endsection