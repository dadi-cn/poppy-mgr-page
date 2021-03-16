@extends('poppy-mgr-page::backend.tpl.default')
@section('backend-main')
    <div class="layui-card-header">
        考核问题
        <div class="pull-right">
            <a href="{{route_url('php:backend.exam.establish')}}" class="layui-btn layui-btn-sm J_iframe">创建问题</a>
        </div>
    </div>
    <div class="layui-card-body">
        {!! Form::model(input(),['class'=> 'layui-form']) !!}
        <div class="layui-form-item">
            <div class="layui-input-inline w84">
                {!! Form::select('field', $fields,null,  ['class'=> 'layui-input']) !!}
            </div>
            <div class="layui-input-inline">
                {!! Form::text('kw', null, ['placeholder' => '关键词', 'class' => 'layui-input']) !!}
            </div>
            <div class="layui-input-inline w84">
                {!! Form::select('type',\Php\Models\ExamContent::kvType(), null, ['placeholder' => '类型', 'class' => 'layui-input']) !!}
            </div>
            @include('poppy-mgr-page::backend.tpl.inc_search')
        </div>
        {!! Form::close() !!}
        <table class="layui-table">
            <tr>
                <th class="w72 text-center">ID</th>
                <th class="w24"><i class="fa fa-anchor J_tooltip" title="标识"></i></th>
                <th>问题标题</th>
                <th class="w84">问题答案</th>
                <th class="w72 text-center">操作</th>
            </tr>
            @if ($items->total())
                @foreach($items as $item)
                    <tr>
                        <td class="text-center">{{$item->id}}</td>
                        <td>
                            <i class="fa fa-{!! $item->type === \Php\Models\ExamContent::TYPE_SELECT ? 'dot-circle' : 'check-square' !!} J_tooltip"
                               title="{!! \Php\Models\ExamContent::kvType($item->type) !!}"></i>
                        </td>
                        <td>{{$item->title}}</td>
                        <td>{{ $item->answer }}</td>
                        <td class="text-center">
                            <a class="J_iframe J_tooltip" title="编辑" data-height="600px" data-width="600px"
                               href="{{route_url('php:backend.exam.establish', [$item->id])}}">
                                <i class="fa fa-edit text-info"></i>
                            </a>
                            <a title="删除" class="J_request J_tooltip"
                               data-confirm="确认删除问题`{!! $item->title !!}`?"
                               href="{{route('php:backend.exam.delete', [$item->id])}}">
                                <i class="fa fa-times text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">
                        @include('poppy-mgr-page::backend.tpl._empty')
                    </td>
                </tr>
            @endif
        </table>
        <div class="pull-right">
            {!! $items->render() !!}
        </div>
    </div>
@endsection