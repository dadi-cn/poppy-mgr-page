<p class="alert alert-info" id="introduce">
	jQuery图片延迟加载插件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.appelsiini.net/projects/lazyload">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-12">
		<img class="lazy" data-original="{!! fake_thumb(500,500) !!}" width="500" height="500">
		<img class="lazy" data-original="{!! fake_thumb(500,500) !!}" width="500" height="500">
		<img class="lazy" data-original="{!! fake_thumb(500,500) !!}" width="500" height="500">
		<img class="lazy" data-original="{!! fake_thumb(500,500) !!}" width="500" height="500">
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;img class="lazy" src="{!! fake_thumb(500,500) !!}"&gt;
&lt;img class="lazy" src="{!! fake_thumb(500,500) !!}"&gt;
&lt;img class="lazy" src="{!! fake_thumb(500,500) !!}"&gt;
&lt;img class="lazy" src="{!! fake_thumb(500,500) !!}"&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.lazyload'], function ($,lazyload) {
	//图片在向下滚动需要的时候被加载
	$("img.lazy").lazyload();
});
</script>
