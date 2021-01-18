<p class="alert alert-info" id="introduce">
	EASY PIE CHART是一个轻量级的jQuery插件，主要用来渲染和制作漂亮的饼图及动画效果，基于与HTML5的canvas元素。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.flowplayer.org/">GITHUB</a></li>
	<li><a target="_blank" href="http://www.flowplayer.org/docs/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div data-percent="73" class="chart">73%</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div data-percent="73" class="chart"&gt;73%&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.easypiechart'], function ($) {
	$(function() {

//create instance

		$('.chart').easyPieChart({

			animate: 2000

		});

//update instance after 5 sec

		setTimeout(function() {

			$('.chart').data('easyPieChart').update(40);

		}, 5000); });
});
</script>
