<p class="alert alert-info" id="introduce">
    基于 Bootstrap 实现的一个右键上下文菜单
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/sydcanem/bootstrap-contextmenu">GITHUB</a></li>
    <li><a target="_blank" href="http://sydcanem.com/bootstrap-contextmenu/">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div id="context" data-toggle="context" data-target="#context-menu" style="height:300px;width:650px;border:1px solid #ddd">
            在此区域点击右键
        </div>
        <div id="context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a tabindex="-1">Action</a></li>
                <li><a tabindex="-1">Another action</a></li>
                <li><a tabindex="-1">Something else here</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1">Separated link</a></li>
            </ul>
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;div id="context" data-toggle="context" data-target="#context-menu" style="height:300px;width:650px;border:1px solid #ddd"&gt;
    在此区域点击右键
&lt;/div&gt;
&lt;div id="context-menu"&gt;
    &lt;ul class="dropdown-menu" role="menu"&gt;
        &lt;li&gt;&lt;a tabindex="-1"&gt;Action&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a tabindex="-1"&gt;Another action&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a tabindex="-1"&gt;Something else here&lt;/a&gt;&lt;/li&gt;
        &lt;li class="divider"&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a tabindex="-1"&gt;Separated link&lt;/a&gt;&lt;/li&gt;
    &lt;/ul&gt;
&lt;/div&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.contextmenu'], function ($) {
        $('.context').contextmenu({
            target:'#context-menu',
            before: function (e) {
                // execute code before context menu if shown
            },
            onItem: function(context,e) {
                // execute on menu item selection
            }
        })
    });
</script>
