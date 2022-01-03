
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
{{--<div class="siteHeader ">--}}
{{--    <div class="top_bg">--}}
{{--        <div class="border-bottom">--}}
{{--            <div class="js-nav-menu">--}}
{{--                <ul class="js-nav-justicy-left"></ul>--}}
{{--                <ul class="js-nav-justicy-right">--}}
{{--                    <li><a href="{{route('myroom')}}">마이룸</a></li>--}}
{{--                    <li><a href="{{route('main_customer')}}">고객센터</a></li>--}}
{{--                    @if(auth()->check())--}}
{{--                        <li><a href="/logout">로그아웃</a></li>--}}
{{--                    @else--}}
{{--                        <li><a href="{{route('user_reg_step1')}}">회원가입</a></li>--}}
{{--                        <li><a href="/login">로그인</a></li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="header-brand-logo">--}}
{{--        <div class="logo">--}}
{{--            <a href="/"><img id="hsds-nav__logo" src="/assets/img/logo.png" alt=""></a>--}}
{{--        </div>--}}
{{--        <div class="search-overlay-wrapper ">--}}
{{--            <ul class="gs_menu" id="gsMenu">--}}
{{--                <li class="gs_search_item">--}}
{{--                    <form id="search-overlay-container" method="post" action="" onsubmit="return searchbarSubmit();">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="filtered_game_id" value="{{$filtered_game_id ?? ''}}">--}}
{{--                        <input type="hidden" name="filtered_game_alias" value="{{$filtered_game_alias ?? ''}}">--}}
{{--                        <input type="hidden" name="filtered_child_id" value="{{$filtered_child_id ?? ''}}">--}}
{{--                        <input type="hidden" name="filtered_child_alias" value="{{$filtered_child_alias ?? ''}}">--}}
{{--                        <input type="hidden" name="filtered_items" value="{{$filtered_items ?? ''}}">--}}
{{--                        <div class="top_game_searchbar">--}}
{{--                            <div class="search_area no-border input-group">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <button class="btn btn-outline-secondary dropdown-toggle" style="border-color: #ced4da;border-right: none;font-size: 12px; border-top-left-radius: 15px;--}}
{{--    border-bottom-left-radius: 15px;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">게임리스트</button>--}}
{{--                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1036px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Another action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                                        <div role="separator" class="dropdown-divider"></div>--}}
{{--                                        <a class="dropdown-item" href="#">Separated link</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <input style="border-top-right-radius: 15px;border-bottom-right-radius: 15px" type="text" class="form-control" name="searchGameServer" id="searchGameServer" title="게임검색" style="ime-mode:active" placeholder="게임명을 입력해주세요." autocomplete="off" data-gameserver="true" >--}}
{{--                            </div>--}}
{{--                            <div class="gameWindowPopup d-none">--}}
{{--                                <div class="gameTypePopup align-center">--}}
{{--                                        <input type="radio" id="search_type1" name="search_type" value="sell" @if(empty($_POST['search_type']) || $_POST['search_type'] != 'buy') checked @endif style="display: none">--}}
{{--                                    <input type="radio" id="search_type2" name="search_type" value="buy" @if(!empty($_POST['search_type']) && $_POST['search_type'] == 'buy') checked @endif style="display: none">--}}

{{--                                </div>--}}
{{--                                <div class="_34Cr45d_reacts">--}}
{{--                                    <div class="tab searchbar_tab">--}}
{{--                                        <div class="active"> <a href="javascript:;" data-target="tab_lastsearch">최근검색게임</a> </div>--}}
{{--                                        <div> <a href="javascript:;" data-target="tab_mygame">나만의 게임</a> </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="tab_content">--}}
{{--                                        <div class="tab_child show" data-content="tab_lastsearch">--}}
{{--                                            <ul class="recent_viewd_games"></ul>--}}
{{--                                        </div>--}}
{{--                                        <div class="tab_child" data-content="tab_mygame">--}}
{{--                                            <ul class="mysearch_filters"></ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
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
{{--                                </div>--}}
{{--                                <div class="angel__menugames d-none" data-gslist="true"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                    <div class="gsgametypes">--}}
{{--                        <ul id="g_type_sel">--}}
{{--                            <li data-type="sell">팝니다</li>--}}
{{--                            <li data-type="buy">삽니다</li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="gs_box" id="gsBox">--}}
{{--                        <div class="gs_box_inner">--}}
{{--                            <div class="gs_head clearfix">--}}
{{--                                <dl class="gs_name" style="display: block;"><dt></dt>--}}
{{--                                </dl>--}}
{{--                                <a target="_self" class="close_btn" title="关闭窗口" href="javascript:;">关闭窗口</a>--}}
{{--                            </div>--}}
{{--                            <ul id="gsNav" class="gs_nav">--}}
{{--                                <li class="first_line"></li>--}}
{{--                                <li id="fastletter" class="w_70" style="display: none;"><a href="javascript:void(0);">搜索结果</a></li>--}}
{{--                                <li class="w_70"><a class="current" href="javascript:void(0);">전체</a></li>--}}
{{--                                <li><a href="javascript:void(0);">A</a></li>--}}
{{--                                <li><a href="javascript:void(0);">B</a></li>--}}
{{--                                <li><a href="javascript:void(0);">C</a></li>--}}
{{--                                <li><a href="javascript:void(0);">D</a></li>--}}
{{--                                <li><a href="javascript:void(0);">E</a></li>--}}
{{--                                <li><a href="javascript:void(0);">F</a></li>--}}
{{--                                <li><a href="javascript:void(0);">G</a></li>--}}
{{--                                <li><a href="javascript:void(0);">H</a></li>--}}
{{--                                <li><a href="javascript:void(0);">I</a></li>--}}
{{--                                <li><a href="javascript:void(0);">J</a></li>--}}
{{--                                <li><a href="javascript:void(0);">K</a></li>--}}
{{--                                <li><a href="javascript:void(0);">L</a></li>--}}
{{--                                <li><a href="javascript:void(0);">M</a></li>--}}
{{--                                <li><a href="javascript:void(0);">N</a></li>--}}
{{--                                <li><a href="javascript:void(0);">O</a></li>--}}
{{--                                <li><a href="javascript:void(0);">P</a></li>--}}
{{--                                <li><a href="javascript:void(0);">Q</a></li>--}}
{{--                                <li><a href="javascript:void(0);">R</a></li>--}}
{{--                                <li><a href="javascript:void(0);">S</a></li>--}}
{{--                                <li><a href="javascript:void(0);">T</a></li>--}}
{{--                                <li><a href="javascript:void(0);">U</a></li>--}}
{{--                                <li><a href="javascript:void(0);">V</a></li>--}}
{{--                                <li><a href="javascript:void(0);">W</a></li>--}}
{{--                                <li><a href="javascript:void(0);">X</a></li>--}}
{{--                                <li><a href="javascript:void(0);">Y</a></li>--}}
{{--                                <li><a href="javascript:void(0);">Z</a></li>--}}
{{--                                <li class="last_line"></li>--}}
{{--                            </ul>--}}
{{--                            <ul  class="gs_nav" style="padding-left: 84px;">--}}
{{--                                <li class="first_line"></li>--}}
{{--                                <li id="fastletter" class="w_70" style="display: none;"><a href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㄱ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㄴ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㄷ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㄹ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅁ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅂ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅅ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅎ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅈ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅊ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅋ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅌ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅍ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅎ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅇ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㄲ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㄸ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅃ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅆ</a></li>--}}
{{--                                <li><a href="javascript:void(0);">ㅉ</a></li>--}}
{{--                                <li class="last_line"></li>--}}
{{--                            </ul>--}}
{{--                            <ul id="gsList" class="gs_list gs_name">--}}

{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="nav_wrap">--}}
{{--        <div class="content_center">--}}
{{--            <ul class="nav nav_menu_nodemon">--}}
{{--                <li @if(str_contains(Request::url(),'character')) style="background: #176ba5" @endif><a href="/character" >캐릭터 거래</a></li>--}}
{{--                <li @if(str_contains(Request::url(),'myroom')) style="background: #176ba5" @endif><a href="/myroom">마이룸</a></li>--}}
{{--                <li @if(str_contains(Request::url(),'portal/giftcard')) style="background: #176ba5" @endif><a href="{{route("giftcard")}}">상품권샵</a></li>--}}
{{--                <li @if(str_contains(Request::url(),'guide')) style="background: #176ba5" @endif><a href="{{route("guide")}}">이용안내</a></li>--}}
{{--            </ul>--}}
{{--            <ul class="nav topmenu_right">--}}
{{--                <li class="highlight" @if(Route::getCurrentRoute()->getName() == 'sell') style="background: #176ba5" @endif><a href="/sell">판매등록</a></li>--}}
{{--                <li class="highlight" @if(Route::getCurrentRoute()->getName() == 'buy') style="background: #176ba5" @endif><a href="/buy">구매등록</a></li>--}}
{{--            </ul>--}}

{{--        </div>--}}
    </div>
</div>
