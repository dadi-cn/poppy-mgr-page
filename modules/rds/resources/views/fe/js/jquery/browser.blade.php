<p class="alert alert-info" id="introduce">
	检测哪一个Web浏览器正在访问网页，通过浏览器本身返回。它包含四个最流行的浏览器类（在Internet Explorer，Mozilla和Webkit，和Opera）以及每个版本信息标志。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/gabceb/jquery-browser-plugin">GITHUB</a></li>
	<li><a target="_blank" href="http://api.jquery.com/jQuery.browser/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="demo"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="demo"&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.browser'], function ($) {
	//返回浏览器版本信息
	$('#demo').text('浏览器版本：' + $.browser.version);
});
</script>
