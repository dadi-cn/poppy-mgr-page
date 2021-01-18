<p class="alert alert-info" id="introduce">
	MixItUp是一种重量轻但功能强大的 jQuery插件，提供美丽的动画过滤和分类 排序内容。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/patrickkunka/mixitup">GITHUB</a></li>
	<li><a target="_blank" href="https://mixitup.kunkalabs.com/">docs</a></li>
</ul>
<hr>
<style>
	#Container .mix{display:none;}
</style>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="Container">
			<div class="mix category-1"  data-my-order="1"><img src="{!! fake_thumb(100,100) !!}" alt=""></div>
			<div class="mix category-1"  data-my-order="2"><img src="{!! fake_thumb(100,100) !!}" alt=""></div>
			<div class="mix category-2"  data-my-order="3"><img src="{!! fake_thumb(100,100) !!}" alt=""></div>
			<div class="mix category-2"  data-my-order="4"><img src="{!! fake_thumb(100,100) !!}" alt=""></div>
		</div>
		<button class="filter" data-filter=".category-1">Category 1</button>
		<button class="filter" data-filter=".category-2">Category 2</button>
		<button class="sort" data-sort="my-order:asc">Ascending Order</button>
		<button class="sort" data-sort="my-order:desc">Descending Order</button>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div id="Container"&gt;
	&lt;div class="mix category-1"  data-my-order="1"&gt;&lt;img src="{!! fake_thumb(100,100) !!}" alt=""&gt;&lt;/div&gt;
	&lt;div class="mix category-1"  data-my-order="2"&gt;&lt;img src="{!! fake_thumb(100,100) !!}" alt=""&gt;&lt;/div&gt;
	&lt;div class="mix category-2"  data-my-order="3"&gt;&lt;img src="{!! fake_thumb(100,100) !!}" alt=""&gt;&lt;/div&gt;
	&lt;div class="mix category-2"  data-my-order="4"&gt;&lt;img src="{!! fake_thumb(100,100) !!}" alt=""&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;button class="filter" data-filter=".category-1"&gt;Category 1&lt;/button&gt;
&lt;button class="filter" data-filter=".category-2"&gt;Category 2&lt;/button&gt;
&lt;button class="sort" data-sort="my-order:asc"&gt;Ascending Order&lt;/button&gt;
&lt;button class="sort" data-sort="my-order:desc"&gt;Descending Order&lt;/button&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.mixitup'], function ($) {
	$('#Container').mixItUp();
});
</script>
