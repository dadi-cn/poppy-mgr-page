<p class="alert alert-info" id="introduce">
	能实现评分效果的插件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/wbotelhos/raty">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-6">
		<div id="star_font"></div>
		<div id="star_img"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="star_font"&gt;&lt;/div&gt;
&lt;div id="star_img"&gt;&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.raty'], function ($) {
	$('#star_font').raty({ starType: 'i' });
});
require(['jquery','global', 'jquery.raty'], function ($, lemon) {
	$('#star_img').raty({
		starType: 'img' ,
		path: lemon.url_images + '/plugins/jquery.raty' ,
	});
});
</script>
