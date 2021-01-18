<p class="alert alert-info" id="introduce">
    Bootstrap Confirmation 是个Bootstrap 的 jQuery 插件，利用 Bootstrap 的 popovers 作为确认对话框，非常简单和易用。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/ethaizone/Bootstrap-Confirmation">GITHUB</a></li>
    <li><a target="_blank" href="http://ethaizone.github.io/Bootstrap-Confirmation/#">docs</a></li>
</ul>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <a href="http://baidu.com" class="btn" data-toggle="confirmation">Confirmation</a>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;a href="http://baidu.com" class="btn" data-toggle="confirmation"&gt;Confirmation&lt;/a&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.confirmation'], function ($) {
        $('[data-toggle="confirmation"]').confirmation();
    });
</script>
