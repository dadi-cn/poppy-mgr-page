<nav class="navbar navbar-expand x--nav fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/" title="{!! sys_setting('py-system::site.name') !!}"> &nbsp; </a>
        <ul class="navbar-nav me-auto mb-lg-0">
            <li class="nav-item">
                <a class="nav-link {!! active_class(if_route(['misc:web.home.index'])) !!}"
                    href="/">
                    首页
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://wulicode.com/note">
                    笔记
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://wulicode.com/webapp">
                    Tools
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://wulicode.com/man">
                    Man
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://wulicode.com/doc">
                    Poppy Framework
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://wulicode.com/lang">
                    语言
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="x--header @if (($type??'') === 'intro') header-about @endif">
    @if ( ($type??'') === 'home')
        <div class="container header-intro">
            <div class="header-left d-flex flex-wrap flex-column justify-content-center">
                <h2>Wulicode - 学习代码的旅途笔记</h2>
                <p>
                    - Poppy Framework<br>
                    - 开发笔记 <br>
                    - 常用工具
                </p>
            </div>
            <div class="header-right d-flex justify-content-end align-items-center">
                <img src="/app/images/prod/time.png" alt="Wulicode">
            </div>
        </div>
    @endif
    @if (($type??'') === 'intro')
        <div class="container header-about-detail">
            <div class="d-flex flex-wrap align-items-center justify-content-center">
                <div>
                    <h2>关于我们</h2>
                    <p>质量为本、客户为根、用于拼搏、务实创新</p>
                </div>
            </div>
        </div>
        <div class="header-about-menu">
            <a href="{!! route('misc:web.home.intro', ['company']) !!}"
                class="{!! active_class(if_route_param('type', 'company')) !!}">
                公司介绍
            </a>
            <a href="{!! route('misc:web.home.intro', ['contact']) !!}"
                class="{!! active_class(if_route_param('type', 'contact')) !!}">
                联系我们
            </a>
            <a href="{!! route('misc:web.home.intro', ['priv']) !!}"
                class="{!! active_class(if_route_param('type', 'priv')) !!}">
                法律声明
            </a>
            <a href="{!! route('misc:web.home.intro', ['service']) !!}"
                class="{!! active_class(if_route_param('type', 'service')) !!}">
                服务协议
            </a>
            <a href="{!! route('misc:web.home.intro', ['server']) !!}"
                class="{!! active_class(if_route_param('type', 'server')) !!}">
                服务器协议
            </a>
        </div>
    @endif
</div>
