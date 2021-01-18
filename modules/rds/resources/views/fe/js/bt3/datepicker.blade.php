<p class="alert alert-info" id="introduce">
    基于bootstrap3的颜色选择器插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/uxsolutions/bootstrap-datepicker/blob/master/docs/index.rst">GITHUB</a></li>
    <li><a target="_blank" href="http://bootstrap-datepicker.readthedocs.io/en/latest/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <input type="text" class="datepicker">
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;input type="text" class="datepicker&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.datepicker'], function ($) {
        $('.datepicker').datepicker();
    });
</script>
