<p class="alert alert-info" id="introduce">
	Plupload 是一个Web浏览器上的界面友好的文件上传模块，可显示上传进度、图像自动缩略和上传分块。可同时上传多个文件。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.plupload.com/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<ul id="filelist"></ul>
		<br />
		<div id="container">
			<a id="pickfiles" href="javascript:;">[选择文件]</a>
			<a id="uploadfiles" href="javascript:;">[开始上传]</a>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;div id="container"&gt;
	&lt;a id="pickfiles" href="javascript:;"&gt;[选择文件]&lt;/a&gt;
	&lt;a id="uploadfiles" href="javascript:;"&gt;[开始上传]&lt;/a&gt;
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'plupload'], function ($,plupload) {
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button : 'pickfiles', // you can pass an id...
		container: document.getElementById('container'), // ... or DOM Element itself
		url : 'upload.php',
		flash_swf_url : '../js/Moxie.swf',
		silverlight_xap_url : '../js/Moxie.xap',

		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "Image files", extensions : "jpg,gif,png"},
				{title : "Zip files", extensions : "zip"}
			]
		},

		init: {
			PostInit: function() {
				document.getElementById('filelist').innerHTML = '';

				document.getElementById('uploadfiles').onclick = function() {
					uploader.start();
					return false;
				};
			},

			FilesAdded: function(up, files) {
				plupload.each(files, function(file) {
					document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				});
			},

			UploadProgress: function(up, file) {
				document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},

			Error: function(up, err) {
				document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
			}
		}
	});

	uploader.init();
});
</script>
