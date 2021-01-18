<p class="alert alert-info" id="introduce">
	SuperSlide 是致力于实现网站统一特效调用的函数，能解决大部分标签切换、焦点图切换等效果，还能多个slide组合创造更多的效果。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.superslide2.com/">docs</a></li>
</ul>
<style>
	ul{list-style: none;}
	.slideTxtBox{ width:450px; border:1px solid #ddd; text-align:left;  }
	.slideTxtBox .hd{ height:30px; line-height:30px; background:#f4f4f4; padding:0 20px; border-bottom:1px solid #ddd;  position:relative; }
	.slideTxtBox .hd ul{ float:left; position:absolute; left:20px; top:-1px; height:32px;   }
	.slideTxtBox .hd ul li{ float:left; padding:0 15px; cursor:pointer;  }
	.slideTxtBox .hd ul li.on{ height:30px;  background:#fff; border:1px solid #ddd; border-bottom:2px solid #fff; }
	.slideTxtBox .bd ul{ padding:15px;  zoom:1;  }
	.slideTxtBox .bd li{ height:24px; line-height:24px;   }
	.slideTxtBox .bd li .date{ float:right; color:#999;  }
</style>
<hr>
<div class="row" id="sample">
	<div class="col-md-8">
		<div class="slideTxtBox">
			<div class="hd">
				<ul><li>item1</li><li>item2</li><li>item3</li></ul>
			</div>
			<div class="bd">
				<ul>
					<li><a href="http://www.SuperSlide2.com" target="_blank">aaaaaaaaaaaaaa</a></li>
					...
				</ul>
				<ul>
					<li><a href="http://www.SuperSlide2.com" target="_blank">bbbbbbbbbbbbbb</a></li>
					...
				</ul>
				<ul>
					<li><a href="http://www.SuperSlide2.com" target="_blank">cccccccccccccc</a></li>
					...
				</ul>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div class="slideTxtBox"&gt;
&lt;div class="hd"&gt;
	&lt;ul&gt;&lt;li&gt;item1&lt;/li&gt;&lt;li&gt;item2&lt;/li&gt;&lt;li&gt;item3&lt;/li&gt;&lt;/ul&gt;
&lt;/div&gt;
&lt;div class="bd"&gt;
	&lt;ul&gt;
		&lt;li&gt;&lt;a href="http://www.SuperSlide2.com" target="_blank"&gt;aaaaaaaaaaaaaa&lt;/a&gt;&lt;/li&gt;
		...
	&lt;/ul&gt;
	&lt;ul&gt;
		&lt;li&gt;&lt;a href="http://www.SuperSlide2.com" target="_blank"&gt;bbbbbbbbbbbbbb&lt;/a&gt;&lt;/li&gt;
		...
	&lt;/ul&gt;
	&lt;ul&gt;
		&lt;li&gt;&lt;a href="http://www.SuperSlide2.com" target="_blank"&gt;cccccccccccccc&lt;/a&gt;&lt;/li&gt;
		...
	&lt;/ul&gt;
&lt;/div&gt;
&lt;/div&gt;
注：css样式需要自己写。
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.superslide'], function ($) {
	$(".slideTxtBox").slide();
});
</script>
