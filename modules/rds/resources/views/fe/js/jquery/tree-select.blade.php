<p class="alert alert-info" id="introduce">
	jQuery treeselect可以将层次HTML列表转换成分层树，也可以结一结构化JSON树型数据转换成树型显示，允许动态AJAX加载数据，级联选择树型数据，也可以进行搜索。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/travist/jquery.treeselect.js">GITHUB</a></li>
	<li><a target="_blank" href="http://travist.github.com/jquery.treeselect.js">demo</a></li>
</ul>
<hr>
<script type='text/javascript'>
	var maxDepth = 3;
	var loadChildren = function(node, level) {
		var hasChildren = node.level < maxDepth;
		for (var i=0; i<8; i++) {
			var id = node.id + (i+1).toString();
			node.children.push({
				id:id,
				title:'Node ' + id,
				has_children:hasChildren,
				level: node.level + 1,
				children:[]
			});
			if (hasChildren && level < 2) {
				loadChildren(node.children[i], (level+1));
			}
		}
		return node;
	};
</script>
<div class="row" id="sample">
	<div class="col-md-4">
		<div class="chosentree">
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div class="chosentree"&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.tree-select'], function ($) {
	$('div.chosentree').chosentree({
		width: 500,
		deepLoad: true,
		load: function(node, callback) {

		}
	});
});
</script>
