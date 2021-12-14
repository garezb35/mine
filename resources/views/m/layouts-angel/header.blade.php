
<div class="g_layer all_menu_layer" id="all_menu_layer">
    <div class="inner"> <a href="javascript:;" class="sp_icon close_r" id="menu_close">닫기</a> </div>
</div>
<div class="quickmenu_area" id="quickmenu_area">
    <div class="inner">
        <ul class="quickmenu close" id="quickmenu">
            <li><a href="javascript:;" data-type="user_info">
                    <span class="user_info"></span>
                </a>
                <div><i>나의 거래정보</i></div>
            </li>
        </ul>
        <div class="quickmenu_dtl" id="quickmenu_dtl">
            <a href="javascript:;" class="sp_icon close" id="quickmenu_close">닫기</a>
            <div class="quickmenu_cont" id="quickmenu_cont"></div>
        </div>
    </div>
</div>
<!--▲▲▲ 거래 탑 배너 ▲▲▲ -->
<div class="g_header ">
    <div class="top_bg">
        <div class="top-ads-part">
            <div class="top-ads-content">
                <table class="w-init m-auto no-border p-0" cellpadding="0" cellspacing="0" style="padding-top :40px">
                    <tr>
                        <td class="p-0 no-border">
                            <p class="ads-title p-0">봄맞이 이벤트</p>
                        </td>
                        <td class="p-0 no-border">
                            <p class="f-16 c-white ads-content">모바일캐시비 충전하면 2천원추가충전</br>꽝없는 적립금 지급은 Bonus!</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="border-bottom">
            <div class="g_snav">
                <ul class="snav_left"></ul>
                <ul class="snav_right">
                    <li><a href="{{route('myroom')}}">마이룸</a></li>
                    <li><a href="{{route('main_customer')}}">고객센터</a></li>
                    <li><a href="#">회원가입</a></li>
                    @if(auth()->check())
                        <li><a href="/logout">로그아웃</a></li>
                    @else
                        <li><a href="/login">로그인</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="g_logo_area">
        <div class="logo">
            <a href="/"><img id="logo_img" src="/assets/img/logo.png" alt="taxify"></a>
        </div>
        <div class="g_search_top ">
            <form id="g_searchbar_form" method="post" action="" onsubmit="return searchbarSubmit();">
                @csrf
                <input type="hidden" name="search_game" value="{{$search_game ?? ''}}">
                <input type="hidden" name="search_game_text" value="{{$search_game_text ?? ''}}">
                <input type="hidden" name="search_server" value="{{$search_server ?? ''}}">
                <input type="hidden" name="search_server_text" value="{{$search_server_text ?? ''}}">
                <input type="hidden" name="search_goods" value="{{$search_goods ?? ''}}">
                <div class="g_search_wrapper">
                    <div class="search_area no-border">
                        <input type="text" class="g_text search_gs_name" name="searchGameServer" id="searchGameServer" title="게임검색" style="ime-mode:active" placeholder="게임명 또는 서버명을 입력해주세요." autocomplete="off" data-gameserver="true">
                    </div>
                    <button type="submit" class="g_search_list" id="g_search_list" title="검색"> <i class="fa fa-search" style="font-size: 19px"></i> </button>
                    <div class="g_search_frame g_hidden">
                        <div class="g_trade_type align-center">
                            <label class="radiocontainer f_blue1"> 팝니다
                                <input type="radio" name="search_type" value="sell" @if(empty($_POST['search_type']) || $_POST['search_type'] != 'buy') checked @endif> <span class="checkmark"></span> </label>
                            <label class="radiocontainer f_green1"> 삽니다
                                <input type="radio" name="search_type" value="buy" @if(!empty($_POST['search_type']) && $_POST['search_type'] == 'buy') checked @endif> <span class="checkmark"></span> </label>
                        </div>
                        <div class="initial_screen">
                            <div class="tab searchbar_tab">
                                <div class="active"> <a href="javascript:;" data-target="tab_lastsearch">최근검색게임</a> </div>
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
                                <div class="popular_game_title">
                                    <span>거래가능게임</span>
                                </div>
                                <ul class="popular_list">
                                    @if(!empty($popular))
                                        @foreach($popular as $rate=>$v)
                                         <li data-pgame="{{$v['game']['id']}}"> <em class="top_rank">{{$rate + 1}}</em>{{$v['game']['game']}} </li>
                                        @endforeach
                                    @endif

                                </ul>
                            </div>
                        </div>
                        <div class="gs_list g_hidden" data-gslist="true"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="nav_wrap">
        <div class="content_center">
            <ul class="nav nav_ct">
                <li><a href="/character">캐릭터 거래</a></li>
                <li><a href="/myroom">마이룸</a></li>
                <li><a href="{{route("giftcard")}}">상품권샵</a></li>
                <li><a href="{{route("guide")}}">이용안내</a></li>
            </ul>
            <ul class="nav nav_highlight">
                <li class="highlight"><a href="/sell">판매등록</a></li>
                <li class="highlight"><a href="/buy">구매등록</a></li>
            </ul>

        </div>
    </div>
</div>
