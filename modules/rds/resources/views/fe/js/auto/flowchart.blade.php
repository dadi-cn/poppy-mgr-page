<p class="alert alert-info" id="introduce">
	Flowchart.js 仅需几行代码即可在 Web 上完成流程图的构建。可以从文字表述中画出简单的 SVG 流程图，也可以画出彩色的图表。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/Ranks/emojify.js">github - emojify</a></li>
	<li><a target="_blank" href="http://www.emoji-cheat-sheet.com/">EMOJI CHEAT SHEET</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div><textarea id="code" style="width: 100%;" rows="11">
st=>start: Start|past:>http://www.google.com[blank]
e=>end: End:>http://www.google.com
op1=>operation: My Operation|past
op2=>operation: Stuff|current
sub1=>subroutine: My Subroutine|invalid
cond=>condition: Yes
or No?|approved:>http://www.google.com
c2=>condition: Good idea|rejected
io=>inputoutput: catch something...|request

st->op1(right)->cond
cond(yes, right)->c2
cond(no)->sub1(left)->op1
c2(yes)->io->e
c2(no)->op2->e
        </textarea></div>
		<div><button id="run" type="button">Run</button></div>
		<div id="canvas"></div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;textarea name="autosize" class="J_autosize"&gt;&lt;/textarea&gt;
        &lt;div&gt;&lt;textarea id="code" style="width: 100%;" rows="11"&gt;
st=>start: Start|past:>http://www.google.com[blank]
e=>end: End:>http://www.google.com
op1=>operation: My Operation|past
op2=>operation: Stuff|current
sub1=>subroutine: My Subroutine|invalid
cond=>condition: Yes
or No?|approved:>http://www.google.com
c2=>condition: Good idea|rejected
io=>inputoutput: catch something...|request

st->op1(right)->cond
cond(yes, right)->c2
cond(no)->sub1(left)->op1
c2(yes)->io->e
c2(no)->op2->e
&lt;/textarea&gt;&lt;/div&gt;
&lt;div&gt;&lt;button id="run" type="button"&gt;Run&lt;/button&gt;&lt;/div&gt;
&lt;div id="canvas"&gt;&lt;/div&gt;
        </pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery','flowchart', 'raphael'], function ($, flowchart) {
	var btn = document.getElementById("run"),
			cd = document.getElementById("code"),
			chart;

	(btn.onclick = function () {
		var code = cd.value;

		if (chart) {
			chart.clean();
		}

		chart = flowchart.parse(code);
		chart.drawSVG('canvas', {
			// 'x': 30,
			// 'y': 50,
			'line-width': 3,
			'line-length': 50,
			'text-margin': 10,
			'font-size': 14,
			'font': 'normal',
			'font-family': 'Helvetica',
			'font-weight': 'normal',
			'font-color': 'black',
			'line-color': 'black',
			'element-color': 'black',
			'fill': 'white',
			'yes-text': 'yes',
			'no-text': 'no',
			'arrow-end': 'block',
			'scale': 1,
			'symbols': {
				'start': {
					'font-color': 'red',
					'element-color': 'green',
					'fill': 'yellow'
				},
				'end':{
					'class': 'end-element'
				}
			},
			'flowstate' : {
				'past' : { 'fill' : '#CCCCCC', 'font-size' : 12},
				'current' : {'fill' : 'yellow', 'font-color' : 'red', 'font-weight' : 'bold'},
				'future' : { 'fill' : '#FFFF99'},
				'request' : { 'fill' : 'blue'},
				'invalid': {'fill' : '#444444'},
				'approved' : { 'fill' : '#58C4A3', 'font-size' : 12, 'yes-text' : 'APPROVED', 'no-text' : 'n/a' },
				'rejected' : { 'fill' : '#C45879', 'font-size' : 12, 'yes-text' : 'n/a', 'no-text' : 'REJECTED' }
			}
		});

		$('[id^=sub1]').click(function(){
			alert('info here');
		});
	})();
});
</script>
