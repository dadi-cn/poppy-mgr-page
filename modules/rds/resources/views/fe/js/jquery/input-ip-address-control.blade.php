<p class="alert alert-info" id="introduce">
	插件控制IPv4或IPv6地址的格式。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/felipevolpatto/jquery-input-ip-address-control">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		暂无示例
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		{{--<pre id="J_html">&lt;textarea name="autosize" class="J_autosize"&gt;&lt;/textarea&gt;</pre>--}}
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.input-ip-address-control'], function ($) {
		$('.ipv4').ipAddress();
		$('.ipv6').ipAddress({v:6});
//mask input type text (ipv4) : ___.___.___.___
//mask input type text (ipv6) : ____:____:____:____:____:____:____:____
});
</script>
