@extends('lemon.template.index')
@section('index-main')
    <div class="container">
        @include('lemon.inc.header')
    </div>
    <div class="container">
        <h1>cp.js</h1>
        <p class="alert alert-info" id="introduce">
            cp.js是自定义的一个js组件，引用cp.js可通过向元素添加类名的方式来方便的为相应的dom元素添加功能。
        </p>

        <h3>J_dialog</h3>
        <hr>
        <h4>参数值</h4>
        <table class="table">
            <tr>
                <th>data-tip(可选)</th>
                <td>鼠标滑过之后的提示项目</td>
            </tr>
            <tr>
                <th>data-title(可选)</th>
                <td>弹出框标题, 默认是J_dialog里边包含的html代码</td>
            </tr>
            <tr>
                <th>data-width(可选)</th>
                <td>弹窗宽度, 默认是 400</td>
            </tr>
            <tr>
                <th>data-height(可选)</th>
                <td>弹窗高度, 默认是 auto</td>
            </tr>
        </table>
        <div class="panel panel-default">
            <div class="panel-heading">
                通过添加J_dialog类名来实现简单弹出
            </div>
            <div class="panel-body">
                <button class="J_dialog" data-title="这是标题" data-tip="弹出内容" data-width="800" data-height="800">点击弹出
                </button>
            </div>
        </div>
        <pre id="J_html">&lt;button class="J_dialog" data-title="这是标题" data-tip="弹出内容" data-width="800" data-height="800"&gt;点击弹出&lt;/button&gt;</pre>
        <hr>
        <hr>


        <h3>J_iframe</h3>
        <hr>
        <h4>参数值</h4>
        <table class="table">
            <tr>
                <th>data-href</th>
                <td>弹出提示HTML的地址</td>
            </tr>
            <tr>
                <th>data-title(可选)</th>
                <td>弹出框标题, 默认是J_dialog里边包含的html代码</td>
            </tr>
            <tr>
                <th>data-width(可选)</th>
                <td>弹窗宽度, 默认是 500</td>
            </tr>
            <tr>
                <th>data-height(可选)</th>
                <td>弹窗高度, 默认是 500</td>
            </tr>
        </table>
        <div class="panel panel-default">
            <div class="panel-heading">通过为a标签添加J_iframe类名来实现简单iframe弹框，通过添加data-href属性定制弹出提示HTML</div>
            <div class="panel-body">
                <a class="J_iframe" data-title="这是标题" data-width="800" data-height="500" href="http://www.baidu.com">点击弹出</a>
            </div>
        </div>
        <pre id="J_html">&lt;a class="J_iframe" data-title="这是标题" data-width="800" data-height="500" href="http://www.baidu.com"&gt;点击弹出&lt;/a&gt;</pre>
        <hr>
        <hr>


        <h3>J_checkAll，J_checkItem</h3>
        <hr>
        <h4>无参数值</h4>
        <div class="panel panel-default">
            <div class="panel-heading">通过选中类名为J_checkAll的checkbox来全部选中类名为J_checkItem的checkbox</div>
            <div class="panel-body">
                <p><input type="checkbox" class="J_checkAll">全选</p>
                <input type="checkbox" class="J_checkItem">条目1<input type="checkbox" class="J_checkItem">条目2<input
                        type="checkbox" class="J_checkItem">条目3
            </div>
        </div>
        <pre id="J_html"> &lt;p&gt;&lt;input type="checkbox" class="J_checkAll"&gt;全选&lt;/p&gt;
&lt;input type="checkbox" class="J_checkItem"&gt;条目1&lt;input type="checkbox" class="J_checkItem"&gt;条目2&lt;input type="checkbox" class="J_checkItem"&gt;条目3</pre>
        <hr>
        <hr>


        <h3>J_image_preview</h3>
        <hr>
        <h4>无参数值</h4>
        <p>图片预览</p>
        <div class="panel panel-default">
            <div class="panel-heading">为图片添加J_image_preview实现鼠标悬浮和点击预览效果</div>
            <div class="panel-body">
                <img src="{!! fake_thumb(200,200) !!}" class="J_image_preview" width="30" height="30">
            </div>
        </div>
        <pre id="J_html"> &lt;img src="{!! fake_thumb(200,200) !!}
            " class="J_image_preview" width="30" height="30"&gt;</pre>
        <hr>
        <hr>


        <h3>J_delay</h3>
        <hr>
        <p>data-time(可选)</p>
        <div class="panel panel-default">
            <div class="panel-heading">点击按钮或者超链接时为此按钮、超链接添加J_delay类实现延时禁用效果，防止短时间内连续跳转。</div>
            <div class="panel-body">
                <a href="http://www.baidu.com" class="J_delay">链接地址</a>
            </div>
        </div>
        <pre id="J_html"> &lt;a href="http://www.baidu.com" class="J_delay"&gt;链接地址&lt;/a&gt;</pre>
        <hr>
        <hr>


        <h3>J_submit</h3>
        <hr>
        <h4>参数值</h4>
        <table class="table">
            <tr>
                <th>data-url</th>
                <td>表单要提交到的地址</td>
            </tr>
        </table>
        <div class="panel panel-default">
            <div class="panel-heading">把当前表单的数据临时提交到指定的地址,data-url属性为提交到的地址。</div>
            <div class="panel-body">
                <form>
                    <input type="text" value="需要提交的内容">
                    <input type="submit" class="J_submit" data-url="someURL">
                </form>
            </div>
        </div>
        <pre id="J_html">&lt;form&gt;
      &lt;input type="text" value="需要提交的内容" &gt;
      &lt;input type="submit" class="J_submit" data-url="someURL"&gt;
&lt;/form&gt;</pre>
        <hr>
        <hr>


        <h3>J_delete</h3>
        <hr>
        <h4>参数值</h4>
        <table class="table">
            <tr>
                <th>data-confirm(可选)</th>
                <td>删除时的提示内容</td>
            </tr>
            <tr>
                <th>href</th>
                <td>提交的ajax的url</td>
            </tr>
        </table>
        <div class="panel panel-default">
            <div class="panel-heading">为a标签添加ajax删除的操作，data-confirm属性的值为删除时的提示内容。href为提交的ajax的url</div>
            <div class="panel-body">
                <a href="ajaxURL" data-confirm="确实删除么？" class="J_delete">删除</a>
            </div>
        </div>
        <pre id="J_html">&lt;a href="ajaxURL" data-confirm="确实删除么？" class="J_delete"&gt;删除&lt;/a&gt;</pre>
        <hr>
        <hr>


        <h3>J_info</h3>
        <link rel="stylesheet" type="text/css" href="{!! assets('css/3rd/metronic/pages/profile.css') !!}" media="all"/>
        <link rel="stylesheet" type="text/css" href="{!! assets('css/3rd/metronic/global/components-default.css') !!}"
        <hr>
        <h4>参数值</h4>
        <table class="table">
            <tr>
                <th>data-url</th>
                <td>对应触发元素的请求地址，请求地址返回包含一个json文件，格式为：{content:"这里写html内容"}</td>
            </tr>
        </table>
        <div class="panel panel-default">
            <div class="panel-heading">
                通过添加J_info类名来实现简单提示内容
            </div>
            <div class="panel-body">
                <button class="J_info" data-url="http://www.sl_fe.com/project/xundu/data/layerDemo-com.json">讯都信息技术有限公司
                </button>
                <button class="J_info" data-url="http://www.sl_fe.com/project/xundu/data/layerDemo-per.json">张先生
                </button>
            </div>
        </div>
        <pre id="J_html">&lt;button class="J_info" data-url="http://www.sl_fe.com/project/xundu/data/layerDemo-com.json"&gt;讯都信息技术有限公司&lt;/button&gt;
&lt;button class="J_info" data-url="http://www.sl_fe.com/project/xundu/data/layerDemo-per.json"&gt;张先生&lt;/button&gt;</pre>
        <hr>
        <hr>
        <script id="J_script_source">
            require(['jquery', 'lemon/cp'])
        </script>
    </div>
@endsection