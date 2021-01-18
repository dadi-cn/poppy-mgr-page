<p class="alert alert-info" id="introduce">
	富头像上传编辑器是一款运用FLASH技术结合ASP/ASP.NET/JSP/PHP等众多语言开发而成的一款网页版头像上传编辑器，支持本地上传、预览、视频拍照和网络加载头像图片，可缩放、裁剪、旋转、定位和调色等，仅46.3 KB，比新浪的头像编辑器组件小，本款富头像上传编辑器具有漂亮的外观、强大的功能、丰富的接口以及跨平台兼容等特点。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.fullavatareditor.com/index.html">链接地址</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div style="width:800px;margin: 0 auto;">
			<h1 style="text-align:center">富头像上传编辑器演示</h1>
			<div>
				<p id="swfContainer">
					本组件需要安装Flash Player后才可使用，请从
					<a href="http://www.adobe.com/go/getflashplayer">这里</a>
					下载安装。
				</p>
			</div>
			<button type="button" id="upload">自定义上传按钮</button>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;div style="width:800px;margin: 0 auto;"&gt;
			&lt;h1 style="text-align:center"&gt;富头像上传编辑器演示&lt;/h1&gt;
			&lt;div&gt;
				&lt;p id="swfContainer"&gt;
					本组件需要安装Flash Player后才可使用，请从
					&lt;a href="http://www.adobe.com/go/getflashplayer"&gt;这里&lt;/a&gt;
					下载安装。
				&lt;/p&gt;
			&lt;/div&gt;
			&lt;button type="button" id="upload"&gt;自定义上传按钮&lt;/button&gt;
			&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['swfobject', 'full-avatar-editor', 'global'], function (swfobject,fullAvatarEditor, lemon){
	window.swfobject = swfobject;
	var path = lemon.url_js + '/libs/full-avatar-editor/2.3/fullAvatarEditor.swf';
	var express_install = lemon.url_js + '/libs/full-avatar-editor/2.3/expressInstall.swf';
	window.swfobject.addDomLoadEvent(function () {
		var swf = new fullAvatarEditor(path, express_install, "swfContainer", {
					id : "swf",
					upload_url : "/upload.php?userid=999&username=looselive",
					method : "post",
					src_upload : 2
				}, function (msg) {
					switch(msg.code) {
						case 1 : alert("页面成功加载了组件！");break;
						case 2 : alert("已成功加载图片到编辑面板。");break;
						case 3 :
							if(msg.type == 0) {
								alert("摄像头已准备就绪且用户已允许使用。");
							} else if (msg.type == 1) {
								alert("摄像头已准备就绪但用户未允许使用！");
							} else {
								alert("摄像头被占用！");
							}
							break;
						case 5 :
							if(msg.type == 0) {
								if(msg.content.sourceUrl) {
									alert("原图片已成功保存至服务器，url为：\n" +　msg.content.sourceUrl);
								}
								alert("头像已成功保存至服务器，url为：\n" + msg.content.avatarUrls.join("\n"));
							}
							break;
					}
				}
		);
		document.getElementById("upload").onclick=function(){
			swf.call("upload");
		};
	});
});
</script>
