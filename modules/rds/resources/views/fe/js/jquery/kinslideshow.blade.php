<p class="alert alert-info" id="introduce">
	兼容IE6/IE7/IE8/IE9,FireFox,Chrome*,Opera的 jQuery. KinSlideshow幻灯片插件，功能很多 ，基本能满足你在网页上使用幻灯片(焦点图)效果。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/BottleMan/KinSlideshow">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-10">
		<div id="KinSlideshow" >
			<a href="#" target="_blank"><img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题一" /></a>
			<a href="#" target="_blank"><img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题二" /></a>
			<a href="#" target="_blank"><img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题三" /></a>
			<a href="#" target="_blank"><img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题四" /></a>
			<a href="#" target="_blank"><img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题五" /></a>
			<a href="#" target="_blank"><img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题六" /></a>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div id="KinSlideshow"&gt;
	&lt;a href="#" target="_blank"&gt;&lt;img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题一" /&gt;&lt;/a&gt;
	&lt;a href="#" target="_blank"&gt;&lt;img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题二" /&gt;&lt;/a&gt;
	&lt;a href="#" target="_blank"&gt;&lt;img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题三" /&gt;&lt;/a&gt;
	&lt;a href="#" target="_blank"&gt;&lt;img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题四" /&gt;&lt;/a&gt;
	&lt;a href="#" target="_blank"&gt;&lt;img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题五" /&gt;&lt;/a&gt;
	&lt;a href="#" target="_blank"&gt;&lt;img src="{!! fake_thumb(500,100) !!}" width="500" height="200" alt="这是标题六" /&gt;&lt;/a&gt;
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.kinslideshow'], function ($) {
	$("#KinSlideshow").KinSlideshow({
		moveStyle:"right",
		titleBar:{
			titleBar_height:30,
			titleBar_bgColor:"#08355c",
			titleBar_alpha:0.5
		},
		titleFont:{
			TitleFont_size:12,
			TitleFont_color:"#FFFFFF",
			TitleFont_weight:"normal"
		},
		btn:{
			btn_bgColor:"#FFFFFF",
			btn_bgHoverColor:"#1072aa",
			btn_fontColor:"#000000",
			btn_fontHoverColor:"#FFFFFF",
			btn_borderColor:"#cccccc",
			btn_borderHoverColor:"#1188c0",
			btn_borderWidth:1
		}
	});
});
</script>
