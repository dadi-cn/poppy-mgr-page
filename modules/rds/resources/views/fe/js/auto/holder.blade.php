<p class="alert alert-info" id="introduce">
	Holder 可直接在客户端渲染图片的占位。支持在线和离线，提供一个链式 API 对图像占位进行样式处理。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/Rovak/InlineAttachment">链接地址</a></li>
	<li><a target="_blank" href="https://github.com/Rovak/InlineAttachment">链接地址</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<img id="myImage" src="holder.js/300x200">
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;img id="myImage" src="holder.js/300x200"&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['holder'], function (Holder) {
	var myImage = document.getElementById('myImage');
	Holder.run({
		images: myImage
	});
});
</script>
