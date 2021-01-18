<p class="alert alert-info" id="introduce">
	MiniColors一款简单的颜色选择器
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/claviska/jquery-minicolors">GITHUB</a></li>
	<li><a target="_blank" href="http://labs.abeautifulsite.net/jquery-minicolors/">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<input class="minicolors" type="text">
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;input class="minicolors" type="text"&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.minicolors'], function ($) {
	$('INPUT.minicolors').minicolors();
});
</script>
