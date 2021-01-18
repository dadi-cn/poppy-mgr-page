<p class="alert alert-info" id="introduce">
	menu-aim 是一个 jQuery 下拉菜单插件，该插件能够甄别用户是尝试移动鼠标到下拉列表项还是将鼠标移至子菜单内容上。
</p>
<ul class="nav nav-pills" id="link">
	<li><a target="_blank" href="https://github.com/kamens/jQuery-menu-aim">GITHUB</a></li>
	<li><a target="_blank" href="https://rawgit.com/kamens/jQuery-menu-aim/master/example/example.html">demo</a></li>
</ul>
<hr>
<div class="row" id="sample">
	<div class="col-md-4">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="#">A dropdown example</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="active">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Explore the Monkeys</a>
								<ul class="dropdown-menu" role="menu">
									<li data-submenu-id="submenu-patas">
										<a href="#">Patas</a>
										<div id="submenu-patas" class="popover">
											<h3 class="popover-title">Patas</h3>
											<div class="popover-content"><img src="{!! fake_thumb(100,100) !!}"></div>
										</div>
									</li>
									<li data-submenu-id="submenu-snub-nosed">
										<a href="#">Golden Snub-Nosed</a>
										<div id="submenu-snub-nosed" class="popover">
											<h3 class="popover-title">Golden Snub-Nosed</h3>
											<div class="popover-content"><img src="{!! fake_thumb(100,100) !!}"></div>
										</div>
									</li>
									<li data-submenu-id="submenu-duoc-langur">
										<a href="#">Duoc Langur</a>
										<div id="submenu-duoc-langur" class="popover">
											<h3 class="popover-title">Duoc Langur</h3>
											<div class="popover-content"><img src="{!! fake_thumb(100,100) !!}"></div>
										</div>
									</li>
									<li data-submenu-id="submenu-pygmy">
										<a href="#">Baby Pygmy Marmoset</a>
										<div id="submenu-pygmy" class="popover">
											<h3 class="popover-title">Baby Pygmy Marmoset</h3>
											<div class="popover-content"><img src="{!! fake_thumb(100,100) !!}"></div>
										</div>
									</li>
									<li data-submenu-id="submenu-tamarin">
										<a href="#">Black Lion Tamarin</a>
										<div id="submenu-tamarin" class="popover">
											<h3 class="popover-title">Black Lion Tamarin</h3>
											<div class="popover-content"><img src="{!! fake_thumb(100,100) !!}"></div>
										</div>
									</li>
									<li data-submenu-id="submenu-monk">
										<a href="#">Monk Saki</a>
										<div id="submenu-monk" class="popover">
											<h3 class="popover-title">Monk Saki</h3>
											<div class="popover-content"><img src="{!! fake_thumb(100,100) !!}"></div>
										</div>
									</li>
									<li data-submenu-id="submenu-gabon">
										<a href="#">Gabon Talapoin</a>
										<div id="submenu-gabon" class="popover">
											<h3 class="popover-title">Gabon</h3>
											<div class="popover-content"><img src="{!! fake_thumb(100,100) !!}"></div>
										</div>
									</li>
									<li data-submenu-id="submenu-grivet">
										<a href="#">Grivet</a>
										<div id="submenu-grivet" class="popover">
											<h3 class="popover-title">Grivet</h3>
											<div class="popover-content"><img src="{!! fake_thumb(100,100) !!}"></div>
										</div>
									</li>
									<li data-submenu-id="submenu-red-leaf">
										<a href="#">Red Leaf</a>
										<div id="submenu-red-leaf" class="popover">
											<h3 class="popover-title">Red Leaf</h3>
											<div class="popover-content"><img src="{!! fake_thumb(100,100) !!}"></div>
										</div>
									</li>
									<li data-submenu-id="submenu-king-colobus">
										<a href="#">King Colobus</a>
										<div id="submenu-king-colobus" class="popover">
											<h3 class="popover-title">King Colobus</h3>
											<div class="popover-content"><img src="{!! fake_thumb(100,100) !!}"></div>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="row" id="code">
	<div class="col-md-12">
		<h4>代码示例</h4>
		<pre id="J_html">
		&lt;div class="navbar-inner"&gt;
	&lt;div class="container"&gt;
		&lt;button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"&gt;
			&lt;span class="icon-bar"&gt;&lt;/span&gt;
			&lt;span class="icon-bar"&gt;&lt;/span&gt;
			&lt;span class="icon-bar"&gt;&lt;/span&gt;
		&lt;/button&gt;
		&lt;a class="brand" href="#"&gt;A dropdown example&lt;/a&gt;
		&lt;div class="nav-collapse collapse"&gt;
			&lt;ul class="nav"&gt;
				&lt;li class="active"&gt;
					&lt;a class="dropdown-toggle" data-toggle="dropdown" href="#"&gt;Explore the Monkeys&lt;/a&gt;
					&lt;ul class="dropdown-menu" role="menu"&gt;
						&lt;li data-submenu-id="submenu-patas"&gt;
							&lt;a href="#"&gt;Patas&lt;/a&gt;
							&lt;div id="submenu-patas" class="popover"&gt;
								&lt;h3 class="popover-title"&gt;Patas&lt;/h3&gt;
								&lt;div class="popover-content"&gt;&lt;img src="{!! fake_thumb(100,100) !!}"&gt;&lt;/div&gt;
							&lt;/div&gt;
						&lt;/li&gt;
						&lt;li data-submenu-id="submenu-snub-nosed"&gt;
							&lt;a href="#"&gt;Golden Snub-Nosed&lt;/a&gt;
							&lt;div id="submenu-snub-nosed" class="popover"&gt;
								&lt;h3 class="popover-title"&gt;Golden Snub-Nosed&lt;/h3&gt;
								&lt;div class="popover-content"&gt;&lt;img src="{!! fake_thumb(100,100) !!}"&gt;&lt;/div&gt;
							&lt;/div&gt;
						&lt;/li&gt;
						&lt;li data-submenu-id="submenu-duoc-langur"&gt;
							&lt;a href="#"&gt;Duoc Langur&lt;/a&gt;
							&lt;div id="submenu-duoc-langur" class="popover"&gt;
								&lt;h3 class="popover-title"&gt;Duoc Langur&lt;/h3&gt;
								&lt;div class="popover-content"&gt;&lt;img src="{!! fake_thumb(100,100) !!}"&gt;&lt;/div&gt;
							&lt;/div&gt;
						&lt;/li&gt;
						&lt;li data-submenu-id="submenu-pygmy"&gt;
							&lt;a href="#"&gt;Baby Pygmy Marmoset&lt;/a&gt;
							&lt;div id="submenu-pygmy" class="popover"&gt;
								&lt;h3 class="popover-title"&gt;Baby Pygmy Marmoset&lt;/h3&gt;
								&lt;div class="popover-content"&gt;&lt;img src="{!! fake_thumb(100,100) !!}"&gt;&lt;/div&gt;
							&lt;/div&gt;
						&lt;/li&gt;
						&lt;li data-submenu-id="submenu-tamarin"&gt;
							&lt;a href="#"&gt;Black Lion Tamarin&lt;/a&gt;
							&lt;div id="submenu-tamarin" class="popover"&gt;
								&lt;h3 class="popover-title"&gt;Black Lion Tamarin&lt;/h3&gt;
								&lt;div class="popover-content"&gt;&lt;img src="{!! fake_thumb(100,100) !!}"&gt;&lt;/div&gt;
							&lt;/div&gt;
						&lt;/li&gt;
						&lt;li data-submenu-id="submenu-monk"&gt;
							&lt;a href="#"&gt;Monk Saki&lt;/a&gt;
							&lt;div id="submenu-monk" class="popover"&gt;
								&lt;h3 class="popover-title"&gt;Monk Saki&lt;/h3&gt;
								&lt;div class="popover-content"&gt;&lt;img src="{!! fake_thumb(100,100) !!}"&gt;&lt;/div&gt;
							&lt;/div&gt;
						&lt;/li&gt;
						&lt;li data-submenu-id="submenu-gabon"&gt;
							&lt;a href="#"&gt;Gabon Talapoin&lt;/a&gt;
							&lt;div id="submenu-gabon" class="popover"&gt;
								&lt;h3 class="popover-title"&gt;Gabon&lt;/h3&gt;
								&lt;div class="popover-content"&gt;&lt;img src="{!! fake_thumb(100,100) !!}"&gt;&lt;/div&gt;
							&lt;/div&gt;
						&lt;/li&gt;
						&lt;li data-submenu-id="submenu-grivet"&gt;
							&lt;a href="#"&gt;Grivet&lt;/a&gt;
							&lt;div id="submenu-grivet" class="popover"&gt;
								&lt;h3 class="popover-title"&gt;Grivet&lt;/h3&gt;
								&lt;div class="popover-content"&gt;&lt;img src="{!! fake_thumb(100,100) !!}"&gt;&lt;/div&gt;
							&lt;/div&gt;
						&lt;/li&gt;
						&lt;li data-submenu-id="submenu-red-leaf"&gt;
							&lt;a href="#"&gt;Red Leaf&lt;/a&gt;
							&lt;div id="submenu-red-leaf" class="popover"&gt;
								&lt;h3 class="popover-title"&gt;Red Leaf&lt;/h3&gt;
								&lt;div class="popover-content"&gt;&lt;img src="{!! fake_thumb(100,100) !!}"&gt;&lt;/div&gt;
							&lt;/div&gt;
						&lt;/li&gt;
						&lt;li data-submenu-id="submenu-king-colobus"&gt;
							&lt;a href="#"&gt;King Colobus&lt;/a&gt;
							&lt;div id="submenu-king-colobus" class="popover"&gt;
								&lt;h3 class="popover-title"&gt;King Colobus&lt;/h3&gt;
								&lt;div class="popover-content"&gt;&lt;img src="{!! fake_thumb(100,100) !!}"&gt;&lt;/div&gt;
							&lt;/div&gt;
						&lt;/li&gt;
					&lt;/ul&gt;
				&lt;/li&gt;
			&lt;/ul&gt;
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;
		</pre>
		<pre id="J_script"></pre>
	</div>
</div>
<script id="J_script_source">
require(['jquery', 'jquery.menu-aim'], function ($) {
	var $menu = $(".dropdown-menu");

	// jQuery-menu-aim: <meaningful part of the example>
	// Hook up events to be fired on menu row activation.
	$menu.menuAim({
		activate: activateSubmenu,
		deactivate: deactivateSubmenu
	});
	// jQuery-menu-aim: </meaningful part of the example>

	// jQuery-menu-aim: the following JS is used to show and hide the submenu
	// contents. Again, this can be done in any number of ways. jQuery-menu-aim
	// doesn't care how you do this, it just fires the activate and deactivate
	// events at the right times so you know when to show and hide your submenus.
	function activateSubmenu(row) {
		var $row = $(row),
				submenuId = $row.data("submenuId"),
				$submenu = $("#" + submenuId),
				height = $menu.outerHeight(),
				width = $menu.outerWidth();

		// Show the submenu
		$submenu.css({
			display: "block",
			top: -1,
			left: width - 3,  // main should overlay submenu
			height: height - 4  // padding for main dropdown's arrow
		});

		// Keep the currently activated row's highlighted look
		$row.find("a").addClass("maintainHover");
	}

	function deactivateSubmenu(row) {
		var $row = $(row),
				submenuId = $row.data("submenuId"),
				$submenu = $("#" + submenuId);

		// Hide the submenu and remove the row's highlighted look
		$submenu.css("display", "none");
		$row.find("a").removeClass("maintainHover");
	}

	// Bootstrap's dropdown menus immediately close on document click.
	// Don't let this event close the menu if a submenu is being clicked.
	// This event propagation control doesn't belong in the menu-aim plugin
	// itself because the plugin is agnostic to bootstrap.
	$(".dropdown-menu li").click(function(e) {
		e.stopPropagation();
	});

	$(document).click(function() {
		// Simply hide the submenu on any click. Again, this is just a hacked
		// together menu/submenu structure to show the use of jQuery-menu-aim.
		$(".popover").css("display", "none");
		$("a.maintainHover").removeClass("maintainHover");
	});

});
</script>
