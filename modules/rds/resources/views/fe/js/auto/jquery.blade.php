<p class="alert alert-info" id="introduce">
	这里填写简单的源码示例
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.flowplayer.org/">GITHUB</a></li>
	<li><a target="_blank" href="http://www.flowplayer.org/docs/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<textarea name="autosize" class="J_autosize form-control" placeholder="在这里填写内容, 超过一定高度则高度会自动增加"></textarea>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;textarea name="autosize" class="J_autosize"&gt;&lt;/textarea&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'autosize'], function ($, autosize) {
	autosize($('.J_autosize'));
});
</script>
