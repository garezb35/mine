
<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>아이템천사</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=1920, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="/angel/photoswipe/css/photoswipe.css">
        <link type="text/css" rel="stylesheet" href="/angel/photoswipe/css/default-skin/default-skin.css">
        <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
        <link type="text/css" rel="stylesheet" href="/angel/global_h/css/header_1.css">
        <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel_plugin.css">
        <link type="text/css" rel="stylesheet" href="/angel/dev/global.css">
        <link type="text/css" rel="stylesheet" href="/angel/dev/change.css">
        <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel.css">
        <script type="text/javascript" src="/angel/carsouel_plugin/js/carsouel_plugin.js"></script>
        <script type="text/javascript" src="/angel/socket/socket.io.js"></script>
        <script>
            var server_domain = '210.112.174.178';
            var a_token = '';
            var socket_client = io.connect('http://'+server_domain+':7443/adminWith', {
                path: '/socket.io',
                reconnectionAttempts:1,
                reconnectionDelay:500,
                reconnectionDelayMax:500,
                transports: ['websocket']
            });
        </script>
        @yield('head_attach')
    </head>
    <body>
    <header aria-label="header navigation">
        <div id="topUpOuter" class="c">
            <div class="justify-content-between" id="topUp">
                <div class="header-item header-link flex">
                    <a class="text-light" href="/">
                        <img src="/assets/img/logo.png" alt="PlayerAuctions Homepage">
                    </a>
                </div>
                <div class="header-item header-item-full flex">
                    <div class="nav-search flex">
                        <div id="search" class="autocomplete">
                            <div class="icon-pl2" id="icon-pl2" style="display: none;">
                                <div class="ball-clip-rotate">
                                    <div></div>
                                </div>
                            </div>
                            <input id="search-input" type="text" role="combobox" aria-autocomplete="list" autocomplete="off" aria-expanded="true" aria-haspopup="true" placeholder="Find your games...">
                            <div id="search-complete"></div>
                        </div>
                        <span class="group-pl hide-xs"></span>
                        <div class="form-group filter-select featured-games dropdown">
                            <button class="dropdown-toggle hide-xs" id="dropdownToggle" aria-expanded="false" aria-controls="tree">
                                <span class="hide-md">Browse</span> Games
                                <span class="caret"></span>
                            </button>
                            <div id="tree" class="nodetree dropdown-menu">
                                <ul class="group">
                                    <li class="group-item featured-games-category" name="Currency">
                                        <button class="link flex align-items-center w-100 toggle-dropdown" aria-expanded="false" aria-controls="drop-Currency" id="subToggle-Currency">
                                            <i class="iconfont icon-card-Currency"></i>
                                            Currency
                                        </button>
                                        <ul class="submenu" id="drop-Currency">
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/new-world-coins/">New World</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/osrs-gold/">RuneScape - Old School</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/wow-classic-tbc-gold/">World of Warcraft: Burning Crusade Classic</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/ffxiv-gil/">Final Fantasy XIV</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/runescape-gold/">RuneScape</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/season-of-mastery-gold/">World of Warcraft Classic Season of Mastery</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/elder-scrolls-online-gold/">Elder Scrolls Online</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/escape-from-tarkov-roubles/">Escape From Tarkov</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/wow-gold/">World of Warcraft US</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/path-of-exile-chaos-orb/">Path of Exile</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="group-item featured-games-category" name="Items / Skins">
                                        <button class="link flex align-items-center w-100 toggle-dropdown" aria-expanded="false" aria-controls="drop-Item" id="subToggle-Item">
                                            <i class="iconfont icon-card-Item"></i>
                                            Items / Skins
                                        </button>
                                        <ul class="submenu" id="drop-Item">
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/escape-from-tarkov-items/">Escape From Tarkov</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/ffxiv-items/">Final Fantasy XIV</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/everquest-items/">EverQuest</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/diablo-2-resurrected-items/">Diablo 2 Resurrected</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/path-of-exile-items/">Path of Exile</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/runescape-items/">RuneScape</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/elder-scrolls-online-items/">Elder Scrolls Online</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/ark-items/">ARK: Survival Evolved</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/ark-items/">ARK: Survival Evolved</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/wow-classic-tbc-items/">World of Warcraft: Burning Crusade Classic</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="group-item featured-games-category" name="Accounts">
                                        <button class="link flex align-items-center w-100 toggle-dropdown" aria-expanded="false" aria-controls="drop-Account" id="subToggle-Account">
                                            <i class="iconfont icon-card-Account"></i>
                                            Accounts
                                        </button>
                                        <ul class="submenu" id="drop-Account">
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/fortnite-account/">Fortnite</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/osrs-account/">RuneScape - Old School</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/genshin-impact-account/">Genshin Impact</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/apex-legends-account/">Apex Legends</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/lol-account/">League of Legends</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/clash-of-clans-account/">Clash of Clans</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/valorant-account/">Valorant</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/summoners-war-account/">Summoners War</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/steam-account/">Steam</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/cod-account/">Call of Duty</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="group-item featured-games-category" name="Power Leveling">
                                        <button class="link flex align-items-center w-100 toggle-dropdown" aria-expanded="false" aria-controls="drop-Power-Leveling" id="subToggle-Power-Leveling">
                                            <i class="iconfont icon-card-Power-Leveling"></i>
                                            Power Leveling
                                        </button>
                                        <ul class="submenu" id="drop-Power-Leveling">
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/osrs-power-leveling/">RuneScape - Old School</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/escape-from-tarkov-power-leveling/">Escape From Tarkov</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/ffxiv-power-leveling/">Final Fantasy XIV</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/apex-legends-power-leveling/">Apex Legends</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/wow-power-leveling/">World of Warcraft US</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/gta-power-leveling/">GTA 5 Online</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/new-world-power-leveling/">New World</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/elder-scrolls-online-power-leveling/">Elder Scrolls Online</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/destiny-2-power-leveling/">Destiny 2</a>
                                            </li>
                                            <li class="group-item featured-games-item">
                                                <a href="https://www.playerauctions.com/lol-boosting/">League of Legends</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="group-item featured-games-item-link">
                                        <div class="link">
                                            <a href="https://www.playerauctions.com/game-index/">View All Games</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-item flex w-22 hide-lg justify-content-between">
                    <span class="text-light align-self-center howToBuyBtn" @if(str_contains(Request::url(),'character')) style="background: #176ba5" @endif><a href="/character" >캐릭터 거래</a></span>
                    <span class="text-light align-self-center howToBuyBtn" @if(str_contains(Request::url(),'myroom')) style="background: #176ba5" @endif><a href="/myroom">마이룸</a></span>
                    <span class="text-light align-self-center howToBuyBtn" @if(str_contains(Request::url(),'portal/giftcard')) style="background: #176ba5" @endif><a href="{{route("giftcard")}}">상품권샵</a></span>
                    <span class="text-light align-self-center howToBuyBtn" @if(str_contains(Request::url(),'guide')) style="background: #176ba5" @endif><a href="{{route("guide")}}">이용안내</a></span>
                    <span class="text-light align-self-center howToBuyBtn" @if(Route::getCurrentRoute()->getName() == 'sell') style="background: #176ba5" @endif><a href="/sell">판매등록</a></span>
                    <span class="text-light align-self-center howToBuyBtn" @if(Route::getCurrentRoute()->getName() == 'buy') style="background: #176ba5" @endif><a href="/buy">구매등록</a></span>
                    <span class="text-light align-self-center howToBuyBtn"><a href="{{route('main_customer')}}">고객센터</a></span>
                    @if(auth()->check())
                        <span class="text-light align-self-center howToBuyBtn"><a href="/logout">로그아웃</a></span>
                    @else
                        <span class="text-light align-self-center howToBuyBtn"><a href="{{route('user_reg_step1')}}">회원가입</a></span>
                        <span class="text-light align-self-center howToBuyBtn"><a href="/login">로그인</a></span>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <script>

        @if(Auth::check())
        a_token = '{{Auth::user()->api_token}}';

         @else
        var a_token = '';

        @endif
        function basicPopup(url) {
            popupWindow = window.open(url,'popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
        }
    </script>
        <div id="global_root" class="mainEntity d-none">
            <div id="thirdys" class="fluid-div"></div>
        </div>
        <div class="roots" id="angel" style="min-width: 1902px">
            @include('layouts-angel.header')
            @yield('content')
            @include('layouts-angel.footer')
        </div>
        <script type="text/javascript" src="/angel/_js/jquery.js"></script>
        <script type="text/javascript" src="/angel/_js/webpack.js"></script>
        <script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
        <script type="text/javascript" src="/angel/_js/loader.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/packery/1.4.3/packery.pkgd.min.js"></script>
        <script type="text/javascript" src="/angel/photoswipe/js/jquery.photoswipe-global.js"></script>
        <script type="text/javascript" src="/angel/_js/fed.min.js"></script>
    @yield('foot_attach')

        <script type="text/javascript">
            loadGlobalItems()
        </script>
        <style>
            .pt-1 {
                padding-top: 0.25rem!important;
            }
            .box-menus td {
                padding-top: 0px;
            }
        </style>
    </body>
    <div class="topbar-left well well--tooltip" id="topbar-left">
        <div class="toobar-content" id="toobar-content">
            @if(auth()->check())
            <div class="myinfo">
                <div style='padding: 0 10px;'>
                    <div class='d-flex w-100'>
                        <div style='width: calc(100% - 78px);'>
                            <div class="rt_figure d-flex">
                                <img src="/angel/img/level/{{$top_role['icon']}}">
                                <div class="" style='padding-top: 12px;'>
                                    <div class='f-14'><span class='user_name f-14'>{{$me['name']}}</span> 고객님</div>
                                    <div class='f-14 f-bold' ><span class='f-16' style='margin-left:10px;'>{{$top_role['alias']}}회원</span> ({{number_format($me['point'])}}점)</div>
                                </div>
                            </div>
                        </div>
                        <div style='width: 78px;'>
                            <div class="other_link no-border">
                                <div><a href="/myroom/my_mileage/index_c" class="head_charge">충전</a></div>
                                <div><a href="/myroom/my_mileage/index_e" class="head_give">출금</a></div>
                            </div>
                        </div>
                    </div>
                    <div class='d-flex w-100'>
                        <div style='width: calc(100% - 78px);'>
                            <style>
                                .tbl-myinfo,
                                .tbl-myinfo tr,
                                .tbl-myinfo td {
                                    border:  none !important;
                                }
                                .tbl-myinfo tr td {
                                    padding: 2px 0px;
                                    padding-right: 12px;
                                }
                            </style>
                            <table class='tbl-myinfo'>
                                <tr>
                                    <td>
                                        <div class="f_black1 f-15 f-bold" style='margin-left: 4px;'>총 마일리지 </div>
                                    </td>
                                    <td>
                                        <div class="f_black1 f-15 f-bold align-right"><span class='f-16' style='color: #ffa300; margin-left: 5px;'>{{number_format($me['mileage'])}}</span> 원</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="f_black1 f-15 f-bold" style='margin-left: 4px;'>무료쿠폰 </div>
                                    </td>
                                    <td align='right'>
                                        <div class="f_black1 f-15 f-bold align-right"><span class='f-16' style='color: #ffa300; margin-left: 5px;'>10</span> 장</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div style='width: 78px;'>
                            <div><span class="cert_state f_black1">@if($me['mobile_verified'] == 1)<img src="/angel/img/icons/icon_check.png">@endif 휴대폰</span></div>
                            <div><span class="cert_state f_black1">@if($me['bank_verified'] == 1)<img src="/angel/img/icons/icon_check.png">@endif &nbsp;계좌</span></div>
                        </div>
                    </div>
                </div>
                <table class="table box-menus mar-t-5 mb-0">
                    <colgroup>
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <td class="text-center align-middle active pt-1 pb-1 border-right-ja">
                                <a href="/myroom">
                                    <div class="position-relative  text-center">
                                        <div class="mb-1  text-center">
                                            <i class="fa fa-home"></i>
                                        </div>
                                        마이룸
                                    </div>
                                </a>
                            </td>
                            <td class="text-center align-middle pt-1 pb-1 border-right-ja">
                                <a href="/myroom/message/">
                                    <div class="position-relative  text-center">
                                        <div class="mb-1  text-center">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        쪽지
                                        @if($msg_count > 0)
                                        <div class="itemCntBox" id="mail-count" >{{number_format($msg_count)}}</div>
                                        @else
                                        <div class="itemCntBox" id="mail-count" style="display:none">0</div>
                                        @endif

                                    </div>
                                </a>
                            </td>
                            <td class="text-center align-middle pt-1 pb-1 border-right-ja">
                                <div class="position-relative  text-center">
                                    <a href="#">
                                        <div class="mb-1  text-center">
                                            <i class="fa fa-gift" aria-hidden="true"></i>
                                        </div>
                                        아이템
                                    </a>
                                </div>
                            </td>
                            <td class="text-center align-middle pt-1 pb-1">
                                <a href="/logout">
                                    <div class="position-relative  text-center">
                                        <div class="mb-1  text-center">
                                            <i class="fa fa-power-off" aria-hidden="true"></i>
                                        </div>
                                        로그아웃
                                    </div>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <style>
                .toobar-content .ing_count .ings > div {
                    width: 88px;
                }
            </style>
            <div class="trade_list">
                <ul class="ing_count">
                    <li class="sell">
                        <span class="c_txt sells" >판매목록</span>
                        <div class="qbox" style="margin-left: 2px;">
                            <div class="ings">
                                <div style="width: 136px !important">
                                    <span class="mr-4">등록</span>
                                    <span><a href="/myroom/sell/sell_regist"><span class="text-blue_modern font-weight-bold">{{number_format($top_selling_register)}}</span>건</a></span>
                                    <span class="mr-4" style="margin-left: 4px;">판매중</span>
                                    <span><a href="/myroom/sell/sell_regist"><span class="text-blue_modern font-weight-bold">{{number_format($top_selling_count)}}</span>건</a></span>
                                </div>
{{--                                <div>--}}
{{--                                    <span class="mr-4">흥정신청</span>--}}
{{--                                    <span><a href="/myroom/sell/sell_check"><span class="text-blue_modern font-weight-bold">{{number_format($top_bargain_request)}}</span>건</a></span>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </li>
                    <li class="buy">
                        <span class="c_txt buys">구매목록</span>
                        <div class="qbox" style="margin-left: 2px;">
                            <dl class="ings">
                                <div style="width: 132px !important">
                                    <span class="mr-4">등록</span>
                                    <span><a href="/myroom/buy/buy_regist"><span class="text-green_modern font-weight-bold">{{number_format($top_buying_register)}}</span>건</a></span>
                                    <span class="mr-4" style="margin-left: 4px;">구매중</span>
                                    <span><a href="/myroom/buy/buy_regist"><span class="text-green_modern font-weight-bold">{{number_format($top_buying_register)}}</span>건</a></span>
                                </div>
                            </dl>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="favorite">
                <div class="s_title">
                    나만의 검색메뉴
                    <a href="/myroom/customer/search" style="margin-left: 15px"><i class="fa fa-cog"></i></a>
                </div>

                <a class="showing_fav font-weight-bold f_14" href="javascript:controlFavorite()"><i class="fa fa-plus"></i></a>
                <dl class="my_game" style="display: none" id="my_game">
                    @foreach($top_games as $t_g)
                    <dd title="{{$t_g['game_text']}}">
                        <span class="title-{{$t_g['type']}}"><img src="/angel/img/icons/{{$t_g['type']}}-i.png">-{{$t_g['type'] == 'sell' ? '팝니다':'삽니다'}}-</span>
                        <strong>{{$t_g['game_text']}} &gt; {{$t_g['server_text']}}</strong>
                        <div class="btn_area">
                            <a href="/{{$t_g['type']}}/list_search?search_type={{$t_g['type']}}&amp;filtered_game_id={{$t_g['game']}}&amp;filtered_game_alias={{$t_g['game_text']}}&amp;filtered_child_id={{$t_g['server']}}&amp;filtered_child_alias={{$t_g['server_text']}}&amp;filtered_items={{itemAlias($t_g['goods_text'])}}">검색</a>
                            <a href="/{{$t_g['type']}}?game={{$t_g['game']}}&amp;server={{$t_g['server']}}">등록</a>
                        </div>
                    </dd>
                    @endforeach
                </dl>
            </div>
            @else
                {!! Form::open(['action' =>'App\Http\Controllers\LoginController@process_login', 'method' => 'post', 'enctype' => 'multipart/form-data','id'=>'login_form']) !!}
                <table class="ml-3 nobordertable">
                    <colgroup>
                        <col width="210px">
                        <col width="110px">
                    </colgroup>
                    <tr>
                        <td class="p-1">
                            {!! Form::text('loginId', '', ["required"=>true,'class' => 'input-green mb-1 w-100','autocomplete'=>"off"]) !!}
                            {!! Form::password('password', ["required"=>true,'class'=>'input-green w-100']) !!}
                        </td>
                        <td class="text-left p-1 pr-3">
                            {!! Form::submit('로그인', ['class' => 'btn btn-jin-greenoutline w-100 h-55']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td class="pt-2 pb-2 pl-1" colspan="2">
                            @if(!empty($errors->first('failed')))
                                <div class="alert alert-danger mr-3 fade show alert-dismissible" role="alert">
                                    {{$errors->first('failed')}}
                                </div>
                            @endif

                            <a class="text-blue mr-2 f-12" href="{{ route('user_reg_step1') }}">회원가입</a>
                            <a class="text-blue f-12" href="{{ route('user_lose_id') }}" target="mainFrame">아이디</a>
                            <a class="text-blue f-12" href="{{ route('user_lose_pwd') }}" target="mainFrame">비밀번호 찾기</a>
                        </td>
                    </tr>
                </table>
                {!! Form::close() !!}
            </form>
            @endif
        </div>
        <iframe scrolling="no" frameborder="0" width="100%" height="500" src="/box_chatting" id="chatFrame"></iframe>
    </div>
</html>

<style>
    .siteHeader .js-nav-menu {
        padding: 0;
    }
    .container_fulids{
        min-height: 802px;
    }
    .well--tooltip {
        min-width: 300px;
        max-width: 300px;
        margin: 0;
    }

    @media (min-width: 500px) {
        .well--tooltip {
            max-width: 380px;
        }
    }


    .well--tooltip::after {
        border-top-color: #f5f5f5;
        margin-top:  -1px;
    }


</style>
<script>
    function controlFavorite() {
        $(".showing_fav").find("i").removeClass('fa-plus')
        $(".showing_fav").find("i").removeClass('fa-minus')
        var x = document.getElementById("my_game");
        if (x.style.display === "none") {
            x.style.display = "block";
            $(".showing_fav").find("i").addClass('fa-minus')
        } else {
            x.style.display = "none";
            $(".showing_fav").find("i").addClass('fa-plus')
        }
    }
    $(document).ready(function(){
        @if(request()->route()->getName() == "index")
            var pos_left = $(".top_full").offset();
            $("#topbar-left").css("left",pos_left.left - 325 + "px")
            $("#topbar-left").css("top",84 + "px")
        @else
            var pos_left = $(".container_fulids").offset();
            $("#topbar-left").css("left",pos_left.left - 325 + "px")
            $("#topbar-left").css("top",84 + "px")
        @endif

    })
</script>

