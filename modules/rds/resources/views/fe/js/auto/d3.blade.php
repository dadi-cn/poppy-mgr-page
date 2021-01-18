<p class="alert alert-info" id="introduce">D3.js是一个JavaScript库，它可以通过数据来操作文档。D3可以通过使用HTML、SVG和CSS把数据鲜活形象地展现出来。</p>
<hr>
<hr>
<div class="row">
	<div class="col-md-12">
		<div id="svg"></div>
		<hr>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['d3'], function (d3) {
	var svg = d3.select("#svg")		//选择文档中的body元素
			.append("svg")				//添加一个svg元素
			.attr("width", 300)		//设定画布的宽度
			.attr("height", 300);	//设定画布的高度

	var dataset = [250, 210, 170, 130, 90];

	var rectHeight = 25;	//每个矩形所占的像素高度(包括空白)

	svg.selectAll("rect")
			.data(dataset)
			.enter()
			.append("rect")
			.attr("x", 20)
			.attr("y", function (d, i) {
				return i * rectHeight;
			})
			.attr("width", function (d) {
				return d;
			})
			.attr("height", rectHeight - 2)
			.attr("fill", "steelblue");
});
</script>
