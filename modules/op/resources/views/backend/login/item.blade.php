@extends('system::backend.tpl.dialog')
@section('backend-main')

    {!! Form::model($item ?? null,['route' => [$_route, $id ?? ''],'class' => 'layui-form']) !!}

    <div class="layui-form-item">
        {!! Form::label('account', '登录账号', ['class' => 'validation']) !!}
        <div>
            {!! Form::text('account',null, ['class' => 'layui-input']) !!}
        </div>
    </div>

    <div class="layui-form-item">
        {!! Form::label('password', '登录密码', ['class' => 'validation']) !!}
        <div>
            {!! Form::text('password',null, ['class' => 'layui-input']) !!}
        </div>
    </div>

    <div class="layui-form-item">
        {!! Form::label('app_key', 'APP_KEY', ['class' => 'validation']) !!}
        <div>
            {!! Form::text('app_key',null, ['class' => 'layui-input']) !!}
        </div>
    </div>

    <div class="layui-form-item">
        {!! Form::label('app_secret', 'APP_SECRET', ['class' => 'validation']) !!}
        <div>
            {!! Form::text('app_secret',null, ['class' => 'layui-input']) !!}
        </div>
    </div>

    <div class="layui-form-item">
        {!! Form::label('platform_domain', '平台域名', ['class' => 'validation']) !!}
        <div>
            {!! Form::text('platform_domain',null, ['class' => 'layui-input']) !!}
        </div>
    </div>

    <div class="layui-form-item">
        {!! Form::label('platform_type', '平台类型', ['class' => 'validation']) !!}
        <div>
            {!! Form::select('platform_type', \Auto\Models\AutoLoginAccount::kvPlatformType(), null, ['placeholder' => '请选择平台类型']) !!}
        </div>
    </div>

    <div class="layui-form-item">
        {!! Form::label('platform_browser', '平台类型', ['class' => 'validation']) !!}
        <div>
            {!! Form::select('platform_browser', \Auto\Models\AutoLoginAccount::kvPlatformBrowser(), null, ['placeholder' => '请选择浏览器']) !!}
        </div>
    </div>

    <div class="layui-form-item">
        {!! Form::label('type', '账号类型', ['class' => 'validation']) !!}
        <div>
            {!! Form::select('type', \Auto\Models\AutoLoginAccount::kvType(), null, ['placeholder' => '请选择账号类型']) !!}
        </div>
    </div>

    {!! Form::button(isset($item) ? '编辑' : '添加', ['class'=>'layui-btn J_submit', 'type'=> 'submit']) !!}
    {!! Form::close() !!}
@endsection
