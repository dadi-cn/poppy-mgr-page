<p class="alert alert-info" id="introduce">
	xCharts 是一个使用 D3.js 来构建漂亮的可定制的数据驱动的 JavaScript 图表库，他使用HTML，CSS，SVG实现图表，
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/tenXer/xcharts">GITHUB</a></li>
	<li><a target="_blank" href="http://tenxer.github.io/xcharts/">官网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<figure style="width: 400px; height: 300px;" id="myChart"></figure>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;figure style="width: 400px; height: 300px;" id="myChart"&gt;&lt;/figure&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['xcharts'], function (xChart) {
	var myChart = new xChart('bar', {
		"xScale": "ordinal",
		"yScale": "linear",
		"type": "bar",
		"main": [
			{
				"className": ".pizza",
				"data": [
					{
						"x": "Pepperoni",
						"y": 12
					},
					{
						"x": "Cheese",
						"y": 8
					}
				]
			}
		],
		"comp": [
			{
				"className": ".pizza",
				"type": "line-dotted",
				"data": [
					{
						"x": "Pepperoni",
						"y": 10
					},
					{
						"x": "Cheese",
						"y": 4
					}
				]
			}
		]
	}, '#myChart');
});
</script>
