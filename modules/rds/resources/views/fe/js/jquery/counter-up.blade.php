<p class="alert alert-info" id="introduce">
	一个轻量级的jQuery插件，计数到有针对性的号码时数的变化动态可见。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/bfintal/Counter-Up">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<span class="counter">1,234,567</span>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;span class="counter"&gt;1,234,567&lt;/span&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.counter-up'], function ($) {
	$('.counter').counterUp({
		delay: 10,
		time: 1000
	});
});
</script>
