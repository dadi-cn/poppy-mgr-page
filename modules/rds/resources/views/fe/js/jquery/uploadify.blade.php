<p class="alert alert-info" id="introduce">
	Uploadify是JQuery的一个上传插件，实现的效果非常不错，带进度显示。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.uploadify.com/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<input type="file" name="file_upload" id="file_upload" />
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;input type="file" name="file_upload" id="file_upload" /&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
	requirejs(['jquery', 'global','jquery.uploadify'], function ($, lemon, uploadify) {
		$("#file_upload").uploadify({
			height        : 30,
			swf           : lemon.url_js + '/libs/jquery.uploadify/3.2.1/uploadify.swf',
			uploader      : '/uploadify/uploadify.php',
			width         : 120,
			buttonText    : '上传文件'
		});
	})

</script>
