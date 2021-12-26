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
    <div class="e4rn34RT" id="e4rn34RT">
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
                    <a href="javascript:;" class="btn_side main_hamburger" id="btn_menu"></a>
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
                    </ul>
                </div>
                <div class="notice clear_fix"> <span class="noti_icon"></span>
                    <div class="notice_ct">
                        @if(!empty($notices))
                        <a href="{{route('view')}}?seq={{$notices[0]['id']}}">
                            [공지]  {{$notices[0]['title']}}
                        </a>
                        @endif
                    </div>
                    <a href="{{route('m_notice')}}" class="sp_b btn_mr" style="font-weight: bold">+</a>
                </div>

            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
    <div class="hgt34TR over__hidden bg-white" id="hgt34TR">
        <form name="juret__react56" id="juret__react56" method="POST">
            @csrf
            <input type="hidden" name="search_game" value="">
            <input type="hidden" name="search_game_text" value="">
            <input type="hidden" name="search_server" value="">
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
                    <div class="g_title">거래가능게임</div>
                    <ul class="popular_list">
                        @if(!empty($popular))
                            @foreach($popular as $key=>$v)
                        <li data-pgame="{{$v['game_code']}}">
                            {{$v['game']['game']}}
                        </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div id="game_wrap" class="gs_wrap">
                <div class="header-part" style="">
                    <h4 class="page_title">게임 검색</h4>
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
                <div class="gs_list over__hidden" id="g_gameServerList" data-gslist="true"></div>
            </div>
        </form>
    </div>
    <div class="g_layer" id="g_layer">
        <div class="l_container">
            <div class="l_content" id="l_content"> </div>
        </div>
    </div>
@endsection
