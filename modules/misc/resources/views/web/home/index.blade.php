@extends('misc::tpl.web')
@section('body-class', 'x--prod')
@section('body-main')
    @include('misc::tpl._header', [
        'type' => 'home'
    ])
    <div class="x--block block-light prod-pro-ser" id="pro-ser">
        <div class="pro-ser-top">
            <div class="container ">
                <h3 class="block-title with-desc">产品优势</h3>
                <div class="block-desc">奇云盾专注而极致，我们已获得游戏、视频、金融等行业领袖的信赖和支持！</div>
                <ul class="pro-ser-header">
                    <li :class="{'pro-ser-calc': true, 'active': active==='ecs' }" @click="switchEcs">
                        计算
                    </li>
                    <li :class="{'pro-ser-calc': true, 'active': active!=='ecs' }" @click="switchDdos">
                        安全
                    </li>
                </ul>
            </div>
        </div>
        <div class="pro-ser-detail">
            <div class="container">
                <transition-group :name="effectMenu" tag="div">
                    <div class="row" id="ecs-ctr" key="ecs" v-if="active==='ecs'">
                        <div class="col-sm-2 detail-nav">
                            <ul>
                                <li class="active">云服务器</li>
                            </ul>
                        </div>
                        <div class="col-sm-10 detail-wrapper">
                            <div class="detail-header">
                                提供中国和全球20多个地区，提供可选Intel Xeon(Cascade Lake)全新一代CPU、内存高性能、高IO云服务器；<a href="/webapp/#/ecs">更多详情查看&gt;&gt;</a>
                            </div>
                            <div class="detail-content">
                                <div>
                                    <h4>云服务器</h4>
                                    <p class="detail-desc">在全球20多个地区，提供基于全新一代CPU、高性能、高IO云服务器；158元/月起</p>
                                    <ul>
                                        <li><span>2核</span><em>CPU</em></li>
                                        <li><span>4G</span><em>内存</em></li>
                                        <li><span>2M</span><em>带宽</em></li>
                                        <li><span>40G</span><em>系统盘</em></li>
                                    </ul>
                                    <p class="detail-buy">
                                        <span class="detail-area">北京/香港 等</span>
                                        <span>
                                            <span class="detail-price">160元/月</span>
                                            <a href="/webapp/#/ecs?spec=u2-m4" class="btn btn-sm btn-primary">158元/月</a>
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <h4>高防云服务器</h4>
                                    <p class="detail-desc">提供单云服务器高达1T的防御能力，纯SSD高性能新代CPU服务器；1399元/月起</p>
                                    <ul>
                                        <li><span>4核</span><em>CPU</em></li>
                                        <li><span>8G</span><em>内存</em></li>
                                        <li><span>10M</span><em>带宽</em></li>
                                        <li><span>30G</span><em>系统盘</em></li>
                                    </ul>
                                    <p class="detail-buy">
                                        <span class="detail-area">北京/香港 等</span>
                                        <span>
                                            <span class="detail-price">原价 : 1885元/月</span>
                                            <a href="/webapp/#/box?spec=u4-m8" class="btn btn-sm btn-primary">1399元/月</a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="detail-more">
                                <a href="/webapp/#/ecs">更多产品&gt;&gt;</a>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="ddos-ctr" key="ddos" v-if="active!=='ecs'">
                        <div class="col-sm-2 detail-nav">
                            <ul>
                                <li :class="{active: active==='ddos'}" @click="switchSafeDdos">高防服务器</li>
                                <li :class="{active: active==='ip'}" @click="switchSafeIp">高防IP</li>
                            </ul>
                        </div>
                        <div class="col-sm-10 detail-wrapper">
                            <transition-group :name="effectSafe" tag="div" class="wrapper-block">
                                <div key="ddos" v-if="active==='ddos'" class="detail-safe-ctr">
                                    <div class="detail-header">
                                        包含Intel Xeon V2 到 新一代Intel Xeon(Skylake) Platinum CPU ，纯SSD 高IO、强劲性能的服务器，增强防御CC 攻击，单服务器最高可以防御1000G DDOS 攻击。<a
                                            href="/webapp/#/box?spec=u2-m4">更多详情查看&gt;&gt;</a>
                                    </div>
                                    <div class="detail-content">
                                        <div>
                                            <h4>高防云服务器</h4>
                                            <p class="detail-desc">提供单云服务器高达1T的防御能力，纯SSD高性能新代CPU服务器，让安全细化到每一个角落；1399元/月起</p>
                                            <ul>
                                                <li><span>4核</span><em>CPU</em></li>
                                                <li><span>8G</span><em>内存</em></li>
                                                <li><span>10M</span><em>带宽</em></li>
                                                <li><span>30G</span><em>系统盘</em></li>
                                            </ul>
                                            <p class="detail-buy">
                                                <span class="detail-area">北京/香港 等</span>
                                                <span>
                                                    <span class="detail-price">1720元/月</span>
                                                    <a href="/webapp/#/box?spec=u4-m8" class="btn btn-sm btn-primary">1399元/月</a>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <h4>高防裸金属服务器</h4>
                                            <p class="detail-desc">提供单点高达1000G DDOS 防御能力，增强防CC攻击，纯SSD高性能新代CPU服务器；1999元/月起</p>
                                            <ul>
                                                <li><span>4核</span><em>CPU</em></li>
                                                <li><span>16G</span><em>内存</em></li>
                                                <li><span>10M</span><em>带宽</em></li>
                                                <li><span>250G</span><em>系统盘</em></li>
                                                <li><span>30G</span><em>标准防御</em></li>
                                            </ul>
                                            <p class="detail-buy">
                                                <span class="detail-area">北京/香港 等</span>
                                                <span>
                                                    <span class="detail-price">原价 : 2150元/月</span>
                                                    <a href="/webapp/#/box?spec=u4-m16" class="btn btn-sm btn-primary">1999元/月</a>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="detail-more">
                                        <a href="/webapp/#/box">更多产品&gt;&gt;</a>
                                    </div>
                                </div>
                                <div key="ip" v-if="active==='ip'" class="detail-safe-ctr">
                                    <div class="detail-header">
                                        奇云盾DDoS防护服务是以骨干网的DDoS防护网络为基础，结合DDoS攻击检测和智能防护体系，向您提供可管理的DDoS防护服务，自动快速的缓解网络攻击对业务造成的延迟增加，访问受限，业务中断等影响，从而减少业务损失，降低潜在DDoS攻击风险。
                                    </div>
                                    <div class="detail-ip">
                                        <div class="row without-style">
                                            <div class="col-xl">
                                                <div class="d-flex position-relative align-items-start">
                                                    <img src="/app/images/prod/good-ddos.png" class="flex-shrink-1" alt="超大流量型DDoS攻击防护">
                                                    <div>
                                                        <h5 class="mt-0">超大流量型DDoS攻击防护</h5>
                                                        <p>提供可弹性扩缩的分布式云防护节点，当发生超大流量攻击时，可根据影响范围，迅速将业务分摊到未受影响的节点。</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl">
                                                <div class="d-flex position-relative align-items-start">
                                                    <img src="/app/images/prod/good-cc.png" class="flex-shrink-1" alt="超大流量型DDoS攻击防护">
                                                    <div>
                                                        <h5 class="mt-0">精准防御CC攻击</h5>
                                                        <p>通过创新的报文基因技术，在用户与防护节点之间建立加密的IP隧道，准确识别合法报文，阻止非法流量进入，可彻底防御CC攻击等资源消耗型攻击。</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="detail-more">
                                        <a href="{!! misc_qq('kf') !!}">定制咨询&gt;&gt;</a>
                                    </div>
                                </div>
                            </transition-group>
                        </div>
                    </div>
                </transition-group>
            </div>
        </div>
    </div>
    <script>
    // https://the-allstars.com/vue2-animate/
    new Vue({
        el : '#pro-ser',
        data() {
            return {
                active : 'ecs',
                effectMenu : 'fadeRight',
                effectSafe : 'fadeUp'
            }
        },
        methods : {
            switchEcs : function() {
                this.active     = 'ecs';
                this.effectMenu = 'fadeLeft';
            },
            switchSafeDdos : function() {
                this.active     = 'ddos';
                this.effectSafe = 'fadeDown';
            },
            switchSafeIp : function() {
                this.active     = 'ip';
                this.effectSafe = 'fadeUp';
            },
            switchDdos : function() {
                this.active     = 'ddos';
                this.effectMenu = 'fadeRight';
            }
        }
    })
    </script>

    <div class="x--block block-dark prod-good-fer">
        <div class="container">
            <h3 class="block-title with-desc">奇云盾优势</h3>
            <div class="block-desc">多功能、优质服务器</div>
            <div class="fer-wrapper">
                <div class="fer-cat">
                    <span class="fer-pad">&nbsp;</span>
                    <span class="fer-x">
                        分<br>类
                    </span>
                    <span class="fer-3x">弹 <br> 性 <br> 计 <br> 算</span>
                    <span class="fer-3x">储<br>存</span>
                    <span class="fer-2x">网<br>络</span>
                    <span class="fer-3x">安<br>全</span>
                    <span class="fer-x">服<br>务</span>
                </div>
                <div class="fer-sub">
                    <span class="fer-pad">&nbsp;</span>
                    <div class="fer-sub-wrapper">
                        <span class="fer-x">功能</span>
                        <span class="fer-3x">功能健全 <br> 多样配置 <br> 弹性升级</span>
                        <span class="fer-3x">数据快照 <br> 存储保障 <br> 读写性能</span>
                        <span class="fer-2x">自动调整 <br> 自定内网</span>
                        <span class="fer-3x">防火墙 <br> 安全组 <br> 登录安全检测</span>
                        <span class="fer-x">售后</span>
                    </div>
                </div>
                <div class="fer-detail">
                    <div class="fer-x">奇云盾服务器</div>
                    <div class="fer-3x">
                        <p>提供开机 、重启、关机、重装、重建等20多项功能</p>
                        <p>支持多种计算类型（包含通用型、新一代、高主频的CPU），支持多种储存类</p>
                        <p>Linux和部分windows支持热升级技术，升级CPU、内存、外网带宽，均不必重启</p>
                    </div>
                    <div class="fer-3x">
                        <p>支持实时快照和自定义计划快照</p>
                        <p>多副本的可靠性保护机制数据</p>
                        <p>高性能低延时的IO读写，IOPS 高达</p>
                    </div>
                    <div class="fer-2x">
                        <p>包含国内BGP、电信、联通、移动，香港CN2，国际带宽多种类型，购买带宽可以</p>
                        <p>支持自定义组建内网，最高内网带宽10Gbps</p>
                    </div>
                    <div class="fer-3x">
                        <p>提供防御CC、SYN攻击，高防类的提供防御DDOS攻击，最高防御1000 GDDOS 攻击</p>
                        <p>支持网络安全组策略，保护进、出的网络安全</p>
                        <p>对检测并阻断服务器登录（ssh、RDP）爆破</p>
                    </div>
                    <div class="fer-x">
                        <p>提供7*24小时全年全天候不间断的服务，支持QQ、微信、电话服务支持</p>
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
    @include('misc::web.home._feat')
    @include('misc::web.home._waf')
    @include('misc::web.home._cooper')
    @include('misc::tpl._footer')
@endsection