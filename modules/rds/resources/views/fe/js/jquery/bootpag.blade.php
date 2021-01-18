<p class="alert alert-info" id="introduce">
	bootpag 是一个动态的 jQuery 翻页插件，可很好的跟 Bootstrap 和其他 HTML 页面工作。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/botmonster/jquery-bootpag">GITHUB</a></li>
	<li><a target="_blank" href="http://botmonster.com/jquery-bootpag/#.V5Ht8lV96Uk">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<p id="content">Dynamic page content</p>
		<p id="pagination-here"></p>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;p id="content"&gt;Dynamic page content&lt;/p&gt;
&lt;p id="pagination-here"&gt;&lt;/p&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.bootpag'], function ($) {
	$('#pagination-here').bootpag({
		total: 7,          // total pages
		page: 1,            // default page
		maxVisible: 5,     // visible pagination
		leaps: true         // next/prev leaps through maxVisible
	}).on("page", function(event, num){
		$("#content").html("Page " + num); // or some ajax content loading...
		// ... after content load -> change total to 10
		$(this).bootpag({total: 10, maxVisible: 10});
	});
});
</script>
