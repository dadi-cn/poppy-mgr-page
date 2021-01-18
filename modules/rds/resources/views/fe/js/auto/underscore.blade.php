<p class="alert alert-info" id="introduce">
	Underscore一个JavaScript实用库，提供了一整套函数式编程的实用功能，但是没有扩展任何JavaScript内置对象。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/jashkenas/underscore">GITHUB</a></li>
	<li><a target="_blank" href="http://www.css88.com/doc/underscore/">中文文档</a></li>
	<li><a target="_blank" href="http://underscorejs.org/">官网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		演示见弹出框,演示了Underscore的一个遍历方法。
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
require(['underscore'], function () {
	_.each([1, 2, 3], alert);
});
</script>
