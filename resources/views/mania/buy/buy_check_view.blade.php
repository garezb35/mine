{{--
0:신청
1:재흥정
10:수락
2:판매자흥정취소
3:유저재흥정거절
4:유저흥정취소
--}}
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
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/buy_pay_wait_view.css">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/common_view.css">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js"></script>
    <script type="text/javascript" src="/mania/myroom/buy/js/buy_check_view.js"></script>
@endsection

@section('content')
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
        <input type="hidden" id="screenshot_info" value="TiUzQg==">
        <div class="g_content">
            <a name="top"></a>
            <!-- ▼ 타이틀 //-->
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 물품정보 //-->
            <div class="g_subtitle first">물품정보</div>
            <table class="g_green_table">
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
                    <th>즉시 판매금액</th>
                    <td colspan="3">{{number_format($user_price)}} 원</td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 물품정보 //-->
            <!-- ▼ 판매자정보 //-->
            <div class="g_subtitle">판매자 정보</div>
            <table class="g_green_table">
                <colgroup>
                    <col width="130">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th>판매자 거래정보</th>
                    <td>
                        <span class="credit_mark gold"></span>
                        <span class="f_red1 f_bold">골드회원</span> (거래점수 : 368점)
                        <dl class="add_info">
                            <dt>인증상태</dt>
                            <dd>
                                <span class="cert_state">우수인증</span><span class="cert_state on">휴대폰</span><span class="cert_state">이메일</span><span class="cert_state on">출금계좌</span>
                            </dd>
                        </dl>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="trade_progress_content">
                <!-- ▼ 판매진행안내 //-->
                <div class="trade_progress buy">
                    <div class="g_subtitle">
                        거래 진행 상황
                    </div>
                    <div class="trade_progress_txt">
                        (흥정 대기 중)
                    </div>
                    <div class="trade_progress_content">
                        <div class="guide_wrap">
                            <div class="guide_set guide_set2 @if($bargains[0]['status'] == 0 || $bargains[0]['status'] == 3){{'active'}}@endif">
                                <span class="SpGroup check_apply"></span>
                                <span class="state">흥정신청</span>
                                <p>판매자의 흥정수락을<br>기다리고 있습니다.<br>판매자가 흥정을 거부할 경우,<br>재흥정이 불가합니다.</p>
                            </div>
                            <div class="guide_set guide_set2 @if($bargains[0]['status'] == 1){{'active'}}@endif">
                                <span class="SpGroup check_re_apply"></span>
                                <span class="state">재흥정신청</span>
                                <p>판매자가 재 흥정 신청을 했습니다.<br>30분안에 재흥정에 대한<br>수락여부를 결정해주세요.</p>
                                <i class="SpGroup arr_mini"></i>
                            </div>
                            <div class="guide_set guide_set2 @if($bargains[0]['status'] == 10){{'active'}}@endif">
                                <span class="SpGroup check_ok"></span>
                                <span class="state">흥정수락</span>
                                <p>흥정이 성사되었습니다.<br>입금해야할 물품에서 결제 후<br>거래를 진행해주세요.</p>
                                <i class="SpGroup arr_mini"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ▲ 판매진행안내 //-->
            </div>
            <!-- ▲ 거래진행상황 //-->
            <!-- ▼ 흥정거래 정보 //-->
            <form id="frmCheckView" name="frmCheckView" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$orderNo}}">
                <input type="hidden" name="process">
            </form>
            <div class="g_subtitle">흥정거래 정보</div>
            <table class="g_green_table tb_list">
                <tbody>
                <tr>
                    <th>흥정일시</th>
                    <th>흥정제시금액</th>
                    <th>흥정상태</th>
                    <th class="bd_right_non">흥정합의</th>
                </tr>
                @foreach($bargains as $value)
                <tr>
                    <td>{{date("Y-m-d H:i:s",strtotime($value['created_at']))}}</td>
                    <td>{{number_format($value['price'])}} 원</td>
                    @if($value['status'] == 0)
                    <td>&nbsp;</td>
                    <td class="bd_right_non">
                        <img src="http://img2.itemmania.com/images/btn/btn_bargain_cancel.gif" width="52" height="17" alt="흥정취소" class="g_button" onclick="if(confirm('흥정을 취소하시겠습니까?')) TradeCheck('Y2FuY2Vs', 'OTM3NDQ2NA=='); ">
                    </td>

                    @elseif($value['status'] == 1)
                        <td>재흥정중({{number_format($value['price1'])}}원)</td>
                        <td class="bd_right_non">
                            <img src="http://img3.itemmania.com/images/btn/btn_rebargain_ok.gif" width="63" height="17" alt="재흥정 수락" class="g_button" onclick="if(confirm('재흥정을 수락하시겠습니까?')) TradeCheck('1', '{{$value['id']}}'); " style="margin-bottom:3px"><br>
                            <img src="http://img4.itemmania.com/images/btn/btn_rebargain_den.gif" width="63" height="17" alt="재흥정 거부" class="g_button" onclick="if(confirm('재흥정을 거부하시겠습니까?')) TradeCheck('0', '{{$value['id']}}'); ">
                        </td>

                    @elseif($value['status'] == 3)
                        <td>흥정거절</td>
                        <td class="bd_right_non">

                        </td>
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
            <!-- ▲ 흥정거래 정보 //-->
            <!-- ▼ 상세설명 //-->
            <div class="g_subtitle">상세설명</div>
            <div class="detail_info">
                <div class="detail_text">
                    {{$user_text}}
                </div>
            </div>
            <!-- ▲ 상세설명 //-->
            <div class="g_right">
                <a href="/myroom/buy/buy_check.html?strRelationType=check"><img src="http://img2.itemmania.com/images/btn/btn_list.gif" width="32" height="14" alt="목록"></a>
                <a href="#top"><img src="http://img3.itemmania.com/images/btn/btn_top.gif" width="32" height="14" alt="TOP"></a>
            </div>
        </div>
        <form id="creditForm" name="creditForm" method="post">
            <input type="hidden" id="infoId" value="a68e5ed758fe86e630c7f30c1dbb221b">
            <input type="hidden" name="id" id="encryptId">
            <input type="hidden" name="type" id="encryptType">
        </form>
        <div class="g_finish"></div>
    </div>
@endsection
