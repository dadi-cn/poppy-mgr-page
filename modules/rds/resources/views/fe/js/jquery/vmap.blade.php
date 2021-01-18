<p class="alert alert-info" id="introduce">
	JQVAMP是一款jquery矢量地图生成插件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/manifestinteractive/jqvmap">GITHUB</a></li>
	<li><a target="_blank" href="http://jqvmap.com/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-12">
		<div id="vmap" style="width: 600px; height: 400px;"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="vmap" style="width: 600px; height: 400px;"&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.vmap','jquery.vmap.world'], function ($) {
	$('#vmap').vectorMap({ map: 'world_en' });
})
</script>
