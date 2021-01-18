@extends('site::tpl.dialog')
@section('body-dialog_class', 'site_collection')
@section('tpl-main')
    {!! Form::model($item ??  null,['route' => [$_route, isset($item) ? $item->id : null]]) !!}
    <div class="form-group row">
        {!! Form::label('url', '网站地址', ['class'=> 'col-lg-3']) !!}
        <div class="col-lg-9">
            {!! Form::text('url', $url ?? null, ['placeholder' => '输入收藏的网站地址', 'class'=>'form-control', 'id'=> 'url']) !!}
        </div>
    </div>
    <div class="form-group row" id="site_title">
        {!! Form::label('title', '网站标题', ['class'=> 'col-lg-3']) !!}
        <div class="col-lg-9">
            {!! Form::text('title', $title ?? null, ['placeholder' => '输入网站标题', 'class'=>'form-control', 'id'=> 'title']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('description', '描述', ['class'=> 'col-lg-3']) !!}
        <div class="col-lg-9">
            {!! Form::textarea('description', $description ?? null, [
                'placeholder' => '输入网站描述, 网站描述不得超过80字符(#)',
                'id' => 'description',
                'class'=>'form-control','rows'=>3]) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('label', '标签', ['class'=> 'col-lg-3']) !!}
        <div class="col-lg-9">
            {!! Form::select('tag[]',$tags ?? [], $tags ?? [], [
                'id'=> 'site_tags' , 'multiple'=> 'multiple',
                'lay-ignore'
            ]) !!}
        </div>
    </div>
    <script>
	$(function() {
		$('#site_tags').tokenize2({
			dataSource        : '{!! route('site:web.tag.search') !!}',
			tokensAllowCustom : true,
			placeholder       : '输入新标签或者点选标签, 最多 6 个',
			tokensMaxItems    : 6,
			searchMinLength   : 2,
			searchHighlight   : true,
			debounce          : 0
		});
	})
    </script>

    <div class="form-group row clearfix">
        <div class="col-lg-9">
            {!! Form::button(isset($item) ? '编辑' : '添加', ['type'=> 'submit', 'class' => 'btn btn-primary J_submit']) !!}
            @if (isset($item))
                <a href="{!! route_url('url:web.collection.delete', [$item->id]) !!}"
                   data-confirm="确定删除 {!! $item->title !!} ?"
                   class="btn btn-danger J_request"
                >删除</a>
            @endif
        </div>
    </div>
    {!! Form::close() !!}
    <script>
	function get_title() {
		var url = $('#url').val();
		if (!url || $('#title').val() || !Util.isUrl(url)) {
			return;
		}
		Util.makeRequest("{!! route('url:web.collection.fetch_title') !!}", {url : url}, function(resp_obj) {
			var obj_data = resp_obj.data;
			if (resp_obj.status === 0) {
				$('#title').val(obj_data.title);
				$('#url').val(obj_data.url);
				$('#description').val(obj_data.description);
				$('#site_title').fadeIn(500);
			} else {
				$('#title').val(obj_data.title);
				$('#url').val(obj_data.url);
				$('#site_title').fadeIn(500);
				Util.splash(resp_obj);
			}
		})
	}

	$('#url').on('blur', get_title);
	$(function() {
		get_title();
	});
    </script>
@endsection