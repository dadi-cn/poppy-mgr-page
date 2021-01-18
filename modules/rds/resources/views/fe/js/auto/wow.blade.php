<p class="alert alert-info" id="introduce">
	WOW.js 实现了在网页滚动时的动画效果。需要 Animate.css 项目的支持。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/matthieua/WOW">GITHUB</a></li>
	<li><a target="_blank" href="http://www.dowebok.com/131.html">中文参考文档</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div class="wow slideInLeft"><img src="{!! fake_thumb(500,100) !!}" alt=""></div>
		<div class="wow slideInRight"><img src="{!! fake_thumb(500,100) !!}" alt=""></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div class="wow slideInLeft"&gt;&lt;img src="{!! fake_thumb(500,100) !!}" alt=""&gt;&lt;/div&gt;
&lt;div class="wow slideInRight"&gt;&lt;img src="{!! fake_thumb(500,100) !!}" alt=""&gt;&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['wow'], function (wow) {
	new wow().init();
});
</script>
