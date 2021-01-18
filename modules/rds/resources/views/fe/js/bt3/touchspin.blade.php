<p class="alert alert-info" id="introduce">
    基于bootstrap的数值调整控件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/istvan-ujjmeszaros/bootstrap-touchspin">GITHUB</a></li>
    <li><a target="_blank" href="http://www.virtuosoft.eu/code/bootstrap-touchspin/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <input id="demo1" type="text" value="55" name="demo1">
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;input id="demo1" type="text" value="55" name="demo1"&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.touchspin'], function ($) {
        $("input[name='demo1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
    });
</script>
