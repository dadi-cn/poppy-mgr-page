<p class="alert alert-info" id="introduce">
    日期时间选择插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/stefangabos/Zebra_Datepicker">GITHUB</a></li>
    <li><a target="_blank" href="http://stefangabos.ro/jquery/zebra-datepicker/">docs</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <input type="text" value="" id="datepicker"/>
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;input type="text" value="" id="datepicker"/&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['jquery', 'jquery.zebra-datepicker'], function ($) {
        $('#datepicker').Zebra_DatePicker({
                    lang_clear_date  : "Clear",
                    months           : ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                    days             : ['日', '一', '二', '三', '四', '五', '六'],
                    show_select_today: '今天',
                    direction        : false
                }
        );
    });
</script>
<br>
<br>
<div class="row" id="sample">
    <div class="col-md-8">
        <input type="text" value="" id="datepicker1"/> ~ <input type="text" value="" id="datepicker2"/>
        <br>
    </div>
</div>
<hr>

<div class="row J_wrap">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre class="J_html">&lt;input type="text" value="" id="datepicker"/&gt;</pre>
        <pre class="J_script"></pre>
    </div>
    <script class="J_script_source">
        require(['moment', 'jquery', 'jquery.zebra-datepicker'], function (moment, $) {
            var today_format1 = moment().format('YYYY-MM-DD').toString(),
                    today_format2 = moment().format('DD MM YYYY').toString(),
                    $start_date = $('#datepicker1'),
                    $end_date = $('#datepicker2');
            var common_opt = {
                        lang_clear_date  : "Clear",
                        months           : ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                        days             : ['日', '一', '二', '三', '四', '五', '六'],
                        show_select_today: '今天',
                        direction        : false
                    },
                    start_opt = $.extend({}, common_opt, {
                        onSelect: function () {
                            var from_date = $start_date.val(),
                                    datepicker = $end_date.data('Zebra_DatePicker');
                            if (from_date == today_format1) {
                                datepicker.update({
                                    disabled_dates: ['*', '*', '*', '*'],
                                    enabled_dates : [today_format2]
                                });
                            } else {
                                datepicker.update({
                                    direction: [false, from_date]
                                });
                            }
                        }
                    }),
                    end_opt = $.extend({}, common_opt, {
                        onSelect: function () {
                            var from_date = $end_date.val(),
                                    datepicker = $start_date.data('Zebra_DatePicker');
                            datepicker.update({
                                start_date: from_date,
                                direction : ['1970-01-01', from_date]
                            });
                        }
                    });
            $start_date.Zebra_DatePicker(start_opt);
            $end_date.Zebra_DatePicker(end_opt);
        });
    </script>
</div>

