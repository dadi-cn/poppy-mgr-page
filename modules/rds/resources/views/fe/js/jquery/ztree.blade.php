<p class="alert alert-info" id="introduce">
	zTree 是一个依靠 jQuery 实现的多功能 “树插件”。优异的性能、灵活的配置、多种功能的组合是 zTree 最大优点。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/zTree/zTree_v3">GITHUB</a></li>
	<li><a target="_blank" href="http://www.ztree.me/v3/main.php#_zTreeInfo">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div>
			<ul id="treeDemo" class="ztree"></ul>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;ul id="treeDemo" class="ztree"&gt;&lt;/ul&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.ztree'], function ($) {
	var zTreeObj;
	// zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
	var setting = {};
	// zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
	var zNodes = [
		{name:"test1", open:true, children:[
			{name:"test1_1"}, {name:"test1_2"}]},
		{name:"test2", open:true, children:[
			{name:"test2_1"}, {name:"test2_2"}]}
	];
	$(document).ready(function(){
		zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
	});
});
</script>
