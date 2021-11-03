@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href=/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/sell/css/common_list.css?210114" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    <div class="aside">
        <div class="nav_subject"><a href="http://trade.itemmania.com/myroom/" class="myroom">MyRoom</a></div>
        <div class="nav">
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/message/">메세지함</a></div>
            <div class="nav_title on_active"><a href="http://trade.itemmania.com/myroom/sell/sell_regist.html">판매관련</a></div>
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/buy/buy_regist.html">구매관련</a></div>
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
        <div class="g_title_blue"> 판매 <span>관련</span>
            <ul class="g_path">
                <li>홈</li>
                <li>마이룸</li>
                <li>판매관련</li>
                <li class="select">판매중인 물품</li>
            </ul>
        </div>
        <!-- ▲ 타이틀 //-->
        <!-- ▼ 판매관련 //-->
        <div class="bs_content sell_content">
            <div class="icon_wrap"> <span class="SpGroup sell_icon">판매</span> </div>
            <div class="regist_product">
                <div class="regist_title">판매 등록 물품</div> <a href="/myroom/sell/sell_regist.html?strRelationType=regist" class="regist_result f_blue1">1건</a> </div>
            <div class="bargain_request_product">
                <div class="bargain_request_title">흥정 신청된 물품</div> <a href="/myroom/sell/sell_check.html?strRelationType=check" class="bargain_request_result f_blue1">0건</a> </div>
            <div class="box_line"></div>
            <div class="step_title deposit_product_title">STEP 1
                <br/>입금 대기 물품</div> <a href="/myroom/sell/sell_pay_wait.html?strRelationType=pay" class="deposit_product f_blue1">0<span> 건</span></a> <span class="SpGroup arr_icon arr1"></span>
            <div class="step_title product_title">STEP 2
                <br/>판매중인 물품</div> <a href="/myroom/sell/sell_ing.html?strRelationType=ing" class="sell_product f_blue1">0<span> 건</span></a> <span class="SpGroup arr_icon arr2"></span>
            <div class="step_title complete_title">STEP 3
                <br/>판매 종료물품</div> <a href="/myroom/complete/sell.html" class="detail_btn">자세히보기<span class="SpGroup arr_right"></span></a> </div>
        <!-- ▲ 판매관련 //-->
        <!-- ▼ 메뉴탭 //-->
        <div class="g_tab">
            <div><a href="/myroom/sell/sell_regist.html?strRelationType=regist">판매등록물품</a></div>
            <div><a href="/myroom/sell/sell_check.html?strRelationType=check">흥정 신청된 물품</a></div>
            <div><a href="/myroom/sell/sell_pay_wait.html?strRelationType=pay">입금 대기 물품</a></div>
            <div class="selected"><a href="/myroom/sell/sell_ing.html?strRelationType=ing">판매중인 물품</a></div>
            <!--    <a href="/myroom/complete/sell.html"><div class="last">판매 종료 물품</div></a>--></div>
        <!-- ▲ 메뉴탭 //-->
        <div class="tab_sib">- 구매자가 입금을 완료한 상태입니다. 구매자와 전화통화 또는 1:1대화함으로 거래를 진행해주시기 바랍니다.</div>
        <!--	<div id="attention" class="g_balloons3"></div>-->
        <!--	<div class="att_btn"><img src="-->
        <!--/images/btn/btn_attention.gif" width="129" height="20" alt="거래시 주의사항 보기" id="att_btn" class="g_button" onclick="if($('#attention').css('display') != 'none') $('#attention').hide(); else make_msgBox('attention', 'attention_info', 'top', -9, 15, 'blue', 27, 10, 'close');"></div>-->
        <!-- ▼ 판매중인물품 //-->
        <table class="g_blue_table tb_list">
            <colgroup>
                <col width="150">
                <col width="70">
                <col />
                <col width="95">
                <col width="80">
                <col width="100">
            </colgroup>
            <tr>
                <th>카테고리</th>
                <th>분류</th>
                <th>제목</th>
                <th>거래금액</th>
                <th>등록일</th>
                <th>구분</th>
            </tr>
            <tr>
                <td colspan="6">등록된 물품이 없습니다.</td>
            </tr>
        </table>
        <!-- ▲ 판매중인물품 //-->
        <div class="g_finish"></div>
        <!-- ▼ 판매진행안내 //-->
        <div class="trade_progress">
            <div class="g_subtitle">판매진행 안내</div>
            <div class="trade_progress_content">
                <div class="guide_wrap">
                    <div class="guide_set"> <span class="SpGroup sell_regist_icon"></span> <span class="state">판매물품 등록</span>
                        <p>팝니다에
                            <br/>판매물품이 등록된
                            <br/>상태입니다.</p>
                    </div>
                    <div class="guide_set"> <span class="SpGroup pay_wait_icon"></span> <span class="state">입금대기</span>
                        <p>구매신청 후 입금 확인 단계,
                            <br/>입금 확인 즉시 판매자에게
                            <br/>SMS를 발송합니다.</p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup sell_ing_icon"></span> <span class="state">판매중</span>
                        <p>구매자의 정보를 확인 가능,
                            <br/>게임상에서 거래의
                            <br/>진행이 가능합니다.</p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup trade_icon"></span> <span class="state">인계</span>
                        <p>구매자에게 물품을
                            <br/>건네주었다면
                            <br/>인계확인을 완료합니다.</p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup sell_complete_icon"></span> <span class="state">판매종료</span>
                        <p>구매자가 인수확인을
                            <br/>완료하면, 거래는
                            <br/>즉시 종료됩니다.</p> <i class="SpGroup arr_mini"></i> </div>
                </div>
            </div>
        </div>
        <!-- ▲ 판매진행안내 //-->
    </div>
    <ul id="attention_info" class="g_black5_11 g_hidden">
        <li class="g_blue1_11b">아이템매니아가 알려드리는 꼭 지켜야할 안전수칙 !!</li>
        <li>1. 구매자의 <span class="g_org1_11b">연락처를 꼭 확인</span>합니다.
            <br>&nbsp;&nbsp;&nbsp;다른 연락처로 전화가 올 경우 거래취소 또는 고객감동센터로 문의합니다.</li>
        <li>2. 판매자 <span class="g_org1_11b">캐릭터명에 입력했던 캐릭터</span>로 거래 합니다.</li>
        <li>3. 거래 시에는 게임상에서 <span class="g_org1_11b">채팅이나 귓말은 삼가하고 가능한 전화통화를 유지</span>하며 거래합니다.</li>
        <li>4. 반드시 물품을 <span class="g_org1_11b">정상적으로 건네주고 물품 인계확인</span>을 합니다.</li>
    </ul>
    <!-- ▼ 안심번호 서비스란? //-->
    <div id="safety_numinfo" class="g_hidden">
        <div class="g_blue1_b">안심번호 서비스란?</div> 고객님의 개인정보 보호를 위해 휴대폰번호에 안심번호를 부여하여 실제 휴대폰번호 대신
        <br> 가상의 안심번호를 상대 거래자에게 노출시켜주는 무료 서비스
        <ul class="margin10 g_red1_11"> <span class="bold_txt">안심번호 서비스 사용 시 주의사항</span>
            <br> 1) 부여받은 안심번호로도 문자 수신이 가능합니다.(발신시에는 부여받은 안심번호 사용)
            <br> 2) 상대거래자가 안심번호 서비스를 사용하지 않는 상태에서 발싱한 경우 실제 번호가 표시됩니다.
            <br> 3) 부여 받은 안심번호는 거래가 종료되는 시점에 자동 회수되며, 회수된 이후에는 연락이 불가능합니다.
            <br> 4) 안심번호 사용 후 48시간을 초과하거나 거래종료 후 문제발생 시 실제 전화번호가 노출됩니다. </ul>
        <div style="margin-top:10px;text-align:center">
            <a href="/guide/add/security_number.html"><img src="http://img4.itemmania.com/images/btn/btn_safe_numer.gif" width="166" height="25" alt="안심번호서비스 자세히보기"></a>
        </div>
    </div>
    <!-- ▲ 안심번호 서비스란? //-->
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
