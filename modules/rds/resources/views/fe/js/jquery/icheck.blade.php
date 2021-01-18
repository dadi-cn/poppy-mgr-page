<p class="alert alert-info" id="introduce">
	iCheck是一款对checkbox的美化插件，支持几乎所有浏览器包括移动浏览器。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/fronteed/icheck">GITHUB</a></li>
	<li><a target="_blank" href="http://icheck.fronteed.com/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<label>
			<input type="checkbox" class="icheckbox_square-green" name="quux[1]" checked>
			Foo
		</label>
		<label for="baz[1]">
            <input type="radio" name="quux" id="baz[1]" checked>
            Bar
        </label>
		<label for="baz[2]">
            <input type="radio" name="quux" id="baz[2]">
            Bar
        </label>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;label&gt;
    &lt;input type="checkbox" class="icheckbox_square-green" name="quux[1]" checked&gt;
    Foo
&lt;/label&gt;
&lt;label for="baz[1]"&gt;
    &lt;input type="radio" name="quux" id="baz[1]" checked&gt;
    Bar
&lt;/label&gt;
&lt;label for="baz[2]"&gt;
    &lt;input type="radio" name="quux" id="baz[2]"&gt;
    Bar
&lt;/label&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.icheck'],function($){
	$('input').iCheck({
		labelHover: false,
		cursor: true,
        checkboxClass: 'icheckbox_square-red',
        radioClass: 'icheckbox_minimal-blue',
        increaseArea: '20%'
	});
});
</script>
