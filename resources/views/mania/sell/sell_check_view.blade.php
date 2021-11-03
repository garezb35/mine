@php
$category = '> > 기타';
    if(!empty($game['game'])){
        $category = $game['game']." > ";
    }
    if(!empty($server['game'])){
        $category .= $server['game']." > ";
    }
    if(!empty($good_type)){
        $category .= $good_type;
    }
@endphp
@extends('layouts-mania.app')

@section('head_attach')

    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/common_view.css">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js"></script>
    <script type="text/javascript" src="/mania/sell/js/sell_check_view.js"></script>

@endsection

@section('content')
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
                <ul class="nav_sub g_list">
                    <li class=""><a href="http://trade.itemmania.com/myroom/mileage/my_mileage/">내마일리지</a></li>
                    <li class=""><a href="http://trade.itemmania.com/myroom/mileage/guide/charge.html">마일리지충전</a></li>
                    <li class=""><a href="http://trade.itemmania.com/myroom/mileage/payment/payment_switch.html">마일리지출금</a></li>
                    <li class=""><a href="http://trade.itemmania.com/myroom/mileage/change/culturecash/">마일리지전환</a></li>
                </ul>
                <div class="nav_title "><a href="http://trade.itemmania.com/myroom/myinfo/myinfo_check.html">개인정보</a></div>
                <ul class="nav_sub g_list">
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
        <form id="frmCheckView" method="post">
            <input type="hidden" name="id">
            <input type="hidden" name="process">
        </form>
        <form id="creditForm" name="creditForm" method="post">
            <input type="hidden" name="id" id="encryptId">
            <input type="hidden" name="type" id="encryptType">
        </form>
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue">
                흥정신청된 <span>물품</span>
                <ul class="g_path">
                    <li>홈</li>
                    <li>마이룸</li>
                    <li>판매관련</li>
                    <li class="select">흥정신청된 물품</li>
                </ul>
            </div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 물품정보 //-->
            <div class="g_subtitle first">물품정보</div>
            <table class="g_blue_table" id="">
                <colgroup>
                    <col width="130">
                    <col width="250">
                    <col width="130">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th>카테고리</th>
                    <td colspan="3">{{$category}}</td>
                </tr>
                <tr>
                    <th>물품제목</th>
                    <td colspan="3">{{$user_title}}</td>
                </tr>
                <tr>
                    <th>거래번호</th>
                    <td>#{{$orderNo}}</td>
                    <th>등록일시</th>
                    <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                </tr>
                <tr>
                    <th>거래유형</th>
                    <td colspan="3">흥정</td>
                </tr>
                <tr>
                    @php
                        $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                    @endphp
                    @if($c != 1)
                        <th>판매수량</th>
                        <td ><span class="trade_money1">{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''}}</span> {{$good_type}}</td>
                    @endif
                    <th>즉시 판매금액</th>
                    <td @if($c == 1)colspan="3" @endif>{{number_format($user_price)}} 원<br>({{$user_price_limit}} 원 미만의 물품 자동거부 사용)</td>
                </tr>
                <tr>
                    <th>판매자 캐릭터명</th>
                    <td colspan="3">{{$user_character}}</td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 물품정보 //-->
            <!-- ▼ 내 개인정보 //-->
            <div class="g_subtitle">내 거래정보</div>
            <table class="g_blue_table">
                <colgroup>
                    <col width="160">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th>이름</th>
                    <td>{{$seller['name']}}</td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td>{{$seller['home']}} / {{$seller['number']}} <span class="f_blue3 f_bold">(SMS수신)</span></td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 내 개인정보 //-->
            <!-- ▼ 거래진행상황 //-->
            <!-- ▼ 판매진행안내 //-->
            <div class="trade_progress">
                <div class="g_subtitle">
                    거래 진행 상황
                </div>
                <div class="trade_progress_content">
                    <div class="guide_wrap">
                        <div class="guide_set guide_set2 @if($mode == 0 || $mode == 2) active @endif">
                            <span class="SpGroup check_apply"></span>
                            <span class="state">흥정신청</span>
                            <p>거래 정보 확인 후<br>흥정거래를<br>진행해주세요.</p>
                        </div>
                        <div class="guide_set guide_set2 @if($mode == 1) active @endif">
                            <span class="SpGroup check_re_apply"></span>
                            <span class="state">재흥정신청</span>
                            <p>흥정신청자(구매자)의<br>재흥정 수락을<br>기다리고 있습니다.</p>
                            <i class="SpGroup arr_mini"></i>
                        </div>
                        <div class="guide_set guide_set2 @if($mode == 3) active @endif">
                            <span class="SpGroup check_ok"></span>
                            <span class="state">흥정수락</span>
                            <p>구매자의 입금을 기다리고<br>있습니다. (최대1시간)<br>미 입금시, 해당 거래자와<br>재흥정이 불가합니다.</p>
                            <i class="SpGroup arr_mini"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ▲ 판매진행안내 //-->        <!-- ▲ 거래진행상황 //-->
            <!-- ▼ 흥정거래 정보 //-->
            <div class="g_subtitle">흥정거래 정보</div>
            <table class="g_blue_table tb_list">
                <colgroup>
                    <col width="130">
                    <col width="130">
                    <col width="150">
                    <col width="200">
                </colgroup>
                <tbody>
                <tr>
                    <th>흥정일시</th>
                    <th>흥정제시금액</th>
                    <th>구매자신용도</th>
                    <th>합의여부</th>
                </tr>
                @foreach($bargains as $value)
                    <tr>
                        <td>{{date("Y-m-d H:i:s",strtotime($value['created_at']))}}</td>
                        <td>{{number_format($value['price'])}}원</td>
                        <td>골드회원
                            <img src="http://img4.itemmania.com/images/btn/btn_detail2.gif" width="40" height="17" alt="자세히" class="g_button" onclick="fnCreditViewCheck('a68e5ed758fe86e630c7f30c1dbb221b')">
                        </td>
                        <td>
                            @if($value['status'] == 1)
                            {{number_format($value['price1'])}}원(재흥정 제시)
                            @endif
                            @if($value['status'] == 2)
                                {{number_format($value['price1'])}}흥정거절
                            @endif
                            @if($value['status'] == 3)
                                유저재흥정거절
                            @endif
                            @if($value['status'] == 4)
                                흥정취소
                            @endif
                            @if($value['status'] == 10)
                                수락
                            @endif
                            @if($value['status'] == 0)
                                    <img src="http://img2.itemmania.com/images/btn/btn_bargain_ok.gif" width="53" height="17" alt="흥정수락" class="g_button" onclick="if(confirm('흥정신청을 수락하시겠습니까?')) TradeCheck('1', '{{$value['id']}}');">
                                    <img src="http://img3.itemmania.com/images/btn/btn_bargain_den.gif" width="53" height="17" alt="흥정거부" class="g_button" onclick="if(confirm('흥정신청을 거절하시겠습니까?')) TradeCheck('0', '{{$value['id']}}');">
                                    <img src="http://img4.itemmania.com/images/btn/btn_barg_again.gif" width="41" height="17" alt="재흥정" class="g_button" onclick="popLayer('dvPopup',{id:'{{$value['id']}}', ba_money:{{$value['price']}}});">
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- ▲ 흥정거래 정보 //-->
        </div>
        <!-- ▼ 재흥정 레이어 //-->
        <div id="dvPopup" class="g_popup">
            <div class="layer_title">
                재흥정
                <a href="javascript:g_nodeSleep.disable();" class="btn_close">닫기</a>
            </div>
            <form id="frmReBa" name="frmReBa" method="post">
                @csrf
                <input type="hidden" name="process" value="">
                <div class="layer_content">
                    <table class="g_blue_table table_category">
                        <colgroup>
                            <col width="160">
                            <col width="210">
                            <col width="250">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th>재흥정</th>
                            <td><input type="text" name="re_ba_money" maxlength="10" class="g_text"> 원</td>
                            <td>- 금액을 정확히 적어주세요.<br>- 흥정금액보다 높은 가격만 제시 가능</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="tb_bt_txt f_blue3">
                        - 구매자에게 재흥정 금액을 제시합니다. 구매자가 재흥정을 수락 할 경우 거래는 입금 대기중이 됩니다.
                    </div>
                    <div class="g_btn">
                        <img src="http://img2.itemmania.com/new_images/btn/pop_btn_ok.gif" width="63" height="35" alt="확인" onclick="TradeReCheck('{{$orderNo}}');">
                        <img src="http://img3.itemmania.com/new_images/btn/pop_btn_cancel.gif" width="63" height="35" alt="취소" onclick="g_nodeSleep.disable();">
                    </div>
                </div>
            </form>
        </div>
        <!-- ▲ 재흥정 레이어 //-->
        <div class="g_finish"></div>
    </div>
@endsection
