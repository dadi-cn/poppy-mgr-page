$(function() {
	// tooltip
	$('[data-toggle="tooltip"]').tooltip();
	// dropdown
	$('.dropdown-toggle').dropdown();

	if (typeof pace !== 'undefined') {
		pace.start({
			document : false
		});
	}


	_handle_footer();
	$(window).resize(_handle_footer);

	function _handle_footer() {
		var $p_footer = $('#footer');
		var $body = $('body');
		if (($body.height() === Util.getViewport().height) || ($body.height() < Util.getViewport().height - $p_footer.height())) {
			$p_footer.css({
				position : 'fixed',
				bottom   : 0
			}).fadeIn(500);
		} else {
			$p_footer.css({
				position : 'inherit'
			}).show();
		}
	}

	if ($.support.pjax) {
		$(document).on('submit', 'form[data-pjax]', function(event) {
			var container = $(this).attr('pjax-ctr');
			if (!container) {
				container = '#pjax-container'
			}
			$.pjax.submit(event, container, {
				fragment : container,
				timeout  : 3000,
			});
			event.preventDefault();
		});
		$(document).on('click', 'a[data-pjax], [data-pjax] a:not(.J_ignore)', function(event) {
			var container = $(this).closest('[pjax-ctr]');
			var ctr = container.attr('pjax-ctr');
			if (typeof ctr === 'undefined') {
				ctr = '#pjax-container'
			}

			if ($(ctr).length === 0) {
				Util.splash({
					status  : 1,
					message : '你的页面中没有 Pjax 容器' + ctr + ',请添加, 否则无法进行页面请求'
				});
				return false;
			}

			$.pjax.click(event, {
				container : ctr,
				fragment  : ctr,
				timeout   : 3000
			})
		});
		$(document).on('pjax:send', function() {
			layer.load(3)
		});
		$(document).on('pjax:complete', function() {
			$('.J_tooltip').tooltip();
			layer.closeAll();
		});
	}
});