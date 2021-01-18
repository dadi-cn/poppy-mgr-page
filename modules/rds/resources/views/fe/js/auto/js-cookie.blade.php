<p class="alert alert-info" id="introduce">
    一个小的客户端JavaScript库，轻量级cookie管理插件。更易缓存cookie的值,设置cookie过期时间，域安全性，跨浏览器支持（支持Chrome、Firefox 3+、Safari 4+、Opera 10+、Internet Explorer 6+）
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/js-cookie/js-cookie">Github</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div id="cookie_id"></div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;div id="cookie_id"&gt;&lt;/div&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['js-cookie'], function (cookie) {
        //存入cookie
       cookie.set('key','value');
        var div = document.getElementById('cookie_id');
        //取出cookie
        div.innerHTML = cookie.get('key');
    })
</script>
