<p class="alert alert-info" id="introduce">
    基于bootstrap3的日期分页插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/jonmiles/bootstrap-datepaginator">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div id="paginator">444</div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;div id="paginator"&gt;444&lt;/div&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','moment','bt3.datepicker','bt3.datepaginator'], function ($,moment) {
        var options = {
            selectedDate: '2013-01-01',
            selectedDateFormat:  'YYYY-MM-DD'
        };
        $('#paginator').datepaginator(options);
    });
</script>
