<p class="alert alert-info" id="introduce">
	多级下拉联动插件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/tuupola/jquery_chained">GITHUB</a></li>
	<li><a target="_blank" href="http://www.appelsiini.net/projects/chained">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<select id="mark" name="mark">
			<option value="">--</option>
			<option value="bmw">BMW</option>
			<option value="audi">Audi</option>
		</select>
		<select id="series" name="series">
			<option value="">--</option>
			<option value="series-3" class="bmw">3 series</option>
			<option value="series-5" class="bmw">5 series</option>
			<option value="series-6" class="bmw">6 series</option>
			<option value="a3" class="audi">A3</option>
			<option value="a4" class="audi">A4</option>
			<option value="a5" class="audi">A5</option>
		</select>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;select id="mark" name="mark"&gt;
	&lt;option value=""&gt;--&lt;/option&gt;
	&lt;option value="bmw"&gt;BMW&lt;/option&gt;
	&lt;option value="audi"&gt;Audi&lt;/option&gt;
&lt;/select&gt;
&lt;select id="series" name="series"&gt;
	&lt;option value=""&gt;--&lt;/option&gt;
	&lt;option value="series-3" class="bmw"&gt;3 series&lt;/option&gt;
	&lt;option value="series-5" class="bmw"&gt;5 series&lt;/option&gt;
	&lt;option value="series-6" class="bmw"&gt;6 series&lt;/option&gt;
	&lt;option value="a3" class="audi"&gt;A3&lt;/option&gt;
	&lt;option value="a4" class="audi"&gt;A4&lt;/option&gt;
	&lt;option value="a5" class="audi"&gt;A5&lt;/option&gt;
&lt;/select&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.chained'], function ($) {
	$("#series").chained("#mark");
});
</script>
