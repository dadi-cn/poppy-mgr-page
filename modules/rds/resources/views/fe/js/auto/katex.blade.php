<p class="alert alert-info" id="introduce">
	KaTeX 是一个快速，为网站呈现 Tex 科学公式 的简单易用的 javascript 库。只需要你会输入公式，该编辑器就会自动排版对应的公式出来。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/Khan/KaTeX">链接地址</a></li>
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
		{{--<h4>代码示例</h4>--}}
		{{--<pre id="J_html">&lt;textarea name="autosize" class="J_autosize"&gt;&lt;/textarea&gt;</pre>--}}
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['katex'], function (katex) {
	katex.render("c = \\pm\\sqrt{a^2 + b^2}", element);
});
</script>
