
<div class="react___gatsby outterWrapper" id="outterWrapper">
    <div class="inner"> <a href="javascript:;" class="close_r" id="menu_close">닫기</a> </div>
</div>
<div class="toolbar-btn" id="toolbar-btn" style="display: none">
    <div class="inner">
        <ul class="drawer-content-menu close" id="drawer-content-menu">
            <li ><a href="#tooltip"  data-type="ss"><i class="fa fa-commenting"></i></a></li>
        </ul>
        <div class="sidebar-btn" id="sidebar-btn"> <a href="javascript:;" class="close" id="sidebar-cls"></a>

        </div>
    </div>
</div>
<div class="siteHeader ">
    <div class="top_bg">
        <div>
            <div class="js-nav-menu">
                <ul class="js-nav-justicy-left"></ul>
                <ul class="js-nav-justicy-right">
                    @if(auth()->check())
                        <li>
                            <a href="/myroom/message/">
                                <i class="fa fa-envelope"></i>
                                @if($msg_count > 0)
                                    <div class="itemCntBox" id="mail-count" >{{number_format($msg_count)}}</div>
                                @else
                                    <div class="itemCntBox" id="mail-count" style="display:none">0</div>
                                @endif
                            </a>
                        </li>
                        <li><a href="{{route('myroom')}}">마이룸</a></li>
                        <li><a href="{{route('main_customer')}}">고객센터</a></li>
                        <li><a href="/logout">로그아웃</a></li>
                    @else
                        <li><a href="{{route('main_customer')}}">고객센터</a></li>
                        <li><a href="{{route('user_reg_step1')}}">회원가입</a></li>
                        <li><a href="/login">로그인</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="fixed__banner">
        <div class="header__banner">
            <div class="nav_wrap">
                <div class="content_center headernav-with">
                    <div class="top-leftli">
                        {{--                    <b class="sjx-rb"></b>--}}
                        {{--                    <b class="sjx-lb"></b>--}}
                        <div class="dropdown">
                            <a href="javascript:void(0);" rel="nofollow" id="dropdown-wz">전체 게임
                                {{--                            <img src="https://www.5mmo.com/templates/game/images/topicojg.png">--}}
                                <div class="border-half"></div>
                            </a>
                            <div class="dropdown-menu" style="display: none;">
                                {{--                        <div class="drop-menu-left">--}}
                                {{--                            <ul style="position: relative;">--}}
                                {{--                                <li><a href="https://www.5mmo.com/mut-22-coins/"><img src="https://www.5mmo.com/upload/202108311712076410.jpg" alt="MUT 22"></a></li>--}}
                                {{--                                <li><a href="https://www.5mmo.com/new-world-coins/"><img src="https://www.5mmo.com/upload/202110091510114061.jpg" alt="New World"></a></li>--}}
                                {{--                                <li><a href="https://www.5mmo.com/nba-2k22-mt/"><img src="https://www.5mmo.com/upload/202109091732131573.jpg" alt="NBA 2K22"></a></li>--}}
                                {{--                                <li><a href="https://www.5mmo.com/fut-22-comfort-trade/"><img src="https://www.5mmo.com/upload/202109241802341702.jpg" alt="FUT 22"></a></li>--}}
                                {{--                                <li><a href="https://www.5mmo.com/wow-tbc-classic-gold/"><img src="https://www.5mmo.com/upload/202105201806179542.jpg" alt="WOW Classic TBC"></a></li>--}}
                                {{--                                <li><a href="https://www.5mmo.com/r6-credits/"><img src="https://www.5mmo.com/upload/202109091118505761.jpg" alt="Rainbow Six Siege (R6)"></a></li>--}}
                                {{--                            </ul>--}}
                                {{--                        </div>--}}
                                <div class="drop-menu-right">
                                    <ul>
                                        @foreach($games_home as $homes)
                                            <li>
                                                <a href="javascript:;" data-id="{{$homes['id']}}" data-name="{{$homes['game']}}">
                                                    <img src="{{$homes['icon']}}" width="20">{{$homes['game']}}
                                                </a>
                                            </li>
                                        @endforeach
                                        <li class="nobg"><a href="https://www.5mmo.com/allgame.html" rel="nofollow" style="color:#f00 !important;">+ More Games</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav_menu_nodemon">
                        <li class="highlight" ><a @if(Route::getCurrentRoute()->getName() == 'sell') style="color: #3295d3" @endif  href="/sell">판매등록 <div class="border-half"></div></a></li>
                        <li class="highlight" ><a @if(Route::getCurrentRoute()->getName() == 'buy') style="color: #edb528" @endif  href="/buy">구매등록 <div class="border-half"></div></a></li>
                        <li ><a @if(str_contains(Request::url(),'/myroom/my_mileage/index_c')) style="color: #ea70a5" @endif href="/myroom/my_mileage/index_c" >마일리지 충전 <div class="border-half"></div></a></li>
                        <li ><a @if(str_contains(Request::url(),'myroom') && !str_contains(Request::url(),'/myroom/my_mileage')) style="color: #1b9fa2" @endif href="/myroom">마이페이지</a></li>
                    </ul>
                </div>
            </div>
            <div class="heads-div">
                <div class="header-brand-logo">
                    <div class="logo">
                        <a href="/"><img id="hsds-nav__logo" src="/assets/img/logo.png" alt=""></a>
                    </div>
                    <div class="search-overlay-wrapper ">
                        <ul class="gs_menu" id="gsMenu">
                            <li class="gs_search_item">
                                <form id="search-overlay-container" method="post" action="" onsubmit="return searchbarSubmit();">
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
                                        <button type="submit" class="search__submit" id="search__submit" title="검색">검색</button>
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
                                                {{--                                    <div class="tradecan_top" data-popular="true">--}}
                                                {{--                                        <div class="tradecan_h89eC">--}}
                                                {{--                                            <span>거래가능게임</span>--}}
                                                {{--                                        </div>--}}
                                                {{--                                        <ul class="top__gamelist">--}}
                                                {{--                                            @if(!empty($popular))--}}
                                                {{--                                                @foreach($popular as $rate=>$v)--}}
                                                {{--                                                    <li data-pgame="{{$v['game']['id']}}"> <em class="top_rank">{{$rate + 1}}</em>{{$v['game']['game']}} </li>--}}
                                                {{--                                                @endforeach--}}
                                                {{--                                            @endif--}}

                                                {{--                                        </ul>--}}
                                                {{--                                    </div>--}}
                                            </div>
                                            <div class="angel__menugames d-none" data-gslist="true"></div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
