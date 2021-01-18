<p class="alert alert-info" id="introduce">
	fancyBox是一款优秀的弹出框Jquery插件。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/fancyapps/fancyBox">GITHUB</a></li>
	<li><a target="_blank" href="http://www.fancyapps.com/fancybox/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-8">
		<a href="{!! fake_thumb(500,500) !!}" class="fancybox" title="Sample title1"><img src="{!! fake_thumb(100,100) !!}" /></a>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;a href="{!! fake_thumb(500,500) !!}" class="fancybox" title="Sample title"&gt;&lt;img src="{!! fake_thumb(100,100) !!}&gt;&lt;/a&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.fancybox'], function ($) {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>
