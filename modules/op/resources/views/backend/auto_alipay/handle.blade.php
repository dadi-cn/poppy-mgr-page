@extends('system::backend.tpl.dialog')
@section('backend-main')

    <div class="layui-form-item">
        {!! Form::label('trade_no', '交易号') !!}
        <div>
            {!! Form::text('trade_no', $item->trade_no, ['disabled','readonly','class' => 'layui-input']) !!}
        </div>
    </div>

    <div class="layui-form-item">
        {!! Form::label('amount', '交易号') !!}
        <div>
            {!! Form::text('amount', $item->trade_amount, ['disabled','readonly','class' => 'layui-input']) !!}
        </div>
    </div>

    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li class="layui-this">充值到用户账号</li>
            <li>取消充值</li>
        </ul>

        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                {!! Form::model($item ?? '',['route'=> [$_route, $item->id ??'']]) !!}
                {!! Form::hidden('type', 'charge') !!}
                <div class="layui-form-item">
                    {!! Form::label('account_name', '用户名', ['class' => 'validation']) !!}
                    <div>
                        {!! Form::text('account_name', null, ['class' => 'layui-input']) !!}
                    </div>
                </div>
                <div class="layui-form-item">
                    {!! Form::label('reason', '原因', ['class' => 'validation']) !!}
                    <div>
                        {!! Form::textarea('reason', null, ['class' => 'layui-textarea', 'rows'=>3]) !!}
                    </div>
                </div>
                <div class="layui-form-item">
                    <div>
                        {!! Form::button('充值到用户账号', ['class'=>'layui-btn J_submit', 'type'=> 'submit']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            <div class="layui-tab-item">
                {!! Form::model($item ?? '',['route'=> [$_route, $item->id ??'']]) !!}
                {!! Form::hidden('type', 'cancel') !!}
                <div class="layui-form-item">
                    {!! Form::label('reason', '原因', ['class' => 'validation']) !!}
                    <div>
                        {!! Form::textarea('reason', null, ['class' => 'layui-textarea', 'rows'=>3]) !!}
                    </div>
                </div>
                <div class="layui-form-item">
                    <div>
                        {!! Form::button('取消充值', ['class'=>'layui-btn J_submit', 'type'=> 'submit']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection