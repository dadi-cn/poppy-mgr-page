<p class="alert alert-info" id="introduce">
	Smooth Scroll是一个平滑滚动插件。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/cferdinandi/smooth-scroll">GITHUB</a></li>
	<li><a target="_blank" href="http://cferdinandi.github.io/smooth-scroll/#bazinga">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<a data-scroll href="#bazinga">点我</a>
		<div style="height:1000px"></div>
		<span id="bazinga">目的地</span>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;a data-scroll href="#bazinga"&gt;点我&lt;/a&gt;
&lt;span id="bazinga"&gt;目的地&lt;/span&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['smooth-scroll'], function (smoothScroll) {
	smoothScroll.init();
});
</script>
