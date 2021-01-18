<p class="alert alert-info" id="introduce">基于html5的浏览器实现复制指定内容到剪贴板功能的js插件</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/zenorocha/clipboard.js/">GITHUB</a></li>
    <li><a target="_blank" href="https://clipboardjs.com/">doc</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <input type="text" value="要复制到剪贴板的内容" id="copy_data"><button class="copy">复制</button>
        <br>
        <br>
        <input type="text" placeholder="可将内容粘贴在此处">
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;textarea name="autosize" class="J_autosize"&gt;&lt;/textarea&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery', 'clipboard'], function ($,Clipboard) {
        var clipboard =new Clipboard('.copy', {
            text: function(trigger) {
                var text = $(trigger).siblings('#copy_data').val();
                return text
            }
        });
        clipboard.on('success', function(e) {
            alert('复制成功');
        });
        clipboard.on('error', function(e) {
            console.error('Action:', e.action);
            console.error('Trigger:', e.trigger);
            alert('复制出错');
        });
    });
</script>
