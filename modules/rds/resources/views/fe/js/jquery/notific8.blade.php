<p class="alert alert-info" id="introduce">
	jQuery 消息提醒插件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/ralivue/notific8">GITHUB</a></li>
	<li><a target="_blank" href="http://www.flowplayer.org/docs/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.notific8'], function ($) {
	$.notific8('通知内容',{color: 'teal'});
});
</script>
