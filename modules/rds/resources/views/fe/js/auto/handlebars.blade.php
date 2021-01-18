<p class="alert alert-info" id="introduce">
	Handlebars 是 JavaScript 一个语义模板库，通过对view和data的分离来快速构建Web模板。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/wycats/handlebars.js">GITHUB</a></li>
	<li><a target="_blank" href="http://handlebarsjs.com/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<script id="entry-template" type="text/x-handlebars-template">
			<div class="entry">
				<h1>@{{title}}</h1>
				<div class="body">
					@{{body}}
				</div>
			</div>
		</script>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		{{--<pre id="J_html">&lt;textarea name="autosize" class="J_autosize"&gt;&lt;/textarea&gt;</pre>--}}
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery','handlebars'],function($,Handlebars){
	var context = {title: "My New Post", body: "This is my first post!"};
	var html    = template(context);
	var source   = $("#entry-template").html();
	var template = Handlebars.compile(source);
});
</script>
