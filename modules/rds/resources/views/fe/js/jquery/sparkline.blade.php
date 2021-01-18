<p class="alert alert-info" id="introduce">
	jQuery线状图插件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/gwatts/jquery.sparkline">GITHUB</a></li>
	<li><a target="_blank" href="http://omnipotent.net/jquery.sparkline/#s-about">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<p>
			Inline Sparkline: <span class="inlinesparkline">1,4,4,7,5,9,10</span>.
		</p>
		<p>
			Sparkline with dynamic data: <span class="dynamicsparkline">Loading..</span>
		</p>
		<p>
			Bar chart with dynamic data: <span class="dynamicbar">Loading..</span>
		</p>
		<p>
			Bar chart with inline data: <span class="inlinebar">1,3,4,5,3,5</span>
		</p>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;p&gt;
	Inline Sparkline: &lt;span class="inlinesparkline"&gt;1,4,4,7,5,9,10&lt;/span&gt;.
&lt;/p&gt;
&lt;p&gt;
	Sparkline with dynamic data: &lt;span class="dynamicsparkline"&gt;Loading..&lt;/span&gt;
&lt;/p&gt;
&lt;p&gt;
	Bar chart with dynamic data: &lt;span class="dynamicbar"&gt;Loading..&lt;/span&gt;
&lt;/p&gt;
&lt;p&gt;
	Bar chart with inline data: &lt;span class="inlinebar"&gt;1,3,4,5,3,5&lt;/span&gt;
&lt;/p&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.sparkline'], function ($) {
	/** This code runs when everything has been loaded on the page */
	/* Inline sparklines take their values from the contents of the tag */
	$('.inlinesparkline').sparkline();

	/* Sparklines can also take their values from the first argument
	 passed to the sparkline() function */
	var myvalues = [10,8,5,7,4,4,1];
	$('.dynamicsparkline').sparkline(myvalues);

	/* The second argument gives options such as chart type */
	$('.dynamicbar').sparkline(myvalues, {type: 'bar', barColor: 'green'} );

	/* Use 'html' instead of an array of values to pass options
	 to a sparkline with data in the tag */
	$('.inlinebar').sparkline('html', {type: 'bar', barColor: 'red'} );
});
</script>
