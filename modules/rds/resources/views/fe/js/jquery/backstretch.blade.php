<p class="alert alert-info" id="introduce">
	Backstretch是一款简单的jQuery插件，可以帮助你给网页添加一个动态的背景图片，可以自动调整大小适应屏幕的尺寸。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/srobbin/jquery-backstretch">GITHUB</a></li>
	<li><a target="_blank" href="http://srobbin.com/jquery-plugins/backstretch/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		示例见背景
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
require(['jquery', 'jquery.backstretch'], function ($) {
    $.backstretch([
        "{!! fake_thumb(1000,1000) !!}"
        , "{!! fake_thumb(1000,1000) !!}"
        , "{!! fake_thumb(1000,1000) !!}"
    ], {duration: 3000, fade: 750});
});
</script>
