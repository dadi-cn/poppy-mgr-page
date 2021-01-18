<p class="alert alert-info" id="introduce">
	Morris.js 是一个轻量级的 JS 库，使用 jQuery 和 Rapha&euml;l 来生成各种时序图。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://morrisjs.github.io/morris.js/">官网</a></li>
	<li><a target="_blank" href="https://github.com/morrisjs/morris.js/">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="myfirstchart" style="height: 250px;"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="myfirstchart" style="height: 250px;"&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['morris'], function (Morris){
	new Morris.Line({
		// ID of the element in which to draw the chart.
		element: 'myfirstchart',
		// Chart data records -- each entry in this array corresponds to a point on
		// the chart.
		data: [
			{ year: '2008', value: 20 },
			{ year: '2009', value: 10 },
			{ year: '2010', value: 5 },
			{ year: '2011', value: 5 },
			{ year: '2012', value: 20 }
		],
		// The name of the data record attribute that contains x-values.
		xkey: 'year',
		// A list of names of data record attributes that contain y-values.
		ykeys: ['value'],
		// Labels for the ykeys -- will be displayed when you hover over the
		// chart.
		labels: ['Value']
	});
});
</script>
