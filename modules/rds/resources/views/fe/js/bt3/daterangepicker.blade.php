<p class="alert alert-info" id="introduce">
    基于bootstrap3的日期范围选择插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/dangrossman/bootstrap-daterangepicker/">GITHUB</a></li>
    <li><a target="_blank" href="http://www.daterangepicker.com/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-10">
        <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" style="width:200px;"/>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;input type="text" name="daterange" value="01/01/2015 - 01/31/2015" style="width:200px;"&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.daterangepicker'], function ($) {
        $('input[name="daterange"]').daterangepicker();
    });
</script>
