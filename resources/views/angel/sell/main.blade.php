@php

    $mobile_a = $mobile_b = $mobile_c = '';
    $home_a = $home_b = $home_c = '';
    $home_array = $number_array = array();
    if(!empty($user->number)){
        $number_array = explode('-',$user->number);
        $mobile_a = $number_array[0];
        $mobile_b = $number_array[1];
        $mobile_c = $number_array[2];
    }
    if(!empty($user->home)){
        $home_array = explode('-',$user->home);
        $home_a = $home_array[0];
        $home_b = $home_array[1];
        $home_c = $home_array[2];
    }
@endphp
@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/sell/css/index.css">
@endsection

@section('foot_attach')

    <script type="text/javascript" src="/angel/js/index210803.js"></script>
    <script type='text/javascript'>

        var rgCtrRegGameUnit = new Array();

        var g_compensation='Y';
        e_select.sale = 'general';
        function __init() {

        }
        e_use.premium = {{$premium}};
        e_use.highlight = {{$highlight}} / 12;
        e_use.quickIcon = {{$quickicon}};
    </script>

@endsection

@section('content')
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <!--▼▼▼ 판매등록 레이어 ▼▼▼ -->
        <!--▲▲▲ 판매등록 레이어 ▲▲▲ -->
        <div class="aside">
            <div class="title_blue">
                <img src="/angel/img/icons/exclamation-mark-png-exclamation-mark-icon-11563006763v9utxg8tnp 1.png" />
                판매등록 알아보기
            </div>
            <div class="menu_know">
                <p class="heads">판매물품 등록 방법</p>
                <img src="/angel/img/new_images/sell_left_know.png" width="210"  alt="팝니다 쉽게 등록하기">
                <p class="m-t-40 font-weight-bold p-left-15">판매등록 알아두기</p>
                <ul class="g_list p-left-15">
                    <li>* 물품등록 본인은 물품의 문제 발생시 민/형사사상의
                        모든 책임을 질 것에 동의을 한것으로 간주됩니다
                    </li>
                    <li>* 열락처는 현제 사용중인 열락처로 필히 입력해주세요
                        열락처가 불분명시 거래에 불이익이 발생할수있습니다
                    </li>
                </ul>
            </div>
        </div>
        <div class="g_content">
            <div class="g_title_noborder">
                팝니다
                <span>등록</span>
            </div>
            <form name="frmSell" id="frmSell" method="post" enctype="multipart/form-data" action="/addService">
                @csrf
                <input type="hidden" name="game_code" id="game_code">
                <input type="hidden" name="game_code_text" id="game_code_text">
                <input type="hidden" name="server_code" id="server_code">
                <input type="hidden" name="server_code_text" id="server_code_text">
                <input type="hidden" name="user_goods" id="user_goods">
                <input type="hidden" id="security_service_userinfo" name="security_service_userinfo" value="N">
                <input type="hidden" id="security_type" name="security_type" value="none">
                <input type="hidden" name="user_premium_use" id="user_premium_use">
                <input type="hidden" name="user_quick_icon_use" id="user_quick_icon_use">
                <input type="hidden" name="user_charge" id="user_charge">
                <input type="hidden" id="certify_pay" name="certify_pay" value="YTo0OntzOjEwOiJjZXJ0aWZ5X2xjIjtzOjg6ImNvbnRyYWN0IjtzOjk6ImZvcm1fbmFtZSI7czo3OiJmcm1TZWxsIjtzOjExOiJzdWJtaXRfdHlwZSI7czoxOiIxIjtzOjEwOiJzdWJtaXRfdXJsIjtzOjE4OiIvc2VsbC9pbmRleF9vay5waHAiO30=">
                <input type="hidden" name="seller_birth" id="seller_birth" value="{{date("Y.m.d",strtotime($user->birthday))}}">
                <!-- 안심번호 -->
                <input type="hidden" name="safety_using_flag" id="safety_using_flag">
                <input type="hidden" name="user_cell_auth" id="user_cell_auth" value="{{$user->mobile_verified}}">
                <input type="hidden" name="user_cell_num" id="user_cell_num" value="{{$user->number}}">
                <input type="hidden" name="user_safety_type" id="user_safety_type">
                <input type="hidden" name="user_phone_check" id="user_phone_check" value="true">
                <input type="hidden" name="user_without" id="user_without" value="{{$user->state}}">
                <input type="hidden" name="good_type" id="good_type" />
                <!-- 안심번호 -->
{{--                <div class="g_subtitle first">물품정보</div>--}}
                <div class="g_subtitle first">물품정보</div>
                <table class="g_blue_table">
                    <colgroup>
                        <col width="130">
                        <col>
                    </colgroup>
                    <tr>
                        <th>게임선택</th>
                        <td>
                            <div class="g_search_wrapper">
                                <div class="search_wrap">
                                    <div class="input_area">
                                        <input type="text" class="g_text search_gs_name" id="searchRegGameServer" placeholder="게임명 또는 서버명을 입력해주세요." autocomplete="off" data-gameserver="true">
                                    </div>
                                    <i class="fa fa-star favorite_icon" onclick="fnSearchAdd()"></i>
                                    <button type="button" class="g_search_list text-center" title="검색">
                                        <i class="fa fa-search" style="color: #fff;font-size: 23px;"></i>
                                    </button>
                                </div>
                                <div class="g_search_frame g_hidden reg_gameserver" id="reg_gameserver">
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
                                                <ul class="last_search"></ul>
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
                                    <div class="gs_list g_hidden" data-gslist="true" id="reg_gameserver_list"></div>
                                </div>
                            </div>
                            <div class="mygame">
                                <div class="th">
                                    나만의 검색메뉴
                                    <div class="g_msgbox blue" id="lastList" style="margin-top: 10px;">
                                        <div class="title">
                                            최근 등록한 물품
                                            <a href="javascript:;" class="close"></a>
                                        </div>
                                        <div class="cont">
                                            <table class="g_blue_table tb_list">
                                                <colgroup>
                                                    <col width="100" />
                                                    <col width="130" />
                                                    <col />
                                                    <col width="120" />
                                                    <col width="80" />
                                                </colgroup>
                                                <thead>
                                                <tr>
                                                    <th>등록일시</th>
                                                    <th>게임 & 서버</th>
                                                    <th>제목 & 수량</th>
                                                    <th>판매금액</th>
                                                    <th>200%보상</th>
                                                </tr>
                                                </thead>
                                                <tbody id="lastListTbody"></tbody>
                                            </table>
                                            <ul class="f_red1 sub_txt">
                                                <li>※ 최근 등록 물품은 7일 이내 등록했던 물품 중 최대 5개 까지 불러오기가 가능합니다. (흥정물품은 제외)</li>
                                                <li>※ 해당 표시된 정보로 등록정보를 불러오니, 등록정보 변동 시 체크 수정하시기 바랍니다.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="mygame_list">
                                    <ul id="mygame_info">
                                        @if(empty($mygame) || sizeof($mygame) == 0)
                                            <li class="empty">게임서버 검색 후 우측 ★표를 클릭하시면 해당물품이 나만의검색메뉴로 등록됩니다.</li>
                                        @else
                                            @foreach($mygame as $v)
                                                <li id="mygame_{{$v['id']}}"><a href="javascript:fnSearchSelect('{{$v['game']}}','{{$v['game_text']}}','{{$v['server']}}','{{$v['server_text']}}','{{$v['goods']}}')">{{$v['game_text']}} &gt; {{$v['server_text']}} &gt; @if($v['goods'] == 3) 게임머니 @endif @if($v['goods'] == 1) 아이템 @endif @if($v['goods'] == 4) 기타 @endif @if($v['goods'] == 6) 캐릭터 @endif</a><span class="del_btn" onclick="fnSearchDel('{{$v['id']}}')"></span></li>
                                            @endforeach
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>판매유형</th>
                        <td>
                            <label><input type="radio" name="user_goods_type" class="g_radio first_radio" value="general" checked>일반</label>
                            <label id="division"><input type="radio" name="user_goods_type" class="g_radio" value="division">분할</label>
                            <label class="g_hidden" id="bargain"><input type="radio" name="user_goods_type" class="g_radio" value="bargain">흥정</label>
                        </td>
                    </tr>
                    <tbody id="d_template">
                    <tr>
                        <th>판매수량</th>
                        <td>
                            <div class="unit_type" id="unit_type">
                                <label><input type="radio" name="gamemoney_unit" class="g_radio" value="1" checked>없음</label>
                                <label><input type="radio" name="gamemoney_unit" class="g_radio" value="만">만</label>
                                <label><input type="radio" name="gamemoney_unit" class="g_radio" value="억">억</label>
                                <label class="f_blue1 f_small">(단위)</label>
                            </div>
                            <div id="game_money">
                                <input type="text" name="user_quantity" id="user_quantity" maxlength="7" class="g_text f_right rad13">
                                <span class="unit"></span> <span class="font-weight-bold">게임머니</span>
                                <span class="g_txtbtn first_btn radbtn" id="plus10" value="10">+10</span>
                                <span class="g_txtbtn radbtn" id="plus50" value="50">+50</span>
                                <span class="g_txtbtn radbtn" id="plus100" value="100">+100</span>
                                <span class="g_txtbtn radbtn" id="plus500" value="500">+500</span>
                                <span class="g_txtbtn radbtn" id="plus1000" value="1000">+1000</span>
                                <span class="g_txtbtn radbtn btn-pa" id="initial" value="0">초기화</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>판매금액</th>
                        <td>
                            <input type="text" name="user_price" id="user_price" maxlength="10" class="g_text f_right rad13">
                            <span class="font-weight-bold">원 (3,000원 이상, 10원 단위 등록 가능)</span>
                        </td>
                    </tr>
                    <tr>
                        <th>캐릭터명</th>
                        <td>
                            <div class="dfServer" id="dfServer">
                            </div>
                            <div class="g_left">
                                <input type="text" class="g_text mode-active rad13" name="user_character" maxlength="30" id="user_character">
                                <span class="font-weight-bold">물품을 전달 하실 본인의 캐릭터명</span>
                                <span id="sub_text" class="f_red1"></span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tr>
                        <th>물품제목</th>
                        <td>
                            <div class="item_detail_opts">
                                <label><input type="checkbox" name="fixed_trade_subject" id="fixed_trade_subject" class="g_checkbox"> 물품제목 기본값 :
                                </label>
                                <span id="trade_sign_txt" class="f_blue1">{{$title}}</span>
                                <a href="javascript:_window.open('fixed_title', '/sell/fixed_trade_subject', 500, 300);" class="btn_white1">설정</a>
                            </div>
                            <input type="text" class="g_text w90 rad10 input34" name="user_title" id="user_title" maxlength="40" value="게임머니 팝니다.">
                        </td>
                    </tr>
                    <tr>
                        <th>상세설명</th>
                        <td class="bg-white">
                            <div>
                                <div class="item_detail_opts">
                                    <label><input type="radio" class="g_radio" name="text_select" value="0" checked>기본문구</label>
                                    <label><input type="radio" class="g_radio" name="text_select" value="1">직접입력</label>
                                </div>
                                <a href="javascript:;" class="wideview1" id="wideview">열기 <i class="fa fa-angle-down"></i></a>
                            </div>
                            <textarea id="user_text" name="user_text" class="txtarea w100 border-right-none" placeholder="휴대폰번호, 메신저(카톡) ID 및 거래와 무관한 내용 기재 시 물품은 삭제되며, 서비스 이용에 제재를 받게 됩니다." readonly>게임머니 팝니다.</textarea>
                        </td>
                    </tr>
                    <!-- 물품등록 알리미 -->
                    <tr id="alarm_line">
                        <th><span class="new">N</span>물품알리미 키워드등록</th>
                        <td>
                            <span class="f_small">아래 입력란에 키워드 등록을 하시면, <br>해당 키워드로 알림등록 신청을 해놓은 회원에게 알림이 되어 더욱 빠른 캐릭터 거래가 진행될 수 있습니다.</span>
                            <input type="text" id="tag_generator" name="noti_keyword" maxlength="5">
                            <span class="alarm_notice">(한글기준 최소 2글자, 최대 5글자 까지 입력가능)</span>
                            <span class="character_use_info"><a href="javascript:_window.open('premium_guide','/sell/goods_alarm_guide.html',875, 630);" class="btn_white1">이용안내</a></span>
                            <div class="tag_wrapper">
                                <h4 class="f_red1">※현재 해당 서버에 등록된 알림 키워드 <span>(클릭 시 자동으로 입력됩니다)</span></h4>
                                <div class="tag_list">
                                </div>
                            </div>
                            <div class="alarm_ballon">
                                <span class="close_btn" onclick="this.parentNode.style.display = 'none';"></span>
                                물품등록알리미를
                                <br>
                                적용해보세요!
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <th>스크린샷</th>
                        <td class="bg-white" >
                            <div class="screen_guide2 m-t-10">
                                크기가 최소 184px x 184px인 500KB이하 jpg.gif 만 가능
                                <a href="javascript:_window.open('screenshot', '#', 718, 900);" class="guide_btn">스샷등록 설명</a>
                            </div>
                            <div class="screenshot_wrap">
                                <input type="file" name="user_screen[]" class="g_file">
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="g_subtitle euro-service">
                    <p class="euro-title">유료 등록 서비스</p>
                    <div class="charge_service">
                        <dl>
                            <div>
                                <div class="text-center m-t-5 m-b-5">
                                    <img src="/angel/img/charge_service/01.png" />
                                </div>
                                <p class="text-center">프리미엄등록</p>
                                <dt class="border-bottom-2 border-yellow"></dt>
                                <dd>
                                    <div class="charge_price">
                                        <strong> 100원 / 1시간</strong>
                                    </div>
                                    <select id="user_premium_time" name="user_premium_time">
                                        <option value="">미설정</option>
                                        <option value="1">1시간</option><option value="2">2시간</option><option value="3">3시간</option><option value="4">4시간</option><option value="5">5시간</option><option value="6">6시간</option><option value="7">7시간</option><option value="8">8시간</option><option value="9">9시간</option><option value="10">10시간</option><option value="11">11시간</option><option value="12">12시간</option><option value="13">13시간</option><option value="14">14시간</option><option value="15">15시간</option><option value="16">16시간</option><option value="17">17시간</option><option value="18">18시간</option><option value="19">19시간</option><option value="20">20시간</option><option value="21">21시간</option><option value="22">22시간</option><option value="23">23시간</option><option value="24">24시간</option>                        </select>
                                    <div class="sub_txt m-t-35">
                                        프리미엄 잔여시간이 많을수록<br>물품리스트 상단에 노출됩니다.
                                    </div>
                                    <a class="free_view btn-premium" href="javascript:_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list?free_use_item=premium',440,450)">무료이용권 &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right text-white"></i> </a>
                                </dd>
                            </div>
                        </dl>
                        <dl>
                            <div>
                                <div class="text-center m-t-5 m-b-5">
                                    <img src="/angel/img/charge_service/02.png" />
                                </div>
                                <p class="text-center">물품강조</p>
                                <dt class="border-bottom-2 border-blue"></dt>
                                <dd>
                                    <div class="charge_price">
                                        <strong> 100원 / 12시간</strong>
                                    </div>
                                    <div class="goods_emphasis">
                                        <label for="user_icon_use" class="f_bold">굵은체</label>
                                        <select name="user_icon_use" id="user_icon_use">
                                            <option value="">미설정</option>
                                            <option value="12">12시간</option><option value="24">24시간</option><option value="36">36시간</option><option value="48">48시간</option><option value="60">60시간</option><option value="72">72시간</option>
                                        </select>
                                        <div class="g_msgbox blue" id="premium_layer" style="display: none !important;">
                                            <div class="cont">
                                                ※ 유료등록 서비스는 선불로 부과되며 거래성사여부, 취소여부, 삭제여부, 이용정지여부 등과<br>
                                                관계 없이 환불, 취소, 교환, 반환 등이 되지 않으니 신중하게 구매해 주시기 바랍니다.
                                            </div>
                                            <div class="btn">
                                                <a href="javascript:;" id="premium_close" class="close btn_blue4">확인</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div  class="goods_emphasis">
                                        <label for="user_bluepen_use" class="f_blue1">파란펜</label>
                                        <select name="user_bluepen_use" id="user_bluepen_use">
                                            <option value="">미설정</option>
                                            <option value="12">12시간</option><option value="24">24시간</option><option value="36">36시간</option><option value="48">48시간</option><option value="60">60시간</option><option value="72">72시간</option>
                                        </select>
                                    </div>
                                    <div class="exp">
                                        <span id="charge_apply" style="display: none">게임머니 팝니다.</span>
                                        제목 굵기/<strong class="text-green">색</strong> 효과 적용
                                    </div>
                                    <a class="free_view btn-goods" href="javascript:_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list?free_use_item=highlight',440,450)">무료이용권 &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right text-white"></i></a>
                                </dd>
                            </div>
                        </dl>
                        <dl>
                            <div>
                                <div class="text-center m-t-5 m-b-5">
                                    <img src="/angel/img/charge_service/04.png" />
                                </div>
                                <p class="text-center">스피드 거래</p>
                                <dt class="border-bottom-2 border-gray"></dt>
                                <dd>
                                    <div class="charge_price">
                                        <strong> 100원 / 1시간</strong>
                                    </div>
                                    <select id="user_quickicon_use" name="user_quickicon_use">
                                        <option value="">미설정</option>
                                        <option value="1">1시간</option><option value="2">2시간</option><option value="3">3시간</option><option value="4">4시간</option><option value="5">5시간</option><option value="6">6시간</option><option value="7">7시간</option><option value="8">8시간</option><option value="9">9시간</option><option value="10">10시간</option><option value="11">11시간</option><option value="12">12시간</option><option value="13">13시간</option><option value="14">14시간</option><option value="15">15시간</option><option value="16">16시간</option><option value="17">17시간</option><option value="18">18시간</option><option value="19">19시간</option><option value="20">20시간</option><option value="21">21시간</option><option value="22">22시간</option><option value="23">23시간</option><option value="24">24시간</option>                        </select>
                                    <div class="sub_txt m-t-35">
                                        물품리스트에 스피드 거래 <br /> 아이콘이 현시 됩니다.
                                    </div>
                                    <a class="free_view btn-speeds" href="javascript:_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list?free_use_item=quickicon',440,450)">무료이용권 &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right text-white"></i></a>
                                </dd>
                            </div>
                        </dl>
                        <dl>
                            <div>
                                <div class="text-center m-t-5 m-b-5">
                                    <img src="/angel/img/charge_service/03.png" />
                                </div>
                                <p class="text-center">자동재등록</p>
                                <dt class="border-bottom-2 border-green"></dt>
                                <dd class="rere">
                                    <div class="charge_price">
                                        <strong> 100원 / 3회</strong>
                                    </div>
                                    <div>
                                        <label for="rereg_count" class="f_black4 f_bold">재등록횟수</label>
                                        <select name="rereg_count" id="rereg_count">
                                            <option value="">미설정</option>
                                            <option value="3">3회</option>
                                            <option value="6">6회</option>
                                            <option value="9">9회</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="rereg_time" class="f_black4 f_bold">재등록시간</label>
                                        <select id="rereg_time" name="rereg_time">
                                            <option value="5">5분</option>
                                            <option value="10">10분</option>
                                        </select>
                                    </div>
                                    <div class="exp">
                                        설정된 <span id="minute" class="text-green">0</span>분 간격으로 </br><span id="rereg_cnt" class="text-green">
                                            0</span>회 재등록 됩니다.
                                    </div>
                                    <a class="free_view btn-auto" href="javascript:alert('죄송합니다.\n서비스 준비중입니다.')">무료이용권&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-chevron-circle-right text-white"></i></a>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="total_charge">
                    <strong class="total_label">총 결제금액 : </strong>
                    <strong class="total_charge_money f_red1" id="total_charge_money">0원</strong>
                    <span class="f-small">
                        (내 사용가능한 마일리지 :
                        <strong id="txtCurrentMileage" class="f_red1">{{number_format($user->mileage)}}원</strong>)
                    </span>
                </div>
                <div id="dv_power" class="dv_power g_hidden"></div>


                <style>
                    .SafetyNumber_plus {display:none;}
                </style>
                <!-- ▼ 연락처 중복 //-->
                <input type="hidden" name="user_contactA" id="user_contactA" value="{{$home_a}}">
                <input type="hidden" name="user_contactB" id="user_contactB" value="{{$home_b}}">
                <input type="hidden" name="user_contactC" id="user_contactC" value="{{$home_c}}">
                <input type="hidden" name="slctMobile_type" id="slctMobile_type" value="3">
                <input type="hidden" name="user_mobileA" id="user_mobileA" value="{{$mobile_a}}">
                <input type="hidden" name="user_mobileB" id="user_mobileB" value="{{$mobile_b}}">
                <input type="hidden" name="user_mobileC" id="user_mobileC" value="{{$mobile_c}}"><!-- ▲ 연락처 중복 //-->

                <div class="g_subtitle">등록 유저 정보</div>
                <table class="g_gray_table private_area">
                    <colgroup>
                        <col width="74">
                        <col width="200"/>
                        <col width="85"/>
                        <col width="*"/>
                    </colgroup>
                    <tr>
                        <th>이름</th>
                        <td>{{$user->name}}</td>
                        <th>연락처</th>
                        <td class="text-center">
                <span id="spnUserPhone">
                070-3595-6151                </span>
                            ( <label><input type="checkbox" class="g_checkbox" name="user_cell_check" id="chk_user_cell_check" value="on" checked> 자택번호안내</label> ) /
                            <span id="spnUserCell">{{$user->number}}</span>
                            <a href="javascript:_window.open('private_edit', '/user/contact_edit?check=true', 496, 350);" class="btn_white1 after">연락처 수정</a>
                        </td>
                    </tr>
                    <tr class="SafetyNumber">
                        <th>안심번호</th>
                        <td colspan="3">
                            개인정보보호 및 사고예방을 위해<br> 고객님의 휴대폰으로 거래시 502로 시작하는 무료안심번호가 휴대폰으로 부여되어 상대방에게 안내됩니다.
                            <div class="safe_area">
{{--                                <a href="javascript:;" class="guide_txt" id="safe_guide">안심번호란?</a>--}}
                                <div class="g_msgbox blue" id="safe_layer">
                                    <div class="title">
                                        안심번호란?
                                        <a href="javascript:;" class="close"></a>
                                    </div>
                                    <div class="cont">
                                        고객님의 개인정보 보호를 위해 휴대폰번호에 안심번호를 부여하여 실제 휴대폰번호 대신<br> 가상의 안심번호를 상대 거래자에게 노출시켜주는 무료 서비스 입니다.
                                        <ul class="f_red1">
                                            <strong>안심번호 서비스 사용 시 주의사항</strong><br> 1) 부여받은 안심번호로도 문자 수신이 가능합니다.(발신시에는 부여받은 안심번호 사용)<br> 2) 상대거래자가 안심번호 서비스를 사용하지 않는 상태에서 발신한 경우 실제 번호가 표시됩니다.<br> 3) 부여 받은 안심번호는 거래가 종료되는 시점에 자동 회수되며, 회수된 이후에는 연락이 불가능합니다.<br> 4) 안심번호 사용 후 48시간을 초과하거나 거래종료 후 문제발생 시 실제 전화번호가 노출됩니다.
                                        </ul>
                                    </div>
                                    <div class="btn">
                                        <a href="/guide/add/security_number class="btn_blue4">안심번호 이용안내 ></a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="SafetyNumber_plus">
                        <th>안심번호 플러스</th>
                        <td>
                            개인정보보호 및 사고예방을 위해<br> 고객님의 휴대폰으로 거래 시 02-1234-1234 형태의 번호가 부과되어 상대방에게 안내됩니다.
                            <div class="safe_area">
                                <a href="javascript:;" class="guide_txt" id="safe_plus_guide">안심번호 플러스란?</a>
                                <div class="g_msgbox blue" id="safe_plus_layer">
                                    <div class="title">
                                        안심번호 플러스란?
                                        <a href="javascript:;" class="close"></a>
                                    </div>
                                    <div class="cont">
                                        고객님의 개인정보 보호를 위해 휴대폰번호에 안심번호를 부여하여 실제 휴대폰번호 대신<br> 가상의 안심번호를 상대 거래자에게 노출시켜주는 무료 서비스 입니다.
                                        <ul class="f_red1">
                                            <strong>안심번호 플러스 사용 시 주의사항</strong><br> 1) 부여받은 안심번호로 통화 시 수신자에게 10초에 20원의 이용료가 부과됩니다.<br> 2) 안심번호 플러스로 문자 수신은 불가능합니다.<br> 3) 부여 받은 안심번호 플러스는 거래가 종료되는 시점에 자동 회수되며, 회수된 이후에는 연락이 불가능합니다.<br> 4) 가상 번호 사용 후 24시간을 초과하거나 거래종료 후 문제발생 시 실제 전화번호가 노출됩니다.
                                        </ul>
                                    </div>
                                    <div class="btn">
                                        <a href="/guide/add/security_number_plus class="btn_blue4"> 이용안내 ></a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="g_gray_table private_area mt-0 border-top-0">
                    <colgroup>
                        <col width="74">
                        <col width="400"/>
                        <col width="85"/>
                        <col width="*"/>
                    </colgroup>
                    <tr>
                        <th>거래알림</th>
                        <td>
                            카카오톡 ,채널/문자 알림
                        </td>
                        <th>우수회원인증</th>
                        <td class="text-center">
                            <ul class="excellent">
                                <li class="cert_state">
                                    @if($user->mobile_verified == 1)
                                        <img src="/angel/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                    @endif
                                        휴대폰
                                </li>

                                <li class="cert_state">
                                    @if(!empty($user->email_verified_at))
                                        <img src="/angel/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                    @endif
                                    이메일</li>
                                <li class="cert_state">
                                    @if($user->bank_verified ==1 )
                                        <img src="/angel/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                    @endif
                                    출금계좌</li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <script>
                    window.onload = function(){

                        if(document.getElementById('safe_guide') !== null) {
                            LayerControl({
                                el: document.getElementById('safe_guide'),
                                layer: document.getElementById('safe_layer'),
                                close_btn : document.getElementById('safe_layer').querySelector('.close'),
                                mask: false,
                                type: 'style'
                            });
                        }

                        if(document.getElementById('safe_plus_guide') !== null){
                            LayerControl({
                                el: document.getElementById('safe_plus_guide'),
                                layer: document.getElementById('safe_plus_layer'),
                                close_btn : document.getElementById('safe_plus_layer').querySelector('.close'),
                                mask: false,
                                type: 'style'
                            });
                        }
                    };
                </script>                        <div class="g_btn_wrap">
                    <button type="submit" href="javascript:;" class="sell_reg" id="ok_btn">판매등록</button>
                    <a href="/index" class="cancel_reg">등록 취소</a>
                </div>
            </form>
            <div class="qntKorean" id="qntKorean"></div>
        </div>
        <div id="dvPremium" class="g_layer premium_info">
            <div class="inner">
                <div class="title">프리미엄 등록안내</div>
                <div class="middle_text">프리미엄 물품 등록을 하시면 물품 리스트 상단에 판매 물품 노출이 가능합니다.<br/>빠른 거래를 원하신다면 프리미엄 등록서비스를 이용하시기 바랍니다.
                </div>
                <div class="mile_area">(내 사용가능한 마일리지 :
                    <span id="pop_txtCurrentMileage" class="f_org1">{{number_format($user->mileage)}}</span> 원)
                </div>
                <div class="mt-40 text-center">
                    <a href="javascript:;_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list?free_use_item=premium',440,450)" class="btn_gray">프리미엄 무료이용권 보기</a>
                </div>
                <div class="dvpremium">
                    <div class="g_left">
                        <strong class="service_title">프리미엄 등록</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select id="pop_user_premium_time" name="pop_user_premium_time" onchange="fnpremiumSelect($(this), $(this).val());">
                            <option value="">미설정</option>
                            <option value="1">1시간</option>
                            <option value="2">2시간</option>
                            <option value="3">3시간</option>
                            <option value="4">4시간</option>
                            <option value="5">5시간</option>
                            <option value="6">6시간</option>
                            <option value="7">7시간</option>
                            <option value="8">8시간</option>
                            <option value="9">9시간</option>
                            <option value="10">10시간</option>
                            <option value="11">11시간</option>
                            <option value="12">12시간</option>
                            <option value="13">13시간</option>
                            <option value="14">14시간</option>
                            <option value="15">15시간</option>
                            <option value="16">16시간</option>
                            <option value="17">17시간</option>
                            <option value="18">18시간</option>
                            <option value="19">19시간</option>
                            <option value="20">20시간</option>
                            <option value="21">21시간</option>
                            <option value="22">22시간</option>
                            <option value="23">23시간</option>
                            <option value="24">24시간</option>
                        </select>
                        이용료<strong class="f_black3"> 100원 </strong> / 1시간
                    </div>

                    <div class="g_clear">※ 프리미엄 잔여시간이 많을수록 물품리스트 상단에 노출됩니다.</div>
                </div>

                <div class="g_btn_wrap">
                    <a href="javascript:;" id="premium_btn" class="btn-default btn-suc">
                        확인
                    </a>
                </div>
            </div>
        </div>
        <div id="dvPopup" class="g_layer reg_info">
            <div class="inner">
                <div class="title">
                    물품등록정보
                    <a href="javascript:;" class="close_w"></a>
                </div>
                <div class="cont">
                </div>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
