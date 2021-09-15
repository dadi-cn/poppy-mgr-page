@extends('misc::tpl.web')
@section('body-class', 'x--intro')
@section('body-main')
    @include('misc::tpl._header', [
        'type' => 'intro'
    ])
    <div class="x--block block-light">
        <div class="container">
            <div class="intro-wrapper">
                @if($type === 'company')
                    <div class="intro-container intro-company">
                        <div>
                            <img src="/app/images/prod/about-company.png" alt="公司介绍">
                        </div>
                        <div>
                            <h3>公司介绍</h3>
                            <p>
                                奇云盾是国内唯一专注传奇游戏领域的互联网业务平台服务提供商。
                                公司专注为传奇运营用户提供低价高性能云计算产品，致力于云计算应用的易用性开发，
                                并引导云计算在国内普及。目前公司研发以及运营云服务基础设施服务平台（IaaS），面向客户提供基于云计算的IT解决方案与客户服务，
                                拥有丰富的国内BGP等优质的IDC资源。
                            </p>
                            <p>
                                公司一直秉承"以人为本、客户为尊、永续创新"的价值观，坚持"以微笑收获友善，
                                以尊重收获理解，以责任收获支持，以谦卑收获成长"的行为观向客户提供全面优质的互联网应用服务。
                            </p>
                        </div>
                    </div>
                @endif
                @if($type === 'contact')
                    <div class="intro-container intro-contact">
                        <ul>
                            <li>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="iconfont icon-call"></i>
                                </div>
                                <div>
                                    <h3>服务热线：</h3>
                                    <p>{!! sys_setting('misc::site.kf_mobile') !!}</p>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="iconfont icon-qq"></i>
                                </div>
                                <div>
                                    <h3>服务QQ：</h3>
                                    <p>{!! sys_setting('misc::site.kf_qq') !!}</p>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="iconfont icon-mail"></i>
                                </div>
                                <div>
                                    <h3>邮政编码：</h3>
                                    <p>311121</p>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="iconfont icon-position"></i>
                                </div>
                                <div>
                                    <h3>通讯地址：</h3>
                                    <p>杭州余杭区仓前街道欧美金融城</p>
                                </div>
                            </li>
                        </ul>
                        <div class="contact-position">
                            <div id="map"></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
    var map = new AMap.Map('map', {
        zoom:16,//级别
        center: [120.002833, 30.281695],//中心点坐标
        viewMode:'3D'//使用3D视图
    });
    // 创建一个 Marker 实例：
    var marker = new AMap.Marker({
        position: new AMap.LngLat(120.002833, 30.281695),   // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
        title: '欧美金融城'
    });

    // 将创建的点标记添加到已有的地图实例：
    map.add(marker);
    </script>
    @include('misc::tpl._footer')
@endsection
