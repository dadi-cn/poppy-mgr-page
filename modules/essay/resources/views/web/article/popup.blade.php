@extends('site::tpl.dialog')
@section('tpl-main')
    {!! Form::model($item??null,['route' => ['essay:article.popup', $item->id??null]]) !!}
    {!! Form::hidden('book_id', $book_id) !!}
    <div class="form-group">
        <label for="title">文档名</label>
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=>'文档名称, 例如: XXXX产品文档']) !!}
    </div>
    <div class="form-group">
        <label for="title">上级文档</label>
        {!! Form::tree('parent_id', $items, (isset($item) ? $item->parent_id : (input('parent_id'))), [
            'placeholder'=> '顶级',
            'class'=> 'form-control'
        ], 'id', 'title', 'parent_id') !!}
    </div>
    <div class="form-group">
        {!! Form::button(isset($item) ? '编辑' : '创建', ['class' => 'btn btn-primary J_submit', 'type'=> 'submit']) !!}
    </div>
    {!! Form::close() !!}
@endsection