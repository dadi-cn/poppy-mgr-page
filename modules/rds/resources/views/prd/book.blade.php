@extends('web.inc.tpl_dialog')
@section('tpl-main')
    <div class="container mb40">
        @if (isset($item))
            {!! Form::model($item,['route' => ['web:prd.book', $item->id]]) !!}
        @else
            {!! Form::open() !!}
        @endif
        <div class="form-group">
            <div class="mt8 text-center pt20 pd20">
                <i class="iconfont icon-book-collection text-info" style="font-size: 120px;"></i>
            </div>
            <div class="mt8">
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=>'文库名称, 例如: wulicode 技术文库']) !!}
            </div>
            <div class="mt8">
                {!! Form::button(isset($item) ? '编辑' : '保存', ['class' => 'form-control btn-success J_submit', 'type'=> 'submit']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection