<p class="alert alert-info" id="introduce">
    Bootstrap Dropdown Hover 是一个简单的插件，它能通过鼠标移入事件打开 Bootstrap 下拉菜单。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/istvan-ujjmeszaros/bootstrap-dropdown-hover">GITHUB</a></li>
    <li><a target="_blank" href="http://www.virtuosoft.eu/code/bootstrap-dropdown-hover/">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                Dropdown
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
            </ul>
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;div class="dropdown"&gt;
    &lt;button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"&gt;
        Dropdown
        &lt;span class="caret"&gt;&lt;/span&gt;
    &lt;/button&gt;
    &lt;ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1"&gt;
        &lt;li role="presentation"&gt;&lt;a role="menuitem" tabindex="-1" href="#"&gt;Action&lt;/a&gt;&lt;/li&gt;
        &lt;li role="presentation"&gt;&lt;a role="menuitem" tabindex="-1" href="#"&gt;Another action&lt;/a&gt;&lt;/li&gt;
        &lt;li role="presentation"&gt;&lt;a role="menuitem" tabindex="-1" href="#"&gt;Something else here&lt;/a&gt;&lt;/li&gt;
        &lt;li role="presentation"&gt;&lt;a role="menuitem" tabindex="-1" href="#"&gt;Separated link&lt;/a&gt;&lt;/li&gt;
    &lt;/ul&gt;
&lt;/div&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.hover-dropdown'], function ($) {
        $('[data-toggle="dropdown"]').dropdownHover();
    });
</script>
