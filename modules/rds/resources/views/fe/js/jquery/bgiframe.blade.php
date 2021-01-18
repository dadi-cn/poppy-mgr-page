<p class="alert alert-info" id="introduce">
	bgiframe 插件用来轻松解决 IE6 z-index 的问题。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/brandonaaron/bgiframe">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		暂无示例
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		{{--<pre id="J_html">&lt;textarea name="autosize" class="J_autosize"&gt;&lt;/textarea&gt;</pre>--}}
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.bg-stretcher'], function ($, bgiframe) {
		$('#floatingBox').bgiframe();
});
</script>
