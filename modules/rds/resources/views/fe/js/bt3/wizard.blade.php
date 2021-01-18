<p class="alert alert-info" id="introduce">
    一款基于bootstrap的向导式插件
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/VinceG/twitter-bootstrap-wizard">GITHUB</a></li>
    <li><a target="_blank" href="http://vadimg.com/twitter-bootstrap-wizard-example/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div id="rootwizard">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">
                        <ul>
                            <li><a href="#tab1" data-toggle="tab">First</a></li>
                            <li><a href="#tab2" data-toggle="tab">Second</a></li>
                            <li><a href="#tab3" data-toggle="tab">Third</a></li>
                            <li><a href="#tab4" data-toggle="tab">Forth</a></li>
                            <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
                            <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
                            <li><a href="#tab7" data-toggle="tab">Seventh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane" id="tab1">
                    1
                </div>
                <div class="tab-pane" id="tab2">
                    2
                </div>
                <div class="tab-pane" id="tab3">
                    3
                </div>
                <div class="tab-pane" id="tab4">
                    4
                </div>
                <div class="tab-pane" id="tab5">
                    5
                </div>
                <div class="tab-pane" id="tab6">
                    6
                </div>
                <div class="tab-pane" id="tab7">
                    7
                </div>
                <ul class="pager wizard">
                    <li class="previous first" style="display:none;"><a href="#">First</a></li>
                    <li class="previous"><a href="#">Previous</a></li>
                    <li class="next last" style="display:none;"><a href="#">Last</a></li>
                    <li class="next"><a href="#">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;div id="rootwizard"&gt;
    &lt;div class="navbar"&gt;
        &lt;div class="navbar-inner"&gt;
            &lt;div class="container"&gt;
                &lt;ul&gt;
                    &lt;li&gt;&lt;a href="#tab1" data-toggle="tab"&gt;First&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="#tab2" data-toggle="tab"&gt;Second&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="#tab3" data-toggle="tab"&gt;Third&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="#tab4" data-toggle="tab"&gt;Forth&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="#tab5" data-toggle="tab"&gt;Fifth&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="#tab6" data-toggle="tab"&gt;Sixth&lt;/a&gt;&lt;/li&gt;
                    &lt;li&gt;&lt;a href="#tab7" data-toggle="tab"&gt;Seventh&lt;/a&gt;&lt;/li&gt;
                &lt;/ul&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="tab-content"&gt;
        &lt;div class="tab-pane" id="tab1"&gt;
            1
        &lt;/div&gt;
        &lt;div class="tab-pane" id="tab2"&gt;
            2
        &lt;/div&gt;
        &lt;div class="tab-pane" id="tab3"&gt;
            3
        &lt;/div&gt;
        &lt;div class="tab-pane" id="tab4"&gt;
            4
        &lt;/div&gt;
        &lt;div class="tab-pane" id="tab5"&gt;
            5
        &lt;/div&gt;
        &lt;div class="tab-pane" id="tab6"&gt;
            6
        &lt;/div&gt;
        &lt;div class="tab-pane" id="tab7"&gt;
            7
        &lt;/div&gt;
        &lt;ul class="pager wizard"&gt;
            &lt;li class="previous first" style="display:none;"&gt;&lt;a href="#"&gt;First&lt;/a&gt;&lt;/li&gt;
            &lt;li class="previous"&gt;&lt;a href="#"&gt;Previous&lt;/a&gt;&lt;/li&gt;
            &lt;li class="next last" style="display:none;"&gt;&lt;a href="#"&gt;Last&lt;/a&gt;&lt;/li&gt;
            &lt;li class="next"&gt;&lt;a href="#"&gt;Next&lt;/a&gt;&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;
&lt;/div&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.wizard'], function ($) {
        $('#rootwizard').bootstrapWizard();
    });
</script>
