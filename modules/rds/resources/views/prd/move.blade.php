@extends('daniu.template.main')
@section('body-start')
    <body class="page-dialog">@endsection
    @section('daniu-main')
        <div class="container mb40">
            {!! Form::model($item,['route' => ['web:prd.move', $item->id]]) !!}
            <div class="form-group">
                <p class="alert alert-warning">您将移动文档 {!! $item->prd_title !!}</p>
                <div class="mt8">
                    {!! Form::select('cat_id', $cats, null, ['class'=> 'form-control', 'placeholder'=>'请选择要移动到的分类']) !!}
                </div>
                <div class="mt8">
                    {!! Form::button('移动', ['class' => 'form-control btn-success J_submit', 'type'=> 'submit']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
@endsection