<p class="alert alert-info" id="introduce">
    基于bootstrap3的颜色选择器插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/itsjavi/bootstrap-colorpicker">GITHUB</a></li>
    <li><a target="_blank" href="https://itsjavi.com/bootstrap-colorpicker/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <input id="cp1" type="text" class="form-control" value="#5367ce" />
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;input id="cp1" type="text" class="form-control" value="#5367ce" /&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.colorpicker'], function ($) {
        $('#cp1').colorpicker();
    });
</script>
