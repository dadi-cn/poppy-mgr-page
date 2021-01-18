<p class="alert alert-info" id="introduce">
    用于在网页的固定位置弹出消息框，轻量级的jQuery插件，支持多种状态的消息类型。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/ifightcrime/bootstrap-growl">GITHUB</a></li>
    <li><a target="_blank" href="http://ifightcrime.github.io/bootstrap-growl/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        演示自动播放
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html"></pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.growl'], function ($) {
        $(function() {
            $.bootstrapGrowl("This is a test.");

            setTimeout(function() {
                $.bootstrapGrowl("This is another test.", { type: 'success' });
            }, 1000);

            setTimeout(function() {
                $.bootstrapGrowl("Danger, Danger!", {
                    type: 'danger',
                    align: 'center',
                    width: 'auto',
                    allow_dismiss: false
                });
            }, 2000);

            setTimeout(function() {
                $.bootstrapGrowl("Danger, Danger!", {
                    type: 'info',
                    align: 'left',
                    stackup_spacing: 30
                });
            }, 3000);
        });

    });
</script>
