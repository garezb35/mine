@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/complete/css/report.css?190220">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/myroom/complete/js/_search.js?190220"></script>
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
            <div class="nav_title "><a href="http://trade.itemmania.com/myroom/goods_alarm/alarm_sell_list.html">물품등록 알리미<span class="new">N</span></a></div>
            <div class="nav_title on_active"><a href="http://trade.itemmania.com/myroom/complete/sell.html">종료내역</a></div>
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
        <div class="g_title_blue"> 종료 <span>내역</span>
            <ul class="g_path">
                <li>홈</li>
                <li>마이룸</li>
                <li>종료 내역</li>
                <li class="select">전체 이용 내역</li>
            </ul>
        </div>
        <!-- ▲ 타이틀 //-->
        <!-- ▼ 메뉴탭 //-->
        <div class="g_tab">
            <div><a href="/myroom/complete/sell.html">판매종료내역</a></div>
            <div><a href="/myroom/complete/buy.html">구매종료내역</a></div>
            <div class='selected'><a href="/myroom/complete/report.html">전체이용내역</a></div>
        </div>
        <!-- ▲ 메뉴탭 //-->
        <!-- ▼ 검색 //-->
        <form method="GET">
            <div class="tab_sib g_left">- 조회기간은 거래종료기준 전년 5년까지 조회 가능합니다.</div>
            <div class="g_right">
                <select name="selectYear" class="g_hidden">
                    <option value="2021" selected>2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                </select>
                <input type="image" src="http://img3.itemmania.com/images/btn/btn_find1.gif" width="50" height="20" alt="검색" class="g_image"> </div>
        </form>
        <!-- ▲ 검색 //-->
        <div class="g_finish"></div>
        <table class="g_blue_table tb_list">
            <colgroup>
                <col width="64">
                <col width="106">
                <col width="106">
                <col width="106">
                <col width="106">
                <col width="106">
                <col width="165">
            </colgroup>
            <tr>
                <th>월</th>
                <th>판매건수</th>
                <th>판매금액</th>
                <th>수수료</th>
                <th>구매건수</th>
                <th>구매금액</th>
                <th>부가서비스이용료</th>
            </tr>
            <tr>
                <td>1월</td>
                <td>23</td>
                <td>3,886,420</td>
                <td>195,040</td>
                <td>0</td>
                <td>0</td>
                <td>3,400</td>
            </tr>
            <tr>
                <td>2월</td>
                <td>138</td>
                <td>20,105,540</td>
                <td>1,006,730</td>
                <td>1</td>
                <td>15,540</td>
                <td>38,100</td>
            </tr>
            <tr>
                <td>3월</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>4월</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>6</td>
                <td>473,780</td>
                <td>0</td>
            </tr>
            <tr>
                <td>5월</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>6월</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr class="f_blue3 f_bold">
                <td>상반기</td>
                <td>161</td>
                <td>23,991,960</td>
                <td>1,201,770</td>
                <td>7</td>
                <td>489,320</td>
                <td>41,500</td>
            </tr>
            <tr>
                <td>7월</td>
                <td>2</td>
                <td>6,000</td>
                <td>2,000</td>
                <td>0</td>
                <td>0</td>
                <td>100</td>
            </tr>
            <tr>
                <td>8월</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>9월</td>
                <td>3</td>
                <td>664,200</td>
                <td>33,200</td>
                <td>1</td>
                <td>3,000</td>
                <td>0</td>
            </tr>
            <tr>
                <td>10월</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>11월</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>12월</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr class="f_blue3 f_bold">
                <td>하반기</td>
                <td>5</td>
                <td>670,200</td>
                <td>35,200</td>
                <td>1</td>
                <td>3,000</td>
                <td>100</td>
            </tr>
            <tr class="f_bold">
                <td>총합계</td>
                <td>166</td>
                <td>24,662,160</td>
                <td>1,236,970</td>
                <td>8</td>
                <td>492,320</td>
                <td>41,600</td>
            </tr>
        </table>
        <!-- ▼ 기능 //-->
        <ul id="print_btn" class="g_sideway">
            <li>
                <a href="javascript:_window.open('trade_report', 'report_print.html?Year=2021&selectbangi=all', 800, 800);"><img src="http://img4.itemmania.com/images/btn/btn_history_print.gif" width="131" height="20" alt="이용내역 확인서 출력"></a>
            </li>
            <li class="excel">
                <a href="report_excel.html?Year=2021&selectbangi=all"><img src="http://img2.itemmania.com/images/btn/btn_excel_save.gif" width="93" height="20" alt="엑셀로 받기"></a>
            </li>
        </ul>
        <!-- ▲ 기능 //-->
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
