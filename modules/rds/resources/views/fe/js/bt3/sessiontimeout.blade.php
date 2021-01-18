<p class="alert alert-info" id="introduce">
    在设置的时间后，向用户显示一个对话框，可以选择立即注销或保持连接。 如果选择现在注销，则页面将重定向到注销URL。 如果选择保持连接，则通过AJAX请求保持活动的URL。 如果在另一设定时间后未选择任何选项，页面将自动重定向到超时URL。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/maxfierke/jquery-sessionTimeout-bootstrap">GITHUB</a></li>
    <li><a target="_blank" href="https://itsjavi.com/bootstrap-colorpicker/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <p>弹窗将在鼠标无变化5秒后弹出,选择是够注销页面跳至主页，5秒后无反应强制跳至主页</p>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;p&gt;弹窗将在鼠标无变化5秒后弹出,选择是够注销页面跳至主页，5秒后无反应强制跳至主页&lt;/p&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['global','jquery','bt3.sessiontimeout'], function (lemon,$) {
        var local_url = window.location;
        $.sessionTimeout({
            message: '5秒后无反应注销此页并返回主页',
            redirUrl: lemon.url_site,
            warnAfter: 5000,
            redirAfter: 10000
        });
    });
</script>
