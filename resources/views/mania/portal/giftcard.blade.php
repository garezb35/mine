@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/portal/giftcard/css/index.css?v=210617">
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/portal/banner/js/banner.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_window_new.js?v=190220"></script>
    <script type="text/javascript" src="/mania/portal/giftcard/js/index.js?v=210617"></script>
@endsection

@section('content')
    <style>
        .aside .nav a {
            border-bottom: solid 1px gray;
            text-align: center;
        }
        .aside .nav > .nav_title {
            font-size: 16px;
            height: 50px;
            line-height: 50px;
            padding-left: 0px;
        }
    </style>
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <div class="g_remocon_l"> </div>
        <script type="text/javascript">
            function serviceCert() {
                if(confirm('I-Pin(아이핀)을 이용하여 아이템매니아에 가입하신 회원\n님들께서는 마일리지 충전 및 물품 거래 시 정상적인 이용\n을 위하여 최초 1회 이름 및 주민등록 번호로 본인 확인 절\n차를 거쳐야만 모든 기능을 사용하실 수 있습니다.\n인증을 하시겠습니까?')) {
                    location.href = '/portal/user/ipin_name_index.html';
                } else {
                    location.href = 'http://www.itemmania.com';
                }
            }
        </script>
        <div class="aside">
            <div class="nav_subject"> <a href="/portal/giftcard/" class="giftcard">상품권몰</a> </div>
            <div class="nav">
                <div class="nav_title"> <a href="/portal/giftcard/giftcard_buy_list.html?pMode=O">나의 구매내역</a> </div>
                <div class="nav_title align-center"><a href="#">추천 상품권</a></div>
                <div class="nav_title align-center"><a href="#">온라인 상품권</a></div>
                <div class="nav_title align-center"><a href="#">모바일 상품권</a></div>
                <div class="nav_title align-center"><a href="#">생활/쇼핑</a></div>
            </div>
            <div id="giftcard_left_banner" style="overflow:hidden;width:200px;height:178px;margin-top:15px">
                <form method="post" id="frmbanner" name="frmbanner"></form>
            </div>
        </div>

        <div class="g_content">
            <div class="top_area">
                <div class="big_bn">
                    <a href="http://www.itemmania.com/portal/giftcard/onestore/"><img src="http://img2.itemmania.com/new_images/portal/gift/bn_onestore.jpg" width="820" height="170" alt="원스토어" title="원스토어"></a>
                </div>
            </div>
            <div class="giftcard_list">
                <ul>
                    <li class="active">
                        <a href="/portal/giftcard/culture"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_culture.jpg" width="160" height="120" alt="문화상품권" title="문화상품권"></a>
                    </li>
                    <li class="active"> <img src="http://img4.itemmania.com/new_images/portal/gift/icon_new.gif" class="ribbon">
                        <a href="/portal/giftcard/palago"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_palago.jpg" width="160" height="120" alt="팔라고 모바일 금액권" title="팔라고 모바일 금액권"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard/culturecash"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_culturecash.jpg" width="160" height="120" alt="컬쳐캐시(컬쳐랜드ID충전)" title="컬쳐캐시(컬쳐랜드ID충전)"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard/happy"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_happy.jpg" width="160" height="120" alt="해피머니 문화상품권" title="해피머니 문화상품권"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard/book/bookcul.html"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_book.jpg" width="160" height="120" alt="도서문화상품권" title="도서문화상품권"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard_touchpay/oncash"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_oncash.jpg" width="160" height="120" alt="온캐시" title="온캐시"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard_touchpay/lol"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_lol.jpg" width="160" height="120" alt="LOL 스마트문상" title="LOL 스마트문상"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard_touchpay/funny"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_funny.jpg" width="160" height="120" alt="퍼니카드" title="퍼니카드"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard/teen"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_teen.jpg" width="160" height="120" alt="틴캐시" title="틴캐시"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard/cashplus"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_cashplus.jpg" width="160" height="120" alt="캐시플러스" title="캐시플러스"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard/eggmoney"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_eggmoney.jpg" width="160" height="120" alt="에그머니" title="에그머니"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard/game_culture"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_game_culture.jpg" width="160" height="120" alt="스마트문상(게임문상)" title="스마트문상(게임문상)"></a>
                    </li>
                    <li class="active"> <img src="http://img4.itemmania.com/new_images/portal/gift/icon_10per.png" class="ribbon">
                        <a href="/portal/giftcard/gamemania"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_gamemania.jpg" width="160" height="120" alt="게임매니아 상품권" title="게임매니아 상품권"></a>
                    </li>
                    <li class="active"> <img src="http://img4.itemmania.com/new_images/portal/gift/icon_5per.png" class="ribbon">
                        <a href="/portal/giftcard_tdata" target="_blank"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_tdata.jpg" width="160" height="120" alt="T데이터 패키지" title="T데이터 패키지"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard/googlegift"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_googlegift.jpg" width="160" height="120" alt="구글 기프트 코드" title="구글 기프트 코드"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard/onestore"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_onestore.jpg" width="160" height="120" alt="원스토어 기프트카드" title="원스토어 기프트카드"></a>
                    </li>
                    <li class="active"> <img src="http://img4.itemmania.com/new_images/portal/gift/icon_new.gif" class="ribbon">
                        <a href="/portal/giftcard/starballoon"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_starballoon.jpg" width="160" height="120" alt="별풍선교환권(아프리카TV)" title="별풍선교환권(아프리카TV)"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard/tcash"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_tcash.jpg" width="160" height="120" alt="티캐시 간편 충전권" title="티캐시 간편 충전권"></a>
                    </li>
                    <li class="active"> <img src="http://img4.itemmania.com/new_images/portal/gift/icon_10per.png" class="ribbon">
                        <a href="/portal/giftcard/datasoda"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_datasoda.jpg" width="160" height="120" alt="데이터소다 쿠폰" title="데이터소다 쿠폰"></a>
                    </li>
                    <li class="active">
                        <a href="/portal/giftcard/kakaocoin"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_kakaocoin.jpg" width="160" height="120" alt="카카오코인" title="카카오코인"></a>
                    </li>
                    <ul>
                        <li class="active">
                            <a href="/portal/giftcard_phone/" target="_blank"> <img src="http://img2.itemmania.com/new_images/portal/gift/img_giftcard_phone.jpg" width="160" height="120" alt="휴대폰 요금납부 상품권" title="휴대폰 요금납부 상품권"></a>
                        </li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </ul>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
