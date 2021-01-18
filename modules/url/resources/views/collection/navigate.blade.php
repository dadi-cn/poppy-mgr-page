@extends('slt::tpl.default')
@section('body-start')
    <body class="site_nav">@stop
    @section('tpl-main')
        @include('web.nav.group')
        <div class="container clearfix">
            <div class="site_nav--content">
                @if(!empty($items))
                    @foreach($items as $key=>$val)
                        <section class="mt20">
                            <h4><span>{!! $val['title'] !!}</span></h4>
                            @if(!empty($val['second']))
                                @foreach($val['second'] as $k=>$v)
                                    <div class="clearfix">
                                        <h5 id="{!! $v['title_en'] !!}">
                                            {!! $v['title'] !!} <br>
                                            <span>{!! $v['title_en'] !!}</span>
                                        </h5>
                                        <ul class="clearfix">
                                            @if(!empty($v['urls']))
                                                @foreach($v['urls'] as $s=>$t)
                                                    <li>
                                                        <a href="{!! route('front_home.jump', [$t['id']]) !!}"
                                                           target="_blank">
                                                            {!! Form::showThumb($t['image']) !!}
                                                            <p>
                                                                {!! $t['title'] !!} <br>
                                                                <span>{!! $t['description'] !!}</span>
                                                            </p>
                                                        </a>
                                                        @if ($t['is_suggest'])
                                                            <i class="iconfont icon-recommend text-danger"></i>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endforeach
                            @endif
                        </section>
                    @endforeach
                @endif
            </div>
        </div>
    @include('slt::tpl.inc_footer')
@endsection