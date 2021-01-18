<p class="alert alert-info" id="introduce">
    基于bootstrap3的颜色选择器插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/Eonasdan/bootstrap-datetimepicker">GITHUB</a></li>
    <li><a target="_blank" href="https://bootstrap-datepicker.readthedocs.io/en/stable/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-12">
        <input type="text" class="form-control" id="datetimepicker1" />
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;input type="text" class="form-control" id="datetimepicker1" /&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.datetimepicker'], function ($) {
        $('#datetimepicker1').datetimepicker();
    });
</script>
