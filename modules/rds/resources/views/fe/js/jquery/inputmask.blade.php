<p class="alert alert-info" id="introduce">
	jquery.inputmask 输入框input输入内容格式限制插件。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/RobinHerbots/jquery.inputmask">GITHUB</a></li>
</ul>
<hr>

<div class="row" id="sample">
	<div class="col-md-4">
		<p class="alert alert-info">日期</p>
		<input class="form-control" data-inputmask="'alias': 'date'" />
	</div>
	<div class="col-md-4">
		<p class="alert alert-info">指定位数的 9</p>
		<input class="form-control" data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" />
	</div>
	<div class="col-md-4">
		<p class="alert alert-info">号码格式</p>
		<input class="form-control" data-inputmask="'mask': '99-9999999'" />
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-4">
		<p class="alert alert-info">Http url</p>
		<input type="text" id="example_regex" class="form-control" data-inputmask-regex="http(s?)://.{5,300}" />
	</div>
	<div class="col-md-4">
	</div>
	<div class="col-md-4">
	</div>
</div>

<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
&lt;input data-inputmask="'alias': 'date'" /&gt;
&lt;input data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" /&gt;
&lt;input data-inputmask="'mask': '99-9999999'" /&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.inputmask'], function ($) {
	$(":input").inputmask();
	$("#example_regex").inputmask('Regex');

});
</script>
