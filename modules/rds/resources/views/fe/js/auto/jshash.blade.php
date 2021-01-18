<p class="alert alert-info" id="introduce">
	这是一个纯 JavaScript 实现的 MD5 加密库。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.flowplayer.org/">链接地址</a></li>
	<li><a target="_blank" href="http://www.flowplayer.org/docs/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-6">
		<h4>原始的md5值</h4>
		<input type="text" class="form-control" name="original" placeholder="在这里填写原生值，可计算出md5值， 使用 md5.js 提供的方法">
	</div>
	<div class="col-md-6">
		<h4>生成md5 的结果</h4>
		<textarea name="result" class="form-control" placeholder="自动计算的md5值"></textarea>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
&lt;h4&gt;原始的md5值&lt;/h4&gt;
&lt;input type="text" class="form-control" name="original" placeholder="在这里填写原生值，可计算出md5值， 使用 md5.js 提供的方法"&gt;
&lt;h4&gt;生成md5 的结果&lt;/h4&gt;
&lt;textarea name="result" class="form-control" placeholder="自动计算的md5值"&gt;&lt;/textarea&gt;
        </pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jshash-md5'], function ($, md5) {
	$(function(){
		$('input[name=original]').on('change blur input', function(){
			var content = $('input[name=original]').val();
			if (content != '') {
				var result = "b64 MD5 : " + md5.b64(content) + "\n" +
						"hex MD5 : " + md5.hex(content) + "\n";
				$('textarea[name=result]').val(
						result
				)
			}
		});
	})
});
</script>
