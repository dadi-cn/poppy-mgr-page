@extends('misc::tpl.layout-basic')
@section('layout-side')
    @include('misc::web.tool._menu')
@endsection
@section('layout-main')
    <div class="wuli--box">

        <h3>Ssl Key 转换</h3>

        <div class="row" style="font-family: monospace;" id="app">
            <div class="col-6">
                <div class="alert alert-info">输入转换的代码</div>
                {!! Form::textarea('input', '', ['class'=> 'form-control', 'id'=> 'J_input', 'rows'=>10]) !!}
                <br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" type="radio" name="type" value="public" id="type_public" checked>
                    <label class="custom-control-label" for="type_public">公钥</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" type="radio" name="type" value="private" id="type_private">
                    <label class="custom-control-label" for="type_private">私钥</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" type="radio" name="type" value="rsa" id="type_rsa">
                    <label class="custom-control-label" for="type_rsa">RSA 私钥</label>
                </div>
            </div>
            <div class="col-6">
                <div class="alert alert-info">输出的代码</div>
                {!! Form::textarea('output', '', ['class'=> 'form-control', 'id'=> 'J_output', 'rows'=>10]) !!}
            </div>
        </div>
        <script>
		$(function() {
			$('#J_input').on('change mouseup input', _do_convert);
			$('input[name=type]').on('change', _do_convert);
			_do_convert();
		});

		function _do_convert() {
			var $input = $('#J_input');
			var $output = $('#J_output');
			var data = $input.val();
			Util.makeRequest('{!! route_url() !!}', {content : data, type : $('[name=type]:checked').val()}, function(str) {
				$output.val(str.data.content);
			})
		}
        </script>
    </div>
@endsection