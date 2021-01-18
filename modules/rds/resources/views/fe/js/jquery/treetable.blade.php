<p class="alert alert-info" id="introduce">
	jQuery treeTable 插件的功能跟 JQTreeTable 类似，是在一个表格内显示树状结果。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/ludo/jquery-treetable">GITHUB</a></li>
	<li><a target="_blank" href="http://ludo.cubicphuse.nl/jquery-treetable/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-12">
		<table id="example-basic-expandable">
			<tr data-tt-id="0">
				<td>app</td>
			</tr>
			<tr data-tt-id="1" data-tt-parent-id="0">
				<td>controllers</td>
			</tr>
			<tr data-tt-id="5" data-tt-parent-id="1">
				<td>application_controller.rb</td>
			</tr>
			<tr data-tt-id="2" data-tt-parent-id="0">
				<td>helpers</td>
			</tr>
			<tr data-tt-id="3" data-tt-parent-id="0">
				<td>models</td>
			</tr>
			<tr data-tt-id="4" data-tt-parent-id="0">
				<td>views</td>
			</tr>
		</table>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;table id="example-basic-expandable"&gt;
	&lt;tr data-tt-id="0"&gt;
		&lt;td&gt;app&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr data-tt-id="1" data-tt-parent-id="0"&gt;
		&lt;td&gt;controllers&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr data-tt-id="5" data-tt-parent-id="1"&gt;
		&lt;td&gt;application_controller.rb&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr data-tt-id="2" data-tt-parent-id="0"&gt;
		&lt;td&gt;helpers&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr data-tt-id="3" data-tt-parent-id="0"&gt;
		&lt;td&gt;models&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr data-tt-id="4" data-tt-parent-id="0"&gt;
		&lt;td&gt;views&lt;/td&gt;
	&lt;/tr&gt;
&lt;/table&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.treetable'], function ($) {
	$("#example-basic-expandable").treetable({ expandable: true });
});
</script>
