@extends('system::backend.tpl.default')
@section('backend-main')
    <fieldset class="layui-elem-field layui-field-title">
        <legend>文章管理</legend>
    </fieldset>

    {!! Form::model(input(),['method' => 'get', 'class'=> 'layui-form', 'data-pjax', 'pjax-ctr'=> '#main']) !!}
    <div class="layui-form-item">
        {!! Form::text('title', null, ['placeholder' => '文章标题', 'class' => 'layui-input layui-input-inline']) !!}
        @include('system::backend.tpl.inc_search')
    </div>
    {!! Form::close() !!}

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
                        <a href="{{ route_url('essay:backend.content.establish', [$item->id]) }}"
                           class="J_tooltip" title="编辑">
                            <i class="fa fa-edit text-info"></i>
                        </a>
                        @can('edit', $item)
                            <a title="编辑" class="J_tooltip"
                               href="{{route_url('essay:backend.content.establish', [$item->id])}}">
                                <i class="fa fa-edit text-info"></i>
                            </a>
                        @endcan
                        <a title="删除" class="J_request J_tooltip"
                           data-confirm="确认删除此文章`{!! $item->title !!}`?"
                           href="{{route('essay:backend.content.delete', [$item->id])}}">
                            <i class="fa fa-times text-danger"></i>
                        </a>
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
@endsection