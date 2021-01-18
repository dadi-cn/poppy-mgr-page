@extends('lemon.template.default')
@section('body-main')
    <link rel="stylesheet" href="/project/lemon/css/daohang.css">
    <div id="side">
        <div class="logo"><a href="">牛大拿设计师导航<i>Niudana.com</i></a></div>
        <h2 class="home"><a href="">首页</a></h2>
        <ul class="ul-tags">
            <li><a href="#">设计平台</a></li>
            <li><a href="">灵感创意</a></li>
            <li><a href="">发现</a></li>
            <li><a href="">素材资源</a></li>
            <li class="sub"><a href="">图标</a></li>
            <li class="sub"><a href="">图库</a></li>
            <li class="sub"><a href="">字体</a></li>
            <li class="sub"><a href="">Sketch资源</a></li>
            <li><a href="">设计软件</a></li>
            <li><a href="">在线工具</a></li>
            <li><a href="">教程文章</a></li>
            <li><a href="">社区交流</a></li>
            <li><a href="">绘画</a></li>
            <li><a href="">前端开发</a></li>
            <li><a href="">设计团队</a></li>
            <li><a href="">设计师</a></li>
            <li><a href="">媒体与公众号</a>
            </li>
        </ul>
        <h2 class="dig"><a href="">设计导读</a></h2>
        <h2 class="guestbook"><a href="">留言板</a></h2>
        <h2 class="donate"><a href="">捐赠</a></h2>
        <h2 class="about"><a href="">关于牛大拿</a></h2>
        <div class="ad-side-a">
            <a href="" target="_blank">
                <img src="/project/lemon/css_images/daohang/AD_Side_A.png">
            </a>
        </div>
    </div>
    <div id="main">
        <div class="search">
            <select>
                <option selected="selected" value="0">Dribbble</option>
                <option value="1">Behance</option>
                <option value="2">Pinterest</option>
                <option value="3">花瓣网</option>
                <option value="4">Iconfinder</option>
            </select>
            <div class="div">
                <div>
                    <form action="" target="_blank">
                        <input type="text" name="q" placeholder="Dribbble Search" value="">
                        <input type="submit" value="">
                    </form>
                </div>
                <div style="display:none;">
                    <form action="" target="_blank">
                        <input type="text" name="search" placeholder="Behance Search" value="">
                        <input type="submit" value="">
                    </form>
                </div>
                <div style="display:none;">
                    <form action="" target="_blank">
                        <input type="text" name="q" placeholder="Pinterest Search" value="">
                        <input type="submit" value="">
                    </form>
                </div>
                <div style="display:none;">
                    <form action="" target="_blank">
                        <input type="text" name="q" placeholder="花瓣搜索" value="">
                        <input type="submit" value="">
                    </form>
                </div>
                <div style="display:none;">
                    <form method="get" accept-charset="UTF-8" action=""
                          target="_blank">
                        <input type="text" name="q" placeholder="Iconfinder Search" value="">
                        <input type="submit" value="">
                    </form>
                </div>
            </div>
        </div>
        <div class="tips">
            <a href=""
               target="_blank">牛大拿 4.3 更新，【设计导读】回归。并且新增 UI8，UpLabs 内容导读，目前功能测试中，欢迎提出你的反馈与建议，谢谢支持。</a>
        </div>
        <div class="item-setting">
            <div id="switchGoto" class="switchGotoShow"></div>
            <div id="switchLanguage" class="switchLanguageShow"></div>
            <div id="switchDetail" class="switchDetailShow"></div>
            <div id="switchLogo" class="switchLogoShow"></div>
        </div>
        <div class="item-grid">
            <h3><b>灵感创意</b></h3>
            <ul>
                <li>
                    <a target="_blank" href="" title="&lt;b&gt;Dribbble&lt;/b&gt;&lt;br&gt;设计师作品分享平台，个人作品交流与分享。"
                       class="Link">
                        <i style="background-image:url(&#39;/project/lemon/css_images/daohang/18922253.png&#39;);"></i>
                        <b>
                            Dribbble
                            <u class="EN"></u>
                        </b>设计师作品分享平台，个人作品交流与分享。
                    </a>
                    <span class="tags">
                        <a href="#" title="设计平台" class="a-tag a-%E8%AE%BE%E8%AE%A1%E5%B9%B3%E5%8F%B0">设计平台</a>
                        <a href="" title="灵感创意" class="a-tag a-%E7%81%B5%E6%84%9F%E5%88%9B%E6%84%8F">灵感创意</a>
                    </span>
                    <a target="_blank" href="" rel="nofollow" title="直达Dribbble" class="goto linkTip"></a>
                </li>
            </ul>
            <div class="ad-list-a">
                <a href="" target="_blank"><img src="/project/lemon/css_images/daohang/AD_List_A_UICN.png" width="760"></a>
            </div>
            <div class="list-backhome"><a href="">返回首页</a></div>
        </div>
        <div class="footer">
            建议使用 Safari, Chrome 浏览器访问本站
            <a href="" target="_blank">牛大拿设计师QQ群 : 436683</a>
            <br>
            Copyright ©
            <a href="" class="a-fav">Niudana.com</a>
            4.0 2016 All Rights Reserved.
            <a href="" target="_blank">京ICP备15015217号</a>
            Powered by
            <a href="" target="_blank">S4MUEL</a>
            <a href="">联系站长</a>
        </div>
        <div id="goTop"></div>
    </div>
    <script>
        require(['jquery'], function ($) {
            $('select').change(function () {
                var numEle = $(this).val();
                $(this).next().find('div').eq(numEle).show().siblings().hide();
            });

            $(window).scroll(function () {
                var sc = $(window).scrollTop();
                if (sc > 0) {
                    $("#goTop").css("display", "block");
                } else {
                    $("#goTop").css("display", "none");
                }
            })
            $("#goTop").click(function () {
                var sc = $(window).scrollTop();
                $('body,html').animate({scrollTop: 0}, 500);
            })

            $(function () {
                $('#switchDetail').click(function () {
                    $(this).toggleClass('switchDetailHide');
                    $('.item-grid span.tags').fadeToggle();
                });
            });
            $(function () {
                $('#switchLogo').click(function () {
                    $(this).toggleClass('switchLogoHide');
                    $('a.Link i').fadeToggle();
                });
            });
            $(function () {
                $('#switchLanguage').click(function () {
                    $(this).toggleClass('switchLanguageHide');
                    $('a.Link b u').fadeToggle();
                });
            });
            $(function () {
                $('#switchGoto').click(function () {
                    $(this).toggleClass('switchGotoHide');
                    $('a.goto').fadeToggle();
                });
            });


            $(function () {
                var x = 10;
                var y = 20;

                $("a.linkTip").mousemove(function (e) {

                    var linkTip = $("#linkTip");
                    if (!linkTip.length) {
                        this.myTitle = this.title;
                        this.title   = "";
                        linkTip      = $("<div id='linkTip'>" + this.myTitle + "</div>");
                        $("body").append(linkTip);
                    }

                    linkTip.css({
                        "top" : (e.pageY + y) + "px",
                        "left": (e.pageX + x) + "px"
                    }).show("fast");

                }).mouseout(function () {
                    this.title = this.myTitle;
                    $("#linkTip").remove();
                });
            });
        })
    </script>
@endsection