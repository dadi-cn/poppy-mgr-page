<p class="alert alert-info" id="introduce">
	jQuery UI 是建立在 jQuery JavaScript 库上的一组用户界面交互、特效、小部件及主题。无论您是创建高度交互的 Web 应用程序还是仅仅向窗体控件添加一个日期选择器，jQuery UI 都是一个完美的选择。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/jquery/jquery-ui">GITHUB</a></li>
	<li><a target="_blank" href="http://jqueryui.com/">官 网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<input type="text" name="date" id="date" />
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;input type="text" name="date" id="date" /&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.ui'], function ($) {
	$( "#date" ).datepicker();
});
</script>
