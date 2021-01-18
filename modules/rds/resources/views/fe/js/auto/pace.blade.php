<p class="alert alert-info" id="introduce">
	pace可实现页面自动加载进度条。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.flowplayer.org/">链接地址</a></li>
	<li><a target="_blank" href="http://github.hubspot.com/pace/docs/welcome/">官网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html"></pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['pace'], function(pace){
	pace.start({
		document : false
	});
});

</script>
