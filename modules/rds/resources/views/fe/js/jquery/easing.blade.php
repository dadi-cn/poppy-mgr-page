<p class="alert alert-info" id="introduce">
	jquery.easing.js插件可以实现直线匀速运功、变加速运动、缓冲等丰富的动画效果。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/gdsmith/jquery.easing">GITHUB</a></li>
	<li><a target="_blank" href="http://www.flowplayer.org/docs/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="easing_id" style="width:100px;background-color: #00aa00">点我</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="easing_id" style="width:100px;background-color: #00aa00"&gt;点我&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.easing'], function ($) {
	$("#easing_id").click(function(){
		$("#easing_id").animate({
			height:500,
			width:600
		},{
			easing: 'easeInOutQuad',
			duration: 500,
		});
	})
});
</script>
