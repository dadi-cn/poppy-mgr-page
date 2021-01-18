@extends('system::backend.tpl.default')
@section('backend-main')
    <fieldset class="layui-elem-field layui-field-title">
        <legend>账号管理</legend>
        <div class="page-header_action">
            <a href="{{ route_url('auto:backend.login.establish') }}" class="btn btn-default J_iframe">添加账号</a>
        </div>
    </fieldset>

    <table class="layui-table">
        <tr>
            <th class="w72">ID</th>
            <th>登录账号</th>
            <th>平台域名</th>
            <th class="w72">平台类型</th>
            <th class="w72">平台浏览器</th>
            <th class="w72">账号类型</th>
            <th>alias</th>
            <th>请求次数</th>
            <th>浏览器登录的session</th>
            <th class="w72">状态</th>
            <th class="w72">操作</th>
        </tr>
        @if ($items->total())
            @foreach($items as $item)
                <tr class="border">
                    <td>{!! $item->id !!}</td>
                    <td>{!! $item->account!!}</td>
                    <td>{!! $item->platform_domain!!}</td>
                    <td>{!! \Auto\Models\AutoLoginAccount::kvPlatformType($item->platform_type) !!}</td>
                    <td>{!! \Auto\Models\AutoLoginAccount::kvPlatformBrowser($item->platform_browser) !!}</td>
                    <td>{!! \Auto\Models\AutoLoginAccount::kvType($item->type) !!}</td>
                    <td>{!! $item->alias !!}</td>
                    <td>{!! \Cache::get('sum'.$item->account) !!}</td>
                    <td>{!! $item->browser_session !!}</td>
                    <td>{!! \Auto\Models\AutoLoginAccount::kvStatus($item->status) !!}</td>
                    <td>
                        <a href="{{ route_url('auto:backend.login.establish', [$item->id]) }}"
                           class="J_iframe" data-toggle="tooltip" title="编辑">
                            <i class="fa fa-edit text-info"></i>
                        </a>
                        <a href="{{ route_url('auto:backend.login.delete', [$item->id]) }}"
                           class="J_request" data-confirm="确认删除 {{ $item->title }} ?" data-toggle="tooltip" title="删除">
                            <i class="fa fa-times text-danger"></i>
                        </a>
                        @if($item->status === \Auto\Models\AutoLoginAccount::STATUS_DISABLED)
                            <a href="{{ route_url('auto:backend.login.reset', [$item->id]) }}"
                               class="J_request" data-toggle="tooltip" title="重置">
                                <i class="fa fa-undo text-success"></i>
                            </a>
                        @else
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">
                    @include('system::backend.tpl.inc_empty')
                </td>
            </tr>
        @endif
    </table>
    <div class="pull-right">
        {{ $items->render() }}
    </div>
@endsection