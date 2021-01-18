<p class="alert alert-info" id="introduce">
    Smooth Scroll是一个平滑滚动插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/cferdinandi/smooth-scroll">GITHUB</a></li>
    <li><a target="_blank" href="http://cferdinandi.github.io/smooth-scroll/#bazinga">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div class="social-share" data-sites="weibo,qq,qzone,tencent,wechat"></div>
        <div class="social-share" data-initialized="true">
            <a href="#" class="social-share-icon icon-weibo"></a>
            <a href="#" class="social-share-icon icon-qq"></a>
            <a href="#" class="social-share-icon icon-qzone"></a>
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;div class="social-share" data-sites="weibo,qq,qzone,tencent,wechat"&gt;&lt;/div&gt;
		</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','jquery.share'], function ($) {
        $('#share-1').share();
        $('#share-2').share({sites: ['qzone', 'qq', 'weibo','wechat']});
        $('#share-3').share();
        $('#share-4').share();
    });
</script>