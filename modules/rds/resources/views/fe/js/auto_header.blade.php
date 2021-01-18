<div class="container">
    <nav class="navbar navbar-expand-lg fe--item_navigation">
        <a class="navbar-brand">代码示例</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                @foreach($singles as $key => $single)
                    <li class="nav-item dropdown">
                        @if (isset($single) && $single)
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button">Js ({!! $key !!}) <span
                                        class="caret"></span></a>
                            <div class="dropdown-menu">
                                @foreach($single as $link)
                                    <a href="{!! route('slt:fe.js', $link) !!}" class="dropdown-item">{!! $link !!}</a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
                @foreach($jquerys as $key => $single)
                    <li class="nav-item dropdown">
                        @if (isset($single) && $single)
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button">Js ({!! $key !!}) <span
                                        class="caret"></span></a>
                            <div class="dropdown-menu">
                                @foreach($single as $link)
                                    <a class="dropdown-item" href="{!! route('slt:fe.js', ['jquery.'. $link]) !!}">{!! $link !!}</a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
                @foreach($bt3s as $key => $single)
                    <li class="nav-item dropdown">
                        @if (isset($single) && $single)
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button">jQuery Bt3({!! $key !!}) <span
                                        class="caret"></span></a>
                            <div class="dropdown-menu">
                                @foreach($single as $link)
                                    <a class="dropdown-item" href="{!! route('slt:fe.js', ['bt3.'. $link]) !!}">{!! $link !!}</a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
</div>
