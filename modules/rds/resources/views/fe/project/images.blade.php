@extends('system::tpl.bt3')
@section('bootstrap-main')
    <style>
        .max_image img {
            max-width  : 50px;
            max-height : 50px;
        }
    </style>
    @include('slt::fe.inc.project_link')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{!! $project !!} 静态图片</h3>
                <p class="alert alert-info">静态图片</p>
                @foreach($images as $folder => $subImages)
                    <h4>{!! $folder !!}</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>示例</th>
                            <th>地址</th>
                            <th>操作</th>
                        </tr>
                        @foreach($subImages as $url)
                            <tr>
                                <td class="max_image"><a href="{!! $url !!}"><img src="{!! $url !!}" alt=""></a></td>
                                <td>{!! $url !!}</td>
                                <td><i class="fa fa-close"></i></td>
                            </tr>
                        @endforeach
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection