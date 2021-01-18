<style>
	.emoji {
		width: 1.5em;
		height: 1.5em;
		display: inline-block;
		margin-bottom: -0.25em;
	}
</style>
<p class="alert alert-info" id="introduce">
	#这里填写简单的源码示例
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/Ranks/emojify.js">github - emojify</a></li>
	<li><a target="_blank" href="http://www.emoji-cheat-sheet.com/">EMOJI CHEAT SHEET</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
		<div id="emojify_id">:smiley: :o</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">&lt;div id="emojify_id"&gt;:smiley: :o&lt;/div&gt;</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['emojify'], function (emojify) {
	emojify.setConfig({
		emojify_tag_type : '#emojify_id',           // Only run emojify.js on this element
		only_crawl_id    : null,            // Use to restrict where emojify.js applies
		img_dir          : '../assets/images/plugins/emojify',  // Directory for emoji images
		ignored_tags     : {                // Ignore the following tags
			'SCRIPT'  : 1,
			'TEXTAREA': 1,
			'A'       : 1,
			'PRE'     : 1,
			'CODE'    : 1
		}
	});
	emojify.run();
});
</script>
