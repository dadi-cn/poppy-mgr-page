@extends('site::tpl.default')
@section('body-class', 'url--home')
@section('tpl-main')
    <div class="layui-row layui-col-space10">
        <div class="layui-col-md3">
            <div class="home-description home-box mt15">
                <h3>收藏集
                    <small class="pull-right">

                    </small>
                </h3>

            </div>
        </div>
        <div class="layui-col-md9">
            <div class="home-display">
                <div class="home-infinite" id="infinite_scroll">
                    <div class="home-display_head clearfix">
                        {!! Form::open(['method'=> 'get', 'class'=> 'layui-form pull-left']) !!}
                        <div class="layui-input-inline">
                            {!! Form::text('title', input('title'), ['placeholder'=> '搜索文章...', 'class'=> 'layui-input']) !!}
                        </div>
                        {!! Form::close() !!}
                        <div class="mt10 pull-right">
                            <a class="J_iframe layui-btn layui-btn-primary layui-btn-sm"
                               href="{!! route('url:web.essay.establish') !!}"
                               data-width="600" data-height="480" data-title="新增文章">
                                <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <table class="layui-table">
                        <tr>
                            <th class="w84 text-center">ID</th>
                            <th>标题</th>
                            <th>描述</th>
                            <th>作者</th>
                            <th class="w96">操作</th>
                        </tr>
                        @if ($items->total())
                            @foreach($items as $item)
                                <tr>
                                    <th class="text-center">{{ $item->id }}</th>
                                    <th>{{ $item->title }}</th>
                                    <th>{{ $item->description }}</th>
                                    <th>{{ $item->author }}</th>
                                    <td>
                                        <h4>
                                            <a href="{!! route('url:web.essay.establish', $item->id) !!}"
                                               data-toggle="tooltip"
                                               title="编辑" class="display_content-comment good btn btn-default J_iframe">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </h4>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="23">
                                    @include('system::backend.tpl.inc_empty')
                                </td>
                            </tr>
                        @endif
                    </table>
                    <div class="pull-right">
                        {!! $items->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection