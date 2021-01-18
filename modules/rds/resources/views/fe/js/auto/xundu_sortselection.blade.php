<p>autosize 示例</p>
<hr>
<link rel="stylesheet" type="text/css" href="../../../../assets/js/xundu/xundu_sortselection/xundu_sortselection.css">
<div class="row">
    <div class="col-md-12">
        车企店多选<input type="text" class="nation" value="" data-value="">
        <hr>
        <pre id="J_html">车企店多选&lt;input type="text" class="nation" value="" data-value=""&gt;</pre>
        <pre id="J_script"></pre>
    </div>
</div>
<script src="../../../../assets/js/xundu/xundu_sortselection/load_hycode.js"></script>
<script id="J_script_source">
    require(['jquery','xundu/xundu_sortselection/xundu_sortselection'],function($,xundu_sortselection){
        $('.nation').click(function(){xundu_sortselection.appendselectbar(this,'duoxuan')})
    })
</script>
