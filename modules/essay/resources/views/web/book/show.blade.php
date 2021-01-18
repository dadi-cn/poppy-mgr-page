@extends('site::tpl.layout-basic')
@section('layout-side')
    <div class="wuli--box">
        <h3>操作</h3>
        <div>
            <a class="J_iframe btn btn-primary btn-block" data-width="400" data-height="444"
               data-title="写一章"
               href="{!! route_url('essay:article.popup', [], ['book_id'=>$book->id]) !!}">
                <i class="fa fa-plus"></i>
                写一章
            </a>
        </div>
    </div>
@endsection
@section('layout-main')
    <div class="wuli--box">
        <h3>《{!! $book->title !!}》</h3>
        <table class="table">
            <tr>
                <th class="w72">ID</th>
                <th>标题</th>
                <th class="w216">操作</th>
            </tr>
            {!! $html_tree !!}
        </table>
    </div>
@endsection