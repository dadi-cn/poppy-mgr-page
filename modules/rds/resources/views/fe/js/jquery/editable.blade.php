<p class="alert alert-info" id="introduce">
	jQuery插件editable可将选定的元素变为“可编辑”
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/tuupola/jquery_jeditable/">GITHUB</a></li>
	<li><a target="_blank" href="http://www.appelsiini.net/projects/jeditable">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div class="edit" id="div_1">Dolor</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div class="edit" id="div_1"&gt;Dolor&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
	require(['jquery', 'jquery.editable'], function ($) {
		$('.edit').editable();
	});
</script>
