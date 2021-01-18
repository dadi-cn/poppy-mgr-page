<p class="alert alert-info" id="introduce">
	Gritter 是一个小型的 jQuery 消息通知插件。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/jboesch/Gritter">GITHUB</a></li>
	<li><a target="_blank" href="http://www.flowplayer.org/docs/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.gritter'], function ($) {
	$.gritter.add({
		// (string | mandatory) the heading of the notification
		title: 'This is a sticky notice!',
		// (string | mandatory) the text inside the notification
		text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" style="color:#ccc">magnis dis parturient</a> montes, nascetur ridiculus mus.',
		// (string | optional) the image to display on the left
		sticky: true,
		// (int | optional) the time you want it to be alive for before fading out
		time: '',
		// (string | optional) the class name you want to apply to that specific message
		class_name: 'my-sticky-class'
	});
});
</script>
