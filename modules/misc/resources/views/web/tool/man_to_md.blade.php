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
        <h3>Man Html Convert To MarkDown</h3>
        <div class="row" style="font-family: monospace;">
            <div class="col-6">
                <div class="editor-wrapper">
                    <pre id="editor" style="min-height: 500px;"></pre>
                    <p class="editor-handle">
                        <button id="change" class="btn btn-info btn-sm">转换</button>
                        <!-- Trigger -->
                        <button class="btn btn-info btn-sm" id="cut" data-clipboard-target="#content">
                            Cut to clipboard
                        </button>
                    </p>
                    <script>
					$(function() {
						var editor = ace.edit("editor");
						editor.setTheme("ace/theme/chrome");
						editor.session.setMode("ace/mode/markdown");

						$('#change').on('click', function() {
							Util.makeRequest('', {
								content   : editor.getValue(),
								'_update' : '#content'
							}, function(data) {
								Util.splash(data);
							})
						});
					});
                    </script>
                </div>
            </div>
            <div class="col-6">
                <textarea id="content" class="form-control mt0" style="min-height: 471px;width: 94%;"></textarea>
            </div>
        </div>
    </div>
    <script>
	$(function() {
		var clipboard = new ClipboardJS('#cut', {
			text : function() {
				return $('#content').val();
			}
		});
		clipboard.on('success', function() {
			Util.splash({
				status  : 0,
				message : '复制成功'
			});
			e.clearSelection();
		});
	})

    </script>
@endsection