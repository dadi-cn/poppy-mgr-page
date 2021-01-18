<p class="alert alert-info" id="introduce">
	Slide 是一个简单的滚动插件。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://slidesjs.com/">官网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-8">
		<div id="slide">
			<img src="{!! fake_thumb(940,528) !!}">
			<img src="{!! fake_thumb(940,528) !!}">
			<img src="{!! fake_thumb(940,528) !!}">
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div id="slide"&gt;
	&lt;img src="{!! fake_thumb(940,528) !!}"&gt;
	&lt;img src="{!! fake_thumb(940,528) !!}"&gt;
	&lt;img src="{!! fake_thumb(940,528) !!}"&gt;
&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.slides'], function ($) {
	$('#slide').slidesjs({
		width: 940,
		height: 528
	});
});
</script>
