<p class="alert alert-info" id="introduce">
	实现背景图片滚动效果
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/nelsonwellswku/jquery.bgpos">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		鼠标移到图片上查看演示
		<div id="demo" style="height:100px;width:100px; background: url({!! fake_thumb(100,100) !!}) no-repeat"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="demo" style="height:100px;width:100px; background: url({!! fake_thumb(100,100) !!}) no-repeat"&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.bg-pos'], function ($) {
	$(function() {

		$("#demo").hover(function(){
					$(this).animate({ backgroundPosition : "100 0"});
				},
				function(){
					$(this).stop()
					$(this).animate({ backgroundPosition : "0 0"});
				});

	});
});
</script>
