@extends('poppy-mgr-page::backend.tpl.dialog')
@section('backend-main')
    {!! Form::model($item ?? null, ['route' => [$_route, $id ?? ''], 'class' => 'layui-form']) !!}

    <div class="layui-form-item">
        {!! Form::label('title', '标题') !!}
        {!! Form::text('title', null, ['class' => 'layui-input']) !!}
    </div>
    <div class="layui-form-item">
        {!! Form::label('type', '类型') !!}
        {!! Form::select('type',\Php\Models\ExamContent::kvType(), null, ['lay-filter' => 'action']) !!}
    </div>
    {{--单选--}}
    {{--<div id="select">--}}
    <div class="layui-form-item">
        <div class="layui-input-inline w15p mr0">
            <div class="select">
                {!! Form::radio('answer', 'a', null, ['title' => 'A']) !!}
            </div>
            <div class="checkbox">
                {!! Form::checkbox('answers[]', 'a', null, ['title' => 'A', 'lay-skin'=> 'primary']) !!}
            </div>
        </div>
        <div class="layui-input-inline w85p mr0">
            {!! Form::text('a', null, ['class'=> 'layui-input']) !!}
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-inline w15p mr0">
            <div class="select">
                {!! Form::radio('answer', 'b', null, ['title' => 'B']) !!}
            </div>
            <div class="checkbox">
                {!! Form::checkbox('answers[]', 'b', null, ['title' => 'B', 'lay-skin'=> 'primary']) !!}
            </div>
        </div>
        <div class="layui-input-inline w85p mr0">
            {!! Form::text('b', null, ['class'=> 'layui-input']) !!}
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-inline w15p mr0">
            <div class="select">
                {!! Form::radio('answer', 'c', null, ['title' => 'C']) !!}
            </div>
            <div class="checkbox">
                {!! Form::checkbox('answers[]', 'c', null, ['title' => 'C', 'lay-skin'=> 'primary']) !!}
            </div>
        </div>
        <div class="layui-input-inline w85p mr0">
            {!! Form::text('c', null, ['class'=> 'layui-input']) !!}
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-inline w15p mr0">
            <div class="select">
                {!! Form::radio('answer', 'd', null, ['title' => 'D']) !!}
            </div>
            <div class="checkbox">
                {!! Form::checkbox('answers[]', 'd', null, ['title' => 'D', 'lay-skin'=> 'primary']) !!}
            </div>
        </div>
        <div class="layui-input-inline w85p mr0">
            {!! Form::text('d', null, ['class'=> 'layui-input']) !!}
        </div>
    </div>

    {!! Form::button(isset($item) ? '编辑' : '添加', ['class'=>'layui-btn J_submit', 'type'=> 'submit']) !!}
    {!! Form::close() !!}
    <script>

	layui.use('form', function() {
		let action = $('[name=type]').val();
		if (action === 'select') {
			$('.checkbox').hide();
			$('input:checkbox').attr('disabled', 'disabled');
			$('.select').show();
			$('input:radio').removeAttr('disabled');
		}
		else {
			$('.checkbox').show();
			$('input:checkbox').removeAttr('disabled');
			$('.select').hide();
			$('input:radio').attr('disabled', 'disabled');
		}

		let form = layui.form;
		form.on('select(action)', function(data) {
			if (data.value === 'select') {
				$('.select').show();
				$('input:radio').removeAttr('disabled');

				$('.checkbox').hide();
				$('input:checkbox').attr('disabled', 'disabled');
			}
			else {
				$('.checkbox').show();
				$('input:checkbox').removeAttr('disabled');

				$('.select').hide();
				$('input:radio').attr('disabled', 'disabled');
			}
			form.render();
		});

		form.render();
	});
    </script>
@endsection