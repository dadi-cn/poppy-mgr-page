@extends('lemon.template.bt3')
@section('bootstrap-main')

	<div id="qq" class="sj-plugin_qq"></div>
	<script>
		requirejs(['jquery', 'lemon/plugin'], function($){
			$(function(){
				$('#qq').plugin_qq();
			});
		})
	</script>

	<div class="container">
		<h3>自定义 tip</h3>
		<button class="btn btn-info" data-tip="这里是自定义tip">自定义tip</button>
		<script>
		requirejs(['jquery', 'lemon/plugin'],  function($){
			$(function(){
				$('button').plugin_tooltip();
			});
		})
		</script>
	</div>

	<div>
		<h3>无缝滚动</h3>
		<div id="scroll"  style="height: 80px;">
			<ul id="scroll">
				<li><a href="#">abcdefghigk1</a></li>
				<li>abcdefghigk2</li>
				<li>abcdefghigk3</li>
				<li>abcdefghigk4</li>
				<li>abcdefghigk5</li>
				<li>abcdefghigk6</li>
				<li>abcdefghigk7</li>
				<li>abcdefghigk8</li>
				<li>abcdefghigk9</li>
				<li>abcdefghigk10</li>
				<li>abcdefghigk11</li>
				<li>abcdefghigk12</li>
				<li>abcdefghigk13</li>
				<li>abcdefghigk14</li>
				<li>abcdefghigk15</li>
				<li>abcdefghigk16</li>
				<li>abcdefghigk17</li>
				<li>abcdefghigk18</li>
			</ul>
		</div>

		<script>
		requirejs(['jquery', 'lemon/plugin'],  function($){
			$(function(){
				$('#scroll').plugin_scroll_seamless({
					speed:29,
					rowHeight: 19
				});
			});
		})
		</script>
	</div>

	<div>
		<h3>左下菜单</h3>
		<div id="rbmenu"></div>
		<script>
		requirejs(['jquery', 'lemon/plugin'],  function ($) {
			$(function () {
				$('#rbmenu').plugin_rbmenu({
					telphone : '15254109156',
					qq       : '408128151',
					wx       : '',
					site     : ''
				});
			});
		})
		</script>
	</div>
@endsection