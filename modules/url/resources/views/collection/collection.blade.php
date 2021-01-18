@extends('slt::tpl.default_dialog')
@section('body-dialog_class', 'site_collection--page_item')
@section('tpl-main')
    @if (isset($item))
        {!! Form::model($item,['route' => ['slt:nav.collection', $item->id]]) !!}
    @else
        {!! Form::open() !!}
    @endif
    <div class="form-group">
        <label>收藏夹标题</label>
        {!! Form::text('title', null, ['placeholder' => '例如：常用网站咨询汇总', 'class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <label>图标</label>
        <div class="clearfix">
            <select name="icon" id="J_img_picker" class="form-control page_item-selector hidden">
                @foreach($options as $option)
                    {!! $option !!}
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group clearfix">
        {!! Form::button(isset($item) ? '编辑收藏夹' : '添加收藏夹', ['type'=> 'submit', 'class' => 'btn btn-success J_submit']) !!}
        @if (isset($item))
            {!! Html::link(route('slt:nav.collection_destroy', $item->id), '删除收藏夹'
            , [
                'class' => 'btn btn-danger J_request',
                'data-confirm' => '确认删除此收藏夹?'
            ]) !!}
        @endif
    </div>
    {!! Form::close() !!}
    <script>
        require(['jquery', 'jquery.image-picker'], function ($) {
            $("#J_img_picker").imagepicker({
                hide_select: true
            });
        })
    </script>
@endsection