<p class="alert alert-info" id="introduce">
	metisMenu 是个Bootstrap 3 风格的 jQuery 菜单插件，允许用户创建类似手风琴效果的可折叠菜单，允许自动折叠效果。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/onokumus/metisMenu">GITHUB</a></li>
	<li><a target="_blank" href="http://mm.onokumus.com/">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<ul class="metismenu" id="menu">
			<li class="active">
				<a href="#" aria-expanded="true">Menu 1</a>
				<ul aria-expanded="true">
					<li>item1</li>
					<li>item2</li>
					<li>item3</li>
				</ul>
			</li>
			<li>
				<a href="#" aria-expanded="false">Menu 2</a>
				<ul aria-expanded="false">
					<li>item1</li>
					<li>item2</li>
					<li>item3</li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;ul class="metismenu" id="menu"&gt;
	&lt;li class="active"&gt;
		&lt;a href="#" aria-expanded="true"&gt;Menu 1&lt;/a&gt;
		&lt;ul aria-expanded="true"&gt;
			&lt;li&gt;item1&lt;/li&gt;
			&lt;li&gt;item2&lt;/li&gt;
			&lt;li&gt;item3&lt;/li&gt;
		&lt;/ul&gt;
	&lt;/li&gt;
	&lt;li&gt;
		&lt;a href="#" aria-expanded="false"&gt;Menu 2&lt;/a&gt;
		&lt;ul aria-expanded="false"&gt;
			&lt;li&gt;item1&lt;/li&gt;
			&lt;li&gt;item2&lt;/li&gt;
			&lt;li&gt;item3&lt;/li&gt;
		&lt;/ul&gt;
	&lt;/li&gt;
&lt;/ul&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.metis-menu'], function ($) {
	$("#menu").metisMenu();
});
</script>
