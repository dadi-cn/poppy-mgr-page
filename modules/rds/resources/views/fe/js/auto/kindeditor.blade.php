<p class="alert alert-info" id="introduce">
	这里填写简单的源码示例测试
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/kindsoft/kindeditor">链接地址</a></li>
	<li><a target="_blank" href="http://kindeditor.org/">官网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-12">
		<textarea id="ke" name="content" style="width:700px;height:300px;"></textarea>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;textarea id="editor_id" name="content" style="width:700px;height:300px;"&gt;&lt;/textarea&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
	require(['ke'], function (ke) {
		ke.create('#ke');
	});
</script>
