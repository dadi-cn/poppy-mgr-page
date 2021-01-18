<div class="panel-heading">
	<div class="panel-options">
		<ul class="nav nav-tabs">
			<li @if (Route::currentRouteName() == 'user.basic')class="active"@endif><a href="{{route('user.basic')}}">个人设置</a></li>
			<li @if (Route::currentRouteName() == 'user.avatar')class="active"@endif><a href="{{route('user.avatar')}}">修改头像</a></li>
		</ul>
	</div>
</div>