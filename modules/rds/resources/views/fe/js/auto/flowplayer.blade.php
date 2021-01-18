<p class="alert alert-info" id="introduce">
	FlowPlayer 是一个用Flash开发的在Web上的视频播放器，可以很容易将它集成在任何的网页上。支持HTTP以及流媒体传输。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.oschina.net/p/editor-md">链接地址</a></li>
	<li><a target="_blank" href="http://www.oschina.net/p/editor-md">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-10">
		<div id="player""></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;a href="http://az29176.vo.msecnd.net/videocontent/DwarfFlyingSquirrel_GettyRM-516611677_768_ZH-CN.mp4"&gt;&lt;/a&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
	require(['flowplayer'], function (flowplayer) {
		var container = document.getElementById("player");
		flowplayer(container, {
			clip: {
				sources: [
					{ type: "video/mp4",
						src:  "http://az29176.vo.msecnd.net/videocontent/DwarfFlyingSquirrel_GettyRM-516611677_768_ZH-CN.mp4" }
				]
			}
		});
	});
</script>
