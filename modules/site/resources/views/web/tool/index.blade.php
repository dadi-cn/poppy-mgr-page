@extends('site::tpl.default')
@section('head-script')
    @parent
    {!! Html::script('assets/js/libs/ace/ace.js') !!}
@endsection
@section('tpl-main')
    <div class="row">
        <div class="col-md-9">
            <p class="alert alert-info mt10">常用开发工具</p>
        </div>
        <div class="col-md-3">
            @include('site::web.tool._menu')
        </div>
    </div>
@endsection