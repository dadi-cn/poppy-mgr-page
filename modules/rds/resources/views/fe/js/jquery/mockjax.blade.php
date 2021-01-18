<p class="alert alert-info" id="introduce">
	jQuery Mockjax插件可模拟Ajax请求。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/jakerella/jquery-mockjax">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="fortune"></div>
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
require(['jquery', 'jquery.mockjax'], function ($) {
	$.mockjax({
		url: '/products/',
		responseText: 'Here you are!'
	});
	$.ajax({
		url: '/products/'
	}).done(function(res) {
		$('#fortune').html(res);
	});
});
</script>
