@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/common_view.css?210114" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21100816"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/myroom/buy/js/buy_regist.js?v=190426"></script>
    <script type="text/javascript" src="/mania/myroom/buy/js/buy_regist_view.js?v=210512"></script>
    <script type="text/javascript">
        function __init() {
            e_use.premium=7;
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
        <a name="top"></a>
        <!-- ▼ 타이틀 //-->
        <div class="g_title_green"> 구매 등록 <span>물품</span>
            <ul class="g_path">
                <li>홈</li>
                <li>마이룸</li>
                <li>구매관련</li>
                <li class="select">구매등록물품</li>
            </ul>
        </div>
        <!-- ▲ 타이틀 //-->
        <!-- ▼ 물품정보 //-->
        <div class="g_subtitle first">물품정보</div>
        <table class="g_green_table">
            <colgroup>
                <col width="160">
                <col width="250">
                <col width="160">
                <col/> </colgroup>
            <tr>
                <th>카테고리</th>
                <td colspan="3">AOS레전드 > 기타 > 기타</td>
            </tr>
            <tr>
                <th>물품제목</th>
                <td colspan="3">
                    <!-- 퀵 아이콘 -->기타 삽니다. </td>
            </tr>
            <tr>
                <th>거래번호</th>
                <td>#2021101407759231</td>
                <th class="bd_left">등록일시</th>
                <td>2021-10-14 14:02:09</td>
            </tr>
            <tr>
                <th>거래유형</th>
                <td colspan="3">일반</td>
            </tr>
            <tr>
                <th>구매금액</th>
                <td colspan="3">3,000원</td>
            </tr>
            <tr>
                <th>구매자 캐릭터명</th>
                <td colspan="3">홍길동</td>
            </tr>
            <tr>
                <th>입금가능시간</th>
                <td colspan="3">판매신청 후 <strong>30분 이내</strong> 안에 입금가능</td>
            </tr>
        </table>
        <!-- ▲ 물품정보 //-->
        <!-- ▼ 내 개인정보 //-->
        <div class="g_subtitle">내 거래정보</div>
        <table class="g_green_table">
            <colgroup>
                <col width="160">
                <col/> </colgroup>
            <tr>
                <th>이름</th>
                <td>이장훈</td>
            </tr>
            <tr>
                <th class="bd_left">연락처</th>
                <td>자택번호없음 / 010-4797-3690 <span class='f_green2 f_bold'>(SMS수신)</span></td>
            </tr>
            <tr>
                <th>거래알림</th>
                <td>
                    <input type='checkbox' disabled='disabled' class='g_checkbox' /> 모바일앱 거래관련 push 알림 <a href="javascript:_window.open('push_guide', '/sell/guide/apppush.html', 650, 1000)" class="guide_txt">앱 PUSH알림이란?</a> </td>
            </tr>
        </table>
        <!-- ▲ 내 개인정보 //-->
        <!-- ▼ 거래진행상황 //-->
        <!-- ▼ 판매진행안내 //-->
        <div class="trade_progress buy">
            <div class="g_subtitle"> 거래 진행 상황 </div>
            <div class="trade_progress_content">
                <div class="guide_wrap">
                    <div class="guide_set active"> <span class="SpGroup buy_regist_icon"></span> <span class="state">구매등록</span>
                        <p>구매할 물품을 등록해놓은
                            <br/>[거래대기] 상태입니다.
                            <br/>판매신청이 들어올때까지
                            <br/>기다려주세요.</p>
                    </div>
                    <div class="guide_set"> <span class="SpGroup pay_wait_icon"></span> <span class="state">입금대기</span>
                        <p>구매자가 입금을
                            <br/>준비하고 있습니다.
                            <br/>입금완료 후, 구매중 상태가
                            <br/>되면 거래를 시작해주세요.</p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup buy_ing_icon"></span> <span class="state">구매중</span>
                        <p>현재 판매자와 거래중입니다.
                            <br/>판매자와 반드시 전화통화로
                            <br/>거래하시기 바랍니다.
                            <br/>[통화 불가 시 1:1대화함 사용] </p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup trade_icon"></span> <span class="state">인수완료</span>
                        <p>거래종료 예정입니다.
                            <br/>판매자가 인계확인 할 때까지
                            <br/>기다려주세요.</p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup buy_complete_icon"></span> <span class="state">구매완료</span>
                        <p>거래가 정상적으로
                            <br/>종료되었습니다.
                            <br/>문제 발생 시
                            <br/>고객센터로 문의해주세요.</p> <i class="SpGroup arr_mini"></i> </div>
                </div>
            </div>
        </div>
        <!-- ▲ 판매진행안내 //-->
        <!-- ▲ 거래진행상황 //-->
        <form id="frmList" name="frmList" method="post">
            <input type="hidden" name="trade_id" value="2021101407759231">
            <input type="hidden" id="process" name="process"> </form>
        <div class="g_btn">
            <a href="/myroom/buy/buy_re_reg.html?id=2021101407759231"><img src="http://img3.itemmania.com/new_images/btn/btn_buy_re.gif" width="137" height="46" alt="재등록" class="first"></a>
            <a href="javascript:;" onclick="tradeProcess('hideSelect')"><img src="http://img4.itemmania.com/new_images/btn/btn_hide.gif" width="137" height="46" alt="숨기기" class="first"></a> <img src="http://img4.itemmania.com/new_images/btn/btn_del.gif" width="137" height="46" alt="삭제" class="g_button" onclick="tradeProcess('deleteSelect');"> </div>
        <!-- ▼ 상세설명 //-->
        <div class="g_subtitle">상세설명</div>
        <div class="detail_info">
            <div class="detail_text">기타&#160;삽니다.</div>
        </div>
        <!-- ▲ 상세설명 //-->
        <div class="g_right">
            <a href="/myroom/buy/buy_regist.html?strRelationType=regist"><img src="http://img2.itemmania.com/images/btn/btn_list.gif" width="32" height="14" alt="목록"></a>
            <a href="#top"><img src="http://img3.itemmania.com/images/btn/btn_top.gif" width="32" height="14" alt="TOP"></a>
        </div>
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
