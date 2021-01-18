<div class="container mt20">
    <div class="site_nav--group clearfix">
        @foreach($groups as $_group)
            <div class="group-container">
                <a href="{!! route('slt:nav.group', [$_group->name]) !!}"
                   class="{!! (isset($group ) && $_group->name == $group) ? 'active' : '' !!}">
                    <div class="group-image">
                        {!! Form::showThumb($_group->image, ['width'=> 80,'height'=> 80]) !!}
                    </div>
                    <span>{!! $_group->title !!}</span>
                </a>
            </div>
        @endforeach
        <div class="group-container pull-right">
            <a href="{!! route('slt:nav.self') !!}"
               class="{!! active_class(if_route('slt:nav.self')) !!}">
                <div class="group-image">
                    {!! Html::image('project/daniu/images/home/custom.png', '用户收藏', ['width'=> 80,'height'=> 80]) !!}
                </div>
                <span>自定义收藏</span>
            </a>
        </div>
    </div>
</div>