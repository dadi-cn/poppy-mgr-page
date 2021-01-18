<p class="alert alert-info" id="introduce">
	jQuery Tools是一组基于jQuery构建的用户界面常用组件的集合。包含如今网站六个最有用的javascript工具。选项卡功能(Tabs)提示工具条功能(ToolTips)信息滚动功能(Scrollable)遮罩效果(overlay)突出效果(expose)Flash嵌入
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/jquerytools/jquerytools">GITHUB</a></li>
	<li><a target="_blank" href="http://www.flowplayer.org/docs/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<ul class="tabs">
			<li><a href="#">Tab 1
			<li><a href="#">Tab 2
			<li><a href="#">Tab 3
		</ul>
		<div class="panes">
			<div>"panes 1"</div>
			<div>"panes 2"</div>
			<div>"panes 3"</div>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;ul class="tabs"&gt;
	&lt;li&gt;&lt;a href="#"&gt;Tab 1
	&lt;li&gt;&lt;a href="#"&gt;Tab 2
	&lt;li&gt;&lt;a href="#"&gt;Tab 3
&lt;/ul&gt;
&lt;div class="panes"&gt;
	&lt;div&gt;"panes 1"&lt;/div&gt;
	&lt;div&gt;"panes 2"&lt;/div&gt;
	&lt;div&gt;"panes 3"&lt;/div&gt;
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.tools'], function ($) {
	$("ul.tabs").tabs("div.panes > div");
});
</script>
