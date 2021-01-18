<p class="alert alert-info" id="introduce">
	Multiselect是一个采用jQuery实现的两边多选列表控件。可以将需要选定的项目从左边添加到右边的列表框中。或者将不需要的项目从右边列表框中删除。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/lou/multi-select">GITHUB</a></li>
	<li><a target="_blank" href="http://loudev.com/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<select multiple="multiple" id="my-select" name="my-select[]">
			<option value='elem_1'>elem 1</option>
			<option value='elem_2'>elem 2</option>
			<option value='elem_3'>elem 3</option>
			<option value='elem_4'>elem 4</option>
			...
			<option value='elem_100'>elem 100</option>
		</select>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;select multiple="multiple" id="my-select" name="my-select[]"&gt;
	&lt;option value='elem_1'&gt;elem 1&lt;/option&gt;
	&lt;option value='elem_2'&gt;elem 2&lt;/option&gt;
	&lt;option value='elem_3'&gt;elem 3&lt;/option&gt;
	&lt;option value='elem_4'&gt;elem 4&lt;/option&gt;
	...
	&lt;option value='elem_100'&gt;elem 100&lt;/option&gt;
&lt;/select&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.multi-select'], function ($) {
	$('#my-select').multiSelect()
});
</script>
