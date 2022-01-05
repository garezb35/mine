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
                <div class="banner_item" data-idx="3">
                    <a href="#" target="_blank"> <img class="carousel_images" src="/assets/img/bkg/main-slide1.jpg"> </a>
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
                <div class="gold-with">
                    <div class="goldtop">
                        <div class="goldtoplf"><img src="/angel/img/icons/midico04.png">인기게임</div>
                        <div class="goldtoprg"></div>
                    </div>
                    <div class="goldmid">
                        @foreach($games_home as $key=>$gg)
                            @php
                                if($key == 8) break;
                            @endphp
                            <div class="hotgame-li" style="text-align: center">
                                <ul>
                                    <li class="hotgame-liimg" style="text-align: center"><a href="javascript:;" onclick="enterSearchList({{$gg['id']}},'{{$gg['game']}}')"><img src="{{$gg['icon']}}" alt="{{$gg['game']}}" title="{{$gg['game']}}"></a></li>
                                    <a href="javascript:;" onclick="enterSearchList({{$gg['id']}},'{{$gg['game']}}')" class="hotgame-x"><li class="hotgame-keysbt">{{$gg['game']}}</li><img src="/angel/img/icons/index_08.jpg"></a>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="goldtop">
                    <div class="goldtoplf"><img src="/angel/img/icons/midico04.png">게임순위</div>
                </div>

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
            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
    <div class="hgt34TR over__hidden bg-white" id="hgt34TR">
        <form name="juret__react56" id="juret__react56" method="POST">
            @csrf
            <input type="hidden" name="filtered_game_id" value="">
            <input type="hidden" name="filtered_game_alias" value="">
            <input type="hidden" name="filtered_child_id" value="">
            <input type="hidden" name="filtered_child_alias" value="">
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

