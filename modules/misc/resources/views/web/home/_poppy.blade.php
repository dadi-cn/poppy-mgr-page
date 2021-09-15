<div class="x--block block-light prod-pro-ser" id="pro-ser">
    <div class="pro-ser-top">
        <div class="container ">
            <h3 class="block-title with-desc">框架介绍</h3>
            <div class="block-desc">
                基于 Laravel 6.0 LTS 的模块化开发框架, 项目由 `框架`, `核心`, `组件` 构成
            </div>
            <ul class="pro-ser-header">
                <li :class="{'pro-ser-calc': true, 'active': active==='system' }" @click="switchSystem">
                    系统
                </li>
                <li :class="{'pro-ser-calc': true, 'active': active==='module' }" @click="switchModule">
                    扩展
                </li>
            </ul>
        </div>
    </div>
    <div class="pro-ser-detail">
        <div class="container">
            <transition-group :name="effectMenu" tag="div">
                <div class="row" id="ecs-ctr" key="system" v-if="active==='system'">
                    <div class="col-sm-2 detail-nav">
                        <ul>
                            <li :class="{'active': system==='framework' }" @click="system='framework'">框架</li>
                            <li :class="{'active': system==='system' }" @click="system='system'">系统</li>
                        </ul>
                    </div>

                    <div class="col-sm-10 detail-wrapper">
                        <transition-group :name="effectSafe" tag="div" class="wrapper-block">
                            <div key="framework" v-if="system==='framework'" class="detail-safe-ctr">
                                <div class="detail-header">
                                    Poppy Framework 是基于 Laravel 6.0 的模块化加载工具
                                </div>
                                <div class="detail-content">
                                    <div>
                                        <h4>完整的模块化命令行工具</h4>
                                        <p class="detail-desc">像 Laravel 一样使用命令行快速创建模块所需的监听, 控制器, 事件, 模型, 测试等</p>
                                        <h4>常用的 Util 帮助函数</h4>
                                        <p class="detail-desc">图像, 字串, 时间, 环境, 满足开发所需大部分函数</p>
                                        <h4>接口约定</h4>
                                        <p class="detail-desc">完善和前端接口的约定以及数据返回</p>
                                    </div>
                                    <div>
                                        <h4>灵活配置</h4>
                                        <p class="detail-desc">满足分页, 消息提示, SEO</p>
                                        <h4>扩展开发</h4>
                                        <p class="detail-desc">支持扩展快速开发, 基于 composer 1.x (Laravel 6.0 不支持 2.x)</p>
                                    </div>
                                </div>
                                <div class="detail-more">
                                    <a href="https://wulicode.com/doc/framework/">查看文档&gt;&gt;</a>
                                </div>
                            </div>
                            <div key="system" v-if="system==='system'" class="detail-safe-ctr">
                                <div class="detail-header">
                                    基于管理后台以及权限验证管理模组
                                </div>
                                <div class="detail-content">
                                    <div>
                                        <h4>Core / 核心</h4>
                                        <p class="detail-desc">封装基于 Redis 的缓存管理, RBAC 权限校验, 文档生成工具和常用运维操作</p>
                                        <h4>System / 系统</h4>
                                        <p class="detail-desc">基于数据库的权限校验, JWT 封装, 灵活 Access-Origin 配置, 灵活加密校验模组</p>

                                    </div>
                                    <div>
                                        <h4>Mgr-Page / 后台管理</h4>
                                        <p class="detail-desc">基于 Poppy 基础模块, Layui 的管理后台</p>
                                    </div>
                                </div>
                                <div class="detail-more">
                                    <a href="https://wulicode.com/doc/poppy/">查看文档&gt;&gt;</a>
                                </div>
                            </div>
                        </transition-group>
                    </div>

                </div>
                <div class="row" id="ddos-ctr" key="module" v-if="active==='module'">
                    <div class="col-sm-2 detail-nav">
                        <ul>
                            <li :class="{active: module==='module'}" @click="module='module'">系统扩展</li>
                            <li :class="{active: module==='extension'}" @click="module='extension'">组件扩展</li>
                        </ul>
                    </div>
                    <div class="col-sm-10 detail-wrapper">
                        <transition-group :name="effectSafe" tag="div" class="wrapper-block">
                            <div key="ddos" v-if="module==='module'" class="detail-safe-ctr">
                                <div class="detail-header">
                                    官方封装的系统扩展
                                </div>
                                <div class="detail-content">
                                    <div>
                                        <h4>版本管理</h4>
                                        <p class="detail-desc">完成对 android/ios 的包管理, 以及包的上传和更新以及在系统信息中返回最新包</p>
                                        <h4>Aliyun Oss</h4>
                                        <p class="detail-desc">封装对于Aliyun Oss 的上传和权限校验返回</p>
                                    </div>
                                    <div>
                                        <h4>敏感词</h4>
                                        <p class="detail-desc">基于敏感词拆分, 对敏感词实现句子/单词的校验和替换</p>
                                        <h4>Aliyun Push</h4>
                                        <p class="detail-desc">对于 aliyun 推送包的封装</p>
                                    </div>
                                </div>
                                <div class="detail-more">
                                    <a href="https://wulicode.com/doc/">文档&gt;&gt;</a>
                                </div>
                            </div>
                            <div key="ip" v-if="module==='extension'" class="detail-safe-ctr">
                                <div class="detail-header">
                                    基础扩展, 对于三方组件的封装
                                </div>
                                <div class="detail-content">
                                    <div>
                                        <h4>Alipay</h4>
                                        <p class="detail-desc">对支付宝的证书/公私钥验证以及回调的封装</p>
                                        <h4>Pinyin</h4>
                                        <p class="detail-desc">基于 Overtrue 对其组件做的 poppy 扩展</p>
                                    </div>
                                    <div>
                                        <h4>IP Store</h4>
                                        <p class="detail-desc">基于 Mon17/纯真库实现的 IP 模糊类库</p>
                                    </div>
                                </div>
                                <div class="detail-more">
                                    <a href="https://wulicode.com/doc/">文档&gt;&gt;</a>
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
            active : 'system',
            system : 'framework',
            module : 'module',
            effectMenu : 'fadeRight',
            effectSafe : 'fadeUp'
        }
    },
    methods : {
        switchSystem : function() {
            this.active     = 'system';
            this.effectMenu = 'fadeLeft';
        },
        switchModule : function() {
            this.active     = 'module';
            this.effectMenu = 'fadeRight';
        },
        switchSafeDdos : function() {
            this.active     = 'ddos';
            this.effectSafe = 'fadeDown';
        },
        switchSafeIp : function() {
            this.active     = 'ip';
            this.effectSafe = 'fadeUp';
        }

    }
})
</script>