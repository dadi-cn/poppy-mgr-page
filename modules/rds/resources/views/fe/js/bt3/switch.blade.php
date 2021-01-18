<p class="alert alert-info" id="introduce">
    这是一个针对Bootstrap实现的开关(switch)控件。能够支持尺寸、颜色等属性的自定义。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/nostalgiaz/bootstrap-switch">GITHUB</a></li>
    <li><a target="_blank" href="hhttp://www.bootcss.com/p/bootstrap-switch/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <input type="checkbox" name="my-checkbox" checked>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;input type="checkbox" name="my-checkbox" checked&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.switch'], function ($) {
        $("[name='my-checkbox']").bootstrapSwitch();
    });
</script>
