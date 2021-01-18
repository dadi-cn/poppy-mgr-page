<p class="alert alert-info" id="introduce">
	该插件可以将一个普通的输入框转换成一个实时 AJAX 搜索部件。可以以任何你喜欢的 HTML 形式来显示结果，搜索结果根据用户输入内容实时更新。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://andreaslagerkvist.com/projects/live-ajax-search/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<form method="get" action="/">
			<input type="text" name="s" placeholder="Search" id="live-search">
		</form>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;form method="get" action="/" id="live-search"&gt;
	&lt;input type="text" name="s" placeholder="Search"&gt;
&lt;/form&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.live-search'], function ($) {
    $('#live-search').liveSearch({
        url : '/tools/live-search'
    });
});
</script>
