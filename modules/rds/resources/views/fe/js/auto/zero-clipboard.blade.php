<style type="text/css">
    .clip_button {
        text-align: center;
        border: 1px solid black;
        background-color: #ccc;
        margin: 10px;
        padding: 10px;
    }
    .clip_button.zeroclipboard-is-hover { background-color: #eee; }
    .clip_button.zeroclipboard-is-active { background-color: #aaa; }
</style>
<p class="alert alert-info" id="introduce">
    复制剪贴板功能插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/zeroclipboard/zeroclipboard">GITHUB</a></li>
    <li><a target="_blank" href="http://zeroclipboard.org/">官网</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <button id="copy-button" data-clipboard-text="Copy Me!" title="Click to copy me.">Copy to Clipboard</button>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
		&lt;button id="copy-button" data-clipboard-text="Copy Me!" title="Click to copy me."&gt;Copy to Clipboard&lt;/button&gt;
		</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['zero-clipboard'], function (ZeroClipboard) {
        ZeroClipboard.config( { swfPath: "../assets/js/libs/zero-clipboard/2.3.0-bata1/ZeroClipboard.swf" } );
        var client = new ZeroClipboard( document.getElementById("copy-button") );
        client.on( "ready", function( readyEvent ) {
            client.on( "aftercopy", function( event ) {
                alert("Copied text to clipboard: " + event.data["text/plain"] );
            });
        });
    });
</script>
