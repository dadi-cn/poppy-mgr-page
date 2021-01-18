<p class="alert alert-info" id="introduce">
    x-editable 允许在页面创建可编辑元素，包括 popup 和 inline 模式。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/vitalets/x-editable">GITHUB</a></li>
    <li><a target="_blank" href="http://vitalets.github.io/x-editable/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <a href="#" id="username">superuser</a>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;a href="#" id="username"&gt;superuser&lt;/a&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.x-editable'], function ($) {
        $('#username').editable();
    });
</script>
