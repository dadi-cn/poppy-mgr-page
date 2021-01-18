<p class="alert alert-info" id="introduce">
	这里填写简单的源码示例
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.json.org/js.html">docs</a></li>
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
		<pre id="J_html">&lt;textarea name="autosize" class="J_autosize"&gt;&lt;/textarea&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
	require(['json'], function (json) {
		var jsonStr = '{"error":0,"url":"http:\/\/www.www.cc\/2014\/01\/07\/102217_Og3K.jpg","basename":"20140107102217_Og3K.jpg","extension":"jpg"}';
		alert(json.parse(jsonStr).url);
	})
</script>
