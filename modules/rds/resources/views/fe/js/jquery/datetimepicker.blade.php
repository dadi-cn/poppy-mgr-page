<p class="alert alert-info" id="introduce">
	日期时间选择插件。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/xdan/datetimepicker">GITHUB</a></li>
	<li><a target="_blank" href="http://xdsoft.net/jqplugins/datetimepicker/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
        <input type="text" value="" id="datetimepicker"/>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;input id="datetimepicker" type="text" &gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery','jquery.datetimepicker'], function ($) {
    $.datetimepicker.setLocale('ch');
    $('#datetimepicker').datetimepicker({
        value:'2015/04/15 05:03',
        step:10
    });
});
</script>
