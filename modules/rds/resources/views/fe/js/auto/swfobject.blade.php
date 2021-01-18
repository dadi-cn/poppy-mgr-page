<p class="alert alert-info" id="introduce">
	SWFObject是一个用于在HTML中方便插入Adobe Flash媒体资源（*.swf文件）的独立、敏捷的JavaScript模块。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/swfobject/swfobject">GITHUB</a></li>
	<li><a target="_blank" href="http://blog.deconcept.com/swfobject/">官网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="780" height="420">
        <param name="movie" value="myContent.swf" />
            <!--[if !IE]>-->
            <object type="application/x-shockwave-flash" data="myContent.swf" width="780" height="420">
                <!--<![endif]-->
                <p>Alternative content</p>
                <!--[if !IE]>-->
            </object>
            <!--<![endif]-->
        </object>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div id="flashcontent"&gt;
	This text is replaced by the Flash movie.
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['swfobject','global'], function (SWFObject,lemon) {
//    var movieswf = lemon.utl_js + '/wsfobject/2.3.0/expressinstall.swf';
//    var so = new SWFObject(movieswf, "mymovie", "400", "200", "8", "#336699");
//    so.write("flashcontent");
});
</script>
