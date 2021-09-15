@extends('misc::tpl.web')
@section('body-class', 'x--prod')
@section('body-main')
    @include('misc::tpl._header', [
        'type' => 'home'
    ])
    @include('misc::web.home._poppy')
    @include('misc::web.home._intro')
    {{--    @include('misc::web.home._feat')--}}
    {{--    @include('misc::web.home._cooper')--}}
    @include('misc::tpl._footer')
@endsection