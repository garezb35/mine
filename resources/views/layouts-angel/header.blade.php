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
                        <li><a href="{{route('myroom')}}"  target="mainFrame">마이룸</a></li>
                        <li><a href="{{route('main_customer')}}"  target="mainFrame">고객센터</a></li>
                        <li><a href="/logout">로그아웃</a></li>
                    @else
                        <li><a href="{{route('main_customer')}}"  target="mainFrame">고객센터</a></li>
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
                <div class="headernav-with">
                    <div class="top-leftli">
                        {{--                    <b class="sjx-rb"></b>--}}
                        {{--                    <b class="sjx-lb"></b>--}}
                        <div class="dropdown">
                            <a href="javascript:void(0);" rel="nofollow" id="dropdown-wz">전체 게임
                                <img src="https://www.5mmo.com/templates/game/images/topicojg.png">
{{--                                <div class="border-half"></div>--}}
                            </a>
                            <div class="dropdown-menu" style="display: none;">
                                <div class="drop-menu-right">
                                    <ul>
                                        @foreach($games_home as $homes)
                                            <li>
                                                <a href="javascript:;" data-id="{{$homes['id']}}" data-name="{{$homes['game']}}">
                                                    <img src="{{$homes['icon']}}" width="20">{{$homes['game']}}
                                                </a>
                                            </li>
                                        @endforeach
                                        <li class="nobg"><a href="https://www.5mmo.com/allgame.html" rel="nofollow" style="color:#f00 !important;"  target="mainFrame">+ More Games</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav_menu_nodemon">
                        <li class="highlight highlight__first" >
                            <a  href="/sell"  target="mainFrame">판매등록</a>
                        </li>
                        <li class="highlight" >
                            <a href="/buy"  target="mainFrame">구매등록</a>
                        </li>
                        <li >
                            <a href="/myroom/my_mileage/index_c"  target="mainFrame">마일리지 충전</a>
                        </li>
                        <li >
                            <a href="/myroom"  target="mainFrame">마이페이지</a>
                        </li>
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
                    <div class="nav">
                        <div class="nav-with">
                            <ul class="navul">
                                <li><a href="https://www.5mmo.com/allproduct.html">
                                        <img src="https://www.5mmo.com/templates/game/images/ipad01.png"><br>전체 게임
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.5mmo.com/contact.html" rel="nofollow">
                                        <img src="https://www.5mmo.com/templates/game/images/ipad02.png"><br>1:1문의
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.5mmo.com/selltous.html">
                                        <img src="https://www.5mmo.com/templates/game/images/ipad03.png"><br>판매등록
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.5mmo.com/ordersearch.html" rel="nofollow">
                                        <img src="https://www.5mmo.com/templates/game/images/ipad04.png"><br>거래내역
                                    </a>
                                </li>
                                <li><a href="https://www.5mmo.com/affiliate.html" rel="nofollow">
                                        <img src="https://www.5mmo.com/templates/game/images/ipad05.png"><br>마일리지충전
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
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
                </div>
            </div>
        </div>
    </div>
</div>
<div @class('zopim')>
    <div @class('jx_ui_Widget meshim_widget_components_ChatButton br')>
        <div @class('meshim_widget_components_chatButton_Button ltr')>
            <div @class('meshim_widget_components_chatButton_ButtonBar button_bar')>
                <div @class('meshim_widget_widgets_Favicon favicon')>
                    <div class="meshim_widget_widgets_IconFont icon_font default_icon default_icon_online" __jx__id="___$_30__icon ___$_30__icon" style="user-select: none;">💬</div>
                </div>
                <div class="button_text jx_ui_Widget" __jx__id="___$_32">
                    <div class="blinds blinds_top jx_ui_Widget" __jx__id="___$_33">
                        <label class="status jx_ui_Label" __jx__id="___$_29__button_bar__status_text_wrapper" style="user-select: none; display: none;">
                            <label class="jx_ui_Label" __jx__id="___$_29__button_bar__status_text" style="user-select: none;">Online</label>
                            <label class="jx_ui_Label" __jx__id="___$_34" style="user-select: none;"> - </label>
                        </label>
                        <label class="greeting jx_ui_Label" __jx__id="___$_29__button_bar__greeting" style="user-select: none;">채팅창 열기</label>
                    </div><div class="blinds blinds_bottom jx_ui_Widget" __jx__id="___$_35">
                        <label class="jx_ui_Label" __jx__id="___$_29__button_bar__unread" style="user-select: none;">XX new messages</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
