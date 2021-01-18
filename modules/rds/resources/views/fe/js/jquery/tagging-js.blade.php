<p class="alert alert-info" id="introduce">
	taggingJS 是 jQuery 插件，用来创建一个高度自定义的前端标签系统，大小小于 2.5 kb，支持主流的浏览器。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/sniperwolf/taggingJS">GITHUB</a></li>
	<li><a target="_blank" href="http://sniperwolf.github.io/taggingJS/">dome</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="J_tags"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id=&quot;J_tags&quot;&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
	require(['jquery', 'jquery.tagging-js'], function ($) {
		$('#J_tags').tagging({
			'tags-input-name' : 'tags',
			'tag-box-class' : 'sj-tagging'
		});
	});
</script>
