<p class="alert alert-info" id="introduce">
	Web表单是一个网站的重要方面，Uniforms可以帮助你为web表单增加一个华丽的外观和视觉效果。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/AudithSoftworks/Uniform">GITHUB</a></li>
	<li><a target="_blank" href="http://opensource.audith.org/uniform/#docs">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-6">
		<select>
			<option value ="volvo">Volvo</option>
			<option value ="saab">Saab</option>
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
			&lt;select&gt;
				&lt;option value ="volvo"&gt;Volvo&lt;/option&gt;
				&lt;option value ="saab"&gt;Saab&lt;/option&gt;
				&lt;option value="opel"&gt;Opel&lt;/option&gt;
				&lt;option value="audi"&gt;Audi&lt;/option&gt;
			&lt;/select&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.uniform'], function ($) {
	$("select, input, a.button, button").uniform();
});
</script>
