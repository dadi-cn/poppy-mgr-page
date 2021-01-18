<p class="alert alert-info" id="introduce">
    将一个&lt;select&gt;中的每一个&lt;optgroup&gt;转变成多级联动的&lt;select&gt;。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/xavierfaucon/bootstrap-selectsplitter">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <select data-selectsplitter-selector>
            <optgroup label="Category 1">
                <option value="1">Choice 1</option>
                <option value="2">Choice 2</option>
                <option value="3">Choice 3</option>
                <option value="4">Choice 4</option>
            </optgroup>
            <optgroup label="Category 2">
                <option value="5">Choice 5</option>
                <option value="6">Choice 6</option>
                <option value="7">Choice 7</option>
                <option value="8">Choice 8</option>
            </optgroup>
            <optgroup label="Category 3">
                <option value="5">Choice 9</option>
                <option value="6">Choice 10</option>
                <option value="7">Choice 11</option>
                <option value="8">Choice 12</option>
            </optgroup>
        </select>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;select data-selectsplitter-selector&gt;
&lt;optgroup label="Category 1"&gt;
    &lt;option value="1"&gt;Choice 1&lt;/option&gt;
    &lt;option value="2"&gt;Choice 2&lt;/option&gt;
    &lt;option value="3"&gt;Choice 3&lt;/option&gt;
    &lt;option value="4"&gt;Choice 4&lt;/option&gt;
&lt;/optgroup&gt;
&lt;optgroup label="Category 2"&gt;
    &lt;option value="5"&gt;Choice 5&lt;/option&gt;
    &lt;option value="6"&gt;Choice 6&lt;/option&gt;
    &lt;option value="7"&gt;Choice 7&lt;/option&gt;
    &lt;option value="8"&gt;Choice 8&lt;/option&gt;
&lt;/optgroup&gt;
&lt;optgroup label="Category 3"&gt;
    &lt;option value="5"&gt;Choice 9&lt;/option&gt;
    &lt;option value="6"&gt;Choice 10&lt;/option&gt;
    &lt;option value="7"&gt;Choice 11&lt;/option&gt;
    &lt;option value="8"&gt;Choice 12&lt;/option&gt;
&lt;/optgroup&gt;
&lt;/select&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.selectsplitter'], function ($) {
        $('select[data-selectsplitter-selector]').selectsplitter();
    });
</script>
