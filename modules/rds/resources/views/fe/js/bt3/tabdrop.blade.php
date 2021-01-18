<p class="alert alert-info" id="introduce">
    Bootstrap-tabdrop插件能够自动排列Tab的选项，如果你的选项比较多的时候，这个插件能够自动将多余的Tab标签作为下拉菜单展示。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/jmschabdach/bootstrap-tabdrop">GITHUB</a></li>
    <li><a target="_blank" href="https://itsjavi.com/bootstrap-colorpicker/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div class="tabbable tabs-below">
            <div class="tab-content">
                <div class="tab-pane active" id="btab1">
                    <p>I'm in Section 1.</p>
                </div>
                <div class="tab-pane" id="btab2">
                    <p>Howdy, I'm in Section 2.</p>
                </div>
                <div class="tab-pane" id="btab3">
                    <p>Howdy, I'm in Section 3.</p>
                </div>
                <div class="tab-pane" id="btab4">
                    <p>Howdy, I'm in Section 4.</p>
                </div>
                <div class="tab-pane" id="btab5">
                    <p>Howdy, I'm in Section 5.</p>
                </div>
                <div class="tab-pane" id="btab6">
                    <p>Howdy, I'm in Section 6.</p>
                </div>
                <div class="tab-pane" id="btab7">
                    <p>Howdy, I'm in Section 7.</p>
                </div>
                <div class="tab-pane" id="btab8">
                    <p>Howdy, I'm in Section 8.</p>
                </div>
                <div class="tab-pane" id="btab9">
                    <p>Howdy, I'm in Section 9.</p>
                </div>
            </div>
            <ul class="nav nav-tabs"><li class="dropdown pull-right tabdrop dropup"><a class="dropdown-toggle" data-toggle="dropdown" href="#">More options <b class="caret"></b></a><ul class="dropdown-menu"><li><a href="#btab9" data-toggle="tab">Section 9</a></li></ul></li>
                <li class="active"><a href="#tab1" data-toggle="tab">Section 1</a></li>
                <li><a href="#btab2" data-toggle="tab">Section 2</a></li>
                <li><a href="#btab3" data-toggle="tab">Section 3</a></li>
                <li><a href="#btab4" data-toggle="tab">Section 4</a></li>
                <li><a href="#btab5" data-toggle="tab">Section 5</a></li>
                <li><a href="#btab6" data-toggle="tab">Section 6</a></li>
                <li><a href="#btab7" data-toggle="tab">Section 7</a></li>
                <li><a href="#btab8" data-toggle="tab">Section 8</a></li>
            </ul>
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;div class="tabbable tabs-below"&gt;
    &lt;div class="tab-content"&gt;
        &lt;div class="tab-pane active" id="btab1"&gt;
            &lt;p&gt;I'm in Section 1.&lt;/p&gt;
        &lt;/div&gt;
        &lt;div class="tab-pane" id="btab2"&gt;
            &lt;p&gt;Howdy, I'm in Section 2.&lt;/p&gt;
        &lt;/div&gt;
        &lt;div class="tab-pane" id="btab3"&gt;
            &lt;p&gt;Howdy, I'm in Section 3.&lt;/p&gt;
        &lt;/div&gt;
        &lt;div class="tab-pane" id="btab4"&gt;
            &lt;p&gt;Howdy, I'm in Section 4.&lt;/p&gt;
        &lt;/div&gt;
        &lt;div class="tab-pane" id="btab5"&gt;
            &lt;p&gt;Howdy, I'm in Section 5.&lt;/p&gt;
        &lt;/div&gt;
        &lt;div class="tab-pane" id="btab6"&gt;
            &lt;p&gt;Howdy, I'm in Section 6.&lt;/p&gt;
        &lt;/div&gt;
        &lt;div class="tab-pane" id="btab7"&gt;
            &lt;p&gt;Howdy, I'm in Section 7.&lt;/p&gt;
        &lt;/div&gt;
        &lt;div class="tab-pane" id="btab8"&gt;
            &lt;p&gt;Howdy, I'm in Section 8.&lt;/p&gt;
        &lt;/div&gt;
        &lt;div class="tab-pane" id="btab9"&gt;
            &lt;p&gt;Howdy, I'm in Section 9.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;ul class="nav nav-tabs"&gt;&lt;li class="dropdown pull-right tabdrop dropup"&gt;&lt;a class="dropdown-toggle" data-toggle="dropdown" href="#"&gt;More options &lt;b class="caret"&gt;&lt;/b&gt;&lt;/a&gt;&lt;ul class="dropdown-menu"&gt;&lt;li&gt;&lt;a href="#btab9" data-toggle="tab"&gt;Section 9&lt;/a&gt;&lt;/li&gt;&lt;/ul&gt;&lt;/li&gt;
        &lt;li class="active"&gt;&lt;a href="#tab1" data-toggle="tab"&gt;Section 1&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href="#btab2" data-toggle="tab"&gt;Section 2&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href="#btab3" data-toggle="tab"&gt;Section 3&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href="#btab4" data-toggle="tab"&gt;Section 4&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href="#btab5" data-toggle="tab"&gt;Section 5&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href="#btab6" data-toggle="tab"&gt;Section 6&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href="#btab7" data-toggle="tab"&gt;Section 7&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href="#btab8" data-toggle="tab"&gt;Section 8&lt;/a&gt;&lt;/li&gt;
    &lt;/ul&gt;
&lt;/div&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.tabdrop'], function ($) {
        $('.nav-pills, .nav-tabs').tabdrop()
    });
</script>
