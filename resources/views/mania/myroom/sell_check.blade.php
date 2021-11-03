@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
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
                <li class="select">흥정 신청된 물품</li>
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
            <div class='selected'><a href="/myroom/sell/sell_check.html?strRelationType=check">흥정 신청된 물품</a></div>
            <div><a href="/myroom/sell/sell_pay_wait.html?strRelationType=pay">입금 대기 물품</a></div>
            <div class=""><a href="/myroom/sell/sell_ing.html?strRelationType=ing">판매중인 물품</a></div>
            <!--    <a href="/myroom/complete/sell.html"><div class="last">판매 종료 물품</div></a>--></div>
        <!-- ▲ 메뉴탭 //-->
        <div class="tab_sib">- 구매자가 흥정을 신청한 상태 또는 판매자가 재흥정한 상태의 물품입니다.</div>
        <!-- ▼ 흥정신청된 물품 //-->
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
        <!-- ▲ 흥정신청된 물품 //-->
        <!-- ▼ 흥정거래 알아두기 //-->
        <dl class="notice_box"> <dt>흥정거래 알아두기</dt>
            <dd> <img src="http://img4.itemmania.com/images/icon/icon_barg_ing.gif" width="62" height="14" alt="흥정신청중"> 구매자가 흥정거래를 요청한 상태로 1시간 이내에 수락하시면 거래가 진행됩니다. 1시간 이내 수락하지 않은 경우 거래는 취소됩니다. </dd>
            <dd> <img src="http://img2.itemmania.com/images/icon/icon_barg_again1.gif" width="39" height="14" alt="재흥정"> 판매자가 구매자에게 재흥정 가격을 제시한 상태로 30분 이내에 재흥정에 대한 구매자의 수락이 없거나 거부할 경우 거래가 취소됩니다. </dd>
        </dl>
        <!-- ▲ 흥정거래 알아두기 //-->
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
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
