<p class="alert alert-info" id="introduce">
    这里填写简单的源码示例
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/jquery/jquery-mousewheel">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div id="my_elem" style="background-color: #000;padding: 5px;width: 100px;height: 100px;color:#fff">此区域滚动滚轮</div>
        <div id="logger"></div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;div id="my_elem" style="background-color: #000;padding: 5px;width: 100px;height: 100px;color:#fff"&gt;此区域滚动滚轮&lt;/div&gt;
&lt;div id="logger"&gt;&lt;/div&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery', 'jquery.mousewheel'], function ($) {
        $('#my_elem').bind('mousewheel', function(event, delta, deltaX, deltaY) {
            var msg = delta + ',' + deltaX + ',' + deltaY + '<br/>'
            $('#logger').append('<p>' + msg + '<\/p>')[0].scrollTop = 999999;
        });
    });
</script>
