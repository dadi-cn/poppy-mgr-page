<p class="alert alert-info" id="introduce">
	ScrollTo是一款基于jQuery的滚动插件，当点击页面的链接时，可以平滑地滚动到页面指定的位置。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/flesler/jquery.scrollTo">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<P id="from">点击</P>
		<div style="height:1000px;"></div>
		<p id="aim">目的地</p>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;P id="from"&gt;点击&lt;/P&gt;
&lt;div style="height:1000px;"&gt;&lt;/div&gt;
&lt;p id="aim"&gt;目的地&lt;/p&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.scroll-to'], function ($) {
	$("#from").click(function(){
		$.scrollTo('#aim',500);
	});
});
</script>
