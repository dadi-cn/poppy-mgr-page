<p class="alert alert-info" id="introduce">
	toastr 是一个实现了类似 Android 的 Toast 提示的 jQuery 插件。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/CodeSeven/toastr">GITHUB</a></li>
	<li><a target="_blank" href="http://codeseven.github.io/toastr/demo.html">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		演示：载入页面后看页面右上角通知
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
require(['jquery', 'jquery.toastr'], function ($,toastr) {
	toastr.info('这是演示通知');
});
</script>
