<p class="alert alert-info" id="introduce">
    允许输入用户字符数.它可以让你显示字符用户插入的最大长度。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/mimo84/bootstrap-maxlength">GITHUB</a></li>
    <li><a target="_blank" href="http://mimo84.github.io/bootstrap-maxlength/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-12">
        <input id="cp1" type="text" class="form-control" maxlength=20 />
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;input id="cp1" type="text" class="form-control" maxlength=20 /&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.maxlength'], function ($) {
        $('.form-control').maxlength();
    });
</script>
