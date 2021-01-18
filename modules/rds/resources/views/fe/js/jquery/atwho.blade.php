<p class="alert alert-info" id="introduce">
    输入框参数提示插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/ichord/At.js">GITHUB</a></li>
    <li><a target="_blank" href="https://github.com/ichord/At.js/wiki">DOC</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div>
            <textarea name="demo" id="demo" cols="30" rows="1" placeholder="输入@查看效果"></textarea>
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;textarea name="demo" id="demo" cols="30" rows="1" placeholder="输入@查看效果"&gt;&lt;/textarea&gt;
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery', 'jquery.atwho'], function ($) {
        data = ['tom','john'];
        $('textarea').atwho({at:"@", 'data':data});
    });
</script>
