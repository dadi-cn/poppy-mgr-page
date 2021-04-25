@extends('py-mgr-page::backend.tpl.default')
@section('backend-main')
    <div class="layui-card-header">
        地区管理
        <div class="pull-right">
            <a href="{{route_url('py-area:backend.content.establish')}}"
                class="layui-btn layui-btn-sm J_iframe">新增</a>
            <a href="{{route_url('py-area:backend.content.fix')}}"
                class="layui-btn layui-btn-sm J_iframe">更新</a>
        </div>
    </div>
    <div class="layui-card-body">
        {!! Form::model(input(),['method' => 'get', 'class'=> 'layui-form', 'data-pjax', 'pjax-ctr'=> '#main']) !!}
        <div class="layui-form-item">
            <div class="layui-input-inline">
                {!! Form::text('title',null,['placeholder'=>'标题','class'=>'layui-input']) !!}
            </div>
            <div class="layui-input-inline">
                {!! Form::tree('id', $top, null, ['placeholder' => '选择父级'], 'id', 'title', 'parent_id') !!}
            </div>
            @include('py-mgr-page::backend.tpl._search')
        </div>
        {!! Form::close() !!}

        <table class="layui-table">
            <tr>
                <th class="w120">地区ID</th>
                <th>名称</th>
                <th class="w120">操作</th>
            </tr>
            @if ($items->total())
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>
                            @if($item->level <= 4)
                                <a href="{{ route_url('py-area:backend.content.index',['id'=>$item->id]) }}">
                                    {{$item->title}}
                                </a>
                            @else
                                {{$item->title}}
                            @endif
                        </td>
                        <td>
                            <a class="J_iframe J_tooltip" title="编辑"
                                href="{{route_url('py-area:backend.content.establish', [$item->id])}}">
                                <i class="fa fa-edit text-info"></i>
                            </a>
                            <a title="删除" class="J_request J_tooltip"
                                data-confirm="确认删除版本`{!! $item->title !!}`?"
                                href="{{route('py-area:backend.content.delete', [$item->id])}}">
                                <i class="fa fa-times text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">
                        @include('py-mgr-page::backend.tpl._empty')
                    </td>
                </tr>
            @endif
        </table>
        {!! $items->render('py-mgr-page::tpl._pagination') !!}
    </div>
@endsection