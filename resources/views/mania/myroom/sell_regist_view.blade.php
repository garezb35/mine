@php

    $selltype = '일반';
    if(!empty($user_goods_type) && $user_goods_type == 'division'){
        $selltype = '분할';
    }
    if(!empty($user_goods_type) && $user_goods_type == 'bargain'){
        $selltype = '할인';
    }

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
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/css/common_myroom.css?210503" />
    <link type='text/css' rel='stylesheet' href='/mania/myroom/sell/css/common_view.css?v=210114'>
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
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
            <a name="top"></a>
            <!-- ▼ 타이틀 //-->
            <div class="g_title_noborder"> 판매등록 <span>물품</span>
                <ul class="g_path">
                    <li>홈</li>
                    <li>마이룸</li>
                    <li>판매관련</li>
                    <li class="select">판매등록물품</li>
                </ul>
            </div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 물품정보 //-->
            <div class="g_subtitle first">물품정보</div>
            @if($user_goods_type == 'general' || $user_goods_type == 'bargain')
                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="160">
                        <col width="250">
                        <col width="160">
                        <col> </colgroup>
                    <tbody><tr>
                        <th>카테고리</th>
                        <td colspan="3">{{$category}}</td>
                    </tr>
                    <tr>
                        <th>물품제목</th>
                        <td colspan="3">
                            {{$user_title}} </td>
                    </tr>
                    <tr>
                        <th>거래번호</th>
                        <td>#{{$orderNo}}</td>
                        <th>등록일시</th>
                        <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                    </tr>
                    <tr>
                        <th>거래유형</th>
                        <td colspan="3">{{$selltype}}</td>
                    </tr>
                    <tr>
                        @php
                        $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                        @endphp
                        @if($c != 1)
                            <th>판매수량</th>
                            <td ><span class="trade_money1">{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''}}</span> {{$good_type}}</td>
                        @endif
                        <th>판매금액</th>
                        <td @if($c ==1)colspan="3" @endif>{{number_format($user_price)}}원</td>
                    </tr>
                    <tr>
                        <th>판매자 캐릭터명</th>
                        <td colspan="3">{{$user_character}}</td>
                    </tr>
                    </tbody>
                </table>
            @endif
{{--            @if($user_goods_type == 'bargain')--}}
{{--            @endif--}}
            @if($user_goods_type == 'division')
                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="160">
                        <col width="250">
                        <col width="160">
                        <col>
                    </colgroup>
                    <tbody><tr>
                        <th>카테고리</th>
                        <td colspan="3">{{$category}}</td>
                    </tr>
                    <tr>
                        <th>물품제목</th>
                        <td colspan="3">
                            <!-- 퀵 아이콘 -->
                            {{$user_title}}             </td>
                    </tr>

                    <tr>
                        <th>거래번호</th>
                        <td>#{{$orderNo}}</td>
                        <th>등록일시</th>
                        <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                    </tr>
                    <tr>
                        <th>거래유형</th>
                        <td colspan="3">{{$selltype}}</td>
                    </tr>
                    <tr>
                        <th>판매금액</th>
                        <td colspan="3">{{$user_division_unit}} 개 당 {{number_format($user_division_price)}}원</td>
                    </tr>
                    <tr>
                        <th>최소수량</th>
                        <td>{{$user_quantity_min}} 개</td>
                        <th>최대수량</th>
                        <td>{{$user_quantity_max}} 개&nbsp;</td>
                    </tr>
                    <tr>
                        <th>판매자 캐릭터명</th>
                        <td colspan="3">{{$user_character}}</td>
                    </tr>
                    </tbody>
                </table>
                @if($discount_use == 1)
                <div class="g_subtitle">복수 구매 할인</div>
                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="160">
                        <col>
                    </colgroup>
                    <tbody><tr>
                        <th>할인적용</th>
                        <td>{{$discount_quantity * $discount_quantity_cnt}}개 구매 시 마다 {{number_format($discount_price)}}원씩 추가로 할인됨.</td>
                    </tr>
                    </tbody>
                </table>
                @endif
            @endif
            <!-- ▲ 물품정보 //-->
            <!-- ▼ 내 개인정보 //-->
            <div class="g_subtitle">내 거래정보</div>
            <table class="table-striped table-green1">
                <colgroup>
                    <col width="160">
                    <col>
                </colgroup>
                <tr>
                    <th>이름</th>
                    <td>{{$cuser['name']}}</td>
                <tr>
                    <th>연락처</th>
                    <td> @if(empty($cuser["home"])){{'자택번호없음'}}@else{{$cuser['home']}}@endif / {{$cuser['number']}} <span class='f_blue3 f_bold'>(SMS수신)</span> </td>
                </tr>
            </table>
            <div class="g_subtitle gray" style="padding-left: 6px">상세설명</div>
            <div class="detail_info mt-0">
                <div class="detail_text"> {{$user_text}} </div>
            </div>
            <!-- ▲ 내 개인정보 //-->
            <!-- ▼ 거래진행상황 //-->
            <!-- ▼ 판매진행안내 //-->
            <div class="trade_progress">
                <div class="g_subtitle"> 거래 진행 상황 </div>
                <div class="trade_progress_content">
                    <div class="guide_wrap">
                        <div class="guide_set @if($status == 0){{'active'}} @endif"> <span class="SpGroup sell_regist_icon"></span> <span class="state">판매등록</span>
                            <p>판매할 물품을 등록해놓은
                                <br/>[거래대기] 상태입니다.
                                <br/>구매신청이 들어올때까지
                                <br/>기다려주세요.</p>
                        </div>
                        <div class="guide_set @if($status == 1){{'active'}} @endif"> <span class="SpGroup sell_ing_icon"></span> <span class="state">판매중</span>
                            <p>현재 구매자와 거래중입니다.
                                <br/>구매자와 반드시 전화통화로
                                <br/>거래할 캐릭터명을 확인 후
                                <br/>물품을 건네시기 바랍니다. </p> <i class="SpGroup arr_mini"></i>
                        </div>
                        <div class="guide_set @if(str_contains($status,3)){{'active'}} @endif"> <span class="SpGroup trade_icon"></span> <span class="state">인계완료</span>
                            <p>거래종료 예정입니다.
                                <br/>구매자가 인수할때까지
                                <br/>기다려주세요.</p> <i class="SpGroup arr_mini"></i> </div>
                        <div class="guide_set @if(str_contains($status,4)){{'active'}} @endif"> <span class="SpGroup sell_complete_icon"></span> <span class="state">판매완료</span>
                            <p>거래가 정상적으로
                                <br/>종료되었습니다.
                                <br/>문제 발생 시
                                <br/>고객센터로 문의해주세요.</p> <i class="SpGroup arr_mini"></i> </div>
                    </div>
                </div>
            </div>
            <div class="warning">
                <p class="warning_title">
                    물품을 넘겨주기전에 꼭 읽어보세요!
                </p>
                <p>
                    1 구매자의 연락처가 다를경우 거래를 중지하시고 고객센터를 통해 문의해 주시기 바랍니다.<br>
                    2 게임상에서 거래할 캐릭터명이 위의 구매자 캐릭터명과 같은지 확인하시기 바랍니다.<br>
                    3 거래시에는 게임상에서 채팅이나 귓말은 감가하시고 가능하면 전화통화를 유지하시기 바랍니다.<br>
                    4 반드시 물품을 정상적으로 인계하신후 물품인계확인을 하시기 바랍니다.<br>
                    5 거래취소 sns 수신 후 1시간 이내 인계확인 되지 않을 경우 거래가 자동취소 될수 있으니 유희하시기 바랍니다.
                </p>
            </div>
            <!-- ▲ 판매진행안내 //-->
            <!-- ▲ 거래진행상황 //-->
            <form id="frmList" name="frmList" method="post">
                <input type="hidden" name="trade_id" value="2021101311629153">
                <input type="hidden" id="process" name="process"> </form>
            <div class="g_btn_wrap">
                <a href="/myroom/sell/sell_re_reg?id={{$orderNo}}" class="btn-default btn-suc">재등록</a>
                <a href="javascript:;" onclick="tradeProcess('hideSelect')" class="btn-default btn-cancel">숨기기</a>
                <a class="btn-default btn-gray" onclick="tradeProcess('deleteSelect');">삭제</a>
            </div>
            <!-- ▼ 상세설명 //-->


        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.min.js?v=21100816"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/js/sell_regist.js?v=190426"></script>
    <script type='text/javascript' src='/mania/js/sell_regist_view.js?v=201221'></script>
@endsection
