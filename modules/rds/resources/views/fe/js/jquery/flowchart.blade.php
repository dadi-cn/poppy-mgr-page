<p class="alert alert-info" id="introduce">
    jQuery流程图插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/sdrdis/jquery.flowchart">GITHUB</a></li>
    <li><a target="_blank" href="http://sebastien.drouyer.com/jquery.flowchart-demo/">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <div id="example" style="height:200px;"></div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;div id="example" style="height:200px;"&gt;&lt;/div&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery', 'jquery.ui','jquery.flowchart'], function ($) {
        var data = {
            operators: {
                operator: {
                    top: 20,
                    left: 20,
                    properties: {
                        title: 'Operator',
                        inputs: {
                            input_1: {
                                label: 'Input 1',
                            },
                            input_2: {
                                label: 'Input 2',
                            }
                        },
                        outputs: {
                            output_1: {
                                label: 'Output 1',
                            },
                            output_2: {
                                label: 'Output 2',
                            },
                            output_3: {
                                label: 'Output 3',
                            }
                        }
                    }
                }
            }
        };

        // Apply the plugin on a standard, empty div...
        $('#example').flowchart({
            data: data
        });
    });
</script>
