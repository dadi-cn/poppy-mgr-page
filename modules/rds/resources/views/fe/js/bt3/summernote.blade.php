<p class="alert alert-info" id="introduce">
    Summernote 是一个简单，灵活，所见即所得（WYSIWYG）的编辑器
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/summernote/summernote/">GITHUB</a></li>
    <li><a target="_blank" href="http://summernote.org/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div id="summernote">Hello Summernote</div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;div id="summernote"&gt;Hello Summernote&lt;/div&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.summernote'], function ($) {
        $('#summernote').summernote();
    });
</script>
