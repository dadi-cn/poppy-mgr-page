<p class="alert alert-info" id="introduce">
	Js sequence diagrams是一个方便建立UML的时序图（序列图or循序图）在线工具。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/bramp/js-sequence-diagrams">GITHUB</a></li>
	<li><a target="_blank" href="https://bramp.github.io/js-sequence-diagrams/">官网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="diagram"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<pre class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="diagram"&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
	require(['raphael','underscore','sequence-diagram'], function (Raphael,underscore,Diagram) {
		console.log(Raphael)
		var diagram = Diagram.parse("A->B: Message");
		diagram.drawSVG("diagram", {theme: 'hand'});
	});
</script>
