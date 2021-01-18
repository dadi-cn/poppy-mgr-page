<p class="alert alert-info" id="introduce">
	jQuery表单插件jQuery.form 让你轻松管理表单数据和进行表单提交。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/malsup/form">GITHUB</a></li>
	<li><a target="_blank" href="http://malsup.com/jquery/form/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		暂无演示
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;form id="myForm" action="comment.php" method="post"&gt;
	Name: &lt;input type="text" name="name" /&gt;
	Comment: &lt;textarea name="comment"&gt&lt;/textarea&gt;
	&lt;input type="submit" value="Submit Comment" /&gt;
&lt;/form&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.form'], function ($) {
	$('#myForm').ajaxForm(function() {
		alert("Thank you for your comment!");
	});
});
</script>
