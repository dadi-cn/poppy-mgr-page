<p class="alert alert-info" id="introduce">Editor.md 是一个可嵌入的开源 Markdown 在线编辑器组件</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/pandao/editor.md/">Github</a></li>
    <li><a target="_blank" href="http://pandao.github.io/editor.md">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-12">
        <div style="height: 600px">
            <div id="editormd">
                <textarea style="display:none;">### Hello Editor.md !</textarea>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
&lt;div id="editormd"&gt;
    &lt;textarea style="display:none;"&gt;### Hello Editor.md !&lt;/textarea&gt;
&lt;div&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    var deps = [
        "jquery",
        "editormd",
        "global",
        'editormd.link-dialog',
        'editormd.reference-link-dialog',
        'editormd.image-dialog',
        'editormd.code-block-dialog',
        'editormd.table-dialog',
        'editormd.goto-line-dialog',
        'editormd.help-dialog',
        'editormd.html-entities-dialog',
        'editormd.preformatted-text-dialog'
    ];
    require(deps, function ($, editormd, lemon) {
        console.log(editormd);
        editormd("editormd", {
            width   : "90%",
            height  : 640,
            id   : "editormd",
            path : '/assets/js/libs/codemirror/5.16.0/',
            pluginPath : lemon.url_js + '/libs/editormd/1.5.0/plugins/',
            codeFold : true,
            searchReplace : true,
            saveHTMLToTextarea : false,                   // 保存HTML到Textarea
            htmlDecode : "style,script,iframe|on*",       // 开启HTML标签解析，为了安全性，默认不开启
            emoji : false,
            taskList : false,
            tex : false,
            lineNumbers: false,
            tocm : true,         // Using [TOCM]
            autoLoadModules : false,
            previewCodeHighlight : true,
            toolbarIcons : 'simple',
            flowChart : false,
            sequenceDiagram : false,
            imageUpload : true,
            imageFormats : ["jpg", "jpeg", "gif", "png"]
        });
    });
</script>


