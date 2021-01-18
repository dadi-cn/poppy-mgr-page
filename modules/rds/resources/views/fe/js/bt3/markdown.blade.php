<p class="alert alert-info" id="introduce">
    基于bootstrap3的颜色选择器插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/toopay/bootstrap-markdown">GITHUB</a></li>
    <li><a target="_blank" href="http://www.codingdrama.com/bootstrap-markdown/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-12">
        <textarea name="content" data-provide="markdown" id="some-textarea" rows="10"></textarea>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;textarea name="content" data-provide="markdown" id="some-textarea" rows="10"&gt;&lt;/textarea&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.markdown'], function ($) {
        $("#some-textarea").markdown({autofocus:false,savable:false})
    });
</script>
