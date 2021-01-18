<p class="alert alert-info" id="introduce">
	jQuery颜色选择器插件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/bgrins/spectrum">GITHUB</a></li>
	<li><a target="_blank" href="http://bgrins.github.io/spectrum/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<input id='colorpicker' />
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
require(['jquery', 'jquery.spectrum'], function ($) {
	$("#colorpicker").spectrum({
		color: "#f00"
	});
});
</script>
