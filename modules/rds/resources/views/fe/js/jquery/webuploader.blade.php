<p class="alert alert-info" id="introduce">
	WebUploader是一个简单的以HTML5为主，FLASH为辅的现代文件上传组件。在现代的浏览器里面能充分发挥HTML5的优势，同时又不摒弃主流IE浏览器，沿用原来的FLASH运行时，兼容IE6+，iOS 6+, android 4+。两套运行时，同样的调用方式，可供用户任意选用
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://fex.baidu.com/webuploader/">docs</a></li>
	<li><a target="_blank" href="https://github.com/fex-team/webuploader/">Github</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="uploader" class="wu-example">
			<!--用来存放文件信息-->
			<div id="thelist" class="uploader-list"></div>
			<div class="btns">
				<div id="picker">选择文件</div>
				<button id="ctlBtn" class="btn btn-default">开始上传</button>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="uploader" class="wu-example"&gt;
	&lt;!--用来存放文件信息--&gt;
	&lt;div id="thelist" class="uploader-list"&gt;&lt;/div&gt;
	&lt;div class="btns"&gt;
		&lt;div id="picker"&gt;选择文件&lt;/div&gt;
		&lt;button id="ctlBtn" class="btn btn-default"&gt;开始上传&lt;/button&gt;
	&lt;/div&gt;
&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
	require(['jquery','jquery.webuploader', 'global'], function ($,WebUploader, lemon) {
		var $list = $('#thelist'),
				$btn = $('#ctlBtn'),
				state = 'pending',
				uploader;

		uploader = WebUploader.create({

			// 不压缩image
			resize: false,

			// swf文件路径
			swf: lemon.url_js + '/libs/jquery.webuploader/0.1.5/Uploader.swf',

			// 文件接收服务端。
			server: 'http://webuploader.duapp.com/server/fileupload.php',

			// 选择文件的按钮。可选。
			// 内部根据当前运行是创建，可能是input元素，也可能是flash.
			pick: '#picker'
		});

		// 当有文件添加进来的时候
		uploader.on( 'fileQueued', function( file ) {
			$list.append( '<div id="' + file.id + '" class="item">' +
					'<h4 class="info">' + file.name + '</h4>' +
					'<p class="state">等待上传...</p>' +
					'</div>' );
		});

		// 文件上传过程中创建进度条实时显示。
		uploader.on( 'uploadProgress', function( file, percentage ) {
			var $li = $( '#'+file.id ),
					$percent = $li.find('.progress .progress-bar');

			// 避免重复创建
			if ( !$percent.length ) {
				$percent = $('<div class="progress progress-striped active">' +
						'<div class="progress-bar" role="progressbar" style="width: 0%">' +
						'</div>' +
						'</div>').appendTo( $li ).find('.progress-bar');
			}

			$li.find('p.state').text('上传中');

			$percent.css( 'width', percentage * 100 + '%' );
		});

		uploader.on( 'uploadSuccess', function( file ) {
			$( '#'+file.id ).find('p.state').text('已上传');
		});

		uploader.on( 'uploadError', function( file ) {
			$( '#'+file.id ).find('p.state').text('上传出错');
		});

		uploader.on( 'uploadComplete', function( file ) {
			$( '#'+file.id ).find('.progress').fadeOut();
		});

		uploader.on( 'all', function( type ) {
			if ( type === 'startUpload' ) {
				state = 'uploading';
			} else if ( type === 'stopUpload' ) {
				state = 'paused';
			} else if ( type === 'uploadFinished' ) {
				state = 'done';
			}

			if ( state === 'uploading' ) {
				$btn.text('暂停上传');
			} else {
				$btn.text('开始上传');
			}
		});

		$btn.on( 'click', function() {
			if ( state === 'uploading' ) {
				uploader.stop();
			} else {
				uploader.upload();
			}
		});
	});
</script>