@extends('site::tpl.dialog')
@section('tpl-main')
    <div class="container mb40">
        {!! Form::model($item??[],['route' => ['essay:book.establish', (isset($item)) ? $item->id: null], 'class'=> 'layui-form']) !!}
        <div class="form-group">
            <label for="title">文库名称</label>
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=>'文库名称, 例如: wulicode 技术文库']) !!}
        </div>
        <div class="form-group">
            {!! Form::button(isset($item) ? '编辑' : '创建文库', ['class' => 'btn btn-primary J_submit', 'type'=> 'submit']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection