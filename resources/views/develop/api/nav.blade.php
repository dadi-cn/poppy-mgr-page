<div id="nav" class="api--nav">
    <ul class="layui-nav" style="padding-right: 175px;">
        <li class="layui-nav-item">
            <a class="layui-nav-item fa fa-home" href="{!! route('py-mgr-page:develop.cp.cp') !!}">
                <small> {!! $guard !!}</small>
            </a>
        </li>
        @if (isset($data['group']) )
            @foreach($data['group'] as $group_key => $group)
                <li class="layui-nav-item">
                    <a href="#">{!! $group_key !!} <span class="caret"></span></a>
                    <dl class="layui-nav-child">
                        @foreach($group as $link)
                            <dd>
                                <a href="{!! route_url('',$guard, ['url'=>$link->url, 'method' => $link->type]) !!}">
                                    {!! $link->title !!}</a></dd>
                        @endforeach
                    </dl>
                </li>
            @endforeach
        @endif
    </ul>
    @if (isset($self_menu))
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="#" v-on:click="switchQuick"><i class="fa fa-search"></i></a>
            </li>
            <li class="layui-nav-item">
                <a href="#">帮助文档</a>
                <dl class="layui-nav-child">
                    @foreach($self_menu as $title => $link)
                        <dd><a target="_blank" href="{!! $link !!}">{!! $title !!}</a></dd>
                    @endforeach
                </dl>
            </li>
        </ul>
    @endif
    <div class="nav-ctr" id="quick_search">
        <div class="nav-search">
            <form class="layui-form">
                <div class="form-group search">
                    <input type="search" class="layui-input" id="search" placeholder="Search ApiDoc">
                </div>
            </form>
            <div class="results">
                @if (isset($data['group']) )
                    @foreach($data['group'] as $group_key => $group)
                        @foreach($group as $link)
                            <div class="interface">
                                <a href="{!! route_url('',$guard, ['url'=>$link->url, 'method' => $link->type]) !!}">
                                    <span>[{!! $group_key !!}] {!! $link->title !!}</span>
                                    <br>
                                    {!! $link->url !!}
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<script>

$(function() {
    Util.holmes({
        input : '#search',
        find : '#quick_search .interface',
        placeholder : '<h5> No Search Result!</h5>'
    });
    layui.element.init();
});

new Vue({
    el : '#nav',
    data : {
        show : 'none'
    },
    methods : {
        switchQuick : function() {
            let display = $('#quick_search').css('display');
            if (display === 'none') {
                $('#quick_search').css('display', 'block');
            } else {
                $('#quick_search').css('display', 'none');
            }
            $('#search').focus();
        }
    }
});
</script>