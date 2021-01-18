<p class="alert alert-info" id="introduce">
	marked 是一个 JavaScript 编写的全功能 Markdown 解析和编译器。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/chjj/marked">链接地址</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-10">
		<div id="content"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="content"&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['marked'], function (marked) {
	document.getElementById('content').innerHTML =
			marked('# Marked in browser\n\nRendered by **marked**.');
});
</script>
