@extends('py-mgr-page::tpl.dialog')
@section('dialog-main')
    @if ($total > 0)
        <div class="layui-elem-quote mt10">
            @if ($left === 0)
                <p>操作完成</p>
            @else
                <p>本次需要操作 <strong>{{$total}}</strong> 条数据, 每批次更新 <strong>{{$section}}</strong> 条, 还剩余
                    <strong>{{$left}}</strong>条</p>
            @endif
        </div>
        @if (isset($info))
            <div class="layui-elem-quote mt10">{!! $info !!}</div>
        @endif
        <div class="layui-progress layui-progress-big" lay-showPercent="yes">
            <div class="layui-progress-bar layui-bg-green" lay-percent="{{$percentage}}%"></div>
        </div>
        <script>
        layui.element.render();
        </script>
        @if ($left === 0)
            <script>
            Util.splash({status : 0, message : '操作成功!'});
            </script>
        @else
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