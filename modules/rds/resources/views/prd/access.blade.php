@extends('web.inc.tpl_dialog')
@section('tpl-main')
    {!! Form::model($item, ['route' => ['web:prd.access',$item->id], 'class'=>'form-horizontal' ]) !!}
    <div class="form-group">
        <label class="col-xs-3 control-label">原型名称 : </label>
        <div class="col-xs-9">
            <p class="form-control-static">{!! $item->title !!}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">加密权限 : </label>
        <div class="col-xs-9">
            {!! Form::radios('access', [
                0 => '关闭',
                1 => '启用',
            ], $item->role_status, [
                'display_type'=> 'bt3'
            ]) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">当前密码 : </label>
        <div class="col-xs-9">
            {!! Form::text('password',$item->password, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-9 col-xs-offset-3">
            {!! Form::button('保存', ['type'=> 'submit', 'class' => 'btn btn-success J_submit']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection