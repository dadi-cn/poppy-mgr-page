<p class="alert alert-info" id="introduce">
    Datatables是一款bootstrap表格插件。它是一个高度灵活的工具，可以将任何HTML表格添加高级的交互功能。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/ssy341/datatables-cn/">GITHUB</a></li>
    <li><a target="_blank" href="http://datatables.club/">中文网</a></li>
</ul>
<hr>
<div class="container">
    <div class="row" id="sample">
        <div class="col-md-10">
            <table id="table_id" class="table">
                <thead>
                <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Row 1 Data 1</td>
                    <td>Row 1 Data 2</td>
                </tr>
                <tr>
                    <td>Row 2 Data 1</td>
                    <td>Row 2 Data 2</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row" id="code">
        <div class="col-md-12">
            <h4>代码示例</h4>
            <pre id="J_html">
				&lt;table id="table_id" class="display">
	&lt;thead&gt;
	&lt;tr&gt;
		&lt;th&gt;Column 1&lt;/th&gt;
		&lt;th&gt;Column 2&lt;/th&gt;
	&lt;/tr&gt;
	&lt;/thead&gt;
	&lt;tbody&gt;
	&lt;tr&gt;
		&lt;td&gt;Row 1 Data 1&lt;/td&gt;
		&lt;td&gt;Row 1 Data 2&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;Row 2 Data 1&lt;/td&gt;
		&lt;td&gt;Row 2 Data 2&lt;/td&gt;
	&lt;/tr&gt;
	&lt;/tbody&gt;
&lt;/table&gt;
			</pre>
            <pre id="J_script"></pre>
        </div>
    </div>
</div>
<script id="J_script_source">
    require(['jquery', 'bt3.data-tables'], function ($) {
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    });
</script>

