@php
$acc[1] = 'Guest';
$acc[2] = 'Google';
$acc[3] = 'Facebook';
$acc[9] = '기타';
@endphp
@extends('layouts-angel.app')
@section('head_attach')

    <link type="text/css" rel="stylesheet" href="/angel/character/css/index.css?v=210204" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/character/js/carousel.js"></script>
    <script type="text/javascript" src="/angel/character/js/index.js"></script>
    <script type='text/javascript'>
    </script>
@endsection

@section('content')
    <style>
        #character_top_section #character_top_section_content .character_menu_wrapper {
            width: 100%;
        }
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu:nth-child(4n+4){margin-right:10px;}
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu:nth-child(6n+6){margin-right:0;}
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu_list { padding: 25px 70px 16px; }
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu {}
        .goods_wrapper dl dt { color: #f22bff; }
        .goods_wrapper:hover {background: #6692ff26;}
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu {font-size: 13px;}
        #character_top_section #character_top_section_content .character_menu_wrapper .character_menu:hover {font-size: 14px;}
    </style>

    <div class="container_fulids" id="module-teaser-fullscreen">
        <div id="character_top_section">
            <div class="section_title_wrapper">
                <h2 class="section_title text-nodemon">캐릭터 거래 게임 리스트</h2> </div>
            <div id="character_top_section_content" class="clear_fix">
                <div class="character_menu_wrapper">
                    <ul class="character_menu_list clear_fix">
                        @foreach($games as $v)
                        <li class="character_menu" data-code="{{$v['id']}}" data-gamename="{{$v['game']}}">{{$v['game']}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div id="character_goods_content">
            @foreach($games as $v)
                @if(sizeof($sub_game[$v['id']]) == 0)
                @php continue; @endphp
                @endif
                <div class="games_goods_wrapper">
                    <div class="section_title_wrapper">
                        <h2 class="section_title text-nodemon">{{$v['game']}} <span class="goods_more_btn" data-code="{{$v['id']}}" data-gamename="{{$v['game']}}">더보기</span></h2></div>
                    <div class="games_goods_carousel">
                        <div class="carousel_module">
                            <div class="banner_in center_banner">
                                @if(!empty($sub_game[$v['id']]) && sizeof($sub_game[$v['id']]) > 0)
                                    @php
                                        $sub_game[$v['id']] = array_chunk($sub_game[$v['id']],4);
                                    @endphp
                                    @foreach($sub_game[$v['id']] as $key_sub=>$sub_v)
                                        <div class="banner_item" data-idx="{{$key_sub}}">
                                        @foreach($sub_v as  $item)

                                                <div class="goods_wrapper goods" data-goods="{{$item['orderNo']}}">
                                                    <dl><dt class="goods_price">{{number_format($item['user_price'])}}<span>원</span></dt>
                                                        <dd class="goods_content">{{!empty($item['accoun_type']) ?  $acc[$item['accoun_type']]: ''}}</dd>
                                                        <dd class="goods_content">{{$item['user_title']}}</dd>
                                                        <dd class="goods_server">{{$item['game']['game']}} > {{$item['server']['game']}}</dd>
                                                    </dl>
                                                </div>
                                        @endforeach
                                        </div>
                                    @endforeach
                                     @endif
                            </div>
                            <div class='banner_indicate indicate'></div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="empty-high"></div>

@endsection
