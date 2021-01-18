<p class="alert alert-info" id="introduce">
    日期范围选择插件。
</p>
<ul class="nav nav-pills" id="link">
    <li><a target="_blank" href="https://github.com/longbill/jquery-date-range-picker">GITHUB</a></li>
    <li><a target="_blank" href="http://longbill.github.io/jquery-date-range-picker/">DOC</a></li>
</ul>
<hr>
<div class="row" id="sample">
    <div class="col-md-4">
        <input type="text" id="demo">
        <input type="hidden" id="start">
        <input type="hidden" id="end">
    </div>
</div>
<hr>
<div class="row" id="code">
    <div class="col-md-12">
        <h4>代码示例</h4>
        <pre id="J_html">&lt;input type="text" id="demo"&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script id="J_script_source">
    require(['moment','jquery','moment-range', 'jquery.date-range-picker'], function (moment,$) {
        var arr = ['2016-11-11:2016-11-20','2016-11-28'];//禁用日期数组
        var ranges = [];
        var range = {};
        for(var i=0; i<arr.length;i++){
            if(arr[i].indexOf(':')>0){
                var arr1 = arr[i].split(':');
                var mon_str0 = arr1[0].substring(5,7);
                var mon_str = arr1[1].substring(5,7);
                var nm0 =  arr1[0].replace(mon_str0,parseInt(mon_str0-1));
                var nm1 =  arr1[1].replace(mon_str,parseInt(mon_str-1));
                var start = moment(nm0, "YYYY-MM-DD");
                var end   = moment(nm1, "YYYY-MM-DD");
                range = moment.range(start, end);
                ranges.push(range);
            }
            else{
                var mon_str0 = arr[i].substring(5,7);
                var nm =  arr[i].replace(mon_str0,parseInt(mon_str0-1));
                var start = moment(nm, "YYYY-MM-DD");
                var end   = moment(nm, "YYYY-MM-DD");
                range = moment.range(start, end);
                ranges.push(range);
            }
        }

        var tdate = new Date();
        var ty = tdate.getFullYear().toString();
        var tm = (tdate.getMonth() + 1).toString();
        var td = tdate.getDate().toString();
        var today = ty + '-' + tm + '-' + td;

        function convertTimes( date ){
            var y = date.getFullYear(date[0]).toString();
            var m = date.getMonth(date[1]-1).toString();
            var d = date.getDate(date[2]).toString();
            var nd = y + '-' + m + '-' + d;
            return nd;
        }

        $('#demo').dateRangePicker(
                {
                    format     : 'YYYY-MM-DD',
                    separator  : ' 至 ',
                    startDate  : today,//today-今天，或者“2016-09-12”
                    endDate    :"",
                    minDays    : "",
                    maxDays    : "",
                    beforeShowDay: function(t) {
                        var nt = convertTimes(t);
                        var mt = moment(nt,"YYYY-MM-DD");
                        var valid = true;
                        for(i=0;i<ranges.length;i++){
                            if (valid) {
                                valid = !mt.within(ranges[i]) ;
                            }
                        }
                        var _class = '';
                        var _tooltip = valid ? '' : '不可选';
                        return [valid,_class,_tooltip];
                    }
                }
        ).bind('datepicker-change',function(event,obj)
        {
            var sy = obj.date1.getFullYear();
            var sm = (obj.date1.getMonth() + 1);
            var sd = obj.date1.getDate();
            var sdate = sy + "-" + sm + "-" + sd;
            var ey = obj.date2.getFullYear();
            var em = (obj.date2.getMonth() + 1);
            var ed = obj.date2.getDate();
            var edate = ey + "-" + em + "-" + ed;
            var str_arr = obj.data1.val.split("至");
            var startdate = str_arr[0].toString();
            var enddate = str_arr[1].toString();

            $("input[type='hidden']#start").val(startdate);
            $("input[type='hidden']#end").val(enddate);
        });
//        $('#demo').data('dateRangePicker').setDateRange('2016-11-22','2016-11-25');//预选时间范围
    });
</script>
