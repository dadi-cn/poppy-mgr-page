<p class="alert alert-info" id="introduce">
	JavaScript 日期处理类库
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://momentjs.cn/">中文网</a></li>
	<li><a target="_blank" href="https://github.com/moment/moment/">链接网址</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<h4>相对时间</h4>
		<p id="moment_id"></p>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;h4&gt;相对时间&lt;/h4&gt;&lt;p id="moment_id"&gt;&lt;/p&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['moment'], function (moment) {
	var p = document.getElementById("moment_id");
	p.innerHTML = moment("20111031", "YYYYMMDD").fromNow();
});
</script>
