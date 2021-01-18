<p class="alert alert-info" id="introduce">
	jsTree是一个 基于jQuery的Tree控件。支持XML，JSON，Html三种数据源。提供创建，重命名，移动，删除，拖"放节点操作。可以自己自定义创建，删 除，嵌套，重命名，选择节点的规则。在这些操作上可以添加多种监听事件。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/vakata/jstree">GITHUB</a></li>
	<li><a target="_blank" href="https://www.jstree.com">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="container">
			<ul>
				<li>Root node
					<ul>
						<li>Child node 1</li>
						<li>Child node 2</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div id="container"&gt;
	&lt;ul&gt;
		&lt;li&gt;Root node
			&lt;ul&gt;
				&lt;li&gt;Child node 1&lt;/li&gt;
				&lt;li&gt;Child node 2&lt;/li&gt;
			&lt;/ul&gt;
		&lt;/li&gt;
	&lt;/ul&gt;
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.jstree'], function ($) {
	$('#container').jstree();
});
</script>
