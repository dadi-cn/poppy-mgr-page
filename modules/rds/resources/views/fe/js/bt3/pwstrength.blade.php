<p class="alert alert-info" id="introduce">
    基于bootstrap3的密码强度验证插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/tanepiper/jquery.ui.pwstrength">GITHUB</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <input id="passwd1" type="password" class="form-control"/>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;input id="passwd1" type="password" class="form-control" /&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery', 'i18next', 'bt3', 'bt3.pwstrength'], function ($, i18next) {
        var options = {};
        options.common = {
            minChar: 8
        };
        options.rules = {
            activated: {
                wordTwoCharacterClasses: true,
                wordRepetitions        : true
            }
        };
        options.ui = {
            showProgressBar: true,
            showErrors     : true,
            showPopover    : true
        };
        options.i18n = {
            t: function (key) {
                function _translate(key) {
                    var keys = {
                        "wordLength"             : "您输入的密码较短",
                        "wordNotEmail"           : "密码中包含了邮箱地址",
                        "wordSimilarToUsername"  : "密码中包含了用户名",
                        "wordTwoCharacterClasses": "请使用不同的字符类型",
                        "wordRepetitions"        : "密码中太多重复字符",
                        "wordSequences"          : "您的密码是一个序列",
                        "errorList"              : "警告",
                        "veryWeak"               : "非常弱",
                        "weak"                   : "弱",
                        "normal"                 : "普通",
                        "medium"                 : "中等",
                        "strong"                 : "强",
                        "veryStrong"             : "非常强"
                    };
                    return keys[key];
                }

                var result = _translate(key); // Do your magic here
                return result === key ? '' : result; // This assumes you return the
                // key if no translation was found, adapt as necessary
            }
        };


        $('#passwd1').pwstrength(options);
    });
</script>
