<p class="alert alert-info" id="introduce">
    基于bootstrap3的时间选择插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/jdewit/bootstrap-timepicker">GITHUB</a></li>
    <li><a target="_blank" href="http://jdewit.github.io/bootstrap-timepicker/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div class="input-group bootstrap-timepicker timepicker">
            <input id="timepicker1" type="text" class="form-control input-small">
            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;div class="input-group bootstrap-timepicker timepicker"&gt;
    &lt;input id="timepicker1" type="text" class="form-control input-small"&gt;
    &lt;span class="input-group-addon"&gt;&lt;i class="glyphicon glyphicon-time"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/div&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.timepicker'], function ($) {
        $('#timepicker1').timepicker();
    });
</script>
