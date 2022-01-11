@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/home/index.css">
    <link type="text/css" rel="stylesheet" href="/angel/home/custom.css">
@endsection

@section('foot_attach')

    <script type="text/javascript" src="/angel/_js/insomnia.js"></script>
    <script type="text/javascript" src="/angel/diagram_chart/init.js"></script>
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
                $("#tab_sell").removeClass('d-none');
                $("#tab_buy").addClass('d-none');
            }
            else{
                $("#tab_buy").removeClass('d-none');
                $("#tab_sell").addClass('d-none');
            }
        })
        $(".list-box").noticerolling()
        function selectedPrice(v) {
            var fillRealMileage = $("#spnPrice");
            if($("#priceD:checked").val() != 0) {
                $("#price_custom").val("직접입력");
            }
            if(v == "0" || v.length < 1) {
                $("#priceD").prop('checked', true);
                if($("#price_custom").val() == "직접입력") {
                    $("#price_custom").val("");
                }
                if($("#price_custom").val() == "") {
                    fillRealMileage.html("0");
                } else {
                    var price = parseInt($("#price_custom").val()) + rgRate;
                    fillRealMileage.html(Number(price).currency());
                }
            } else {
                if(v < 0 || v < 1000) {
                    return;
                }
                // if(v >= 25000) {
                //     fillRealMileage.html(Number(Number(v) - parseInt((Number(Number(v) / 100) * $("#charge_rate").val()))).currency());
                // } else {
                //     fillRealMileage.html(Number(Number(v) - Number($('#commission').val())).currency());
                // }
                fillRealMileage.html(Number(Number(v) - Number($('#commission').val())).currency());
            }
            $('input[name="price"]').val(v);
        }
        $(".mileage_charge").click(function() {
            var type = 1;
            if (confirm("충전하시겟습니까?")) {
                var hitURL = "";
                hitURL = "/api/mileage/charge/proc";
                type = 2;
                ajaxRequest({
                    url:  hitURL,
                    type: "POST",
                    data: {
                        price: $("#price").val(),
                        api_token: a_token
                    },
                    dataType:'json',
                    success: function(response) {
                        if (response.status == "success") {
                            alert("조작이 성공햇습니다.");
                            socket_client.emit("admin_notice",{
                                type: type,
                                userName: "{{$me['name'] ?? ""}}"
                            })
                            window.parent.location = "{{route('my_mileage_detail_list')}}";
                        }
                        else
                            alert("조작이 실패햇습니다.");

                    }
                });
            }
        });
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

    <input type="hidden" name="new_except" value="">
    <div class="react___gatsby settings_window" id="settings_window">
        <div class="inner"> <a href="javascript:;" class="close" id="disableSettings">닫기</a>
            <div class="title f-15">
                즐겨찾는 서비스 <span class="f-13">최대 8개를 선택할수 잇습니다.</span>
                <div class="r_area">
                    <a href="javascript:;" class="btn_white2 save" id="submit_menus">저장</a>
                    <a href="javascript:;" class="btn_white2 init" id="reset_menus">초기화</a>
                </div>
            </div>
            <ul class="service_list" id="service_list">
                <li class="arrange_menus @if(!empty($fav[1])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="1" @if(!empty($fav[1])) checked @endif> <span class="tmp_checkbox"></span> <span class="has-sprite mileage"></span> 내 마일리지 </label>
                </li>
                <li class="arrange_menus @if(!empty($fav[2])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="2" @if(!empty($fav[2])) checked @endif> <span class="tmp_checkbox"></span> <span class="has-sprite counsel"></span> 상담내역보기 </label>
                </li>
                <li class="arrange_menus @if(!empty($fav[3])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="3" @if(!empty($fav[3])) checked @endif> <span class="tmp_checkbox"></span> <span class="has-sprite sell"></span> 판매관련물품 </label>
                </li>
                <li class="arrange_menus @if(!empty($fav[4])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="4" @if(!empty($fav[4])) checked @endif> <span class="tmp_checkbox"></span> <span class="has-sprite buy"></span> 구매관련물품 </label>
                </li>
                <li class="arrange_menus @if(!empty($fav[5])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="5" @if(!empty($fav[5])) checked @endif> <span class="tmp_checkbox"></span> <span class="has-sprite charge"></span> 마일리지충전 </label>
                </li>
                <li class="arrange_menus @if(!empty($fav[6])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="6" @if(!empty($fav[6])) checked @endif> <span class="tmp_checkbox"></span> <span class="has-sprite calc"></span> 수수료 </label>
                </li>
                <li class="arrange_menus @if(!empty($fav[7])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="7" @if(!empty($fav[7])) checked @endif> <span class="tmp_checkbox"></span> <span class="has-sprite credit_rating"></span> 신용등급/수수료 </label>
                </li>
                <li class="arrange_menus @if(!empty($fav[8])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="8" @if(!empty($fav[8])) checked @endif> <span class="tmp_checkbox"></span> <span class="has-sprite guide"></span> 초보자가이드 </label>
                </li>
                <li class="arrange_menus @if(!empty($fav[9])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="9" @if(!empty($fav[9])) checked @endif> <span class="tmp_checkbox"></span> <span class="has-sprite faq"></span> FAQ </label>
                </li>
                <li class="arrange_menus @if(!empty($fav[10])) on @endif">
                    <label>
                        <input type="checkbox" class="cs_checkbox" name="service[]" value="10" @if(!empty($fav[10])) checked @endif> <span class="tmp_checkbox"></span> <span class="has-sprite message"></span> 메시지함 </label>
                </li>

            </ul>
        </div>
    </div>
    <style>
        .service_wrap, .bg_opacity {
            height:  38px;
        }
        .service_set>ul {
            padding: 0px 10px 0;
            padding-left: 40px;
        }
        .service_set .setting {
            top: 12px;
            left: 10px;
        }

        ._34Cr45d_reacts .tab>div {
            height: 40px;
            line-height: 40px;
        }
        .title, .box3 .title {
            padding: 8px 20px 8px !important;
        }
    </style>

    <div class="content_center" id="home__content">
        <div class="sec_left realtime_status">
            <div class="top_full">
                <div class="top_area">
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
                    <div class="service_wrap">
                        <div class="service_set">
                            {{--                        <a href="javascript:;" id="enableSettings"><i class="fa fa-cog setting f-18 text-white"></i></a>--}}
                            <ul>
                                {{--                            @foreach($list as $v)--}}
                                {{--                                <a href="{{getmyService()[$v['id']]['href']}}" target="_self">--}}
                                {{--                                    <li>--}}
                                {{--                                        <img style="margin-top:10px" src="{{getmyService()[$v['id']]['img']}}" height="{{getmyService()[$v['id']]['height']}}" width="17">--}}
                                {{--                                        <div class="f-16">{{getmyService()[$v['id']]['alias']}}</div>--}}
                                {{--                                    </li>--}}
                                {{--                                </a>--}}
                                {{--                            @endforeach--}}
                            </ul>
                        </div>
                        <div class="bg_opacity"></div>
                    </div>

                </div>
            </div>
{{--            <div class="neworder-box clearfix">--}}
{{--                <p class="key">--}}
{{--                    최근거래--}}
{{--                </p>--}}
{{--                <div class="list-box">--}}
{{--                    <ul class="clearfix" style="top: 0px;" id="list-box_illl">--}}
{{--                        @foreach($completed_orders as $compled)--}}
{{--                            <li>--}}
{{--                                <a class="link"><span class="game con red">[{{$compled['type'] == 'sell' ? '팝니다':'삽니다'}}]</span>--}}
{{--                                    <span class="detail con">[ {{$compled['game']['game']}} > {{$compled['server']['game']}} > {{$compled['good_type']}} ] {{$compled['user_title']}}</span>--}}
{{--                                    <span class="price con">거래가격：<span class="red">{{number_format($compled['payitem']['price'])}}원</span></span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="title">게임별 시세정보--}}
{{--            </div>--}}
{{--            <div id="gameChart" class="border-normal"></div>--}}
{{--            <div class="_34Cr45d_reacts">--}}
{{--                <div class="tab searchbar_tab">--}}
{{--                    <div class="active" data-t="1">--}}
{{--                        <a class="f-18 tab-title" href="javascript:void(0);" >실시간 팝니다 목록</a>--}}
{{--                    </div>--}}
{{--                    <div data-t="2">--}}
{{--                        <a class="f-18 tab-title" href="javascript:void(0);" >실시간 삽니다 목록</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="tab_content">--}}
{{--                    <div class="tab_child show">--}}
{{--                        <table class="f-14 no-border">--}}
{{--                            <tr>--}}
{{--                                <td class="realtime_list align-center no-border" >종류</td>--}}
{{--                                <td class="realtime_game align-center no-border" >게임명/서버명</td>--}}
{{--                                <td class="realtime_desc align-center no-border" >멘트</td>--}}
{{--                                <td class="realtime_money align-left no-border" >거래가격</td>--}}
{{--                            </tr>--}}
{{--                        </table>--}}
{{--                        <hr>--}}
{{--                        <div class="realtime_sell_wrapper" id="tab_sell">--}}
{{--                            <table class="realtime_sell_table f-14 no-border">--}}
{{--                                <tbody>--}}
{{--                                @if(!empty($sells))--}}
{{--                                    @foreach($sells as $v)--}}
{{--                                        @php--}}
{{--                                            $price_alias = "";--}}
{{--                                            $price = $v['user_price'];--}}
{{--                                            $game_unit = !empty($v['game_unit']) && $v['game_unit'] !=1 ? $v['game_unit'] : '';--}}
{{--                                            if(!empty($price)){--}}
{{--                                                if($v['user_quantity'] > 1 || !empty($v['game_unit']))--}}
{{--                                                    $price_alias = $v['user_quantity'].$v['game_unit'].'개당 '.number_format($price).'원';--}}
{{--                                                else--}}
{{--                                                    $price_alias = number_format($price).'원';--}}
{{--                                            }--}}
{{--                                            else{--}}
{{--                                                $price_alias = $v['user_division_unit'].$v['game_unit'].'개당 '.number_format($v['user_division_price']).'원';--}}
{{--                                            }--}}
{{--                                        @endphp--}}
{{--                                        <tr>--}}
{{--                                            <td class="realtime_list align-center no-border" >{{$v['good_type']}}</td>--}}
{{--                                            <td class="realtime_game no-border" >{{$v['game']['game']}} > {{$v['server']['game']}}</td>--}}
{{--                                            <td class="realtime_desc no-border text-center" >{{$v['user_title']}}</td>--}}
{{--                                            <td class="realtime_money  no-border align-left" >{{$price_alias}}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <div class="realtime_sell_wrapper d-none" id="tab_buy">--}}
{{--                            <table class="realtime_sell_table f-14 no-border">--}}
{{--                                <tbody>--}}
{{--                                @if(!empty($buys))--}}
{{--                                    @foreach($buys as $v)--}}
{{--                                        @php--}}
{{--                                            $price_alias = "";--}}
{{--                                            $price = $v['user_price'];--}}
{{--                                            $game_unit = !empty($v['game_unit']) && $v['game_unit'] !=1 ? $v['game_unit'] : '';--}}
{{--                                            if(!empty($price)){--}}
{{--                                                if($v['user_quantity'] > 1 || !empty($v['game_unit']))--}}
{{--                                                    $price_alias = $v['user_quantity'].$v['game_unit'].'개당 '.number_format($price).'원';--}}
{{--                                                else--}}
{{--                                                    $price_alias = number_format($price).'원';--}}
{{--                                            }--}}
{{--                                            else{--}}
{{--                                                $price_alias = $v['user_division_unit'].$v['game_unit'].'개당 '.number_format($v['user_division_price']).'원';--}}
{{--                                            }--}}
{{--                                        @endphp--}}
{{--                                        <tr>--}}
{{--                                            <td class="realtime_list align-center no-border" >{{$v['good_type']}}</td>--}}
{{--                                            <td class="realtime_game no-border" >{{$v['game']['game']}} > {{$v['server']['game']}}</td>--}}
{{--                                            <td class="realtime_desc no-border text-center" >{{$v['user_title']}}</td>--}}
{{--                                            <td class="realtime_money  no-border align-left" >{{$price_alias}}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="tab_child" data-content="tab_mygame">--}}
{{--                        <ul class="mysearch_filters"></ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div style="display:flex">--}}
{{--                <div class="w-50 no-border back-normal " style="margin-right: 10px;height: 188px;padding-top: 33px">--}}
{{--                    <div class="title no-border">--}}
{{--                        전화 상담안내--}}
{{--                    </div>--}}
{{--                    <div class="d-flex w-100 inquery_part">--}}
{{--                        <img src="/assets/img/icons/inquery_time.png" height="91" width="97" />--}}
{{--                        <div class="bottom_info">--}}
{{--                            <span class="call_num">1532-9945</span>--}}
{{--                            <span class="call_txt">365일 24시간 연중무휴</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-50  no-border back-normal" style="    height: 125px;--}}
{{--    text-align: right;--}}
{{--    margin-right: 11px;--}}
{{--    padding-top: 51px;">--}}
{{--                    <a href="/customer/report"><img src="/assets/img/button/btn_using_inquery.png" width="160px"></a>--}}
{{--                    <a href="/customer"><img src="/assets/img/button/btn_24_time.png" width="160px"></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="angel__menugames d-none" data-gslist="true"></div>--}}
        </div>
        <div class="sec_right">
            <div class="box3 gamenews">
                <div class="title f-18 f-normal"> 공지사항 </div>
                <div>
                    @if(!empty($notices))
                    <p @class('notice__title')>{{$notices[0]['title']}}</p>
                    <div @class('notice__content')>{!! $notices[0]['content'] !!}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="module-gamelist" id="gameList">
            <div class="inner-border border-right">
                <div class="inner-border">
                    <div class="gold-with">
                        <div class="goldtop">
                            <div class="goldtoplf">인기게임</div>
                            <div @class('border-bottom')></div>
                            {{--                                <div class="goldtoprg"></div>--}}
                        </div>
                        <div class="goldmid">
                            @foreach($games_home as $key=>$gg)
                                @php
                                    if($key == 10) break;
                                @endphp
                                <div class="hotgame-li" style="text-align: center">
                                    <ul>
                                        <li class="hotgame-liimg" style="text-align: center"><a href="javascript:;" onclick="enterSearchList({{$gg['id']}},'{{$gg['game']}}')"><img src="{{$gg['icon']}}" alt="{{$gg['game']}}" title="{{$gg['game']}}"></a></li>
                                        <a href="javascript:;" onclick="enterSearchList({{$gg['id']}},'{{$gg['game']}}')" class="hotgame-x"><li class="hotgame-keysbt">{{$gg['game']}}</li></a>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{--                        <div class="gamelist-wrap">--}}
                    {{--                            <ul class="gamelist-ul clearfix hotgame-hotspell">--}}
                    {{--                                @foreach($games_home as $gg)--}}
                    {{--                                    <li data-code="{{$gg['id']}}" data-gamename="{{$gg['game']}}" class="goods_more_btn">--}}
                    {{--                                        <a class="link-all" href="javascript:;" target="_self">--}}
                    {{--                                            <img class="lazyload" src="{{$gg['icon']}}"  alt="{{$gg['game']}}" style="display: block;">--}}
                    {{--                                            <p class="name">{{$gg['game']}}</p>--}}
                    {{--                                        </a>--}}
                    {{--                                    </li>--}}
                    {{--                                @endforeach--}}

                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                </div>
            </div>
        </div>
        <table @class('noborder')>
            <colgroup>
                <col width="50%"/>
            </colgroup>
            <tr>
                <td>
                    <div class="title"> 게임순위 </div>
                    <div class="border-normal d-flex bg-white">
                        <ul class="rank_list">
                            @for($i  = 0; $i< 5; $i++)
                                @if(empty($game_list[$i]))
                                    @php
                                        continue;
                                    @endphp
                                @endif
                                <li @if($i < 3)class="top"@endif> <span class="num">{{$game_list[$i]['id']}}</span>
                                    <span class="game_name">{{$game_list[$i]['game']}}</span>
                                    <span class="ranks_orders {{$game_list[$i]['type']}}"></span>
                                </li>
                            @endfor
                        </ul>
                        <ul class="rank_list">
                            @for($i  = 5; $i< 10; $i++)
                                @if(empty($game_list[$i]))
                                    @php
                                        continue;
                                    @endphp
                                @endif
                                <li @if($i < 3)class="top"@endif> <span class="num">{{$game_list[$i]['id']}}</span>
                                    <span class="game_name">{{$game_list[$i]['game']}}</span> <span class="ranks_orders {{$game_list[$i]['type']}}"></span>
                                </li>
                            @endfor
                        </ul>
                    </div>
                </td>
                <td></td>
            </tr>
        </table>
        <div class="empty-high"></div>
    </div>
@endsection



<!--
<div class="title"> 게임순위 </div>
            <div class="border-normal d-flex">
                <ul class="rank_list">
                    @for($i  = 0; $i< 5; $i++)
    @if(empty($game_list[$i]))
        @php
            continue;
        @endphp
    @endif
        <li @if($i < 3)class="top"@endif> <span class="num">{{$game_list[$i]['id']}}</span>
                            <span class="game_name">{{$game_list[$i]['game']}}</span>
                            <span class="ranks_orders {{$game_list[$i]['type']}}"></span>
                        </li>
                    @endfor
    </ul>
    <ul class="rank_list">
@for($i  = 5; $i< 10; $i++)
    @if(empty($game_list[$i]))
        @php
            continue;
        @endphp
    @endif
        <li @if($i < 3)class="top"@endif> <span class="num">{{$game_list[$i]['id']}}</span>
                            <span class="game_name">{{$game_list[$i]['game']}}</span> <span class="ranks_orders {{$game_list[$i]['type']}}"></span>
                        </li>
                    @endfor
    </ul>
</div>
<div id="charge_main">
    <form id="ini" name="ini" action="" method="post">
        <input type="hidden" name="commission" id="commission" value="0" />
        <input type="hidden" name="charge_rate" id="charge_rate" value="2" />
        <input type="hidden" name="ITEM_OID" value="" />
        <input type="hidden" name="price" id="price" />
        <div id="" class="highlight_contextual_nodemon">충전금액 선택</div>
        <div class="f-bold" style="background: #e4eef0; padding: 24px;">
            <div class="d-flex m-auto">
                <div class="align-center" style="width: 33.33%">
                    <input type="radio" name="selectPrice" id="selectPrice10000" value="10000" class="g_radio" onclick="selectedPrice(this.value);" />
                    <label for="selectPrice10000">10,000 원</label>
                </div>
                <div class="align-center" style="width: 33.33%">
                    <input type="radio" name="selectPrice" id="selectPrice20000" value="20000" class="g_radio" onclick="selectedPrice(this.value);" />
                    <label for="selectPrice20000">20,000 원</label>
                </div>
                <div class="align-center" style="width: 33.33%">
                    <input type="radio" name="selectPrice" id="selectPrice30000" value="30000" class="g_radio" onclick="selectedPrice(this.value);" />
                    <label for="selectPrice30000">30,000 원</label>
                </div>
            </div>
            <div class="d-flex m-auto" style=" margin-top: 10px; margin-bottom: 10px;">
                <div class="align-center" style="width: 33.33%">
                    <input type="radio" name="selectPrice" id="selectPrice100000" value="100000" class="g_radio" onclick="selectedPrice(this.value);" />
                    <label for="selectPrice100000">100,000 원</label>
                </div>
                <div class="align-center" style="width: 33.33%">
                    <input type="radio" name="selectPrice" id="selectPrice300000" value="300000" class="g_radio" onclick="selectedPrice(this.value);" />
                    <label for="selectPrice300000">300,000 원</label>
                </div>
                <div class="align-center" style="width: 33.33%">
                    <input type="radio" name="selectPrice" id="selectPrice500000" value="500000" class="g_radio" onclick="selectedPrice(this.value);" />
                    <label for="selectPrice500000">500,000 원</label>
                </div>
            </div>
            <hr style="width: 60%;">
            <div class="m-auto align-center" style="width: 60%;">
                <input type="radio" name="selectPrice" id="priceD" value="0" class="g_radio" onclick="selectedPrice(this.value)" />
                <input type="text" name="price_custom" id="price_custom" maxlength="6" class="angel__text" onclick="selectedPrice(0)" onblur="fnCustomOut()" onkeyup="onlynum(this.value);selectedPrice(this.value)" maxlength="5" />원
            </div>
        </div>

        <div class="empty-high"></div>
        <div class="m_button" style="text-align: center">
            <a href="javascript:void(0)" class="mileage_charge btn-color-img btn-blue-img" style="" >충전하기</a>
        </div>
    </form>
</div>
-->
