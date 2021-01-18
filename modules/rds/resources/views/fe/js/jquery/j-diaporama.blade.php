<p class="alert alert-info" id="introduce">
	jDiaporama是一个高度可定制的图片幻灯片播放控件。支持键盘导航、自动播放、控制播放方向、设置循环播放次数、显示标题，说明和图片计数器等功能。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="http://www.guillaumevoisin.fr/jquery/diaporama-simple-avec-jquery-nouvelle-version-jdiaporama">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<ul class="diaporama">
			<li><img src="{!! fake_thumb(500,100) !!}" title="title" alt="Image 1" /></li>
			<li><img src="{!! fake_thumb(500,100) !!}" title="title" alt="Image 2" /></li>
			<li><img src="{!! fake_thumb(500,100) !!}" title="title" alt="Image 3" /></li>
			<li><img src="{!! fake_thumb(500,100) !!}" title="title" alt="Image 4" /></li>
			<li><img src="{!! fake_thumb(500,100) !!}" title="title" alt="Image 5" /></li>
		</ul>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;ul class="diaporama"&gt;
	&lt;li&gt;&lt;img src="{!! fake_thumb(500,100) !!}" alt="Image 1" /&gt;&lt;/li&gt;
	&lt;li&gt;&lt;img src="{!! fake_thumb(500,100) !!}" alt="Image 2" /&gt;&lt;/li&gt;
	&lt;li&gt;&lt;img src="{!! fake_thumb(500,100) !!}" alt="Image 3" /&gt;&lt;/li&gt;
	&lt;li&gt;&lt;img src="{!! fake_thumb(500,100) !!}" alt="Image 4" /&gt;&lt;/li&gt;
	&lt;li&gt;&lt;img src="{!! fake_thumb(500,100) !!}" alt="Image 5" /&gt;&lt;/li&gt;
&lt;/ul&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.j-diaporama'], function ($) {
	$(".diaporama").jDiaporama({
		animationSpeed: "slow",
		delay:2
	});
});
</script>
