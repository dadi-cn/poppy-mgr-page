<p class="alert alert-info" id="introduce">
	SumoSelect 是一个 jQuery 单/多选择插件，它可以几乎任何设备上使用。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/HemantNegi/jquery.sumoselect">GITHUB</a></li>
	<li><a target="_blank" href="http://hemantnegi.github.io/jquery.sumoselect/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<select class="SlectBox">
			<option value="volvo">Volvo</option>
			<option value="saab">Saab</option>
			<option value="opel">Opel</option>
			<option value="audi">Audi</option>
		</select>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;select class="SlectBox"&gt;
	&lt;option value="volvo"&gt;Volvo&lt;/option&gt;
	&lt;option value="saab"&gt;Saab&lt;/option&gt;
	&lt;option value="opel"&gt;Opel&lt;/option&gt;
	&lt;option value="audi"&gt;Audi&lt;/option&gt;
&lt;/select&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.sumo-select'], function ($) {
	$('.SlectBox').SumoSelect();
});
</script>
