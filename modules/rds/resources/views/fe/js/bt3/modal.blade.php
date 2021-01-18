<p class="alert alert-info" id="introduce">
    模态框（Modal）是覆盖在父窗体上的子窗体。通常，目的是显示来自一个单独的源的内容，可以在不离开父窗体的情况下有一些互动。子窗体可提供信息、交互等。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/jschr/bootstrap-modal/">GITHUB</a></li>
    <li><a target="_blank" href="http://jschr.github.io/bootstrap-modal/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            开始演示模态框
        </button>
        <!-- 模态框（Modal） -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            模态框（Modal）标题
                        </h4>
                    </div>
                    <div class="modal-body">
                        在这里添加一些文本
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                        </button>
                        <button type="button" class="btn btn-primary">
                            提交更改
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"&lt;
    开始演示模态框
&lt;/button&lt;
&lt;div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"&lt;
    &lt;div class="modal-dialog"&lt;
        &lt;div class="modal-content"&lt;
            &lt;div class="modal-header"&lt;
                &lt;button type="button" class="close" data-dismiss="modal" aria-hidden="true"&lt;
                    &times;
                &lt;/button&lt;
                &lt;h4 class="modal-title" id="myModalLabel"&lt;
                    模态框（Modal）标题
                &lt;/h4&lt;
            &lt;/div&lt;
            &lt;div class="modal-body"&lt;
                在这里添加一些文本
            &lt;/div&lt;
            &lt;div class="modal-footer"&lt;
                &lt;button type="button" class="btn btn-default" data-dismiss="modal"&lt;关闭
                &lt;/button&lt;
                &lt;button type="button" class="btn btn-primary"&lt;
                    提交更改
                &lt;/button&lt;
            &lt;/div&lt;
        &lt;/div&lt;
    &lt;/div&lt;
&lt;/div&lt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.modal'], function ($) {
//        $('body').modalmanager('loading');
    });
</script>
