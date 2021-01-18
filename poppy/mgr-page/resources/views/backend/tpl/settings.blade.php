@extends('py-mgr-page::backend.tpl.default')
@section('backend-main')
    <ul class="layui-tab-title mg8 pl8 pr8">
        @foreach($hooks as $key => $hook)
            <li class="{!! active_class($key === $path, 'layui-this') !!}">
                <a class="J_ignore" href="{!! route('py-mgr-page:backend.home.setting', [$key]) !!}">
                    {!! $hook['title'] !!}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <?php $i = 0 ?>
                    @foreach($forms as $group_key => $form)
                        <li class="{!! active_class($group_key === $index, 'layui-this') !!}">
                            <a class="J_ignore" href="{!! route('py-mgr-page:backend.home.setting', [$path, $group_key]) !!}">
                                {!! $form->title  !!}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="layui-tab-content">
                    {!! $cur !!}
                </div>
            </div>
        </div>
    </div>
@endsection