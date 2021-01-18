@extends('slt::tpl.default')
@section('head-css')
    @parent
    {!! Html::style('/assets/js/libs/codemirror/5.24.2/codemirror.css') !!}
@endsection
@section('tpl-main')
    <div class="fe--editor editor-wrapper">
        <div class="editor-html" id="code_html">

        </div>
        <div class="editor-js" id="code_js">

        </div>
        <div class="editor-css" id="code_css">

        </div>
        <div class="editor-preview" id="code_preview">

        </div>
    </div>
    <div class="code-outer" id="code-wraper">
        <div class="side-bar" id="left-bar">
            <div class="inner-bar">
                <div class="inner-out">
                    <div class="repo">
                        <a href="https://www.awesomes.cn/repo/moment/moment" target="_blank">
                            <img class="cover" src="/project/lemon/images/default/logo.png">
                            <h4>
                                --
                            </h4>
                        </a>
                    </div>
                    <ul>
                        @if ($items->total())
                            @foreach($items as $t)
                                <li>
                                    <a href="{!! route('web:fe.editor', [$t->id]) !!}"><i class="fa fa-angle-right"></i> {!! $t->id !!}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="code-editor">
            <div class="toolbar">
                <i class="fa fa-bars fold-btn" v-on:click="switchSideBar('#left-bar', 'left')"></i>
                <i class="fa fa-bars fold-btn pull-right" v-on:click="switchBar()"> </i>
                <div class="search">
                    <input class="txt" type="text" placeholder="搜索前端库" v-model="libkey" v-on:keyup="getLibs()">
                </div>
                <a class="pull-right open-modal" href="javascript:void(0)" data-modal="media"><i class="fa fa-file-image-o"></i> 插入媒体</a>
                <a class="pull-right" href="https://www.awesomes.cn/code/15/preview" target="_blank"><i class="fa fa-globe"></i> 新窗口预览</a>
                <a class="pull-right open-login-modal" href="javascript:void(0)" data-modal="fork"><i class="fa fa-code-fork"></i> Fork </a>
                <a v-on:click="switchAuto()" class="pull-right" href="javascript:void(0)">
                    <i class="fa" v-bind:class="[is_auto_run ? 'fa-check-square' : 'fa-square-o' ]"></i> 实时预览</a>
                <a class="pull-right" href="javascript:void(0)" v-on:click="preview()"><i class="fa fa-play"></i> 运行</a>
                <a class="pull-right" href="javascript:void(0)" v-on:click="save()"><i class="fa fa-save"></i> 保存</a>
            </div>
            <div class="p1" style="width: 456px; height: 262px;">
              <span>
                  <textarea id="code-html" style="display: none;">{!! isset($item->html) ? $item->html : '' !!}</textarea>
              </span>
                <span class="online-label">HTML</span>
            </div>
            <div class="splitx" style="height: 262px;"></div>
            <div class="p2 unselect" style="width: 456px; height: 262px;">
                <span><textarea id="code-js"
                                style="display: none;">{!! isset($item->javascript) ? $item->javascript : '' !!}</textarea></span>
                <span class="online-label">JavaScript</span>
            </div>
            <div class="splitx" style="height: 262px;"></div>
            <div class="p3" style="width: 446px; height: 262px;">
                <span><textarea id="code-css" style="display: none;">{!! isset($item->css) ? $item->css : '' !!}</textarea></span>
                <span class="online-label">CSS</span>
            </div>
            <div class="clear"></div>
            <div class="splity"></div>
            <div class="p4" style="height: 389px;">
                <iframe class="code-preview" id="preview" src="#">..</iframe>
                <div class="window-cover" style="display: none;"></div>
            </div>
            <div class="side-bar" id="toolbox">
                <div class="inner-out" style="display: none;">
                    <ul>
                        333
                    </ul>
                </div>
                <div class="loading" style="display: none;">
                    <div class="sk-rotating-plane"></div>
                    <span>如果速度太慢，请访问国内的CDN </span>
                    <ul>
                        <li>
                            <a href="http://cdn.code.baidu.com/" target="_blank"> 百度静态资源公共库</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <style type="text/css">
        .container {
            width : 100%;
        }
    </style>
    {{--
    <script src="./moment 基本用法 - 在线代码_files/closetag.js"></script>
    <script src="./moment 基本用法 - 在线代码_files/xml-fold.js"></script>
    <script src="./moment 基本用法 - 在线代码_files/javascript.js"></script>
    <script src="./moment 基本用法 - 在线代码_files/css.js"></script>
    <script src="./moment 基本用法 - 在线代码_files/online.js"></script>
    --}}
    <script>
	var code_id = {!! $id !!}
	require(['jquery', 'codemirror', 'sour/editor/online'])
    </script>
@endsection