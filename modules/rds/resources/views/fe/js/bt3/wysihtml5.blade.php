<p class="alert alert-info" id="introduce">
    bootstrap-wysihtml5 是一个基于 Bootstrap 框架实现的所见即所得的 HTML 编辑器。相当于是集成了 Bootstrap 和 wysihtml5 。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/jhollingworth/bootstrap-wysihtml5">GITHUB</a></li>
    <li><a target="_blank" href="http://jhollingworth.github.io/bootstrap-wysihtml5/">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-12">
        <textarea class="textarea" placeholder="Enter text ..." style="width: 810px; height: 200px"></textarea>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;textarea class="textarea" placeholder="Enter text ..." style="width: 810px; height: 200px"&gt;&lt;/textarea&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.wysihtml5'], function ($) {
        $('.textarea').wysihtml5({
            stylesheets:[]
        });
    });
</script>
