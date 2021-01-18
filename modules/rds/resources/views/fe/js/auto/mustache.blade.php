<p class="alert alert-info" id="introduce">
	Mustache 是一个 logic-less （轻逻辑）模板解析引擎，它的优势在于可以应用在 Javascript、PHP、Python、Perl 等多种编程语言中。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/janl/mustache.js">链接地址</a></li>
	<li><a target="_blank" href="http://www.open-open.com/lib/view/open1416792564461.html">demo地址</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="mustache_id"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="mustache_id"&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['mustache'], function (Mustache) {
    console.log(Mustache)
    var data = {
        "company": "Apple",
        "address": {
            "street": "1 Infinite Loop Cupertino</br>",
            "city": "California ",
            "state": "CA ",
            "zip": "95014 "
        },
        "product": ["Macbook ","iPhone ","iPod ","iPad "]
    };
    var tpl = '<h1>Hello @{{company}}</h1>';
    var html = Mustache.render(tpl, data);
    alert( html )
});
</script>
