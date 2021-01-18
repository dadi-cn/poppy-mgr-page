<p class="alert alert-info" id="introduce">
	InlineAttachments允许用户方便地在文本输入框中嵌入图像。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/Rovak/InlineAttachment">GITHUB</a></li>
	<li><a target="_blank" href="http://inlineattachment.readthedocs.io/en/latest/index.html">入 门</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<textarea id="code" rows="10" cols="50"></textarea>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;textarea id="code" rows="10" cols="50"&gt;&lt;/textarea&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['inline-attachment','input.inline-attachment'], function (inlineAttachment) {
	inlineAttachment.editors.input.attachToInput(document.getElementById("code"));
});
</script>
