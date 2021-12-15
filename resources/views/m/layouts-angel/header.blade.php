
<div class="react___gatsby outterWrapper" id="outterWrapper">
    <div class="inner"> <a href="javascript:;" class="sp_icon close_r" id="menu_close">닫기</a> </div>
</div>
<div class="toolbar-btn" id="toolbar-btn">
    <div class="inner">
        <ul class="drawer-content-menu close" id="drawer-content-menu">
            <li><a href="javascript:;" data-type="user_info">
                    <span class="user_info"></span>
                </a>
                <div><i>나의 거래정보</i></div>
            </li>
        </ul>
        <div class="sidebar-btn" id="sidebar-btn">
            <a href="javascript:;" class="sp_icon close" id="sidebar-cls">닫기</a>
            <div class="toobar-content" id="toobar-content"></div>
        </div>
    </div>
</div>
<div class="siteHeader ">
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
            <div class="js-nav-menu">
                <ul class="js-nav-justicy-left"></ul>
                <ul class="js-nav-justicy-right">
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
    <div class="header-brand-logo">
        <div class="logo">
            <a href="/"><img id="hsds-nav__logo" src="/assets/img/logo.png" alt=""></a>
        </div>
        <div class="search-overlay-wrapper ">
            <form id="search-overlay-container" method="post" action="" onsubmit="return searchbarSubmit();">
                @csrf
                <input type="hidden" name="filtered_game_id" value="{{$filtered_game_id ?? ''}}">
                <input type="hidden" name="filtered_game_alias" value="{{$filtered_game_alias ?? ''}}">
                <input type="hidden" name="filtered_child_id" value="{{$filtered_child_id ?? ''}}">
                <input type="hidden" name="filtered_child_alias" value="{{$filtered_child_alias ?? ''}}">
                <input type="hidden" name="filtered_items" value="{{$filtered_items ?? ''}}">
                <div class="top_game_searchbar">
                    <div class="search_area no-border">
                        <input type="text" class="angel__text search_gs_name" name="searchGameServer" id="searchGameServer" title="게임검색" style="ime-mode:active" placeholder="게임명 또는 서버명을 입력해주세요." autocomplete="off" data-gameserver="true">
                    </div>
                    <button type="submit" class="search__submit" id="search__submit" title="검색"> <i class="fa fa-search" style="font-size: 19px"></i> </button>
                    <div class="gameWindowPopup d-none">
                        <div class="gameTypePopup align-center">
                            <label class="radiocontainer text-blue_modern"> 팝니다
                                <input type="radio" name="search_type" value="sell" @if(empty($_POST['search_type']) || $_POST['search_type'] != 'buy') checked @endif> <span class="checkmark"></span> </label>
                            <label class="radiocontainer text-green_modern"> 삽니다
                                <input type="radio" name="search_type" value="buy" @if(!empty($_POST['search_type']) && $_POST['search_type'] == 'buy') checked @endif> <span class="checkmark"></span> </label>
                        </div>
                        <div class="_34Cr45d_reacts">
                            <div class="tab searchbar_tab">
                                <div class="active"> <a href="javascript:;" data-target="tab_lastsearch">최근검색게임</a> </div>
                                <div> <a href="javascript:;" data-target="tab_mygame">나만의 게임</a> </div>
                            </div>
                            <div class="tab_content">
                                <div class="tab_child show" data-content="tab_lastsearch">
                                    <ul class="recent_viewd_games"></ul>
                                </div>
                                <div class="tab_child" data-content="tab_mygame">
                                    <ul class="mysearch_filters"></ul>
                                </div>
                            </div>
                            <div class="tradecan_top" data-popular="true">
                                <div class="tradecan_h89eC">
                                    <span>거래가능게임</span>
                                </div>
                                <ul class="top__gamelist">
                                    @if(!empty($popular))
                                        @foreach($popular as $rate=>$v)
                                         <li data-pgame="{{$v['game']['id']}}"> <em class="top_rank">{{$rate + 1}}</em>{{$v['game']['game']}} </li>
                                        @endforeach
                                    @endif

                                </ul>
                            </div>
                        </div>
                        <div class="angel__menugames d-none" data-gslist="true"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="nav_wrap">
        <div class="content_center">
            <ul class="nav nav_menu_nodemon">
                <li><a href="/character">캐릭터 거래</a></li>
                <li><a href="/myroom">마이룸</a></li>
                <li><a href="{{route("giftcard")}}">상품권샵</a></li>
                <li><a href="{{route("guide")}}">이용안내</a></li>
            </ul>
            <ul class="nav topmenu_right">
                <li class="highlight"><a href="/sell">판매등록</a></li>
                <li class="highlight"><a href="/buy">구매등록</a></li>
            </ul>

        </div>
    </div>
</div>
