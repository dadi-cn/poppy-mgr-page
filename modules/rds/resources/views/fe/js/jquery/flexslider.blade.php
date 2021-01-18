<p class="alert alert-info" id="introduce">
	Flexslider是一款基于的jQuery内容滚动插件。它能让你轻松的创建内容滚动的效果，具有非常高的可定制性。开发者可以使用Flexslider轻松创建各种图片轮播效果、焦点图效果、图文混排滚动效果。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.flowplayer.org/">GITHUB</a></li>
	<li><a target="_blank" href="http://www.flowplayer.org/docs/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-8">
		<div class="flexslider">
			<ul class="slides">
				<li>
					<img src="{!! fake_thumb(500,200) !!}" />
				</li>
				<li>
					<img src="{!! fake_thumb(500,200) !!}" />
				</li>
				<li>
					<img src="{!! fake_thumb(500,200) !!}" />
				</li>
			</ul>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;div class="flexslider"&gt;
	&lt;ul class="slides"&gt;
		&lt;li&gt;
			&lt;img src="{!! fake_thumb(500,200) !!}" /&gt;
		&lt;/li&gt;
		&lt;li&gt;
			&lt;img src="{!! fake_thumb(500,200) !!}" /&gt;
		&lt;/li&gt;
		&lt;li&gt;
			&lt;img src="{!! fake_thumb(500,200) !!}" /&gt;
		&lt;/li&gt;
	&lt;/ul&gt;
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.flexslider'], function ($) {
	$('.flexslider').flexslider();
});
</script>
