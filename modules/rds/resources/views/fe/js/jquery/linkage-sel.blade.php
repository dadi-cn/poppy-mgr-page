<p class="alert alert-info" id="introduce">
	基于jquery的联动下拉框组件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/waitingsong/LinkageSel">GITHUB</a></li>
	<li><a target="_blank" href="http://linkagesel.xiaozhong.biz/index.html">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<select name="" id="demo1"></select>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;select name="" id="demo1"&gt;&lt;/select&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.linkage-sel'], function ($) {
	var data1 = {
		1: {name: '蔬菜', cell: { 10: {name: '菠菜' }, 11: {name: '茄子'} }
		},
		3: {name: '水果',
			cell: {
				20: {name: '苹果', cell: {201: {name: '红富士'}  } } ,
				21: {name: '桃',
					cell: {
						210: {name: '猕猴桃'},
						211: {name: '油桃'},
						212: {name: '蟠桃'} }
				}
			}
		},
		9: {name: '粮食',
			cell: {
				30: {name: '水稻',    cell: { 301: {name: '大米', cell: {3001: {name: '五常香米', price: 50}} } }   }
			}
		}
	};
	var opts = {
		data: data1,
		select: '#demo1'
	};
	var linkageSel1 = new LinkageSel(opts);

});
</script>
