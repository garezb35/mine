@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/_banner/css/_banner.css?v=210107101945">
    <link type="text/css" rel="stylesheet" href="/angel/home/index.css">
    <link type="text/css" rel="stylesheet" href="/angel/home/custom.css">

    <script type="text/javascript" src="/angel/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')

    <script type="text/javascript" src="/angel/_js/_xml2json.js"></script>
    <script type="text/javascript" src="/angel/_js_chart/_avgGameChart.js"></script>
    <script type="text/javascript" src="/angel/js/home.js"></script>
    <script>
        $(document).ready(function() {
            $(".tab-title").click(function() {
                var elem = $(this);
                if (!elem.parent().hasClass("active")) {
                    $(".tab-title").parent().removeClass("active");
                    elem.parent().addClass("active")
                }
            });
        });
        $(".searchbar_tab div").click(function(){
            if($(this).data('t') == 1){
                $("#tab_sell").removeClass('g_hidden');
                $("#tab_buy").addClass('g_hidden');
            }
            else{
                $("#tab_buy").removeClass('g_hidden');
                $("#tab_sell").addClass('g_hidden');
            }
        })
    </script>
@endsection

@section('content')
    <style>
        #gameChart .gameChart_title_list div {
            border: solid 1px #3d9fff;
            border-top: none;
            border-right: none;
            width: 136.4px;
        }
        #gameChart .gameChart_title_list .game_on {
            background: initial !important;
            color: black;
            border: solid 1px #3d9fff;
            border-bottom: none;
        }
        #gameChart .gameChart_title_list {
            border: none !important;
        }
    </style>
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <input type="hidden" name="new_except" value="">
    <div class="g_layer service_layer" id="service_layer">
        <div class="inner"> <a href="javascript:;" class="close" id="service_close">닫기</a>
            <div class="title f-15"> 즐겨찾는 서비스 <span class="f-13">최대 8개를 선택할수 잇습니다.</span>
                <div class="r_area"> <a href="javascript:;" class="btn_white2 save" id="service_save">저장</a> <a href="javascript:;" class="btn_white2 init" id="service_init">초기화</a> </div>
            </div>
            <ul class="service_list" id="service_list">
                <li class="service_list_btn @if(!empty($fav[1])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="1" @if(!empty($fav[1])) checked @endif> <span class="tmp_checkbox"></span> <span class="SpGroup mileage"></span> 내 마일리지 </label>
                </li>
                <li class="service_list_btn @if(!empty($fav[2])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="2" @if(!empty($fav[2])) checked @endif> <span class="tmp_checkbox"></span> <span class="SpGroup counsel"></span> 상담내역보기 </label>
                </li>
                <li class="service_list_btn @if(!empty($fav[3])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="3" @if(!empty($fav[3])) checked @endif> <span class="tmp_checkbox"></span> <span class="SpGroup sell"></span> 판매관련물품 </label>
                </li>
                <li class="service_list_btn @if(!empty($fav[4])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="4" @if(!empty($fav[4])) checked @endif> <span class="tmp_checkbox"></span> <span class="SpGroup buy"></span> 구매관련물품 </label>
                </li>
                <li class="service_list_btn @if(!empty($fav[5])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="5" @if(!empty($fav[5])) checked @endif> <span class="tmp_checkbox"></span> <span class="SpGroup charge"></span> 마일리지충전 </label>
                </li>
                <li class="service_list_btn @if(!empty($fav[6])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="6" @if(!empty($fav[6])) checked @endif> <span class="tmp_checkbox"></span> <span class="SpGroup calc"></span> 수수료 </label>
                </li>
                <li class="service_list_btn @if(!empty($fav[7])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="7" @if(!empty($fav[7])) checked @endif> <span class="tmp_checkbox"></span> <span class="SpGroup credit_rating"></span> 신용등급/수수료 </label>
                </li>
                <li class="service_list_btn @if(!empty($fav[8])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="8" @if(!empty($fav[8])) checked @endif> <span class="tmp_checkbox"></span> <span class="SpGroup guide"></span> 초보자가이드 </label>
                </li>
                <li class="service_list_btn @if(!empty($fav[9])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="9" @if(!empty($fav[9])) checked @endif> <span class="tmp_checkbox"></span> <span class="SpGroup faq"></span> FAQ </label>
                </li>
                <li class="service_list_btn @if(!empty($fav[10])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="10" @if(!empty($fav[10])) checked @endif> <span class="tmp_checkbox"></span> <span class="SpGroup message"></span> 메시지함 </label>
                </li>

            </ul>
        </div>
    </div>
    <div class="top_full">
        <div class="top_area">
            <!--▼▼▼ 거래 중앙 롤링 배너 ▼▼▼ -->
            <div class="carousel_module" data-code="TR0001">
                <div class="banner_in center_banner" id="center_banner">
                    <div class="banner_item" data-idx="0">
                        <a href="#" target="_blank"> <img class="carousel_images" src="/assets/img/bkg/main-slide1.jpg" alt="출석이벤트(가을)" title="출석이벤트(가을)"> </a>
                    </div>
                    <div class="banner_item" data-idx="1">
                        <a href="#" target="_blank"> <img class="carousel_images" src="/assets/img/bkg/main-slide1.jpg" alt="출석이벤트(가을)" title="출석이벤트(가을)"> </a>                    </div>
                    <div class="banner_item" data-idx="2">
                        <a href="#" target="_blank"> <img class="carousel_images" src="/assets/img/bkg/main-slide1.jpg" alt="출석이벤트(가을)" title="출석이벤트(가을)"> </a>                    </div>
                    <div class="banner_item" data-idx="3">
                        <a href="#" target="_blank"> <img class="carousel_images" src="/assets/img/bkg/main-slide1.jpg" alt="출석이벤트(가을)" title="출석이벤트(가을)"> </a>                    </div>
                </div>
                <div class='banner_indicate indicate'></div>
            </div>
            <script>
                var selector = document.querySelector(".carousel_module")
                new Carousel(selector, {
                    "showNavi": false,
                    "showIndicate": true,
                    "delay": 3000,
                    "random": true
                });
            </script>
            <!--▲▲▲ 거래 중앙 롤링 배너 ▲▲▲ -->
            <div class="service_wrap">
                <div class="service_set">
                    <div class="service_favorite">즐겨찾는 서비스</div>
                    <a href="javascript:;" id="service_btn"><i class="sp_icon setting">설정</i></a>
                    <ul>
                        @foreach($list as $v)
                            <a href="{{getmyService()[$v['id']]['href']}}" target="_self">
                                <li>
                                    <span class="SpGroup counsel"></span><div class="f-16">{{getmyService()[$v['id']]['alias']}}</div>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>
                <div class="bg_opacity"></div>
            </div>
        </div>
    </div>
    <div class="content_center">
        <div class="sec_left realtime_status">
            <div class="initial_screen">
                <div class="tab searchbar_tab">
                    <div class="active" data-t="1">
                        <a class="f-18 tab-title" href="javascript:void(0);" >실시간 팝니다 목록</a>
                    </div>
                    <div data-t="2">
                        <a class="f-18 tab-title" href="javascript:void(0);" >실시간 삽니다 목록</a>
                    </div>
                </div>
                <div class="tab_content">
                    <div class="tab_child show">
                        <table class="f-14 no-border">
                            <tr>
                                <td class="realtime_list align-center no-border" >종류</td>
                                <td class="realtime_game align-center no-border" >게임명/서버명</td>
                                <td class="realtime_desc align-center no-border" >멘트</td>
                                <td class="realtime_money align-left no-border" >거래가격</td>
                            </tr>
                        </table>
                        <hr>
                        <div class="realtime_sell_wrapper" id="tab_sell">
                            <table class="realtime_sell_table f-14 no-border">
                                <tbody>
                                @if(!empty($sells))
                                    @foreach($sells as $v)
                                        @php
                                            $price_alias = "";
                                            $price = $v['user_price'];
                                            $game_unit = !empty($v['game_unit']) && $v['game_unit'] !=1 ? $v['game_unit'] : '';
                                            if(!empty($price)){
                                                if($v['user_quantity'] > 1 || !empty($v['game_unit']))
                                                    $price_alias = $v['user_quantity'].$v['game_unit'].'개당 '.number_format($price).'원';
                                                else
                                                    $price_alias = number_format($price).'원';
                                            }
                                            else{
                                                $price_alias = $v['user_division_unit'].$v['game_unit'].'개당 '.number_format($v['user_division_price']).'원';
                                            }
                                        @endphp
                                        <tr>
                                            <td class="realtime_list align-center no-border" >{{$v['good_type']}}</td>
                                            <td class="realtime_game no-border" >{{$v['game']['game']}} > {{$v['server']['game']}}</td>
                                            <td class="realtime_desc no-border text-center" >{{$v['user_title']}}</td>
                                            <td class="realtime_money  no-border align-left" >{{$price_alias}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="realtime_sell_wrapper g_hidden" id="tab_buy">
                            <table class="realtime_sell_table f-14 no-border">
                                <tbody>
                                @if(!empty($buys))
                                    @foreach($buys as $v)
                                        @php
                                            $price_alias = "";
                                            $price = $v['user_price'];
                                            $game_unit = !empty($v['game_unit']) && $v['game_unit'] !=1 ? $v['game_unit'] : '';
                                            if(!empty($price)){
                                                if($v['user_quantity'] > 1 || !empty($v['game_unit']))
                                                    $price_alias = $v['user_quantity'].$v['game_unit'].'개당 '.number_format($price).'원';
                                                else
                                                    $price_alias = number_format($price).'원';
                                            }
                                            else{
                                                $price_alias = $v['user_division_unit'].$v['game_unit'].'개당 '.number_format($v['user_division_price']).'원';
                                            }
                                        @endphp
                                        <tr>
                                            <td class="realtime_list align-center no-border" >{{$v['good_type']}}</td>
                                            <td class="realtime_game no-border" >{{$v['game']['game']}} > {{$v['server']['game']}}</td>
                                            <td class="realtime_desc no-border text-center" >{{$v['user_title']}}</td>
                                            <td class="realtime_money  no-border align-left" >{{$price_alias}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab_child" data-content="tab_mygame">
                        <ul class="g_my_search"></ul>
                    </div>
                </div>
            </div>
            <div class="gs_list g_hidden" data-gslist="true"></div>
        </div>
        <div class="sec_right">
            <div class="box3 gamenews">
                <div class="title f-18 f-normal"> 공지사항 </div>
                <ul class="g_list news_list f-14">
                    @foreach($notices as $v)
                        <li>
                            <a href="/news/view?seq={{$v['id']}}">
                                {{$v['title']}}<span class="comp">{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="g_finish"></div>

        <div class="sec_left no-border">
            <div class="title">게임별 시세정보
            </div>
            <div id="gameChart" class="border-normal"></div>
        </div>
        <div class="sec_right no-border">
            <div class="title"> 게임순위 </div>
            <div class="border-normal d-flex">
                <ul class="rank_list">
                    @for($i  = 0; $i< 5; $i++)
                        @if(empty($game_list[$i]))
                            @php
                                continue;
                            @endphp
                        @endif
                        <li @if($i < 3)class="top"@endif> <span class="num">{{$i+1}}</span> <span class="game_name">{{$game_list[$i]['game']['game']}}</span> <span class="sp_icon @if(($game_list[$i]['orders'] - $game_list[$i]['old_order']) > 0)up @endif @if(($game_list[$i]['orders'] - $game_list[$i]['old_order']) < 0)down @endif  @if(($game_list[$i]['orders'] - $game_list[$i]['old_order']) == 0) none @endif"></span> </li>
                    @endfor
                </ul>
                <ul class="rank_list">
                    @for($i  = 5; $i< 10; $i++)
                        @if(empty($game_list[$i]))
                            @php
                                continue;
                            @endphp
                        @endif
                        <li> <span class="num">{{$i+1}}</span> <span class="game_name">{{$game_list[$i]['game']['game']}}</span> <span class="sp_icon @if(($game_list[$i]['orders'] - $game_list[$i]['old_order']) > 0)up @endif @if(($game_list[$i]['orders'] - $game_list[$i]['old_order']) < 0)down @endif @if(($game_list[$i]['orders'] - $game_list[$i]['old_order']) == 0) none @endif"></span> </li>
                    @endfor
                </ul>
            </div>
        </div>
        <div class="g_finish"></div>

        <div class="d-flex w-100">
            <div class="w-50 sec_left no-border back-normal " style="margin-right: 10px;">
                <div class="title no-border">
                    전화 상담안내
                </div>
                <div class="d-flex w-100 inquery_part">
                    <img src="/assets/img/icons/inquery_time.png" height="91" width="97" />
                    <div class="bottom_info">
                        <span class="call_num">1532-9945</span>
                        <span class="call_txt">365일 24시간 연중무휴</span>
                    </div>
                </div>
            </div>
            <div class="w-50 sec_right no-border">
                <div class="title">
                    마일리지 충전
                    <div class="move_btn" id="chargeBtn">
                        <a href="javascript:;" data-type="p"><i class="sp_icon btn_prev">이전</i></a>
                        <a href="javascript:;" data-type="n"><i class="sp_icon btn_next">다음</i></a>
                    </div>
                </div>
                <div class="charge_wrap border-normal fixed-height" id="charge_list">
                    <ul class="charge_list">
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/tcash',700,900);">
                                <span class="c_name">티캐시</span>
                                <span class="sp_main tcash"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/ktclip',700,900);">
                                <span class="c_name">카드포인트 </span>
                                <span class="sp_main ktclip"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/onlyhpmn',700,900);">
                                <span class="c_name">해피머니상품권</span>
                                <span class="sp_main happy"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/onlyculture',700,900);">
                                <span class="c_name">문화상품권</span>
                                <span class="sp_main culture"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/phone_ars',700,900);">
                                <span class="c_name">휴대폰 ARS충전</span>
                                <span class="sp_main phone_ars"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/bookgift',700,900);">
                                <span class="c_name">도서문화상품권</span><span class="sp_main book"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/realaccount',700,900);"><span
                                    class="c_name">자동이체</span><span class="sp_main realaccount"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/onlydgcl',700,900);"><span
                                    class="c_name">스마트문상(게임문상)</span><span class="sp_main smart"></span></a>
                        </li>
                    </ul>
                    <ul class="charge_list">
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/cashgate',700,900);"><span
                                    class="c_name">캐시플러스</span><span class="sp_main cashgate"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/touchpay',700,900);"><span
                                    class="c_name">터치페이</span><span class="sp_main touchpay"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/teencash',700,900);"><span
                                    class="c_name">틴캐시</span><span class="sp_main teen"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/eggmoney',700,900);"><span
                                    class="c_name">에그머니</span><span class="sp_main eggmoney"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/tmoney',700,900);"><span
                                    class="c_name">모바일 티머니</span><span class="sp_main tmoney"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/pointpark',700,900);"><span
                                    class="c_name">포인트충전</span><span class="sp_main point"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/gpgw',700,900);"><span
                                    class="c_name">GP쿠폰</span><span class="sp_main gpcoupon"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/angelcoupon',700,900);"><span
                                    class="c_name">매니아 선불</span><span class="sp_main maniacoupon"></span></a>
                        </li>
                    </ul>
                    <ul class="charge_list">
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/funnycard',700,900);"><span
                                    class="c_name">퍼니카드</span><span class="sp_main funny"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/coupon',700,900);"><span
                                    class="c_name">이벤트쿠폰</span><span class="sp_main coupon"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/ars',700,900);"><span
                                    class="c_name">ARS</span><span class="sp_main ars"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/cashbee',700,900);"><span
                                    class="c_name">모바일 캐시비</span><span class="sp_main cashbee"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/creditcard',700,900);"><span
                                    class="c_name">신용카드 충전</span><span class="sp_main creditcard"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/okcashbag',700,900);"><span
                                    class="c_name">OK캐시백</span><span class="sp_main okcashbag"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/mileage',700,900);"><span
                                    class="c_name">마일리지 상품권</span><span class="sp_main mileage"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/index',700,900);"><span
                                    class="c_name">전용계좌</span><span class="sp_main account"></span></a>
                        </li>
                    </ul>
                    <ul class="charge_list">
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/mmileage',700,900);"><span
                                    class="c_name">M마일리지 이용권</span><span class="sp_main mmileage"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/im_gift',700,900);"><span
                                    class="c_name">IM기프트</span><span class="sp_main imgift"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/mobilepop',700,900);"><span
                                    class="c_name">모바일팝</span><span class="sp_main mobilepop"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/pipe',700,900);"><span
                                    class="c_name">암호화폐 충전</span><span class="sp_main pipe"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/paycoin',700,900);"><span
                                    class="c_name">페이코인 충전</span><span class="sp_main paycoin"></span></a>
                        </li>
                        <li>
                            <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/kbank',700,900);"><span
                                    class="c_name">케이뱅크 페이</span><span class="sp_main kbank"></span></a>
                        </li>
                    </ul>
                    <i class="border_hz"></i>
                </div>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 테스트 홈 //-->
    <!-- ▲ 컨텐츠 영역 //-->

@endsection
