@extends('py-mgr-page::backend.tpl.dialog')
@section('backend-main')
    {!! Form::model($item ?? null, ['route' => [$_route, $item['id'] ?? ''], 'class' => 'layui-form']) !!}
    {!! Form::hidden('scope', $scope) !!}
    <div class="layui-form-item">
        {!! Form::label('type', '平台:') !!}
    </div>
    <div class="layui-form-item">
        {!! Form::text('scope_desc', \Poppy\Sms\Action\Sms::kvPlatform($scope), ['class' => 'layui-input', 'readonly']) !!}
    </div>
    <div class="layui-form-item">
        {!! Form::label('type', '类型:', ['class' => 'validation']) !!}
    </div>
    <div class="layui-form-item">
        {!! Form::select('type', \Poppy\Sms\Action\Sms::kvType(), null, ['placeholder'=>'选择类型', 'lay-ignore'=>1]) !!}
    </div>
    <div class="layui-form-item">
        {!! Form::label('code', 'SmsCode:', ['class' => 'validation']) !!}
        {!! Form::tip('本地填写支持 Laravel 变量的模版(遵循 laravel translate 写法), 其他平台可填写短信模板或者内容') !!}
    </div>
    <div class="layui-form-item">
        {!! Form::textarea('code', null, ['class' => 'layui-textarea','rows' => 3]) !!}
    </div>
    {!! Form::button(isset($item) ? '编辑' : '添加', ['class'=>'layui-btn J_submit', 'type'=> 'submit']) !!}
    {!! Form::close() !!}
@endsection