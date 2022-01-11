<!DOCTYPE HTML>
<html>
    <head>
        <title>아이템천사</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="keyword" content="">
        <meta name="description" content="">
        <link rel="stylesheet" href="/angel_mobile/main/css/component.css" />
        <link rel="stylesheet" href="/angel_mobile/main/css/init.css" />
        <script src="/angel_mobile/main/js/jquery.min.js"></script>
        <script src="/angel_mobile/main/js/ut__webpack.js"></script>
        <script src="/angel_mobile/main/js/hjts_ss.js"></script>
        <script src="/angel_mobile/main/js/swiper.min.js"></script>
        <script src="/angel_mobile/main/js/makePCookie.js"></script>
        <script src="/angel_mobile/main/js/hangul.js"></script>
        <script src="/angel_mobile/main/js/modernizr.custom.js"></script>
        <script src="/angel_mobile/main/js/jquery.dlmenu.js"></script>

        @yield('head_attach')
        <script>
            @if (Auth::user())
                var a_token = '{{Auth::user()->api_token}}';
            @endif
        </script>
    </head>
    <body>
        <script>
            var server_domain = '210.112.174.178';
            var a_token = '';
            @if(Auth::check())
            a_token = '{{Auth::user()->api_token}}';
            @endif
            function basicPopup(url) {
                popupWindow = window.open(url,'popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
            }
        </script>
        <div class="header-with">
            <header class="header fixed">
                <div class="headertop">
                    <div class="headertop-with">
                        <ul class="header-top-lf">
                            <li><img src="https://www.5mmo.com/templates/game/images/topico01.png"></li>
                            <li><img src="https://www.5mmo.com/templates/game/images/topico02.png"></li>
                            <li>|</li>
                            <li><img src="https://www.5mmo.com/templates/game/images/topico04.gif"></li>
                            <li class="cly"><a class="diblivechat1">Live Support</a></li>
                            <li>|</li>
                            <li class="top-wz">100% Safe &amp; Cheap RS Gold and POE Trade for Sale with Fast Delivery on 5Mmo.com</li>
                        </ul>
                        <ul class="header-top-rt">
                            @if(!empty($me))
                            <li>
                                <span><a rel="nofollow" href="/myroom" title="User Center" class="cly"><img src="/angel/img/icons/cusico.png">{{$me['name']}}</a>님&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red; font-weight:bold">{{$top_role['alias']}}</span>회원</span>
                            </li>
                            @else
                                <li>
                                    <a class="cly" rel="nofollow" href="/login" title="SignIn">로그인</a>
                                    <span>|</span>
                                    <a class="cly" rel="nofollow" href="/portal/user" title="Register">회원가입</a>
                                </li>
                            @endif
                        </ul>
                        <div id="dl-menu" class="dl-menuwrapper">
                            <button id="dl-menu-button">Open Menu</button>
                            <ul class="dl-menu">
                                <li><a href="{{route('index')}}">홈페이지</a></li>
                                <li><a href="{{route('index')}}">판매등록</a></li>
                                <li><a href="{{route('index')}}">구매등록</a></li>
                                <li>
                                    <a href="javascript:void(0);" rel="nofollow">마이페이지</a>
                                    <ul class="dl-submenu">
                                        <li class="dl-back"><a href="javascript:void(0);" rel="nofollow">마이페이지</a></li>
                                        <li><a href="https://www.5mmo.com/wow-tbc-classic-gold/">메세지함</a></li>
                                        <li><a href="https://www.5mmo.com/wow-tbc-classic-gold/">판매관련</a></li>
                                        <li><a href="https://www.5mmo.com/wow-classic-gold/">구매관련</a></li>
                                        <li><a href="https://www.5mmo.com/cheap-wow-gold-us/">종료내역</a></li>
                                        <li><a href="https://www.5mmo.com/cheap-wow-gold-eu/">취소내역</a></li>
                                        <li><a href="https://www.5mmo.com/cheap-wow-gold-eu/">마일리지</a></li>
                                        <li><a href="https://www.5mmo.com/cheap-wow-gold-eu/">개인정보</a></li>
                                        <li><a href="https://www.5mmo.com/cheap-wow-gold-eu/">현금영수증</a></li>
                                        <li><a href="https://www.5mmo.com/cheap-wow-gold-eu/">환경설정</a></li>
                                        <li><a href="https://www.5mmo.com/cheap-wow-gold-eu/">회원탈퇴</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" rel="nofollow">고객센터</a>
                                    <ul class="dl-submenu">
                                        <li class="dl-back"><a href="javascript:void(0);" rel="nofollow">고객센터</a></li>
                                        <li><a href="https://www.5mmo.com/wow-tbc-classic-gold/">FAQ</a></li>
                                        <li><a href="https://www.5mmo.com/wow-tbc-classic-gold/">거래취소/종료</a></li>
                                        <li><a href="https://www.5mmo.com/wow-classic-gold/">이용관련</a></li>
                                        <li><a href="https://www.5mmo.com/cheap-wow-gold-us/">나의 질문과 답변</a></li>
                                        <li><a href="https://www.5mmo.com/cheap-wow-gold-eu/">신규게임/서버 추가</a></li>
                                        <li><a href="https://www.5mmo.com/cheap-wow-gold-eu/">안전거래</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('index')}}">이용안내</a></li>
                            </ul>
                        </div>
                        <script type="text/javascript">
                            $(function(){
                                $( '#dl-menu' ).dlmenu();
                            });
                        </script>
                    </div>
                </div>
                <div class="headerlogo">
                    <div class="headerlogo-with">
                        <div class="lf-logo"><a href="/"><img src="/assets/img/logo.png" alt="아이템천사" title="아이템천사" width="240"></a></div>
                        <div class="rt-search">
                            <div class="search-box">
                                <form id="SearchGameForm" name="SearchGameForm" method="post" action="https://www.5mmo.com/allproduct.html">
                                    <ul>
                                        <li class="pl5">
                                            <input type="text" class="g_text srh_inp w405"  placeholder="게임명을 검색해주세요." id="keyword">
                                        </li>
                                        <li class="btn-search"><img src="/angel/img/icons/topicoss.png" style="cursor:pointer"></li>
                                    </ul>
                                    <ul id="searchs" hidden="">
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </header>
            <div class="nav">
                <div class="nav-with">
                    <ul class="navul">
                        <li><a href="https://www.5mmo.com/allproduct.html"><img src="https://www.5mmo.com/templates/game/images/ipad01.png"><br>전체 게임</a></li>
                        <li><a href="https://www.5mmo.com/contact.html" rel="nofollow"><img src="https://www.5mmo.com/templates/game/images/ipad02.png"><br>1:1문의</a> </li>
                        <li><a href="https://www.5mmo.com/selltous.html"><img src="https://www.5mmo.com/templates/game/images/ipad03.png"><br>판매등록</a></li>
                        <li><a href="https://www.5mmo.com/ordersearch.html" rel="nofollow"><img src="https://www.5mmo.com/templates/game/images/ipad04.png"><br>거래내역</a></li>
                        <li><a href="https://www.5mmo.com/affiliate.html" rel="nofollow"><img src="https://www.5mmo.com/templates/game/images/ipad05.png"><br>마일리지충전</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="roots" id="angel">
            @yield('content')
        </div>


        @yield('foot_attach')

    </body>
</html>
