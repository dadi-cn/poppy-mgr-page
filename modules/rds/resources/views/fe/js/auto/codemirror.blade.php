<p class="alert alert-info" id="introduce">CodeMirror 是一款“Online Source Editor”，基于Javascript，短小精悍，实时在线代码高亮显示，他不是某个富文本编辑器的附属产品，他是许多大名鼎鼎的在线代码编辑器的基础库。</p>
<hr>
<hr>
<div class="row">
    <div class="col-md-12">
        <textarea id="editor" name="editor"></textarea>
        <hr>
        <pre id="J_html">&lt;textarea id="editor" name="editor"&gt;&lt;/textarea&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['codemirror'], function (codemirror) {
        var myTextarea = document.getElementById('editor');
        var CodeMirrorEditor = codemirror.fromTextArea(myTextarea, {
            mode: "text/javascript",
            lineNumbers: true   //参数显示行号
        });
    });
</script>
