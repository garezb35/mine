@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/common_list.css?210512" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/goods_alarm/css/goods_alarm.css?210503" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/myroom/goods_alarm/js/alarm_add.js?210503"></script>
@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    <div class="aside">
        <div class="nav_subject"><a href="http://trade.itemmania.com/myroom/" class="myroom">MyRoom</a></div>
        <div class="nav">
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/message/">메세지함</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/sell/sell_regist.html">판매관련</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/buy/buy_regist.html">구매관련</a></div>
            <div class="nav_title on_active"><a href="http://trade.itemmania.com/myroom/goods_alarm/alarm_sell_list.html">물품등록 알리미<span class="new">N</span></a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/complete/sell.html">종료내역</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/complete/cancel_sell.html">취소내역</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/mileage/my_mileage/">마일리지</a></div>
            <ul class='nav_sub g_list'>
                <li class=""><a href="http://trade.itemmania.com/myroom/mileage/my_mileage/">내마일리지</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/mileage/guide/charge.html">마일리지충전</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/mileage/payment/payment_switch.html">마일리지출금</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/mileage/change/culturecash/">마일리지전환</a></li>
            </ul>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/myinfo/myinfo_check.html">개인정보</a></div>
            <ul class='nav_sub g_list'>
                <li class=""><a href="http://trade.itemmania.com/myroom/myinfo/myinfo_check.html">개인정보수정</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/myinfo/myinfo_login_sync.html">로그인연동관리</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/myinfo/myinfo_offer_check.html">수신/동의철회</a></li>
                <li class=""><a href="http://trade.itemmania.com/myroom/myinfo/credit_rating.html">신용등급/인증</a></li>
            </ul>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/lotto/lottopot.html">로또 추천번호</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/pmall/spointmall.html">쇼핑포인트</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/cash_receipt/cash_receipt_list.html">현금영수증</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/coupon/free.html">이용권현황</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/myinfo/myinfo_safe_settlement.html">보안센터</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/customer/">환경설정</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/user_leave/user_leave_form.html">회원탈퇴</a></div>
        </div>
    </div>
    <div class="g_content">
        <div class="g_title_blue"> 물품등록 알리미
            <ul class="g_path">
                <li>홈</li>
                <li>마이룸</li>
                <li class="select">물품등록 알리미</li>
            </ul>
        </div>
        <div class="SpGroup top_box">
            <p class="top_title"><span class="ft_orange">물품등록</span>알리미란?</p>
            <p>회원이 원하는 물품 조건(키워드,캐릭터 종류 등)에 맞는 물품이 등록되면,</p>
            <p>이를 회원에게(캐릭터거래에 한해) 알림 해주는 편리한 무료서비스입니다.</p>
        </div>
        <div class="g_tab">
            <div class=""><a href="/myroom/goods_alarm/alarm_sell_list.html">등록 알림 내역</a></div>
            <div class="selected"><a href="/myroom/goods_alarm/alarm_add.html">알림 설정 등록</a></div>
        </div>
        <form name="alarmAdd" id="alarmAdd" method="post" action="alarm_add_ok.php">
            <input type="hidden" name="save_type" id="save_type" value="write">
            <input type="hidden" name="game_code" id="game_code" value="">
            <input type="hidden" name="game_code_text" id="game_code_text">
            <input type="hidden" name="server_code" id="server_code" value="">
            <input type="hidden" name="server_code_text" id="server_code_text">
            <table id="table_wrapper" class="g_blue_table">
                <colgroup>
                    <col width="160">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th>카테고리</th>
                    <td>
                        <select id="game_code_selector" class="game_code_selector"> </select>
                        <select id="server_code_selector" class="server_code_selector"> </select>
                        <p class="server_select_noti">- 원하시는 캐릭터 물품의 등록 알림 게임서버를 선택하세요.</p>
                    </td>
                </tr>
                <tr>
                    <th>캐릭터 정보</th>
                    <td>
                        <h5>물품등록 구분</h5>
                        <div class="goods_radio_wrapper">
                            <label>
                                <input type="radio" name="user_goods_type" class="g_radio first_radio change_table" value="1" checked>팝니다</label>
                            <label>
                                <input type="radio" name="user_goods_type" class="g_radio change_table" value="2">삽니다</label>
                        </div>
                        <h5>구매등록자의 신용등급</h5>
                        <div class="goods_radio_wrapper">
                            <label>
                                <input type="radio" name="credit_type" class="g_radio first_radio" value="1" checked>전체</label>
                            <label>
                                <input type="radio" name="credit_type" class="g_radio" value="2">VIP이상</label>
                            <label>
                                <input type="radio" name="credit_type" class="g_radio" value="3">플래티넘이상</label>
                            <label>
                                <input type="radio" name="credit_type" class="g_radio" value="4">골드이상</label>
                            <label>
                                <input type="radio" name="credit_type" class="g_radio" value="5">실버이상</label>
                        </div>
                        <h5>캐릭터 종류</h5>
                        <div class="goods_radio_wrapper">
                            <label>
                                <input type="radio" name="account_type" class="g_radio first_radio" value="1" checked>전체</label>
                            <label>
                                <input type="radio" name="account_type" class="g_radio" value="2">Guest</label>
                            <label>
                                <input type="radio" name="account_type" class="g_radio" value="3">Google</label>
                            <label>
                                <input type="radio" name="account_type" class="g_radio" value="4">Facebook</label>
                            <label>
                                <input type="radio" name="account_type" class="g_radio" value="5">기타</label>
                        </div>
                        <h5>캐릭터 상태</h5>
                        <div class="goods_radio_wrapper">
                            <label>
                                <input type="radio" name="purchase_type" class="g_radio first_radio" value="1" checked>전체</label>
                            <label>
                                <input type="radio" name="purchase_type" class="g_radio" value="2">본인(1대)</label>
                            <label>
                                <input type="radio" name="purchase_type" class="g_radio" value="3">그 외</label>
                        </div>
                        <h5>결제내역</h5>
                        <div class="goods_radio_wrapper">
                            <label>
                                <input type="radio" name="payment_existence" class="g_radio first_radio" value="1" checked>전체</label>
                            <label>
                                <input type="radio" name="payment_existence" class="g_radio" value="2">결제내역 있음(O)</label>
                            <label>
                                <input type="radio" name="payment_existence" class="g_radio" value="3">결제내역 없음(X)</label>
                        </div>
                        <h5>이중연동 여부</h5>
                        <div class="goods_radio_wrapper">
                            <label>
                                <input type="radio" name="multi_access" class="g_radio first_radio" value="1" checked>전체</label>
                            <label>
                                <input type="radio" name="multi_access" class="g_radio" value="2">연동(O)</label>
                            <label>
                                <input type="radio" name="multi_access" class="g_radio" value="3">미연동(X)</label>
                        </div>
                        <h5>기타조건</h5>
                        <div id="alarm_change_wrapper" class="alarm_change_wrapper">
                            <div class="goods_radio_wrapper">
                                <label>
                                    <input type="checkbox" name="compen" id="compen" class="g_checkbox"> 200% 보상 물품</label>
                                <label>
                                    <input type="checkbox" name="sell_compen" id="sell_compen" class="g_checkbox"> 200% 구매보상</label>
                                <label>
                                    <input type="checkbox" name="excellent" id="excellent" class="g_checkbox"> 우수인증 물품</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>알림키워드</th>
                    <td>
                        <div class="">
                            <input type="text" class="add_subject mode-active" name="subject[]" minlength="2" maxlength="5" value="">
                            <input type="text" class="add_subject mode-active" name="subject[]" minlength="2" maxlength="5" value="">
                            <input type="text" class="add_subject mode-active" name="subject[]" minlength="2" maxlength="5" value=""> <span id="sub_text" class="f_red1">(1개 이상 필수 입력)</span> </div>
                        <p class="character_noti">- 제목 알림 설정은 최대 3개까지 가능하며, 이중 1개만 매칭 되어도 알림이 됩니다.</p>
                        <p class="character_noti">- 각 제목의 텍스트는 한글기준 최소 2글자 ~ 최대 5글자까지 입력 가능합니다.</p>
                    </td>
                </tr>
                <tr>
                    <th>알림방식</th>
                    <td>
                        <div>
                            <label>
                                <input type="radio" name="user_alarm_type" class="g_radio" value="1" checked>모바일앱 Push (무료)</label>
                            <label>
                                <input type="radio" name="user_alarm_type" class="g_radio" value="2">문자메시지 SMS (무료)</label>
                        </div>
                        <p class="character_noti">- 모바일앱 PUSH로 알림을 받으시려면 아이템매니아앱 설치 및 로그인이 되어 있어야 합니다.</p>
                        <p class="character_noti">- 앱PUSH 알림은 모바일앱 > 환경설정 > 마케팅정보PUSH알림에서 수신동의 상태일때만 발송됩니다.</p>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="goods_alarm_btn_wrapper">
                <button id="submit_btn" class="submit_btn form_btn sell" type="button"> 알림설정 등록 </button>
            </div>
        </form>
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
