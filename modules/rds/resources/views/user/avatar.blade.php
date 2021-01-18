@extends('daniu.template.main')
@section('body-start')
    <body class="page-dialog">@endsection
    @section('daniu-main')
        {!! Form::open(['class'=>'form-horizontal']) !!}
        <div class="form-group">
            <label class="col-xs-3 control-label">上传头像</label>
            <div class="col-xs-6">
                {!! Form::webUploader('avatar', $_front->avatar, ['ext' => 'image']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-offset-3">
                <button type="submit" class="ml10 mt8 btn btn-success J_submit">保存头像</button>
            </div>
        </div>
    {!! Form::close() !!}
@endsection