<p class="alert alert-info" id="introduce">
	jquery滚动条插件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/kujian/jQuery-slimScroll?utm_source=caibaojian.com">GITHUB</a></li>
	<li><a target="_blank" href="http://rocha.la/jQuery-slimScroll">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div class="some-content-related-div">
			<div id="inner-content-div">
				<p>示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例</p>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;div class="some-content-related-div"&gt;
	&lt;div id="inner-content-div"&gt;
		&lt;p&gt;示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例示例&gt;&lt;/p&gt;
	&lt;/div&gt;
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.slimscroll'], function ($) {
	$('#inner-content-div').slimScroll({
		height: '50px'
	});
});
</script>
