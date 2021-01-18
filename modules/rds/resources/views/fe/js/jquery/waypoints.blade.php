<p class="alert alert-info" id="introduce">
	Waypoints 是一个 jQuery 用来实现捕获各种滚动事件的插件，例如实现无翻页的内容浏览，或者固定某个元素不让滚动等等。支持主流浏览器版本。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/imakewebthings/waypoints">GITHUB</a></li>
	<li><a target="_blank" href="http://imakewebthings.com/waypoints/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<img id="basic-waypoint" src="{!! fake_thumb(500,200) !!}" alt="">
		<div style="height:1000px;"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;img id="basic-waypoint" src="{!! fake_thumb(500,200) !!}" alt=""&gt;
&lt;div style="height:1000px;"&gt;&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery','jquery.waypoints'], function ($,waypoint) {
	var waypoints = $('#basic-waypoint').waypoint({
		handler: function() {
			alert("图片滚到顶部了");
		}
	})
});
</script>
