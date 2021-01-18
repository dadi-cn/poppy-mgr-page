@extends('site::tpl.layout-basic')
@section('layout-side')
    @include('site::web.tool._menu')
@endsection
@section('layout-main')
    <div class="wuli--box">
        <h3>Html实体转换器</h3>
        <div class="row" style="font-family: monospace;">
            <div class="col-6">
                <div class="alert alert-info">输入转换的代码</div>
                {!! Form::textarea('input', '<p>Sample Html String</p>', ['class'=> 'form-control', 'id'=> 'J_input', 'rows'=>10]) !!}
            </div>
            <div class="col-6">
                <div class="alert alert-info">输出的代码</div>
                {!! Form::textarea('output', '', ['class'=> 'form-control', 'id'=> 'J_output', 'rows'=>10]) !!}
            </div>
        </div>
        <script>
	    $(function() {
		    $('#J_input').on('change mouseup input', _do_convert);
		    _do_convert();
	    });

	    function _do_convert() {
		    var $input = $('#J_input');
		    var $output = $('#J_output');
		    var data = $input.val();
		    $.post('{!! route_url() !!}', {content : data}, function(str) {
			    $output.val(str.data.content);
		    })
	    }
        </script>
    </div>
@endsection