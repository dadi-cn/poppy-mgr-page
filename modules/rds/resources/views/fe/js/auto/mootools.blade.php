<p class="alert alert-info" id="introduce">
	MooTools是一个简洁，模块化，面向对象的开源JavaScript web应用框架。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/mootools/mootools-core">链接地址</a></li>
	<li><a target="_blank" href="http://mootools.net/core/docs/1.6.0/core">英文手册</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<p id="MooTools">演示文字</p>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
        <pre id="J_html">&lt;p id="MooTools"&gt;演示文字&lt;/p&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['mootools'], function () {
    $$("#MooTools").setStyle("color", "red").setStyle("font-size", "20px");
});
</script>
