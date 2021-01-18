<p class="alert alert-info" id="introduce">
	Tocify是一个jQuery插件，能够动态的生成文章目录，Tocify可以随意的设置Twitter Bootstrap 或者 jQueryUI Themeroller支持的可选动画和jQuery的显示/隐藏效果，Tocify还支持平滑滚动，向前和向后按钮支持，可以监听浏览器的滚动显示当前的目录结构。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/gfranko/jquery.tocify.js">GITHUB</a></li>
	<li><a target="_blank" href="http://gregfranko.com/jquery.tocify.js/">官 网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="toc"></div>
		<div class="wrap">
			<h1>Tocify</h1>
			<br />
			<section>
				<h2>节点1</h2>
				<p>内容</p>
			</section>
			<br />
			<section>
				<h2>节点2</h2>
				<p>内容</p>
			</section>
			...
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;div id="toc"&gt;&lt;/div&gt;
&lt;div class="wrap"&gt;
	&lt;h1&gt;Tocify&lt;/h1&gt;
	&lt;br /&gt;
	&lt;section&gt;
		&lt;h2&gt;节点1&lt;/h2&gt;
		&lt;p&gt;内容&lt;/p&gt;
	&lt;/section&gt;
	&lt;br /&gt;
	&lt;section&gt;
		&lt;h2&gt;节点2&lt;/h2&gt;
		&lt;p&gt;内容&lt;/p&gt;
	&lt;/section&gt;
	...
&lt;/div&gt;
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.tocify'], function ($) {
	$("#toc").tocify();
});
</script>
