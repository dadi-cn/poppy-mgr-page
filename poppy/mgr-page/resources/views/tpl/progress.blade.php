@extends('py-mgr-page::tpl.dialog')
@extends('py-mgr-page::tpl.default')
@section('head-css')
    {!! Html::style('assets/libs/layui/css/layui.css') !!}
@endsection
@section('body-main')
    @include('py-mgr-page::tpl._toastr')
    @if ($total > 0)
        <div class="layui-elem-quote mt10" style="{!! $left === 0 ? 'color:green' : ''!!}">
            <p>
                本次需要操作 <strong>{{$total}}</strong> 条数据, 每批次更新 <strong>{{$section}}</strong> 条, 还剩余
                <strong>{{$left}}</strong>条
                @if ($left === 0)
                    操作完成
                @endif
            </p>
        </div>
        @if (isset($info))
            <div class="layui-elem-quote mt10">{!! $info !!}</div>
        @endif
        <div class="layui-progress layui-progress-big">
            <div class="layui-progress-bar layui-bg-green" style="width: {{$percentage}}%">
                <span class="layui-progress-text">{{$percentage}}%</span>
            </div>
        </div>
        @if ($left !== 0)
            <script>
            setTimeout("window.location.href = '{!!$continue_url!!}'", {{$continue_time}});
            </script>
        @endif
    @else
        <div class="layui-elem-quote">
            <p>没有需要更新的内容</p>
        </div>
    @endif
@endsection