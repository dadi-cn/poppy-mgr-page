<p class="alert alert-info" id="introduce">
	Highlight.js是用JavaScript编写的一个语法高亮显示组件。可以在浏览器以及服务器上运行。它适用于几乎任何语言且不依赖于任何框架来自动检测语言。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/isagalaev/highlight.js/">链接地址</a></li>
	<li><a target="_blank" href="https://highlightjs.org/">官网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<pre><code class="html">var i = 1;</code></pre>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;pre&gt;&lt;code class="html"&gt;var i = 1;&lt;/code&gt;&lt;/pre &gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['highlight'], function () {
	hljs.initHighlightingOnLoad();
});
</script>
