<?php
$_type = $_type ?? [];
?>
{!! Html::style('assets/libs/layui/css/layui.css') !!}

{!! Html::style('assets/libs/boot/style.css') !!}

@if(!in_array('!easy-web', $_type))
    {!! Html::style('assets/libs/easy-web/module/admin.css') !!}
@endif