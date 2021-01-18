@extends('system::backend.tpl.default')
@section('backend-main')
    <fieldset class="layui-elem-field layui-field-title">
        <legend>账号管理</legend>
    </fieldset>

    {!! Form::model(input(), ['method' => 'get', 'class' => 'layui-form', 'data-pjax', 'pjax-ctr'=> '#main']) !!}
    <div class="layui-input-inline w108">
        {!! Form::select('platform', \Auto\Models\AutoAlipayTrade::kvPlatform(), null, ['placeholder' => '全部']) !!}
    </div>
    <div class="layui-input-inline">
        {!! Form::text('true_name', null, ['placeholder' => '真实姓名', 'class' => 'layui-input']) !!}
    </div>
    <div class="layui-input-inline">
        {!! Form::text('trade_no', null, ['placeholder' => '输入trade_no进行搜索', 'class' => 'layui-input w288']) !!}
    </div>
    <div class="layui-input-inline w108">
        {!! Form::select('status', \Auto\Models\AutoAlipayTrade::kvStatus(), null, ['placeholder' => '全部']) !!}
    </div>
    @include('system::backend.tpl.inc_search')
    {!! Form::close() !!}

    <table class="layui-table">
        <tr>
            <th class="w72">ID</th>
            <th>转账备注</th>
            <th class="w72">真实姓名</th>
            <th class="w72">转账金额</th>
            <th>转账时间</th>
            <th class="w72">当前状态</th>
            <th>备注</th>
            <th class="w48">操作</th>
        </tr>
        @if ($pager->total())
            @foreach($pager as $item)
                <tr class="border">
                    <td>{!! $item->id !!}</td>
                    <td>{!! $item->trans_memo !!}</td>
                    <td>{!! $item->other_account_fullname !!}</td>
                    <td>{!! $item->trade_amount !!}</td>
                    <td>{!! $item->trade_time !!}</td>
                    <td>{!! \Auto\Models\AutoAlipayTrade::kvStatus($item->status) !!}</td>
                    <td>{{$item->reason}}</td>
                    <td>
                        @if ($_pam->can('handle', $item))
                            <a href="{{ route_url('auto:backend.auto_alipay.handle', [$item->id]) }}"
                               class="J_iframe" data-toggle="tooltip" title="操作充值">
                                <i class="fa fa-money-check-alt"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">
                    @include('system::backend.tpl.inc_empty')
                </td>
            </tr>
        @endif
    </table>
    <div class="pull-right">
        {{ $pager->render() }}
    </div>
@endsection