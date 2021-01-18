<p class="alert alert-info" id="introduce">
	简单，轻量级的的视差引擎，智能设备的方向作出反应。凡没有陀螺仪或运动检测硬件是可用的，光标的位置来代替。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/wagerfield/parallax">GITHUB</a></li>
	<li><a target="_blank" href="http://matthew.wagerfield.com/parallax/">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-12">
		<div id="container" class="container">
			<ul id="scene" class="scene">
				<li class="layer" data-depth="1.00"><img src="/project/lemon/images/plugins/jquery.parallax/layer1.png"></li>
				<li class="layer" data-depth="0.80"><img src="/project/lemon/images/plugins/jquery.parallax/layer2.png"></li>
				<li class="layer" data-depth="0.60"><img src="/project/lemon/images/plugins/jquery.parallax/layer3.png"></li>
				<li class="layer" data-depth="0.40"><img src="/project/lemon/images/plugins/jquery.parallax/layer4.png"></li>
				<li class="layer" data-depth="0.20"><img src="/project/lemon/images/plugins/jquery.parallax/layer5.png"></li>
				<li class="layer" data-depth="0.00"><img src="/project/lemon/images/plugins/jquery.parallax/layer6.png"></li>
			</ul>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
			&lt;div id=&quot;container&quot; class=&quot;container&quot;&gt;
	&lt;ul id=&quot;scene&quot; class=&quot;scene&quot;&gt;
		&lt;li class=&quot;layer&quot; data-depth=&quot;1.00&quot;&gt;&lt;img src=&quot;/project/lemon/images/plugins/jquery.parallax/layer1.png&quot;&gt;&lt;/li&gt;
		&lt;li class=&quot;layer&quot; data-depth=&quot;0.80&quot;&gt;&lt;img src=&quot;/project/lemon/images/plugins/jquery.parallax/layer2.png&quot;&gt;&lt;/li&gt;
		&lt;li class=&quot;layer&quot; data-depth=&quot;0.60&quot;&gt;&lt;img src=&quot;/project/lemon/images/plugins/jquery.parallax/layer3.png&quot;&gt;&lt;/li&gt;
		&lt;li class=&quot;layer&quot; data-depth=&quot;0.40&quot;&gt;&lt;img src=&quot;/project/lemon/images/plugins/jquery.parallax/layer4.png&quot;&gt;&lt;/li&gt;
		&lt;li class=&quot;layer&quot; data-depth=&quot;0.20&quot;&gt;&lt;img src=&quot;/project/lemon/images/plugins/jquery.parallax/layer5.png&quot;&gt;&lt;/li&gt;
		&lt;li class=&quot;layer&quot; data-depth=&quot;0.00&quot;&gt;&lt;img src=&quot;/project/lemon/images/plugins/jquery.parallax/layer6.png&quot;&gt;&lt;/li&gt;
	&lt;/ul&gt;
&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.parallax'], function ($) {
	$(function(){
		$('#scene').parallax();
	})

});
</script>
