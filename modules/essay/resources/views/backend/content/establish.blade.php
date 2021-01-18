@extends('system::backend.tpl.default')
@section('backend-main')
    <fieldset class="layui-elem-field layui-field-title">
        <legend>帮助文章</legend>
    </fieldset>
   {{-- @if(!$id)
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                @foreach($types as $key => $name)
                    <li class="{!! active_class($type === $key, 'layui-this') !!}">
                        <a class="nav-link {!! active_class($type === $key) !!}"
                           href="{!! sys_url('type', $key) !!}">{{$name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif--}}

    {!! Form::model($item ?? null,['class' => 'layui-form']) !!}
    {{--{!! Form::hidden('type', $type) !!}--}}
    <div class="layui-form-item">
        {!! Form::label('title','标题:',['class' => 'layui-form-label validation']) !!}
        <div class="layui-input-block">
            {!! Form::text('title',null,['class' => 'layui-input']) !!}
        </div>
    </div>
    <div class="layui-form-item">
        {!! Form::label('description','描述:',['class' => 'layui-form-label validation']) !!}
        <div class="layui-input-block">
            {!! Form::text('description',null,['class' => 'layui-input']) !!}
        </div>
    </div>
    <div class="layui-form-item">
        {!! Form::label('author','作者:',['class' => 'layui-form-label validation']) !!}
        <div class="layui-input-block">
            {!! Form::text('author',null,['class' => 'layui-input']) !!}
        </div>
    </div>
    <div class="layui-form-item">
        {!! Form::label('content','内容:',['class' => 'layui-form-label validation']) !!}
        <div class="layui-input-block">
            {!! Form::editor('content',null,['class' => 'layui-input', 'pam'=> $_pam]) !!}
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            {!! Form::button('提交',['class'=>'layui-btn J_submit', 'type'=> 'submit']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection