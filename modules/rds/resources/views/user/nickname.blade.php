@extends('daniu.template.main')
@section('body-start')
    <body class="page-dialog">@endsection
@section('daniu-main')
    {!! Form::open(['class'=>'form-horizontal' ]) !!}
    <div class="form-group">
        <label class="col-xs-2 control-label pt5">昵称</label>
        <div class="col-xs-10">
            {!! Form::text('nickname',$_front->nickname, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-10 col-xs-offset-2">
            {!! Form::button('保存', ['type'=> 'submit', 'class' => 'btn btn-success J_submit']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection