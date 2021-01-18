<p class="alert alert-info" id="introduce">
	tinycarousel是一个轻量级的基于HTML内容滑动旋转木马。支持垂直或水平滑动，支持通过按钮或分页导航，设置幻灯片间隔，无限的幻灯片循环，响应式设计。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/wieringen/tinycarousel">GITHUB</a></li>
	<li><a target="_blank" href="http://baijs.com/tinycarousel/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-10">
		<div id="slider1">
			<a class="buttons prev" href="#">&#60;</a>
			<div class="viewport">
				<ul class="overview">
					<li><img src="{!! fake_thumb(500,200) !!}" /></li>
					<li><img src="{!! fake_thumb(500,200) !!}" /></li>
					<li><img src="{!! fake_thumb(500,200) !!}" /></li>
					<li><img src="{!! fake_thumb(500,200) !!}" /></li>
					<li><img src="{!! fake_thumb(500,200) !!}" /></li>
					<li><img src="{!! fake_thumb(500,200) !!}" /></li>
				</ul>
			</div>
			<a class="buttons next" href="#">&#62;</a>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div id="slider1"&gt;
&lt;a class="buttons prev" href="#"&gt;&#60;&lt;/a&gt;
&lt;div class="viewport"&gt;
	&lt;ul class="overview"&gt;
		&lt;li&gt;&lt;img src="{!! fake_thumb(500,200) !!}" /&gt;&lt;/li&gt;
		&lt;li&gt;&lt;img src="{!! fake_thumb(500,200) !!}" /&gt;&lt;/li&gt;
		&lt;li&gt;&lt;img src="{!! fake_thumb(500,200) !!}" /&gt;&lt;/li&gt;
		&lt;li&gt;&lt;img src="{!! fake_thumb(500,200) !!}" /&gt;&lt;/li&gt;
		&lt;li&gt;&lt;img src="{!! fake_thumb(500,200) !!}" /&gt;&lt;/li&gt;
		&lt;li&gt;&lt;img src="{!! fake_thumb(500,200) !!}" /&gt;&lt;/li&gt;
	&lt;/ul&gt;
&lt;/div&gt;
&lt;a class="buttons next" href="#"&gt;&#62;&lt;/a&gt;
&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.tinycarousel'], function ($) {
	$('#slider1').tinycarousel();
});
</script>
