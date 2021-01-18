<blockquote>editable <span class="intro"> jquery poshytip </span></blockquote>
<ul class="nav nav-pills">
	<li><a target="_blank" href="http://vadikom.com/demos/poshytip">demos</a></li>
	<li><a target="_blank" href="https://github.com/vadikom/poshytip">github</a></li>
	<li><a target="_blank" href="http://vadikom.com/tools/poshy-tip-jquery-plugin-for-stylish-tooltips/">Stylish Tooltips</a></li>
</ul>
<hr>
<div class="row">
	<div class="col-md-12">
		<input type="text" class="J_poshyTip" title="输入xxx">
		<input type="text" class="J_poshyTip" title="输入xxx2">
	</div>
</div>
<hr>
<div class="row mt20">
	<div class="col-md-12">
		<pre id="J_script"></pre>
	    <pre id="J_html">
&lt;input type=&quot;text&quot; class=&quot;J_poshyTip&quot; title=&quot;输入xxx&quot;&gt;
&lt;input type=&quot;text&quot; class=&quot;J_poshyTip&quot; title=&quot;输入xxx2&quot;&gt;
	    </pre>
	</div>
</div>
<script id="J_script_source">
requirejs(['jquery', 'jquery.poshytip'], function ($) {
	$('.J_poshyTip').poshytip({
		className : 'sj-poshytip-yellowsimple',
		showOn : 'focus',
		alignTo : 'target',
		alignX : 'inner-left',
		alignY : 'top',
		offsetX : 5,
		showTimeout : 100
	});
})
</script>