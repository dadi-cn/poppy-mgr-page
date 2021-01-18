<p class="alert alert-info" id="introduce">
	Swiper 是移动端使用的触摸滑动的一个开源lib，可应用于移动网站，web App，native App或者混合类app。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/nolimits4web/Swiper">GITHUB</a></li>
	<li><a target="_blank" href="http://www.swiper.com.cn/">中文网</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-8">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<div class="swiper-slide">Slide 1</div>
				<div class="swiper-slide">Slide 2</div>
				<div class="swiper-slide">Slide 3</div>
			</div>
			<!-- 如果需要分页器 -->
			<div class="swiper-pagination"></div>

			<!-- 如果需要导航按钮 -->
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>

			<!-- 如果需要滚动条 -->
			<div class="swiper-scrollbar"></div>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div class="swiper-container"&gt;
			&lt;div class="swiper-wrapper"&gt;
				&lt;div class="swiper-slide"&gt;Slide 1&lt;/div&gt;
				&lt;div class="swiper-slide"&gt;Slide 2&lt;/div&gt;
				&lt;div class="swiper-slide"&gt;Slide 3&lt;/div&gt;
			&lt;/div&gt;
			&lt;!-- 如果需要分页器 --&gt;
			&lt;div class="swiper-pagination"&gt;&lt;/div&gt;

			&lt;!-- 如果需要导航按钮 --&gt;
			&lt;div class="swiper-button-prev"&gt;&lt;/div&gt;
			&lt;div class="swiper-button-next"&gt;&lt;/div&gt;

			&lt;!-- 如果需要滚动条 --&gt;
			&lt;div class="swiper-scrollbar"&gt;&lt;/div&gt;
		&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.swiper'], function ($) {
	$(document).ready(function () {
		var mySwiper = new Swiper ('.swiper-container', {
			direction: 'vertical',
			loop: true,

			// 如果需要分页器
			pagination: '.swiper-pagination',

			// 如果需要前进后退按钮
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',

			// 如果需要滚动条
			scrollbar: '.swiper-scrollbar',
		})
	})
});
</script>
