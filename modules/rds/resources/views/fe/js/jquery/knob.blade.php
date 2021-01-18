<p class="alert alert-info" id="introduce">
	一款生成漂亮旋钮(knob)的jQuery插件。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/aterrien/jQuery-Knob">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<input type="text" class="dial" data-min="-50" data-max="50" >
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;input type="text" class="dial" data-min="-50" data-max="50" &gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.knob'], function ($) {
	$(".dial").knob();
});
</script>
