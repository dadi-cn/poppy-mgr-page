<p class="alert alert-info" id="introduce">
	这款插件可以允许我们设置动态的背景图片，我们只需要准备一张大图或一组大图，bgStretcher 会自动让图片适应整个网页，并且循环背景图片
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.jq22.com/jquery-info86">jq22链接地址</a></li>
	<li><a target="_blank" href="http://www.w3blender.com/codecanyon/bgstretcher/index.html">bgStretcher Demo</a></li>
	<li><a target="_blank" href="http://www.wufangbo.com/jquery-bgstretcher-js/">使用方法和参数[wufangbo.com]</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-12">
		<div id="bgstretcher" style="width: 1140px;height: 500px;"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="bgstretcher" style="width: 1140px;height: 500px;"&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
requirejs(['jquery', 'jquery.bg-stretcher'], function ($) {
	$(function () {
		$("#bgstretcher").bgStretcher({
			images      : ["{!! fake_thumb(1170, 500) !!}", "{!! fake_thumb(1170, 500) !!}"],
			imageWidth  : 1200,
			imageHeight : 500
		})
	});
});
</script>