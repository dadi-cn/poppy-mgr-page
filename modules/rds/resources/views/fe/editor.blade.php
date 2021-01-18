@extends('slt::tpl.default')
@section('head-js')
    @parent
    {!! Html::script('assets/js/re_libs/emmet/emmet.js') !!}
    {!! Html::script('assets/js/libs/ace/1.2.6/ace.js') !!}
    {!! Html::script('assets/js/libs/ace/1.2.6/ext-emmet.js') !!}
@endsection
@section('tpl-main')
    <div class="fe--outer">
        <div class="outer-code" id="code_selector">
            <ul>
                @if ($items->total())
                    @foreach($items as $t)
                        <li>
                            <a href="{!! route('web:fe.editor', [$t->id]) !!}"><i
                                        class="fa fa-angle-right"></i> {!! $t->id !!}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="fe--editor " id="editor">
        <div class="editor-tools">
            <div class="editor-tools-left pull-left">
                <a href="javascript:void(0)" v-on:click="switch_code_selector()" class="pull-left">
                    <i class="iconfont icon-code"></i>
                </a>
                <input type="text" v-model="snippet_title" value="{{ isset($item->title) ? $item->title : '' }}" class="form-control input-sm" placeholder="请输入片段说明">
            </div>
            <div class="editor-tools-center pull-left">
                <div class="btn-group btn-group-xs" role="group">
                    <button type="button" class="btn btn-default" v-bind:class="{'btn-primary':is_html_show}"
                            v-on:click="calc_code_area('html')">Html
                    </button>
                    <button type="button" class="btn btn-default" v-bind:class="{'btn-primary':is_js_show}"
                            v-on:click="calc_code_area('js')">Js
                    </button>
                    <button type="button" class="btn btn-default" v-bind:class="{'btn-primary':is_css_show}"
                            v-on:click="calc_code_area('css')">Css
                    </button>
                    <button type="button" class="btn btn-disable">Preview</button>
                </div>
            </div>
            <div class="editor-tools-right pull-right">
                <a v-on:click="switchAuto()" href="javascript:void(0)">
                    <i class="iconfont" v-bind:class="[is_auto_run ? 'icon-check-selection' : 'icon-check-empty' ]"></i>
                    实时预览
                </a>
                <a href="javascript:void(0)" v-on:click="preview()"><i class="iconfont icon-run"></i> 运行</a>
                <a href="javascript:void(0)" v-on:click="save()"><i class="iconfont icon-save"></i> 保存</a>
            </div>
        </div>
        {!! Form::open(['target'=>'code_preview', 'route'=> 'web:fe.run', 'id'=> 'code_form']) !!}
        {!! Form::hidden('html', null, ['id'=> 'html_content']) !!}
        {!! Form::hidden('js', null, ['id'=> 'js_content']) !!}
        {!! Form::hidden('css', null, ['id'=> 'css_content']) !!}
        <div class="editor-main clearfix">
            <div class="editor-html editor-part" v-show="is_html_show">
                <pre class="editor-expand"><br></pre>
                <span class="editor-label">HTML</span>
                <pre id="code_html" class="editor-area">{{ isset($item->html) ? $item->html : '' }}</pre>
            </div>
            <div class="editor-js editor-part" v-show="is_js_show">
                <pre class="editor-expand"><br></pre>
                <span class="editor-label">Js</span>
                <pre id="code_js" class="editor-area">{{ isset($item->javascript) ? $item->javascript : '' }}</pre>
            </div>
            <div class="editor-css editor-part" v-show="is_css_show">
                <pre class="editor-expand"><br></pre>
                <span class="editor-label">CSS</span>
                <pre id="code_css" class="editor-area">{{ isset($item->css) ? $item->css : '' }}</pre>
            </div>
            <div class="editor-preview editor-part">
                <pre class="editor-expand"><br></pre>
                <span class="editor-label">Preview</span>
                <div class="editor-area">
                    <iframe id="code_preview" name="code_preview"></iframe>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        var code_id = {!! $id !!}
	require([
            'sour/editor/rf'
        ])
    </script>
@endsection