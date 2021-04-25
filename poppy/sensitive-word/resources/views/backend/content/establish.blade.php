@extends('py-mgr-page::backend.tpl.dialog')
@section('backend-main')
	{!! Form::model($item ?? null,['route' => [$_route, $id ?? ''],'class' => 'layui-form']) !!}
	<div class="layui-form-item">
		{!! Form::label('title', '地区名称') !!}
		{!! Form::text('title', null, ['class' => 'layui-input']) !!}
	</div>
	<div class="layui-form-item">
		{!! Form::label('top_id', '选择省级') !!}
		{!! Form::select('top_id', $top,null, ['placeholder'=>'请选择']) !!}
	</div>

	<div class="form-group" id="note" style="display: none">
		{!! Form::label('parent_id', '选择市级') !!}
		{!! Form::select('parent_id', [],null, ['placeholder'=>'请选择','id'=>'parent']) !!}
	</div>
	{!! Form::button(isset($item) ? '编辑' : '添加', ['class'=>'layui-btn J_submit', 'type'=> 'submit']) !!}
	{!! Form::close() !!}

	<script>
    $('[name=top_id]').on('change', function() {
        var id = $(this).val();
        $.ajax({
            type : "GET",
            url : "{{route_url('py-area:backend.content.establish')}}",
            data : "city=" + id,
            success : function(resp) {
                var city = Util.toJson(resp);
                $("#parent").html('');
                $('#parent').append("<option>请选择</option>");
                $.each(city, function(k, v) {
                    $('#parent').append("<option value=" + k + ">" + v + "</option>");
                });

                $('#note').show();
            }
        });
    })
	</script>
@endsection