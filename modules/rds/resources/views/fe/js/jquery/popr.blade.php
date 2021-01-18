<p class="alert alert-info" id="introduce">
	POPR是一个小而简单的弹出式菜单的jQuery插件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.tipue.com/popr/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div class="popr" data-id="1">Feugait nostrud</div>

		<div class="popr-box" style="display: none;" data-box-id="1">
			<a href="#"><div class="popr-item">Feugait delenit</div></a>
			<a href="#"><div class="popr-item">Vero dolor et</div></a>
			<a href="#"><div class="popr-item">Exerci ipsum</div></a>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div class="popr" data-id="1"&gt;Feugait nostrud&lt;/div&gt;
&lt;div class="popr-box" style="display: none;" data-box-id="1"&gt;
	&lt;a href="#"&gt;&lt;div class="popr-item"&gt;Feugait delenit&lt;/div&gt;&lt;/a&gt;
	&lt;a href="#"&gt;&lt;div class="popr-item"&gt;Vero dolor et&lt;/div&gt;&lt;/a&gt;
	&lt;a href="#"&gt;&lt;div class="popr-item"&gt;Exerci ipsum&lt;/div&gt;&lt;/a&gt;
&lt;/div&gt;

		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.popr'], function ($) {
	$('.popr').popr();
});
</script>
