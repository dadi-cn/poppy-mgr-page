<p class="alert alert-info" id="introduce">
	Raphael 是一个用于在网页中绘制矢量图形的 Javascript 库。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/DmitryBaranovskiy/raphael">GITHUB</a></li>
	<li><a target="_blank" href="http://dmitrybaranovskiy.github.io/raphael/">官网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="canvas"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="canvas"&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
window.onload = function () {
	require(['raphael'], function(Raphael) {
		var paper = Raphael("canvas", 640, 480);
		paper.circle(320, 240, 60).animate({fill: "#223fa3", stroke: "#000", "stroke-width": 80, "stroke-opacity": 0.5}, 2000);
	});
};
</script>
