<p class="alert alert-info" id="introduce">
    Bootstrap Select 是使用按钮下拉的 Bootstrap 风格的自定义的选项和多选插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/silviomoreto/bootstrap-select">GITHUB</a></li>
    <li><a target="_blank" href="http://silviomoreto.github.io/bootstrap-select/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <select class="selectpicker">
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Relish</option>
        </select>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;select class="selectpicker"&gt;
    &lt;option&gt;Mustard&lt;/option&gt;
    &lt;option&gt;Ketchup&lt;/option&gt;
    &lt;option&gt;Relish&lt;/option&gt;
&lt;/select&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.select'], function ($) {
        $('.selectpicker').selectpicker({
            style: 'btn-info',
            size: 4
        });
    });
</script>
