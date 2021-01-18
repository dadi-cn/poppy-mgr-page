<p class="alert alert-info" id="introduce">
	JQuery.BlockUI是众多JQuery插件弹出层中的一个，它小巧（原版16k，压缩后10左右）,容易使用, 功能齐全，支持Iframe，支持Modal，可定制性高也意味他默认谦虚的外表。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/malsup/blockui">GITHUB</a></li>
	<li><a target="_blank" href="http://jquery.malsup.com/block/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="myButton">点我</div>
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
require(['jquery', 'jquery.blockui'], function ($) {
	// invoke blockUI as needed -->
	$(document).on('click', '#myButton', function() {
		$.blockUI();
	});
});
</script>
