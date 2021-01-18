<p class="alert alert-info" id="introduce">
	FullCalendar用日历的形式直观的展示了日程安排、代办事宜等事件
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/fullcalendar/fullcalendar">链接地址</a></li>
	<li><a target="_blank" href="http://fullcalendar.io/">演示</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id='calendar'></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id='calendar'&gt;&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'moment','fullcalendar'], function ($, moment,fullCalendar) {
	$(document).ready(function() {

		// page is now ready, initialize the calendar...

		$('#calendar').fullCalendar({
			weekends: false // will hide Saturdays and Sundays
		})

	});
});
</script>
