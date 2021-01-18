@extends('site::tpl.layout-basic')
@section('body-class', 'essay--my')

@section('layout-side')
    <div class="wuli--box">
        <h3>初衷</h3>
        <div>
            做一个快速搜集整理知识的工具 <br> 做自己的文库
        </div>
        <div>
            <a class="J_iframe btn btn-primary btn-block"
               data-width="400" data-height="444"
               data-title="创建文库"
               href="{!! route('essay:book.establish') !!}">
                <i class="iconfont icon-book"></i> 创建文库
            </a>
        </div>
    </div>
@endsection
@section('layout-main')
    <div class="wuli--box">
        <h3>我的书籍</h3>
        <div class="row">
            @if ($items->total())
                @foreach($items as $item)
                    <div class="col-lg-3">
                        <div class="card">
                            <a href="{!! route('web:prd.my_book_item', [$item->id]) !!}">
                                {!! Form::showThumb('', [
                                    'class' => 'card-img-top'
                                ]) !!}
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{!! route('essay:book.show', [$item->id]) !!}"
                                       title="{!! $item->title !!}">
                                        {!! $item->title !!}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    最后更新于 {!! \Poppy\Framework\Helper\TimeHelper::datetime($item->created_at, '3-2') !!}
                                </p>

                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <a href="{!! route('essay:book.show', [$item->id]) !!}"
                                       class="btn btn-primary"
                                       title="{!! $item->title !!}">
                                        查看详细
                                    </a>

                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            操作
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="J_iframe"
                                               href="{!! route('web:prd.access', [$item->id]) !!}"
                                               data-width="444" data-height="333" data-title="权限控制">
                                                <i class="iconfont icon-lock"></i>
                                            </a>
                                            <a class="J_iframe"
                                               href="{!! route('web:prd.address', [$item->id]) !!}"
                                               data-width="444" data-height="555">
                                                <i class="iconfont icon-share"></i>
                                            </a>
                                            @can('move', $item)
                                                <a class="J_iframe"
                                                   href="{!! route('web:prd.move', [$item->id]) !!}">移动</a>

                                            @endcan
                                            <a class="J_iframe"
                                               href="{!! route('essay:book.establish', [$item->id]) !!}">重命名</a>
                                            <a href="{!! route('essay:article.establish', [$item->id]) !!}">编辑</a>
                                            <a class="J_request"
                                               data-confirm="确认删除`{!! $item->title !!}` ? "
                                               href="{!! route('web:prd.status', [$item->id, 'delete']) !!}">删除</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($items->hasPages())
                    <div class="container clearfix">
                        <div class="pull-right">
                            {!!$items->render()!!}
                        </div>
                    </div>
                @endif
            @else
                <div class="row">
                    <div class="col-md-12">
                        @include('site::tpl._empty')
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection