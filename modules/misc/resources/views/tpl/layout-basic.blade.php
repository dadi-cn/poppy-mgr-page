@extends('misc::tpl.default')
@section('tpl-main')
    <div class="row">
        <div class="col-md-9">
            @yield('layout-main')
        </div>
        <div class="col-md-3">
            @yield('layout-side')
        </div>
    </div>
@endsection