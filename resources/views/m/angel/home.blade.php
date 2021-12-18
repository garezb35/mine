@extends('layouts-angel-mobile.app')

@section('head_attach')
    <link rel="stylesheet" href="/angel_mobile/home/css/index.css" />
    <link rel="stylesheet" src="/angel_mobile/notice/css/index.css" />
@endsection

@section('foot_attach')
    <script src="/angel_mobile/home/js/index.js"></script>
    <script src="/angel_mobile/notice/js/index.js"></script>
@endsection

@section('content')
    <div class="g_BODY" id="g_BODY">
        @include('m.angel.aside.nav', ['user' => $user])
        <div class="container">
            <div class="main_container">
                @php
                    $isLogined = '';
                    if (Auth::check()) {
                        $isLogined = 1;
                    }
                @endphp
                <input id="_LOGINCHECK" type="hidden" value="{{$isLogined}}">
                <input id="main_login_check" type="hidden" value="1">
                <div class="main_hamburger_wrapper">
{{--                    <a id="alarm_noti" class="btn_side main_alarm" href="/myroom/goods_alarm/alarm_sell_list.html"> <span class="new"></span> </a>--}}
                    <a href="javascript:;" class="btn_side main_hamburger" id="btn_menu"></a>
                    <div class="sns_list">
{{--                        <a href="" class="facebook">페이스북</a>--}}
{{--                        <a href="" class="instagram">인스타그램</a>--}}
{{--                        <a href="" class="youtube">유튜브</a>--}}
                    </div>
                </div>
                <div id="main_logo_wrapper"> <a href=""><h2 id="main_logo"></h2></a> </div>
                <div id="main_search_wrapper">
                    <div class="srh_inp_wrap" data-hash="searchSell">
                        <input type="search" class="g_text srh_inp" name="srh_game" placeholder="게임명 또는 서버명을 검색해주세요." readonly>
                        <button class="btn_srh"></button>
                    </div>
                </div>
                <div class="srh_inp_wrap_scroll" data-hash="searchSell">
                    <input type="search" class="g_text srh_inp" name="srh_game" placeholder="게임명 또는 서버명을 검색해주세요." readonly>
                    <button class="btn_srh"></button>
                </div>
                <div id="bookmark_list_wrapper">
                    <ul id="bookmark_list">
                        @php
                            $arrUrl = array('#regSell', '#regBuy', '#', '#', route('mileage_payment_charge'), route('mileage_payment_exchange'), route('myroom'), '#');
                            $arrImgClass = array('regSell', 'regBuy', 'selling', 'buying', 'charge', 'myroom', 'giftmall', 'message');
                            $arrBtnText = array('판매등록', '구매등록', '판매중', '구매중', '충전', '출금', '마이룸', '상품권사기', '메시지함');
                        @endphp
                        @for ($i = 0; $i < 8; $i++)
                            @if(!empty($fav[$i]))
                                <li>
                                    <a href="{{$arrUrl[$i]}}">
                                        <span class="bookmark_icon {{$arrImgClass[$i]}}"></span>
                                        <span class="bookmark_title">{{$arrBtnText[$i]}}</span>
                                    </a>
                                </li>
                            @endif
                        @endfor
                        <li>
                            <a href="{{route('favorite')}}">
                                <span class="bookmark_icon bookmark_add"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="notice clear_fix"> <span class="noti_icon"></span>
                    <div class="notice_ct"> <a href="{{route('m_notice')}}">[안내] 패턴인증 서비스 안내</a> </div>
                    <a href="{{route('m_notice')}}" class="sp_b btn_mr">+</a>
                </div>
                <div id="power_zone_part">
                    <div id="power_zone" style="">
                        <h4 id="power_list_title">인기물품
                            <span class="power_list_title_blue">목록</span>
                        </h4>
                        <div id="power_list_wrapper">
                            <div id="power_list" class="clear_fix">
                                <div class="power_goods_wrapper">
                                    <a href="#">
                                        <dl class="power_goods" data-id="2021121608196688"> <dt class="power_goods_title">디아블로2:레저렉션</dt>
                                            <dd class="power_goods_money">1개당 1,000원</dd>
                                            <dd class="power_goods_id">노말</dd>
                                        </dl> <span class="power_goods_title_badge"></span> </a>
                                </div>
                                <div class="power_goods_wrapper">
                                    <a href="#">
                                        <dl class="power_goods" data-id="2021121605876216"> <dt class="power_goods_title">디아블로2:레저렉션</dt>
                                            <dd class="power_goods_money">1개당 1,000원</dd>
                                            <dd class="power_goods_id">기타</dd>
                                        </dl> <span class="power_goods_title_badge"></span> </a>
                                </div>
                                <div class="power_goods_wrapper">
                                    <a href="#">
                                        <dl class="power_goods" data-id="2021121608548399"> <dt class="power_goods_title">로스트아크</dt>
                                            <dd class="power_goods_money">1만당 9,400원</dd>
                                            <dd class="power_goods_id">루페온</dd>
                                        </dl> <span class="power_goods_title_badge"></span> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner_module">
                    <div class="banner_content_wrapper">
                        <div class="banner_content">
                            <a href="" target=""> <img class="banner_content_images" src="/angel_mobile/img/banner/slide1.jpg" alt="캐릭터 물품등록 알리미 이벤트 시즌 5" title="캐릭터 물품등록 알리미 이벤트 시즌 5"> </a>
                        </div>
                    </div>
                </div>
                <div class="spacer_bottom_1"></div>
                <div class="banner_module">
                    <div class="banner_content_wrapper">
                        <div class="banner_content">
                            <a href="" target=""> <img class="banner_content_images" src="/angel_mobile/img/banner/slide1.jpg" alt="로또팟" title="로또팟"> </a>
                        </div>
                    </div>
                </div>
                <div class="spacer_bottom_1"></div>
                <div class="banner_module">
                    <div class="banner_content_wrapper">
                        <div class="banner_content">
                            <a href="" target=""> <img class="banner_content_images" src="/angel_mobile/img/banner/slide1.jpg" alt="애드팝콘" title="애드팝콘"> </a>
                        </div>
                    </div>
                </div>
                <div class="spacer_bottom_1"></div>
            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
    <div class="g_search_frame g_hidden bkg-white" id="g_search_frame">
        <form name="g_search_form" id="g_search_form" method="POST">
            <input type="hidden" name="search_game" value="827">
            <input type="hidden" name="search_game_text" value="">
            <input type="hidden" name="search_server" value="5803">
            <input type="hidden" name="search_server_text" value="">
            <input type="hidden" name="search_goods" value="">
            <input type="hidden" name="character_view" value="">
            <div class="initial_screen" id="initial_screen">
                <div class="searchbar_tab" id="gs_tab">
                    <div class="active"> <a href="javascript:;" data-target="tab_lastsearch">최근 검색 게임</a> </div>
                    <div> <a href="javascript:;" data-target="tab_mygame">나만의 게임</a> </div>
                </div>
                <div class="tab_content">
                    <div class="tab_child show" data-content="tab_lastsearch">
                        <ul class="last_search"></ul>
                    </div>
                    <div class="tab_child" data-content="tab_mygame">
                        <ul class="g_my_search"></ul>
                    </div>
                </div>
                <div class="popular_game" data-popular="true">
                    <div class="g_title">인기게임</div>
                    <ul class="popular_list">
                        <li data-pgame="4763"> 리니지W </li>
                        <li data-pgame="4714"> 디아블로2:레저렉션 </li>
                        <li data-pgame="4696"> 오딘:발할라라이징 </li>
                        <li data-pgame="2696"> 로스트아크 </li>
                        <li data-pgame="138"> 메이플스토리 </li>
                        <li data-pgame="4322"> 바람의나라:연 </li>
                        <li data-pgame="546"> 아이온 </li>
                        <li data-pgame="281"> 던전앤파이터 </li>
                        <li data-pgame="3449"> 리니지M </li>
                        <li data-pgame="4326"> 리니지2M </li>
                    </ul>
                </div>
            </div>
            <div id="game_wrap" class="gs_wrap">
                <div class="header-part" style="">
                    <h4 class="page_title">즐겨찾는 서비스</h4>
                    <a href="javascript:history.back()" class="back_btn" id="back_btn"></a>
                </div>
                <div class="gs_search">
                    <select class="search_type" name="search_type">
                        <option value="sell" selected>팝니다</option>
                        <option value="buy">삽니다</option>
                    </select>
                    <input type="search" name="searchGameServer" id="searchGameServer" placeholder="게임 또는 서버 검색" autocomplete="off" class="search_gs_name">
                    <span class="btn_srh" id="srhButton">검색</span>
                </div>
                <div class="gs_list g_hidden" id="g_gameServerList" data-gslist="true"></div>
            </div>
        </form>
    </div>
    <div class="g_layer" id="g_layer">
        <div class="l_container">
            <div class="l_content" id="l_content"> </div>
        </div>
    </div>
@endsection
