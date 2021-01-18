<p class="alert alert-info" id="introduce">
	用于通知用户，他们的会话即将过期。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/ehynds/jquery-idle-timeout">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-6">
		<div id="idletimeout">
			<p>保持键盘和鼠标不动5秒。</p>
			你将会在 <span><!-- countdown place holder --></span>&nbsp;秒后退出登录！
			<a id="idletimeout-resume" href="#">点此继续使用页面</a>.
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div id="idletimeout"&gt;
	&lt;p&gt;保持键盘和鼠标不动5秒。&lt;/p&gt;
	你将会在 &lt;span&gt;&lt;!-- countdown place holder --&gt;&lt;/span&gt;&nbsp;秒后退出登录！
	&lt;a id="idletimeout-resume" href="#"&gt;点此继续使用页面&lt;/a&gt;.
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
	require(['jquery','jquery.idle-timeout'], function ($) {
		$.idleTimeout('#idletimeout', '#idletimeout a', {
			idleAfter: 5,
			pollingInterval: 2,
			keepAliveURL: 'index',
			serverResponseEquals: 'OK',
			onTimeout: function(){
				$(this).slideUp();
				window.location = "timeout.htm";
			},
			onIdle: function(){
				$(this).slideDown(); // show the warning bar
			},
			onCountdown: function( counter ){
				$(this).find("span").html( counter ); // update the counter
			},
			onResume: function(){
				$(this).slideUp(); // hide the warning bar
			}
		});
	});
</script>