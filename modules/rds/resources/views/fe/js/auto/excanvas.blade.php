<p class="alert alert-info" id="introduce">
	让低版本IE（6,7,8）支持canvas
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/yinso/excanvas">链接地址</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<canvas id="myCanvas"></canvas>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;textarea name="autosize" class="J_autosize"&gt;&lt;/textarea&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['excanvas'],function () {
	var canvas=document.getElementById('myCanvas');
	var ctx=canvas.getContext('2d');
	ctx.fillStyle='#FF0000';
	ctx.fillRect(0,0,80,100);
});
</script>
