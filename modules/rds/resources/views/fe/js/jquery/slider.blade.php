<p class="alert alert-info" id="introduce">
    Slider 是一个炫酷的轮播图插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/jssor/slider">GITHUB</a></li>
    <li><a target="_blank" href="http://www.jssor.com/development/index.html">文档</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-8">
        <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 300px;">
            <!-- Slides Container -->
            <div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 600px; height: 300px;">
                <div><img u="image" src="{!! fake_thumb(940,528) !!}" /></div>
                <div><img u="image" src="{!! fake_thumb(940,528) !!}" /></div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
	&lt;div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 300px;"&gt;
    &lt;!-- Slides Container --&gt;
    &lt;div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 600px; height: 300px;"&gt;
        &lt;div&gt;&lt;img u="image" src="{!! fake_thumb(940,528) !!}" /&gt;&lt;/div&gt;
        &lt;div&gt;&lt;img u="image" src="{!! fake_thumb(940,528) !!}" /&gt;&lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery', 'jquery.slider'], function ($) {
        var options = { $AutoPlay: true };
        var jssor_slider1 = new $JssorSlider$('slider1_container', options);
    });
</script>
