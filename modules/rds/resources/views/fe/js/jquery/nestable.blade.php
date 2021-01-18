<p class="alert alert-info" id="introduce">
	jquery拖动排序插件Nestable
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/dbushell/Nestable">GITHUB</a></li>
	<li><a target="_blank" href="http://dbushell.github.io/Nestable/">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div class="dd">
			<ol class="dd-list">
				<li class="dd-item" data-id="1">
					<div class="dd-handle">Item 1</div>
				</li>
				<li class="dd-item" data-id="2">
					<div class="dd-handle">Item 2</div>
				</li>
				<li class="dd-item" data-id="3">
					<div class="dd-handle">Item 3</div>
					<ol class="dd-list">
						<li class="dd-item" data-id="4">
							<div class="dd-handle">Item 4</div>
						</li>
						<li class="dd-item" data-id="5">
							<div class="dd-handle">Item 5</div>
						</li>
					</ol>
				</li>
			</ol>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div class="dd"&gt;
	&lt;ol class="dd-list"&gt;
		&lt;li class="dd-item" data-id="1"&gt;
			&lt;div class="dd-handle"&gt;Item 1&lt;/div&gt;
		&lt;/li&gt;
		&lt;li class="dd-item" data-id="2"&gt;
			&lt;div class="dd-handle"&gt;Item 2&lt;/div&gt;
		&lt;/li&gt;
		&lt;li class="dd-item" data-id="3"&gt;
			&lt;div class="dd-handle"&gt;Item 3&lt;/div&gt;
			&lt;ol class="dd-list"&gt;
				&lt;li class="dd-item" data-id="4"&gt;
					&lt;div class="dd-handle"&gt;Item 4&lt;/div&gt;
				&lt;/li&gt;
				&lt;li class="dd-item" data-id="5"&gt;
					&lt;div class="dd-handle"&gt;Item 5&lt;/div&gt;
				&lt;/li&gt;
			&lt;/ol&gt;
		&lt;/li&gt;
	&lt;/ol&gt;
&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.nestable'], function ($) {
	$('.dd').nestable();
});
</script>
