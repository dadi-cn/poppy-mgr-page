<p class="alert alert-info" id="introduce">
    实现可以页面上的关键词搜索。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/CodeSeven/toastr">GITHUB</a></li>
    <li><a target="_blank" href="http://codeseven.github.io/toastr/demo.html">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-12">
        <div class="search fr">
            <span class="fl">输入关键字：</span><input type="text" class="fl" id="search-text" /><input class="s-btn fl" type="submit" value="搜索一下" onmouseout="this.className='s-btn'" onmousedown="this.className='s-btn s-btn-h'" id="btn">
        </div>
        <div id="searchTextTest" class="l">
            <h2 class="tc l">苹果中国售后部门被曝竟设在新加坡</h2>
            <p>最让消费者郁闷的事，莫过于你看着它的产品遍布大江南北，但出了问题才发现，你根本不知道它在哪儿，维权找不着本主儿。</p>
            <p>官网上找不到它的在华机构全称，想起诉都难。公开的地址“建国门外大街1号”，是建筑面积达110万平方米的国贸中心的总体地址，按图索骥找不着门。而它的售后部门在新加坡，中国没有。</p>
            <p>它就是苹果。国内首例消费者针对苹果售后服务提起的诉讼即将开庭。消费者感慨：“我算知道为啥那么多人不满，我的案子却是首例了！”</p>
        </div>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;div class="search fr"&gt;
    &lt;span class="fl"&gt;输入关键字：&lt;/span&gt;&lt;input type="text" class="fl" id="search-text" /&gt;&lt;input class="s-btn fl" type="submit" value="搜索一下" onmouseout="this.className='s-btn'" onmousedown="this.className='s-btn s-btn-h'" id="btn"&gt;
    &lt;/div&gt;
    &lt;div id="searchTextTest" class="l"&gt;
    &lt;h2 class="tc l"&gt;苹果中国售后部门被曝竟设在新加坡&lt;/h2&gt;
    &lt;p&gt;最让消费者郁闷的事，莫过于你看着它的产品遍布大江南北，但出了问题才发现，你根本不知道它在哪儿，维权找不着本主儿。&lt;/p&gt;
    &lt;p&gt;官网上找不到它的在华机构全称，想起诉都难。公开的地址“建国门外大街1号”，是建筑面积达110万平方米的国贸中心的总体地址，按图索骥找不着门。而它的售后部门在新加坡，中国没有。&lt;/p&gt;
    &lt;p&gt;它就是苹果。国内首例消费者针对苹果售后服务提起的诉讼即将开庭。消费者感慨：“我算知道为啥那么多人不满，我的案子却是首例了！”&lt;/p&gt;
&lt;/div&gt;
        </pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery', 'jquery.text-search'], function ($) {
        $("#btn").click(function(){
            var key= $("#search-text").val();
            $("#searchTextTest").textSearch(key);
        });
    });
</script>
