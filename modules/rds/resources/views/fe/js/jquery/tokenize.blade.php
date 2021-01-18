<p class="alert alert-info" id="introduce">
	tokenize是一个jQuery插件，它允许用户从预定义列表或AJAX选择多个项目。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/zellerda/Tokenize">GITHUB</a></li>
	<li><a target="_blank" href="https://www.zellerda.com/projects/jquery/tokenize">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-8">
		<select id="tokenize" multiple="multiple" class="tokenize-sample">
			<option value="1">Dave</option>
		</select>
		<p>输入 d 查看演示。</p>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;select id="tokenize" multiple="multiple" class="tokenize-sample"&gt;
	&lt;option value="1"&gt;Dave&lt;/option&gt;
&lt;/select&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.tokenize'], function ($) {
	$('#tokenize').tokenize();
});
</script>
