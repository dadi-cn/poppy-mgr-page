<p class="alert alert-info" id="introduce">
	Fuel UX 扩展了 Bootstrap 提供额外的轻量级的 JavaScript 控制，易于安全、定制、更新和优化。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/ExactTarget/fuelux">链接地址</a></li>
	<li><a target="_blank" href="http://getfuelux.com/getting-started.html">入门</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
        <div class="fuelux">
            <div class="showchange"></div>
            <div class="checkbox highlight" id="myCheckbox10">
                <label class="checkbox-custom highlight" data-initialize="checkbox">
                    <input class="sr-only" type="checkbox" value="option1">
                    点击更改状态，并记录更改状态
                </label>
            </div>
            <label class="checkbox-custom checkbox-inline highlight" data-initialize="checkbox" id="myCheckbox11">
                <input class="sr-only" type="checkbox" value="option2">
                这是另一个多选框
            </label>
        </div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;textarea name="autosize" class="J_autosize"&gt;&lt;/textarea&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery','fuelux'],function($){
    var content = '';
    $('.checkbox input').on('change', function () {
       $('.showchange').html(content += $(this).is(':checked') );
    });
});
</script>
