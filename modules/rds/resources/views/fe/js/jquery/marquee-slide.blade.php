<p class="alert alert-info" id="introduce">
	marquee.js 多功能无缝滚动jQuery插件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/wange1228/marquee-slide">GITHUB</a></li>
	<li><a target="_blank" href="http://wange.im/demo/marquee-slide/marquee_slide.html">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-12">
		<div id="marquee_slide">
			<ul style="list-style: none">
				<li>1</li>
				<li>2</li>
				<li>3</li>
				<li>4</li>
				<li>5</li>
			</ul>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;div id="marquee_slide"&gt;
	&lt;ul style="list-style: none"&gt;
		&lt;li&gt;1&lt;/li&gt;
		&lt;li&gt;2&lt;/li&gt;
		&lt;li&gt;3&lt;/li&gt;
		&lt;li&gt;4&lt;/li&gt;
		&lt;li&gt;5&lt;/li&gt;
	&lt;/ul&gt;
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.marquee-slide'], function ($) {
	$('#marquee_slide').marquee({
		auto: true,
		interval: 3000,
		speed: 500,
		showNum: 5,
		stepLen: 5
	});
});
</script>
