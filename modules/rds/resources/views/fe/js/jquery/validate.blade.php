<p class="alert alert-info" id="introduce">
	这里填写简单的源码示例
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.flowplayer.org/">GITHUB</a></li>
	<li><a target="_blank" href="http://www.flowplayer.org/docs/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<form id="form_validate">
			<div class="form-group">
				<label for="exampleInputEmail1">验证表单必填</label>
				<input type="text" name="require_field" class="form-control" id="exampleInputEmail1" placeholder="验证表单必填">
			</div>
			<button type="submit" class="btn btn-default">提交验证</button>
		</form>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
&lt;form id="form_validate"&gt;
	&lt;div class="form-group"&gt;
		&lt;label for="exampleInputEmail1"&gt;验证表单必填 [require:true]&lt;/label&gt;
		&lt;input type="text" name="require_field" class="form-control" id="exampleInputEmail1" placeholder="验证表单必填"&gt;
	&lt;/div&gt;
	&lt;button type="submit" class="btn btn-default"&gt;提交验证&lt;/button&gt;
&lt;/form&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
	requirejs(['jquery', 'lemon/util', 'jquery.validation'], function ($, util) {
		var conf = util.validate_conf({
			rules : {
				require_field : {required : true},
				kindeditor_field : {
					required : true
				}
			},
			ignore:'.ignore'
		}, 'bt3_inline');
		$('#form_validate').validate(conf);
	});
</script>