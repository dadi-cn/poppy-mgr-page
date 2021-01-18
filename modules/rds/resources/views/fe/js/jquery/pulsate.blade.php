<p class="alert alert-info" id="introduce">
	jQuery.pulsate.js用于为元素增加了脉动效果， 绘制吸引用户关注的动画。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/Kilian/jQuery.pulsate">GITHUB</a></li>
	<li><a target="_blank" href="https://kilianvalkhof.com/jquerypulsate/">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<p id="pulsate">演示</p>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;p id="pulsate"&gt;演示&lt;/p&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.pulsate'], function ($) {
	$("#pulsate").pulsate({glow:false});
});
</script>
