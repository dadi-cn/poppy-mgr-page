<p class="alert alert-info" id="introduce">
    Vue.js 是用于构建交互式的 Web  界面的库。它提供了 MVVM 数据绑定和一个可组合的组件系统，具有简单、灵活的 API。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/vuejs/vue/">GITHUB</a></li>
    <li><a target="_blank" href="http://cn.vuejs.org/">中文文档</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <input type="text" v-model="item" placeholder="输入一些文字">
        <p>@{{ item }}</p>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">
		&lt;input type="text" v-model="item" placeholder="输入一些文字"&gt;&lt;p&gt;@{{ item }}&lt;/p&gt;
		</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['vue'], function (vue) {
        new vue({
            el:'body',
            data:({
                item:''
            })
        })
    });
</script>
