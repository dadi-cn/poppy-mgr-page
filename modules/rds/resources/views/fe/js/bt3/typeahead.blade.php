<p class="alert alert-info" id="introduce">
    Typeahead 在用户填写表单时，为用户提供提示或数据。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/twitter/typeahead.js">GITHUB</a></li>
    <li><a target="_blank" href="http://twitter.github.io/typeahead.js/examples/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <input type="text" class="span3" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Ahmedabad&quot;,&quot;Akola&quot;,&quot;Asansol&quot;,&quot;Aurangabad&quot;]">
        <p>填入a查看效果</p>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
        &lt;input type="text" class="span3" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Ahmedabad&quot;,&quot;Akola&quot;,&quot;Asansol&quot;,&quot;Aurangabad&quot;]"&gt;
&lt;p&gt;填入a查看效果&lt;/p&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.typeahead']);
</script>
