<p class="alert alert-info" id="introduce">
    wysihtml5 是一个开源的基于 HTML 技术的富文本编辑器，可生成完全兼容 HTML5 标签的文本。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/xing/wysihtml5">GITHUB</a></li>
    <li><a target="_blank" href="http://xing.github.io/wysihtml5/examples/simple.html">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <form><textarea id="wysihtml5-textarea" placeholder="Enter your text ..." autofocus></textarea></form>
        {{--下面创建工具类按钮--}}
        <div id="wysihtml5-toolbar" style="display: none;">
            <a data-wysihtml5-command="bold">bold</a>
            <a data-wysihtml5-command="italic">italic</a>

            <!-- Some wysihtml5 commands require extra parameters -->
            <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red">red</a>
            <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green">green</a>
            <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue">blue</a>

            <!-- Some wysihtml5 commands like 'createLink' require extra paramaters specified by the user (eg. href) -->
            <a data-wysihtml5-command="createLink">insert link</a>
            <div data-wysihtml5-dialog="createLink" style="display: none;">
                <label>
                    Link:
                    <input data-wysihtml5-dialog-field="href" value="http://" class="text">
                </label>
                <a data-wysihtml5-dialog-action="save">OK</a> <a data-wysihtml5-dialog-action="cancel">Cancel</a>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
             &lt;form&gt;&lt;textarea id="wysihtml5-textarea" placeholder="Enter your text ..." autofocus&gt;&lt;/textarea&gt;&lt;/form&gt;
    {{--下面创建工具类按钮--}}
    &lt;div id="wysihtml5-toolbar" style="display: none;"&gt;
    &lt;a data-wysihtml5-command="bold"&gt;bold&lt;/a&gt;
    &lt;a data-wysihtml5-command="italic"&gt;italic&lt;/a&gt;

        &lt;!-- Some wysihtml5 commands require extra parameters --&gt;
    &lt;a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red"&gt;red&lt;/a&gt;
    &lt;a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green"&gt;green&lt;/a&gt;
    &lt;a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue"&gt;blue&lt;/a&gt;

        &lt;!-- Some wysihtml5 commands like 'createLink' require extra paramaters specified by the user (eg. href) --&gt;
    &lt;a data-wysihtml5-command="createLink"&gt;insert link&lt;/a&gt;
    &lt;div data-wysihtml5-dialog="createLink" style="display: none;"&gt;
        &lt;label&gt;
            Link:
            &lt;input data-wysihtml5-dialog-field="href" value="http://" class="text"&gt;
        &lt;/label&gt;
        &lt;a data-wysihtml5-dialog-action="save"&gt;OK&lt;/a&gt; &lt;a data-wysihtml5-dialog-action="cancel"&gt;Cancel&lt;/a&gt;
    &lt;/div&gt;
&lt;/div&gt;
		</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['wysihtml5'], function (wysihtml5) {
        var editor = new wysihtml5.Editor("wysihtml5-textarea", { // id of textarea element
            toolbar:      "wysihtml5-toolbar", // id of toolbar element
            parserRules:  wysihtml5ParserRules // defined in parser rules set
        });
    });
</script>
