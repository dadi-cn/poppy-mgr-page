<p class="alert alert-info" id="introduce">
    jQuery插件显示文本框中的位置。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/ichord/Caret.js">GITHUB</a></li>
    <li><a target="_blank" href="http://ichord.github.io/Caret.js/">DEMO</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div id="show">输入框的偏移<span></span></div>
        <textarea name="demo" id="demo" cols="30" rows="1"></textarea>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;div id="show"&gt;输入框的偏移&lt;span&gt;&lt;/span&gt;&lt;/div&gt;
&lt;textarea name="demo" id="demo" cols="30" rows="1"&gt;&lt;/textarea&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery', 'jquery.caret'], function ($) {
        var pos = $('#demo').caret('position');
        $('#show span').html('左边距:' + pos.left + ',' + '上边距:' + pos.top + ',' + '高度:' + pos.height  )
    });
</script>
