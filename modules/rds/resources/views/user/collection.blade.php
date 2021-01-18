@extends('daniu.template.main')
@section('body-start')
    <body class="user_attention_fans bg-grey">
    @endsection
    @section('daniu-main')
        @include('front.inc.nav')
        <div class="container mt20">
            <div class="col-md-2">
                <ul class="list-group user_attention_fans-side">
                    <li class="list-group-item @if ($type == 'attention') active @endif">
                        <a href="{!! route('front_user.collection', ['attention', $user->account_id]) !!}">关注的用户</a>
                        <span class="badge">{!! $user->attention_num !!}</span>
                    </li>
                    <li class="list-group-item @if ($type == 'fans') active @endif">
                        <a href="{!! route('front_user.collection', ['fans',$user->account_id]) !!}">关注 Ta 粉丝</a>
                        <span class="badge">{!! $user->fans_num !!}</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 user_attention_fans-content">
                {{--start attention --}}
                @if ($type == 'attention')
                    <h4>
                        <a href="{!! \App\Models\AccountFront::shortUrl($user) !!}">
                            {!! Html::image(avatar($user->head_pic), $user->nickname, ['width'=> '30px', 'height'=> '30px', 'class'=> 'img-circle']) !!} {!! $user->nickname !!}
                        </a>
                        关注的用户数 ({!! $user->attention_num !!})
                    </h4>
                    <div>
                        @if ($items->total())
                            <ul class="list-group">
                                @foreach($items as $item)
                                    <li class="list-group-item">
                                        <a target="_blank" href="{!! \App\Models\AccountFront::shortUrl($item->to_front) !!}">
                                            {!! Html::image(avatar($item->to_front->head_pic), $item->to_front->nickname, ['width'=> '50px', 'height'=> '50px', 'class'=> 'img-circle']) !!}
                                            {!! $item->to_front->nickname ?: $item->to_front->nickname !!}
                                        </a>
                                        @if ($_front && $_front->account_id != $item->to_front->account_id)
                                            @can('follow', $item->to_front)
                                                <a href="{!! route('front_user.attention', $item->to_front->account_id) !!}"
                                                   class="J_request btn btn-success pull-right">+ 关注</a>
                                            @endcan
                                            @can('un_follow', $item->to_front)
                                                <a href="{!! route('front_user.attention', [$item->to_front->account_id, 'cancel']) !!}"
                                                   class="J_request btn btn-success pull-right">取消关注</a>
                                            @endcan
                                        @else
                                            @if (!$_front || ($_front && $_front->account_id != $item->to_front->account_id))
                                                <a href="{!! route('front_user.login', 'mini') !!}"
                                                   class="btn btn-success J_iframe pull-right">关注</a>
                                            @endif
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            <div class="clearfix">
                                {!! $items->render() !!}
                            </div>
                        @else
                            <div class="user_attention_fans-empty">
                                <h3>暂无用户关注</h3>
                            </div>
                        @endif
                    </div>
                @endif
                {{-- end attention --}}

                {{-- start fans --}}
                @if ($type == 'fans')
                    <h4>
                        <a href="{!! \App\Models\AccountFront::shortUrl($user) !!}">
                            {!! Html::image(avatar($user->head_pic), $user->nickname, ['width'=> '30px', 'height'=> '30px', 'class'=> 'img-circle']) !!} {!! $user->nickname !!}
                        </a>
                        关注 Ta 粉丝 ({!! $user->fans_num !!})
                    </h4>
                    <div>
                        @if ($items->total())
                            <ul class="list-group">
                                @foreach($items as $item)
                                    <li class="list-group-item">
                                        <a target="_blank" href="{!! \App\Models\AccountFront::shortUrl($item->from_front) !!}">
                                            {!! Html::image(avatar($item->from_front->head_pic), $item->from_front->nickname, ['width'=> '50px', 'height'=> '50px', 'class'=> 'img-circle']) !!}
                                            {!! $item->from_front->nickname ?: $item->from_pam->nickname !!}
                                        </a>
                                        @if ($_front && $_front->account_id != $item->from_front->account_id)
                                            @can('follow', $item->from_front)
                                                <a href="{!! route('front_user.attention', $item->from_front->account_id) !!}"
                                                   class="J_request btn btn-success pull-right">+ 关注</a>
                                            @endcan
                                            @can('un_follow', $item->from_front)
                                                <a href="{!! route('front_user.attention', [$item->from_front->account_id, 'cancel']) !!}"
                                                   class="J_request btn btn-success pull-right">取消关注</a>
                                            @endcan
                                        @else
                                            @if (!$_front || ($_front && $_front->account_id != $item->from_front->account_id))
                                                <a href="{!! route('front_user.login', 'mini') !!}"
                                                   class="btn btn-success J_iframe pull-right">关注</a>
                                            @endif
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            <div class="clearfix">
                                {!! $items->render() !!}
                            </div>
                        @else
                            <div class="user_attention_fans-empty">
                                <h3>暂无用户关注</h3>
                            </div>
                        @endif
                    </div>
                @endif
                {{-- end fans --}}


            </div>
        </div>
    @include('front.inc.footer')
@endsection