@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/buy/css/index.css?v=210803">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21100816"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/myroom/buy/js/buy_re_reg.js?v=210512"></script>
    <script type="text/javascript">
        var useMileage = '245';
        function __init() {
            e_select.goods = "etc";
            e_select.sale = "general";
            e_use.highlight=7;

        }
    </script>

@endsection

@section('content')
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <div class="aside">
            <div class="nav_subject"><a href="http://trade.itemmania.com/myroom/" class="myroom">MyRoom</a></div>
            <div class="nav">
                <div class="nav_title "><a href="http://trade.itemmania.com/myroom/message/">메세지함</a></div>
                <div class="nav_title "><a href="http://trade.itemmania.com/myroom/sell/sell_regist.html">판매관련</a></div>
                <div class="nav_title on_active"><a href="http://trade.itemmania.com/myroom/buy/buy_regist.html">구매관련</a></div>
                <div class="nav_title "><a href="http://trade.itemmania.com/myroom/goods_alarm/alarm_sell_list.html">물품등록 알리미<span class="new">N</span></a></div>
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
            <!-- ▼ 타이틀 //-->
            <div class="g_title_green"> 재 등록할 <span>물품</span>
                <ul class="g_path">
                    <li>홈</li>
                    <li>마이룸</li>
                    <li class="select">구매관련</li>
                </ul>
            </div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <form id="frmBuy" name="frmBuy" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id" value="2021101407759231">
                <input type="hidden" id="user_goods" name="user_goods" value="etc">
                <input type="hidden" id="user_goods_type" name="user_goods_type" value="general">
                <input type="hidden" id="game_code" name="game_code" value="3492">
                <input type="hidden" id="server_code" name="server_code" value="13667">
                <input type="hidden" id="gs_name" name="gs_name" value="AOS레전드 > 기타">
                <input type="hidden" id="unit" name="unit" value="기타">
                <input type="hidden" id="security_type" name="security_type" value="INCS">
                <input type="hidden" id="security_number" name="security_number">
                <input type="hidden" id="security_code" name="security_code">
                <input type="hidden" name="user_premium_use" id="user_premium_use">
                <input type="hidden" name="user_quick_icon_use" id="user_quick_icon_use">
                <input type="hidden" name="user_charge" id="user_charge">
                <!-- 마일리지 결제 인증 변수 -->
                <input type="hidden" id="certify_pay" name="certify_pay" value="YTo0OntzOjEwOiJjZXJ0aWZ5X2xjIjtzOjM6ImJ1eSI7czo5OiJmb3JtX25hbWUiO3M6NjoiZnJtQnV5IjtzOjExOiJzdWJtaXRfdHlwZSI7czoxOiIxIjtzOjEwOiJzdWJtaXRfdXJsIjtzOjI5OiIvbXlyb29tL2J1eS9idXlfcmVfcmVnX29rLnBocCI7fQ==">
                <!-- ▼ 재등록 물품정보 //-->
                <div class="g_subtitle first">물품정보</div>
                <table class="g_green_table">
                    <colgroup>
                        <col width="160">
                        <col>
                    </colgroup>
                    <tr>
                        <th>카테고리</th>
                        <td>AOS레전드 > 기타 > 기타</td>
                    </tr>
                    <tr>
                        <th>구매유형</th>
                        <td>일반</td>
                    </tr>
                    <tbody id="d_template">
                    <tr>
                        <th>구매금액</th>
                        <td>
                            <input type="text" name="user_price" id="user_price" maxlength="10" class="g_text f_right" value="3,000"> 원 (3,000원 이상, 10원 단위 등록 가능)
                            <div id="coms_area" class="coms_area">수수료 5% : <span class="f_red1" id="commission_price">0</span>원 | 실 수령액 : <span class="f_red1" id="receive_price">0</span>원 </div>
                        </td>
                    </tr>
                    </tbody>
                    <tr>
                        <th>캐릭터명</th>
                        <td>
                            <div class="g_left">
                                <input type="text" class="g_text mode-active" name="user_character" id="user_character" value="홍길동"> 물품을 전달 받으실 본인의 캐릭터명 </div>
                        </td>
                    </tr>
                    <tr>
                        <th>즉시구매</th>
                        <td>
                            <div>
                                <label>
                                    <input type="checkbox" class="g_checkbox" id="direct_reg_trade" name="direct_reg_trade" value="1"> 즉시구매 등록</label>
                            </div>
                            <dl class="direct_info"> <dt>판매신청 조건 설정 :</dt>
                                <dd>
                                    <select name="direct_condition_credit" disabled>
                                        <option value="1">조건없음</option>
                                        <option value="2">VIP</option>
                                        <option value="5">플래티넘 이상</option>
                                        <option value="7">골드 이상</option>
                                        <option value="9">실버 이상</option>
                                    </select>
                                    <select name="direct_condition_hpp" disabled>
                                        <option value="" selected>휴대폰인증 X</option>
                                        <option value="1">휴대폰인증 O</option>
                                    </select>
                                    <select name="direct_condition_acc" disabled>
                                        <option value="" selected>계좌인증 X</option>
                                        <option value="1">계좌인증 O</option>
                                    </select>
                                </dd>
                                <dd class="guide_txt">해당 조건을 충족하는 판매자만이 판매신청을 할 수 있습니다.</dd>
                            </dl>
                        </td>
                    </tr>
                    <tr>
                        <th>물품제목</th>
                        <td>
                            <div class="item_detail_opts">
                                <label>
                                    <input type="checkbox" name="fixed_trade_subject" id="fixed_trade_subject" class="g_checkbox"> 물품제목 기본값 : </label> <span id="trade_sign_txt" class="f_blue1"></span> <a href="javascript:_window.open('fixed_title', 'fixed_trade_subject.html', 500, 300);" class="btn_white1">설정</a> </div>
                            <input type="text" class="g_text w100" name="user_title" id="user_title" maxlength="40" value="기타 삽니다.">
                            <br> </td>
                    </tr>
                    <tr>
                        <th>상세설명</th>
                        <td>
                            <textarea id="user_text" name="user_text" class="txtarea w100">기타&#160;삽니다.</textarea>
                        </td>
                    </tr>
                </table>
                <!-- ▲ 재등록 물품정보 //-->
                <!-- ▼ 유료등록 서비스 //-->
                <div class="g_subtitle"> 유료등록 서비스
                    <div> <span class="f_small">등록하려는 물품 제목을 강조하거나, 물품리스트 상단에 노출 및 자동으로 등록된 물품을 재등록할 수 있는 서비스입니다.</span>
                        <div class="btn_area"> <a href="javascript:;" class="btn_green" id="credit_benefit">신용등급혜택받기</a> <a href="javascript:_window.open('premium_guide','/sell/premium_guide.html',628, 630);" class="btn_white1">이용안내</a> </div>
                    </div>
                </div>
                <div class="charge_service">
                    <div class="g_msgbox green" id="premium_layer" style="right: 150px; top:100px;">
                        <div class="cont"> ※ 유료등록 서비스는 선불로 부과되며 거래성사여부, 취소여부, 삭제여부, 이용정지여부 등과
                            <br> 관계 없이 환불, 취소, 교환, 반환 등이 되지 않으니 신중하게 구매해 주시기 바랍니다. </div>
                        <div class="btn"> <a href="javascript:;" id="premium_close" class="close btn_green2">확인</a> </div>
                    </div>
                    <dl> <dt>프리미엄등록</dt>
                        <dd>
                            <div class="charge_price">(이용료 : <strong> 100원 </strong> / 1시간) </div>
                            <select id="user_premium_time" name="user_premium_time">
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
                            <div class="sub_txt"> 프리미엄 잔여시간이 많을수록
                                <br>물품리스트 상단에 노출됩니다. </div> <a class="free_view" href="javascript:_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list.html?free_use_item=premium',440,450)">무료이용권 보기 ></a> </dd>
                    </dl>
                    <dl> <dt>물품강조</dt>
                        <dd>
                            <div class="charge_price">(이용료 : <strong> 100원 </strong> / 12시간) </div>
                            <div>
                                <label for="user_icon_use" class="f_bold">굵은체</label>
                                <select name="user_icon_use" id="user_icon_use">
                                    <option value="">미설정</option>
                                    <option value="12">12시간</option>
                                    <option value="24">24시간</option>
                                    <option value="36">36시간</option>
                                    <option value="48">48시간</option>
                                    <option value="60">60시간</option>
                                    <option value="72">72시간</option>
                                </select>
                            </div>
                            <div>
                                <label for="user_bluepen_use" class="f_green1">녹색펜</label>
                                <select name="user_bluepen_use" id="user_bluepen_use">
                                    <option value="">미설정</option>
                                    <option value="12">12시간</option>
                                    <option value="24">24시간</option>
                                    <option value="36">36시간</option>
                                    <option value="48">48시간</option>
                                    <option value="60">60시간</option>
                                    <option value="72">72시간</option>
                                </select>
                            </div>
                            <div class="exp"> 적용 시 : 예) <span id="charge_apply">게임머니 삽니다.</span> </div> <a class="free_view" href="javascript:_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list.html?free_use_item=highlight',440,450)">무료이용권 보기 ></a> </dd>
                    </dl>
                    <dl> <dt><span class="new">N</span>퀵아이콘</dt>
                        <dd>
                            <div class="charge_price"> (이용료 : <strong> 100원 </strong> / 1시간) </div>
                            <select id="user_quickicon_use" name="user_quickicon_use">
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
                            <div class="sub_txt"> 물품리스트에 빠른거래
                                <br> 아이콘이 노출됩니다. </div> <a class="free_view" href="javascript:_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list.html?free_use_item=quickicon',440,450)">무료이용권 보기 ></a> </dd>
                    </dl>
                    <dl> <dt>자동재등록</dt>
                        <dd>
                            <div class="charge_price">(이용료 : <strong> 100원 </strong> / 3회) </div>
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
                            <div class="exp"> 적용 시 : 예) <span id="minute">0분</span> 간격으로 <span id="rereg_cnt">0회</span> 재등록 </div> <a class="free_view" onclick="">무료이용권 보기 ></a> </dd>
                        <dd class="prepare"> 준비중 </dd>
                    </dl>
                    <div class="total_charge"> <strong class="total_label">총 결제금액 : </strong> <strong class="total_charge_money f_red1" id="total_charge_money">0원</strong>
                        <div> (내 사용가능한 마일리지 : <strong id="txtCurrentMileage" class="f_red1">245원</strong>) </div>
                    </div>
                </div>
                <!-- ▲ 유료등록 서비스 //-->
                <!-- ▼ 개인정보 //-->
                <style>
                    .SafetyNumber_plus {
                        display: none;
                    }
                </style>
                <!-- ▼ 연락처 중복 //-->
                <input type="hidden" name="user_id" id="user_id" value="pejjwh">
                <input type="hidden" name="user_contactA" id="user_contactA" value="N">
                <input type="hidden" name="user_contactB" id="user_contactB" value="">
                <input type="hidden" name="user_contactC" id="user_contactC" value="">
                <input type="hidden" name="slctMobile_type" id="slctMobile_type" value="1">
                <input type="hidden" name="user_mobileA" id="user_mobileA" value="010">
                <input type="hidden" name="user_mobileB" id="user_mobileB" value="4797">
                <input type="hidden" name="user_mobileC" id="user_mobileC" value="3690">
                <!-- ▲ 연락처 중복 //-->
                <div class="g_subtitle">내 거래정보</div>
                <table class="g_green_table private_area">
                    <colgroup>
                        <col width="160">
                        <col/> </colgroup>
                    <tr>
                        <th>이름</th>
                        <td>이장훈</td>
                    </tr>
                    <tr>
                        <th>연락처</th>
                        <td> <span id="spnUserPhone">
                자택번호 없음                </span> (
                            <label>
                                <input type="checkbox" class="g_checkbox" name="user_cell_check" id="chk_user_cell_check" value="on" checked> 자택번호안내</label> ) / <span id="spnUserCell">010-4797-3690</span> <a href="javascript:_window.open('private_edit', '/user/contact_edit.html', 496, 350);" class="btn_white1 after">연락처 수정</a> </td>
                    </tr>
                    <tr class="SafetyNumber">
                        <th>안심번호</th>
                        <td> 개인정보보호 및 사고예방을 위해
                            <br> 고객님의 휴대폰으로 거래 시 0508로 시작하는 무료안심번호가 휴대폰으로 부여되어 상대방에게 안내됩니다.
                            <div class="safe_area"> <a href="javascript:;" class="guide_txt" id="safe_guide">안심번호란?</a>
                                <div class="g_msgbox green" id="safe_layer">
                                    <div class="title"> 안심번호란?
                                        <a href="javascript:;" class="close"></a>
                                    </div>
                                    <div class="cont"> 고객님의 개인정보 보호를 위해 휴대폰번호에 안심번호를 부여하여 실제 휴대폰번호 대신
                                        <br> 가상의 안심번호를 상대 거래자에게 노출시켜주는 무료 서비스 입니다.
                                        <ul class="f_red1"> <strong>안심번호 서비스 사용 시 주의사항</strong>
                                            <br> 1) 부여받은 안심번호로도 문자 수신이 가능합니다.(발신시에는 부여받은 안심번호 사용)
                                            <br> 2) 상대거래자가 안심번호 서비스를 사용하지 않는 상태에서 발신한 경우 실제 번호가 표시됩니다.
                                            <br> 3) 부여 받은 안심번호는 거래가 종료되는 시점에 자동 회수되며, 회수된 이후에는 연락이 불가능합니다.
                                            <br> 4) 안심번호 사용 후 48시간을 초과하거나 거래종료 후 문제발생 시 실제 전화번호가 노출됩니다. </ul>
                                    </div>
                                    <div class="btn"> <a href="/guide/add/security_number.html" class="btn_green2">안심번호 이용안내 ></a> </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="SafetyNumber_plus">
                        <th>안심번호 플러스</th>
                        <td> 개인정보보호 및 사고예방을 위해
                            <br> 고객님의 휴대폰으로 거래 시 02-1234-1234 형태의 번호가 부과되어 상대방에게 안내됩니다.
                            <div class="safe_area"> <a href="javascript:;" class="guide_txt" id="safe_plus_guide">안심번호 플러스란?</a>
                                <div class="g_msgbox green" id="safe_plus_layer">
                                    <div class="title"> 안심번호 플러스란?
                                        <a href="javascript:;" class="close"></a>
                                    </div>
                                    <div class="cont"> 고객님의 개인정보 보호를 위해 휴대폰번호에 안심번호를 부여하여 실제 휴대폰번호 대신
                                        <br> 가상의 안심번호를 상대 거래자에게 노출시켜주는 무료 서비스 입니다.
                                        <ul class="f_red1"> <strong>안심번호 플러스 사용 시 주의사항</strong>
                                            <br> 1) 부여받은 안심번호로 통화 시 수신자에게 10초에 20원의 이용료가 부과됩니다.
                                            <br> 2) 안심번호 플러스로 문자 수신은 불가능합니다.
                                            <br> 3) 부여 받은 안심번호 플러스는 거래가 종료되는 시점에 자동 회수되며, 회수된 이후에는 연락이 불가능합니다.
                                            <br> 4) 가상 번호 사용 후 24시간을 초과하거나 거래종료 후 문제발생 시 실제 전화번호가 노출됩니다. </ul>
                                    </div>
                                    <div class="btn"> <a href="/guide/add/security_number_plus.html" class="btn_green2"> 이용안내 ></a> </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>거래알림</th>
                        <td>
                            <label>
                                <input type="checkbox" name="user_sms" id="user_sms" value="1" class="g_checkbox" checked>SMS 수신 동의</label>
                            <label>
                                <input type="checkbox" name="user_push" id="user_push" value="1" class="g_checkbox">모바일앱 거래관련 PUSH 알림</label>
                            <br> <a href="javascript:_window.open('push_guide', '/sell/guide/apppush.html', 650, 1000)" class="guide_txt">앱 PUSH알림이란?</a> </td>
                    </tr>
                    <tr>
                        <th>우수인증</th>
                        <td>
                            <div class="excellent_txt"> 우수인증 회원이 아닙니다. </div>
                            <ul class="excellent">
                                <li class="cert_state on">휴대폰</li>
                                <li class="cert_state">이메일</li>
                                <li class="cert_state on">출금계좌</li>
                            </ul> <a href="javascript:_window.open('excellent_guide','/popup/excellent_guide.html',520, 440);" class="guide_txt">우수인증회원이란?</a> </td>
                    </tr>
                </table>
                <script>
                    window.onload = function() {
                        if(document.getElementById('safe_guide') !== null) {
                            LayerControl({
                                el: document.getElementById('safe_guide'),
                                layer: document.getElementById('safe_layer'),
                                close_btn: document.getElementById('safe_layer').querySelector('.close'),
                                mask: false,
                                type: 'style'
                            });
                        }
                        if(document.getElementById('safe_plus_guide') !== null) {
                            LayerControl({
                                el: document.getElementById('safe_plus_guide'),
                                layer: document.getElementById('safe_plus_layer'),
                                close_btn: document.getElementById('safe_plus_layer').querySelector('.close'),
                                mask: false,
                                type: 'style'
                            });
                        }
                    };
                </script>
                <!-- ▲ 개인정보 //-->
                <div class="g_btn_wrap">
                    <button type="submit" href="javascript:;" class="buy_re_reg" id="ok_btn">재등록</button> <a href="/index.html" class="cancel_reg">등록 취소</a> </div>
            </form>
            <div class="qntKorean" id="qntKorean"></div>
        </div>
        <!-- ▼ 프리미엄 등록 안내 //-->
        <div id="dvPremium" class="g_layer green premium_info">
            <div class="inner">
                <div class="pre_title">프리미엄 등록안내</div>
                <div class="f_green2 middle_text">프리미엄 물품 등록을 하시면 물품 리스트 상단에 판매 물품 노출이 가능합니다.
                    <br/>빠른 거래를 원하신다면 프리미엄 등록서비스를 이용하시기 바랍니다. </div>
                <div class="f_green2 mile_area">(내 사용가능한 마일리지 : <span id="pop_txtCurrentMileage" class="f_org1">245</span> 원) </div>
                <div class="dvpremium">
                    <div class="g_left"> <strong class="service_title">프리미엄 등록</strong>
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
                        </select> 이용료<strong class="f_black3"> 100원 </strong> / 1시간 </div>
                    <div class="g_right"> <a href="javascript:;_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list.html?free_use_item=premium',440,450)" class="btn_green2">프리미엄 무료이용권 보기</a> </div>
                    <div class="g_clear">※ 프리미엄 잔여시간이 많을수록 물품리스트 상단에 노출됩니다.</div>
                </div>
                <div class="noti_txt"> * 유료등록 서비스는 선불로 부과되며 거래성사여부, 취소여부, 삭제여부, 이용정지여부 등과
                    <br> 관계 없이 환불, 취소, 교환, 반환 등이 되지 않으니 신중하게 구매해 주시기 바랍니다. </div>
                <div class="g_btn_wrap">
                    <a href="javascript:;" id="premium_btn"><img src="http://img4.itemmania.com/new_images/btn/btn_pop_ok_g.gif" width="63" height="35" alt="확인"></a>
                </div>
            </div>
        </div>
        <!-- ▲ 프리미엄 등록 안내//-->
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
