<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<ul class="nav navbar-nav">
			<li><a href="{!! route('index') !!}"><i class="fa fa-home"></i> 首页</a></li>
			<li><a href="{!! route('p', $project) !!}">项目主页</a></li>
			<li><a href="{!! route('img', $project) !!}">项目图片</a></li>
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					工具 <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="{!! route('p','lemon.tools.html_entity') !!}">实体转换</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>