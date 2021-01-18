<p class="alert alert-info" id="introduce">
    基于bootstrap的分页控件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/esimakin/twbs-pagination">GITHUB</a></li>
    <li><a target="_blank" href="http://esimakin.github.io/twbs-pagination/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-12">
        <ul id="pagination-demo" class="pagination-sm"></ul>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;ul id="pagination-demo" class="pagination-sm"&gt;&lt;/ul&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery','bt3.twbs-pagination'], function ($) {
        $('#pagination-demo').twbsPagination({
            totalPages: 35,
            visiblePages: 7,
            onPageClick: function (event, page) {
                $('#page-content').text('Page ' + page);
            }
        });
    });
</script>
