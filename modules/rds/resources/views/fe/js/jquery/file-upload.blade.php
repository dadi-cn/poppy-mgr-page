<style>
	.bar {
		height: 18px;
		background: green;
	}
</style>
<p class="alert alert-info" id="introduce">
	jQuery File Upload 是一个Jquery图片上传组件，支持多文件上传、取消、删除，上传前缩略图预览、列表显示图片大小，支持上传进度条显示；支持各种动态语言开发的服务器端。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/blueimp/jQuery-File-Upload">GITHUB</a></li>
	<li><a target="_blank" href="https://blueimp.github.io/jQuery-File-Upload/">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple>
		<div id="progress">
			<div class="bar" style="width: 0%;"></div>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
	&lt;input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple&gt;
&lt;div id="progress"&gt;
	&lt;div class="bar" style="width: 0%;"&gt;&lt;/div&gt;
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery','jquery.file-upload'], function ($) {
	$('#fileupload').fileupload({
		dataType: 'json',
		done: function (e, data) {
			$.each(data.result.files, function (index, file) {
				$('<p/>').text(file.name).appendTo(document.body);
			});
		},
		progressall: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .bar').css(
					'width',
					progress + '%'
			);
		}
	});
});
</script>
