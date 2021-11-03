@extends('layouts-mania.app')
@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/character/css/index.css?v=210204" />
    {{--    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>--}}
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/character/js/carousel.js?v=21010710"></script>
    <script type="text/javascript" src="/mania/character/js/index.js?v=21020410"></script>
    <script type='text/javascript'>
        var gsVersion = '2110141801';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')
    <style>
        #character_top_section #character_top_section_content .character_menu_wrapper {
            width: 100%;
        }
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu:nth-child(4n+4){margin-right:10px;}
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu:nth-child(6n+6){margin-right:0;}
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu_list { padding: 25px 70px 16px; }
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu {}
        .goods_wrapper dl dt { color: #f22bff; }
        .goods_wrapper:hover {background: #6692ff26;}
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu {font-size: 13px;}
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu:hover {font-size: 14px;}
    </style>
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <div id="character_top_section">
            <div class="section_title_wrapper">
                <h2 class="section_title c-blue-title">캐릭터 거래 게임 리스트</h2> </div>
            <div id="character_top_section_content" class="clear_fix">
                <div class="character_menu_wrapper">
                    <ul class="character_menu_list clear_fix">
                        <li class="character_menu" data-code="4593" data-gamename="R2M">R2M</li>
                        <li class="character_menu" data-code="4553" data-gamename="DK모바일">DK모바일</li>
                        <li class="character_menu" data-code="4696" data-gamename="오딘:발할라라이징">오딘:발할라라이징</li>
                        <li class="character_menu" data-code="4685" data-gamename="블레이드앤소울2">블레이드앤소울2</li>
                        <li class="character_menu" data-code="4613" data-gamename="원신">원신</li>
                        <li class="character_menu" data-code="4322" data-gamename="바람의나라:연">바람의나라:연</li>
                        <li class="character_menu" data-code="4326" data-gamename="리니지2M">리니지2M</li>
                        <li class="character_menu" data-code="3413" data-gamename="메이플스토리M">메이플스토리M</li>
                        <li class="character_menu" data-code="4462" data-gamename="그랑사가">그랑사가</li>
                        <li class="character_menu" data-code="3799" data-gamename="검은사막모바일">검은사막모바일</li>
                        <li class="character_menu" data-code="3449" data-gamename="리니지M">리니지M</li>
                        <li class="character_menu" data-code="4629" data-gamename="세븐나이츠2">세븐나이츠2</li>
                        <li class="character_menu" data-code="4033" data-gamename="에픽세븐">에픽세븐</li>
                        <li class="character_menu" data-code="4337" data-gamename="라이즈오브킹덤즈">라이즈오브킹덤즈</li>
                        <li class="character_menu" data-code="4660" data-gamename="쿠키런:킹덤">쿠키런:킹덤</li>
                        <li class="character_menu" data-code="4342" data-gamename="V4">V4</li>
                        <li class="character_menu" data-code="4538" data-gamename="라그나로크오리진">라그나로크오리진</li>
                        <li class="character_menu" data-code="3907" data-gamename="라그나로크M">라그나로크M</li>
                        <li class="character_menu" data-code="2270" data-gamename="서머너즈워">서머너즈워</li>
                        <li class="character_menu" data-code="4268" data-gamename="로한M">로한M</li>
                    </ul>
                </div>
                {{--                <div class="character_banner_carousel">--}}
                {{--                    <div class="carousel_module" data-code="TR0002">--}}
                {{--                        <div class="banner_in center_banner" id="center_banner">--}}
                {{--                            <div class="banner_item" data-idx="0">--}}
                {{--                                <a href="http://www.itemmania.com/event/event_ing/e161012_mobile/" target="_blank"> <img class="carousel_images" src="http://img4.itemmania.com/new_images/banner_manager/20210203/20210203175731_dNX66.jpg" alt="아무게임" title="아무게임"> </a>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class='banner_indicate indicate'></div>--}}
                {{--                    </div>--}}
                {{--                    <script>--}}
                {{--                        var selector = document.querySelector(".carousel_module")--}}
                {{--                        new Carousel(selector, {--}}
                {{--                            "showNavi": false,--}}
                {{--                            "showIndicate": true,--}}
                {{--                            "delay": 3000,--}}
                {{--                            "random": true--}}
                {{--                        });--}}
                {{--                    </script>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div id="character_goods_content">
            <div class="games_goods_wrapper">
                <div class="section_title_wrapper">
                    <h2 class="section_title c-blue-title">오딘:발할라라이징 <span class="goods_more_btn" data-code="4696" data-gamename="오딘:발할라라이징">더보기 <img src="http://img4.itemmania.com/new_images/icon/icon_more.png" alt="" /></span></h2></div>
                <div class="games_goods_carousel">
                    <div class="carousel_module">
                        <div class="banner_in center_banner">
                            <div class="banner_item" data-idx="0">
                                <div class="goods_wrapper goods" data-goods="2021101106576300">
                                    <dl><dt class="goods_price">24,000,000<span>원</span></dt>
                                        <dd class="goods_content">Google</dd>
                                        <dd class="goods_content">3.55 74렙 스나,어쌔 3전설/전설장갑</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 이둔3</dd>
                                    </dl>
                                </div>
                                <div class="goods_wrapper goods" data-goods="2021101307088189">
                                    <dl><dt class="goods_price">19,000,000<span>원</span></dt>
                                        <dd class="goods_content">기타</dd>
                                        <dd class="goods_content">Lv.80 어쌔신 3전설 투력 39260 정리합니다.</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 오딘9</dd>
                                    </dl>
                                </div>
                                <div class="goods_wrapper goods" data-goods="2021092500027179">
                                    <dl><dt class="goods_price">12,345,670<span>원</span></dt>
                                        <dd class="goods_content">기타</dd>
                                        <dd class="goods_content">71 아크메이지 2.95투력 판매합니다.</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 오딘7</dd>
                                    </dl>
                                </div>
                                <div class="goods_wrapper goods" data-goods="2021100708348938">
                                    <dl><dt class="goods_price">10,000,000<span>원</span></dt>
                                        <dd class="goods_content">기타</dd>
                                        <dd class="goods_content">32000대 스나 처분해요</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 헤임달5</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="banner_item" data-idx="1">
                                <div class="goods_wrapper goods" data-goods="2021091901421286">
                                    <dl><dt class="goods_price">10,000,000<span>원</span></dt>
                                        <dd class="goods_content">Google</dd>
                                        <dd class="goods_content">75팔라딘 팝니다 사냥중</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 로키1</dd>
                                    </dl>
                                </div>
                                <div class="goods_wrapper goods" data-goods="2021100110246678">
                                    <dl><dt class="goods_price">10,000,000<span>원</span></dt>
                                        <dd class="goods_content">기타</dd>
                                        <dd class="goods_content">랭커 어쌔 계정 저렴히 정리(내용 가격무시)</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 로키3</dd>
                                    </dl>
                                </div>
                                <div class="goods_wrapper goods" data-goods="2021101213048663">
                                    <dl><dt class="goods_price">9,900,000<span>원</span></dt>
                                        <dd class="goods_content">Google</dd>
                                        <dd class="goods_content">72랩 전변1티어 팔라딘 전변1티어 세인트 스왑가능 구</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 로키1</dd>
                                    </dl>
                                </div>
                                <div class="goods_wrapper goods" data-goods="2021093004722406">
                                    <dl><dt class="goods_price">9,800,000<span>원</span></dt>
                                        <dd class="goods_content">Guest</dd>
                                        <dd class="goods_content">카카오완전깡통 팔라딘 투력3.4 2전설 전변1티어(pvp)전탈(가름)영날</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 기타</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="banner_item" data-idx="2">
                                <div class="goods_wrapper goods" data-goods="2021101300965887">
                                    <dl><dt class="goods_price">8,500,000<span>원</span></dt>
                                        <dd class="goods_content">기타</dd>
                                        <dd class="goods_content">토르9 71렙 3.28만 다크(전압/전탈) 처분합니다.</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 토르9</dd>
                                    </dl>
                                </div>
                                <div class="goods_wrapper goods" data-goods="2021101006483950">
                                    <dl><dt class="goods_price">8,000,000<span>원</span></dt>
                                        <dd class="goods_content">Google</dd>
                                        <dd class="goods_content">세인트 전설1티어 치유의마그니 전설 케릭 정리합니다.구</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 이둔2</dd>
                                    </dl>
                                </div>
                                <div class="goods_wrapper goods" data-goods="2021101305040631">
                                    <dl><dt class="goods_price">8,000,000<span>원</span></dt>
                                        <dd class="goods_content">기타</dd>
                                        <dd class="goods_content">pvp전설 1 디펜더 영웅탈날 777악세 팝니다 !</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 토르9</dd>
                                    </dl>
                                </div>
                                <div class="goods_wrapper goods" data-goods="2021100912319943">
                                    <dl><dt class="goods_price">8,000,000<span>원</span></dt>
                                        <dd class="goods_content">기타</dd>
                                        <dd class="goods_content">캐릭터 팝니다.</dd>
                                        <dd class="goods_server">오딘:발할라라이징 > 로키5</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class='banner_indicate indicate'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="g_finish"></div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
