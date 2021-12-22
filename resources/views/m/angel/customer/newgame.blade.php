@extends('layouts-angel-mobile.app')

@section('head_attach')
    <link rel="stylesheet" href="/angel_mobile/customer/css/newgame.css">
@endsection

@section('foot_attach')
    <script src="/angel_mobile/customer/js/index.js"></script>
@endsection

@section('content')
    <div class="g_BODY" id="g_BODY" style="opacity: 1;">
        @include('m.angel.aside.nav', ['user' => $me])
        <div class="header">
            <div class="h_tit bkg-white">
                <a href="javascript:history.back()" class="back_btn" id="back_btn"></a>
                <h1 class="c-black">신규게임/서버 추가</h1>
                <button class="btn_menu" id="btn_menu"><em>메뉴</em></button>
            </div>
        </div>
        <div class="container">
            @php
                $isLogined = '';
                if (Auth::check()) {
                    $isLogined = 1;
                }
            @endphp
            <input id="_LOGINCHECK" type="hidden" value="{{$isLogined}}">
            <div class="content">
                <!-- ▼ 신규게임/서버 추가 //-->
                <form method="post" id="frm_game" action="">
                    <input type="hidden" name="a_code" value="A4">
                    <input type="hidden" name="b_code" value="01">
                    <div class="g_title mg0">요청하실 게임/서버를 입력해주세요.</div>
                    <ul class="tb_form">
                        <li>
                            <label>분류</label>
                            <div class="new_type">
                                <label for="radio1">
                                    <input type="radio" id="radio1" class="g_radio first_radio" name="new_type" value="g" checked="checked">신규게임
                                </label>
                                <label for="radio2">
                                    <input type="radio" id="radio2" class="g_radio" name="new_type" value="s">신규서버
                                </label>
                                <label for="radio3">
                                    <input type="radio" id="radio3" class="g_radio" name="new_type" value="e">기타
                                </label>
                            </div>
                        </li>
                        <li>
                            <label id="game_label">게임명</label>
                            <div id="game_area"><input type="text" class="g_text" name="game_name" id="game_name" placeholder="게임명을 입력해 주세요."></div>
                        </li>
                        <li class="h_auto" id="search_game" style="visibility: hidden;"></li>
                        <li>
                            <label id="server_label">서버명</label>
                            <div id="server_area"><input type="text" class="g_text" name="server_name" disabled="disabled"></div>
                        </li>
                        <li id="addr_tr" class="addr_tr" style="">
                            <label>URL(주소)</label>
                            <div>
                                <span>http://</span><input type="text" class="g_text" name="game_url" placeholder="주소를 입력해 주세요.">
                            </div>
                        </li>
                    </ul>
                    <div class="g_btn_wrap">
                        <button class="box_bu" type="submit">확인</button>
                    </div>
                </form>
                <!-- ▲ 신규게임/서버 추가 //-->
            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
