<nav class="navbar navbar-default">
	<div class="navbar-header">
		<a class="navbar-brand" href="{!! route('slt:fe.md') !!}"><i class="fa fa-home"></i></a>
	</div>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			@if (isset($self_menu) && is_array($self_menu))
				@foreach($self_menu as $title => $link)
					@if (!$link['archive'])
						<li><a target="_blank" href="{!! $link['url'] !!}">{!! $title !!}</a></li>
					@endif
				@endforeach
			@endif
		</ul>
		@if (isset($self_menu) && is_array($self_menu))
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">帮助 <span class="caret"></span></a>
					<ul class="dropdown-menu">
						@foreach($self_menu as $title => $link)
							@if ($link['archive'])
								<li><a target="_blank" href="{!! $link['url'] !!}">{!! $title !!}</a></li>
							@endif
						@endforeach
					</ul>
				</li>
			</ul>
		@endif
	</div>
</nav>