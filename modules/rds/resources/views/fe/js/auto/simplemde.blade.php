<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://simplemde.com/">simplemde.com</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-12">
        <textarea name="simpleide" id="simplemde" cols="30" rows="10"></textarea>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;textarea name="autosize" class="J_autosize"&gt;&lt;/textarea&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
require(['simplemde', 'inline-attachment'], function(SimpleMDE, inlineAttachment) {
	var simplemde = new SimpleMDE({
		element      : document.getElementById("simplemde"),
		spellChecker : false,
		toolbar      : [
			"bold", "italic", "heading", "|", "quote", "code", "table",
			"horizontal-rule", "unordered-list", "ordered-list", "|",
			"link", "image", "|", "side-by-side", 'fullscreen', "|",
			{
				name      : "guide",
				action    : function customFunction(editor) {
					var win = window.open('https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md', '_blank');
					if (win) {
						//Browser has allowed it to be opened
						win.focus();
					} else {
						//Browser has blocked it
						alert('Please allow popups for this website');
					}
				},
				className : "fa fa-info-circle",
				title     : "Markdown 语法！",
			},
			{
				name      : "publish",
				action    : function customFunction(editor) {
					$('.submit-btn').click();
				},
				className : "fa fa-paper-plane",
				title     : "发布文章",
			}
		],
	});

	inlineAttachment.editors.codemirror4.attach(simplemde.codemirror, {
		uploadUrl            : '',
		uploadFieldName      : 'image',
		extraParams          : {
			'_token' : '{!! csrf_token() !!}'
		},
		onFileUploadResponse : function(xhr) {
			var result = JSON.parse(xhr.responseText),
				filename;

			if (result.status === 0) {
				filename = result.data.url[0];
			}
			if (result && filename) {
				var newValue;
				if (typeof this.settings.urlText === 'function') {
					newValue = this.settings.urlText.call(this, filename, result);
				} else {
					newValue = this.settings.urlText.replace(this.filenameTag, filename);
				}
				var text = this.editor.getValue().replace(this.lastValue, newValue);
				this.editor.setValue(text);
				this.settings.onFileUploaded.call(this, filename);
			}
			return false;
		}
	});
})
</script>
