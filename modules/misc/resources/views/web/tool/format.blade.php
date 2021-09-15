@extends('misc::tpl.layout-basic')
@section('head-script')
    @parent
    {!! Html::script('assets/js/libs/ace/ace.js') !!}
@endsection
@section('layout-side')
    @include('misc::web.tool._menu')
@endsection
@section('layout-main')
    <div class="wuli--box">
        <h3>{!! ucfirst($type) !!} 格式化</h3>
        <pre id="editor" style="min-height: 500px;"></pre>
        <br>
        <p>
            <button id="format" class="btn btn-primary btn-sm">格式化</button>
            <button id="copy" data-clipboard-target="#editor" class="btn btn-primary btn-sm">复制</button>
            <button id="minify" class="btn btn-primary btn-sm">压缩</button>
            <button id="clear" class="btn btn-primary btn-sm">清空</button>
        </p>
        <script>
		$(function() {
			var editor = ace.edit("editor");
			editor.setTheme("ace/theme/chrome");
			editor.session.setMode("ace/mode/{!! $type !!}");

			$("#copy").click(function() {
				new ClipboardJS('#copy', {
					text : function() {
						return editor.getValue();
					}
				});
				Util.splash({
					status  : 0,
					message : '已经复制到粘贴板'
				});
			});

			$("#format").click(function() {
				var content = editor.getValue();
				try {
					editor.setValue(vkbeautify.{!! $type !!}(content));
				} catch (err) {
					alert("Your document is invalid");
				}
			});
			$("#clear").click(function() {
				editor.setValue("");
			});
			$("#minify").click(function() {
				var content = editor.getValue();
				try {
					editor.setValue(vkbeautify.{!! $type !!}min(content));
				} catch (err) {
					alert("Your document is invalid");
				}
			});
		});
        </script>
    </div>
@endsection