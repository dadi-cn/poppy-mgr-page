<nav class="navbar wuli--navbar" data-pjax pjax-ctr="#main">
    <div class="container navbar-expand-lg">
        <a class="navbar-brand" href="/">
            {!! \Site\Classes\Site::logo() !!}
        </a>
        <button class="navbar-toggler" type="button"
                data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="fa fa-list"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {!! active_class(if_route(['site:tool.index'])) !!}">
                    <a class="nav-link" href="{!! route('site:tool.index') !!}">工具</a>
                </li>
                <li class="nav-item {!! active_class(if_route(['site:nav.index'])) !!}">
                    <a class="nav-link" href="{!! route('url:web.collection.index') !!}">导航</a>
                </li>
                <li class="nav-item {!! active_class(if_route(['essay:book.my'])) !!}">
                    <a class="nav-link" href="{!! route('essay:book.my') !!}">文库</a>
                </li>
            </ul>
        </div>
		<?php $_pam = Auth::guard(\Poppy\System\Models\PamAccount::GUARD_WEB)->user() ?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {!! active_class(if_route(['slt:nav.index'])) !!}">
                <a class="nav-link J_iframe" data-width="320" data-height="480" href="{!! route_url('site:user.login') !!}">
                    <i class="fa fa-user"></i> @if ($_pam) {!! $_pam->username !!} @endif
                </a>
            </li>
            @if ($_pam)
                <li class="nav-item {!! active_class(if_route(['site:user.logout'])) !!}">
                    <a class="nav-link" href="{!! route('site:user.logout') !!}">
                        <i class="fa fa-sign-out"></i> 退出登录
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>

