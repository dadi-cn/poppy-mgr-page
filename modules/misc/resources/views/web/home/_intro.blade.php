<div class="x--block block-dark prod-good-fer">
    <div class="container">
        <h3 class="block-title with-desc">网站内容</h3>
        <div class="block-desc">学习经历, 踩坑历史, 框架文档</div>
        <div class="fer-wrapper">
            <div class="fer-cat">
                <span class="fer-pad">&nbsp;</span>
                <span class="fer-x">
                    分<br>类
                </span>
                <span class="fer-3x">框 <br> 架</span>
                <span class="fer-3x">笔 <br> 记</span>
                {{--                <span class="fer-2x">网<br>络</span>--}}
                {{--                <span class="fer-3x">安<br>全</span>--}}
                <span class="fer-x">学 <br> 习</span>
            </div>
            <div class="fer-sub">
                <span class="fer-pad">&nbsp;</span>
                <div class="fer-sub-wrapper">
                    <span class="fer-x">功能</span>
                    <span class="fer-3x">命令化 <br> 常用模块 <br> 管理后台</span>
                    <span class="fer-3x">开发文档 <br> 系统 <br> Nginx</span>
                    {{--                    <span class="fer-2x">自动调整 <br> 自定内网</span>--}}
                    {{--                    <span class="fer-3x">防火墙 <br> 安全组 <br> 登录安全检测</span>--}}
                    <span class="fer-x">成长</span>
                </div>
            </div>
            <div class="fer-detail">
                <div class="fer-x">内容介绍</div>
                <div class="fer-3x">
                    <p>使用命令管理网站模块创建和使用, 快速, 便捷</p>
                    <p>多种模块, 自由组合</p>
                    <p>基于 layui 的后台管理系统</p>
                </div>
                <div class="fer-3x">
                    <p>开发经历</p>
                    <p>Mac/Linux 常用工具以及说明</p>
                    <p>服务器详解</p>
                </div>
                {{--                <div class="fer-2x">--}}
                {{--                    <p>包含国内BGP、电信、联通、移动，香港CN2，国际带宽多种类型，购买带宽可以</p>--}}
                {{--                    <p>支持自定义组建内网，最高内网带宽10Gbps</p>--}}
                {{--                </div>--}}
                {{--                <div class="fer-3x">--}}
                {{--                    <p>提供防御CC、SYN攻击，高防类的提供防御DDOS攻击，最高防御1000 GDDOS 攻击</p>--}}
                {{--                    <p>支持网络安全组策略，保护进、出的网络安全</p>--}}
                {{--                    <p>对检测并阻断服务器登录（ssh、RDP）爆破</p>--}}
                {{--                </div>--}}
                <div class="fer-x">
                    <p>有学习才有成长</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

let ferAddClass = debounce(function() {
    let $fer         = $('.prod-good-fer');
    let scrollAt     = $(this).scrollTop();
    let screenHeight = $(window).height();
    let elePos       = $fer.position().top;

    let con = ( scrollAt > ( elePos - screenHeight + 300 ) );
    if (con && !$fer.data('added')) {
        $('.prod-good-fer .fer-wrapper > div').addClass('fadeInRight');
        $fer.data('added', 1)
    }
}, 100);

$(function() {
    ferAddClass()
    $(document).on('scroll', ferAddClass)
})
</script>