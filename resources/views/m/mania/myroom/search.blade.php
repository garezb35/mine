@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/customer/css/search.css" />
    <!--<script type="text/javascript" src="/angel/advertise/advertise_code_head.js?v=200727"></script>-->
    <script type="text/javascript" src="/angel/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript"  src="/angel/myroom/customer/js/search.js" ></script>
    <script type="text/javascript">
        function redirect(){
            location.reload()
        }
    </script>
@endsection
@section('content')
    <div class="g_container" id="g_CONTENT">
        @include('aside.myroom',['group'=>'settings'])
        <div class="g_content">
            <!-- ▼ 사용자 환결설정 탭 -->
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue noborder">
                환경설정
            </div>
            @include('tab.g_tab_customer',['group'=>'search'])
            <!-- ▼ 설정하기 //-->
            <div class="g_smtitle">설정하기</div>
            <div class="box">
                <form id="frm_search" method="post" action="/myroom/customer/search_add">
                    @csrf
                    <input type="hidden" name="game" value="">
                    <input type="hidden" name="game_text" value="">
                    <input type="hidden" name="server" value="">
                    <input type="hidden" name="server_text" value="">
                    <input type="hidden" name="goods" value="">
                    <input type="hidden" name="goods_text" value="">
                    <div class="g_search_wrapper custom_search_wrapper">
                        <div class="g_trade_type">
                            <label class="radiocontainer f_blue1">
                                팝니다
                                <input type="radio" name="type" value="sell" checked="">
                                <span class="checkmark"></span>
                            </label>
                            <label class="radiocontainer f_green1" style="margin-left: 30px">
                                삽니다
                                <input type="radio" name="type" value="buy">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="search_area">
                            <input type="text" class="g_text search_gs_name" id="searchRegGameServer" placeholder="게임명 또는 서버명을 입력해주세요." autocomplete="off" data-gameserver="true">
                            <a href="javascript:;" class="delete_btn"></a>
                        </div>
                        <input type="submit" class="g_search_list" value="추가">
                        <div class="g_search_frame custom_gameserver g_hidden" id="custom_gameserver">
                            <div class="initial_screen">
                                <div class="tab searchbar_tab">
                                    <div class="active">
                                        <a href="javascript:;" data-target="tab_lastsearch">최근검색게임</a>
                                    </div>
                                    <div>
                                        <a href="javascript:;" data-target="tab_mygame">나만의 게임</a>
                                    </div>
                                </div>
                                <div class="tab_content">
                                    <div class="tab_child show" data-content="tab_lastsearch">
                                        <ul class="last_search">
                                            <li class="empty">최근 검색 게임이 없습니다.</li>
                                        </ul>
                                    </div>
                                    <div class="tab_child" data-content="tab_mygame">
                                        <ul class="g_my_search"></ul>
                                    </div>
                                </div>
                                <div class="popular_game" data-popular="true">
                                    <div class="popular_game_title">거래가능게임</div>
                                    <ul class="popular_list">
                                        @if(!empty($popular))
                                            @foreach($popular as $key=>$v)
                                                <li data-pgame="{{$v['game_code']}}">
                                                    <em class="top_rank">{{$key + 1}}</em>{{$v['game']['game']}}
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="gs_list g_hidden game_empty" data-gslist="true" id="custom_gameserver_list">
                                <div class="game g_hidden">
                                    <ul>
                                        <li class="search_ing">검색 결과가 없습니다.</li>
                                    </ul>
                                </div>
                                <div class="server g_hidden">
                                    <ul></ul>
                                </div>
                                <div class="goods g_hidden">
                                    <ul></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <form method="post" id="frm_list" action="search_order">
                @csrf
                <table class="g_blue_table tb_list" id="search_tb">
                    <colgroup>
                        <col width="90">
                        <col width="450">
                        <col width="140">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th class="first">&nbsp;</th>
                        <th>카테고리</th>
{{--                        <th>기본페이지</th>--}}
                        <th>&nbsp;</th>
                    </tr>
                    @foreach($list as $v)
                    <tr>
                        <td class="first">
                            <img src="/angel/img/button/btn-up.png" width="8"  alt="위로" class="move">
                            <img src="/angel/img/button/btn-down.png" width="8"  alt="아래로" class="move">
                            <input type="hidden" name="id[]" value="{{$v['id']}}">
                        </td>
                        <td class="category">{{$v['type'] == 'sell' ? '팝니다' : '삽니다'}} > {{$v['game_text']}} > {{$v['server_text']}} > {{$v['goods_text']}}</td>
{{--                        <td>--}}
{{--                            <input type="radio" name="startPage" id="startPage{{$v['id']}}" value="{{$v['id']}}" class="g_radio" onclick="startpage_update(this);" @if($v['default'] == 1) checked @endif>--}}
{{--                            <label for="startPage{{$v['id']}}">설정</label>--}}
{{--                        </td>--}}
                        <td>
                            <a href="javascript:_window.open('search_update','/search_update_form?id={{$v['id']}}',657,260)" class="btn-default-medium btn-suc-rect">
                                수정
                            </a>
                            <a href="javascript:void(0)" onclick="list_delete(this,'{{$v['id']}}');" class="btn-default-medium btn-cancel-rect">삭제</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$list->links()}}
                <!-- ▼ 기본페이지 해제 버튼 //-->
                <!-- ▲ 기본페이지 해제 버튼 //-->
                <div class="g_btn">
                    <input type="submit" value="확인" class="btn-default-medium btn-submit-rect">
                </div>
            </form>
        </div>
        <div class="g_finish"></div>
    </div>
@endsection
