@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/home/index.css">
    <link type="text/css" rel="stylesheet" href="/angel/home/custom.css">
@endsection

@section('foot_attach')

    <script type="text/javascript" src="/angel/_js/insomnia.js"></script>
    <script type="text/javascript" src="/angel/diagram_chart/init.js"></script>
    <script type="text/javascript" src="/angel/js/home.js"></script>
    <script>
        function enterSearchList(id,game){
            $('input[name="filtered_game_id"]').val(id);
            $('input[name="filtered_game_alias"]').val(game);
            $("#search-overlay-container").submit()
        }
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
        <div style="overflow: auto;">
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
                                <ul>
                                </ul>
                            </div>
                            <div class="bg_opacity"></div>
                        </div>

                    </div>
                </div>
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
                                    if($key == 8) break;
                                @endphp
                                <div class="hotgame-li" style="text-align: center">
                                    <ul>
                                        <li class="hotgame-liimg" style="text-align: center">
                                            <a href="javascript:;" onclick="enterSearchList({{$gg['id']}},'{{$gg['game']}}')">
                                                <img src="{{$gg['icon']}}" alt="{{$gg['game']}}" title="{{$gg['game']}}">
                                            </a>
                                        </li>
                                        <a href="javascript:;" onclick="enterSearchList({{$gg['id']}},'{{$gg['game']}}')" class="hotgame-x"><li class="hotgame-keysbt">{{$gg['game']}}</li></a>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table @class('noborder visible--pc')>
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
        <div @class('visible--mobile p-1')>
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
            <div class="phone__contact m-t-5">
                <p class="ph__title">전화 상담안내</p>
                <div class="ph__content">
                    <div>
                        <p class="ph__title">1532-9945</p>
                        <p class="rest__part">365일 24시간 연중무휴</p>
                    </div>
                </div>
            </div>
            <div class="private__00">
                <a href="/customer/report" class="big_private__btn">1:1이용문의</a>
            </div>
        </div>
        <div class="empty-high"></div>


        <form id="search-overlay-container" method="post" action="" onsubmit="return searchbarSubmit();" target="mainFrame" class="d-none">
            @csrf
            <input type="hidden" name="filtered_game_id" value="{{$filtered_game_id ?? ''}}">
            <input type="hidden" name="filtered_game_alias" value="{{$filtered_game_alias ?? ''}}">
            <input type="hidden" name="filtered_child_id" value="{{$filtered_child_id ?? ''}}">
            <input type="hidden" name="filtered_child_alias" value="{{$filtered_child_alias ?? ''}}">
            <input type="hidden" name="filtered_items" value="{{$filtered_items ?? ''}}">
            <div class="top_game_searchbar">
                <div class="search_area no-border">
                    <input type="text" class="angel__text search_gs_name" name="searchGameServer" id="searchGameServer" title="게임검색" style="ime-mode:active" placeholder="게임명을 입력해주세요." autocomplete="off" data-gameserver="true">
                </div>
                <button type="submit" class="search__submit" id="search__submit" title="검색"><i @class('fa fa-search')></i></button>
                <div class="gameWindowPopup d-none">
                    <div class="gameTypePopup align-center">
                        <input type="radio" id="search_type1" name="search_type" value="sell" @if(empty($_POST['search_type']) || $_POST['search_type'] != 'buy') checked @endif style="display: none">
                        <input type="radio" id="search_type2" name="search_type" value="buy" @if(!empty($_POST['search_type']) && $_POST['search_type'] == 'buy') checked @endif style="display: none">

                    </div>
                    <div class="_34Cr45d_reacts">
                        <div class="tab searchbar_tab">
                            <div class="active"> <a href="javascript:;" data-target="tab_lastsearch">최근검색게임</a> </div>
                            <div> <a href="javascript:;" data-target="tab_mygame">즐겨찾는 게임</a> </div>
                        </div>
                        <div class="tab_content">
                            <div class="tab_child show" data-content="tab_lastsearch">
                                <ul class="recent_viewd_games"></ul>
                            </div>
                            <div class="tab_child" data-content="tab_mygame">
                                <ul class="mysearch_filters"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="angel__menugames d-none" data-gslist="true"></div>
                </div>
            </div>
        </form>
@endsection
