<p class="alert alert-info" id="introduce">
	Zebra_Dialog是一个可灵活配置的对话框jQuery插件，大小只有4KB，要求jQuery 1.5.2+支持。可用于替换JavaScript原始的“alert” 和“confirmation”对话框。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/stefangabos/Zebra_Dialog">GITHUB</a></li>
	<li><a target="_blank" href="http://stefangabos.ro/jquery/zebra-dialog/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<input id="zebra_id" type="button" value="点击弹出">
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;input id="zebra_id" type="button" value="点击弹出"&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.zebra-dialog'], function ($) {
	$('#zebra_id').bind('click', function(e) {
		e.preventDefault();
		$.Zebra_Dialog('The link was clicked!');
	});
});
</script>
