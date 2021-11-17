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
$use_mileage = 0;
$add_price = 0;
if($buyer['mileage'] >= $payitem['price'])
    $use_mileage = $payitem['price'];
else
    {
        $use_mileage = $buyer['mileage'];
        $add_price = $payitem['price'] - $buyer['mileage'];
    }
@endphp
@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/css/common_myroom.css" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/buy_pay_wait_view.css" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/common_list.css" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/myroom/buy/js/buy_pay_wait_sell.js"></script>
    <script>
        $('#js-gallery')
            .packery({
                itemSelector: '.slide',
                gutter: 10
            })
            .photoSwipe('.slide', {bgOpacity: 0.8, shareEl: false}, {
                close: function () {
                    console.log('closed');
                }
            });
    </script>
@endsection

@section('content')
    <div class="g_container" id="g_CONTENT">
        @include('aside.myroom',['group'=>'buy'])
        <input type="hidden" id="screenshot_info" value="TiUzQg==">
        <div class="g_content">
            <a name="top"></a>
            <!-- ▼ 타이틀 //-->
            <div class="g_title_green noborder">
                입금해야 할
                <span>물품</span>
            </div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 물품정보 //-->
            <div class="g_subtitle first">물품정보</div>
            <table class="table-striped table-green1">
                <colgroup>
                    <col width="160">
                    <col width="250">
                    <col width="160">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th>카테고리</th>
                    <td colspan="3">{{$category}}</td>
                </tr>
                <tr>
                    <th>물품제목</th>
                    <td colspan="3">
                        {{$user_title}}
                    </td>
                </tr>
                <tr>
                    <th>거래번호</th>
                    <td>#{{$orderNo}}</td>
                    <th>등록일시</th>
                    <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                </tr>
                <tr>
                    @php
                        $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                    @endphp
                    @if($c != 1)
                        <th>구매수량</th>
                        <td ><span class="trade_money1">{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''}}</span> {{$good_type}}</td>
                    @endif
                </tr>
                <tr>
                    <th>구매금액</th>
                    <td>{{number_format($payitem['price'])}} 원 </td>
                    <th>단위금액</th>
                    <td>-</td>
                </tr>
                <tr>
                    <th>구매자 캐릭터명</th>
                    <td colspan="3">{{$buyer['character']}}</td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 물품정보 //-->
            <!-- ▼ 판매자정보 //-->
            <div class="g_subtitle">판매자 정보</div>
            <table class="table-greenwith">
                <colgroup>
                    <col width="310px" />
                    <col width="*" />
                </colgroup>
                <tr>
                    <th class="p-left-10">
                        <div>
                            <img src="/mania/img/level/{{$seller['roles']['icon']}}" width="37"/>
                            <span class="f_green4 f_bold">{{$seller['roles']['alias']}}회원</span>&nbsp;&nbsp;&nbsp; (거래점수 : {{number_format($seller['point'])}}점)
                        </div>
                    </th>
                    <td>
                        <dl class="add_info">
                            <dd>
                                <span class="w80 cert_state">인증상태</span>
                                <span class="con w80 btn_state">
                                        @if($seller['mobile_verified'] == 1)
                                        <img src="/mania/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/mania/img/icons/icon_nocheck.png" width="14">
                                    @endif휴대폰</span>
                                <span class="on w80 btn_state">
                                        @if($seller['bank_verified'] == 1)
                                        <img src="/mania/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/mania/img/icons/icon_nocheck.png" width="14">
                                    @endif계좌</span>
                                <span class="on w80 btn_state">
                                        @if($seller['pin'] == 1)
                                        <img src="/mania/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/mania/img/icons/icon_nocheck.png" width="14">
                                    @endif아이핀</span>
                                <span class="w80 btn_state">
                                        @if(!empty($seller['email_verified_at']))
                                        <img src="/mania/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/mania/img/icons/icon_nocheck.png" width="14">
                                    @endif이메일</span>
                                </dd>
                            </dl>
                        <div class="g_right">
                            <a href="javascript:fnCreditViewCheck()"></a>
                        </div>
                    </td>
                </tr>
            </table>
            <!-- ▲ 판매자정보 //-->
            <!-- ▼ 내 개인정보 //-->
            <div class="g_subtitle">내 거래정보</div>
            <table class="table-striped table-green1">
                <colgroup>
                    <col width="160">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th>이름</th>
                    <td>{{$buyer['name']}}</td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td>{{$buyer['home']}} / {{$buyer['number']}}</td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 내 개인정보 //-->
            <form id="frmPayment" name="frmPayment" action="buy_pay_wait_ok" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$orderNo}}">
                <input type="hidden" name="nCouponMoney" value="0">
                <input type="hidden" name="t_type" value="{{$type}}">
                <input type="hidden" name="p_type" value="m">
                <input type="hidden" name="bankCode" value="">
                <input type="hidden" name="code" id="code">
                <!-- 마일리지 결제 인증 변수 -->
                <input type="hidden" id="security_type" name="security_type" value="INCS">
                <input type="hidden" id="certify_pay" name="certify_pay" value="YTo0OntzOjEwOiJjZXJ0aWZ5X2xjIjtzOjM6InBheSI7czo5OiJmb3JtX25hbWUiO3M6MTA6ImZybVBheW1lbnQiO3M6MTE6InN1Ym1pdF90eXBlIjtzOjE6IjEiO3M6MTA6InN1Ym1pdF91cmwiO3M6MzE6Ii9teXJvb20vYnV5L2J1eV9wYXlfd2FpdF9vay5waHAiO30=">
                <input type="hidden" name="price" value="">
                <input type="hidden" name="mileage" value="0">
                <input type="hidden" name="my_mileage" value="{{$buyer['mileage']}}">
                <input type="hidden" id="other_pay" name="use_creditcard" value="{{number_format($buyer['mileage'])}}">
                <input type="hidden" name="use_creditcard_original" value="{{$buyer['mileage']}}">
                <div class="g_subtitle">결제정보</div>
                <div>
                    <div class="card text-white bg-success mb-3 fl" style="max-width: 18rem;">
                        <div class="card-header">
                            구매금액
                            <span class="h_price fr">{{number_format($payitem['price'])}}원</span>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                    <div class="card text-white bg-success mb-3 fr" style="max-width: 18rem;">
                        <div class="card-header">
                            총 결제금액
                            <span class="h_price fr text-red">{{number_format($payitem['price'])}}원</span>
                        </div>
                        <div class="card-body">
                            <div style="clear: both;margin-bottom: 10px;height: 20px">
                                <span class="fl">내 마일리지</span>
                                <span class="fr">{{number_format($buyer['mileage'])}}원</span>
                            </div>
                            <div style="clear: both;height: 20px;margin-bottom: 10px">
                                <span class="fl">게임 마일리지</span>
                                <span class="fr">{{number_format(0)}}원</span>
                            </div>
                            <div style="clear: both;height: 20px">
                                <span class="fl">사용할 마일리지</span>
                                <span class="fr"><input style="width: 100px" type="text" class="g_text" id="use_mileage" name="use_mileage" value="{{number_format($payitem['price'])}}" readonly disabled>원</span>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="160">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <th>결제방식</th>
                        <td>
                            마일리지
                        </td>
                    </tr>
                    <tr>
                        <th>마일리지</th>
                        <td>
                            @if($buyer['mileage'] < $payitem['price'])
                                <span class="g_left f_bold">* 현재 결제할 마일리지가 부족합니다.</span>
                                <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/index', 701, 900);" class="g_right btn btn-outline-secondary btn-sm" style="margin-right: 10px">마일리지 충전 &gt;</a>
                            @else
                                <span class="g_left f_bold">* 현재 결제할 마일리지가 충분합니다.</span>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="160">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <th>상세설명</th>
                        <td style="max-height: 150px;overflow-y: scroll">
                            <div id="js-gallery" class="mb-5">
                                @foreach (\File::glob(public_path('assets/images/mania/'.$id).'/*') as $file)
                                    <a href="/{{ str_replace(public_path()."\\", '', $file) }}" class="slide">
                                        <img src="/{{ str_replace(public_path()."\\", '', $file) }}" class="g_top">
                                    </a>
                                @endforeach
                            </div>
                            {{$user_text}}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <ul class="add_charge" id="add_charge">
                    <li>
                        <span class="bold_txt">추가 결제해야할 금액</span>
                    </li>
                    <li id="add_pay" class="price_font2">{{number_format($add_price)}}</li>
                    <li>
                        <span class="bold_txt">원</span> (<span class="pay_text">마일리지</span> 방식으로 해당 추가금액을 결제합니다.)
                    </li>
                </ul>
                <div class="g_finish"></div>
                <div class="g_btn_wrap">
                    <a href="javascript:void(0)"  onclick="Payment();" class="btn-default btn-suc">입금확인요청</a>
                    <a href="javascript:void(0)"  onclick="PaymentCancel();" id="cancel_btn"  class="btn-default btn-cancel">구매취소</a>
                </div>
            </form>
        </div>
        <form id="creditForm" name="creditForm" method="post">
            <input type="hidden" id="infoId" value="a68e5ed758fe86e630c7f30c1dbb221b">
            <input type="hidden" name="id" id="encryptId">
            <input type="hidden" name="type" id="encryptType">
        </form>
        <!-- ▼ 확인 팝업 //-->
        <div id="dvGoodsInfo" class="g_popup green">
            <div class="layer_title">
                <div class="title">물품신청정보</div>
                <img class="btn_close" src="http://img4.itemmania.com/images/icon/popup_x.gif" width="15" height="15" alt="닫기" onclick="g_nodeSleep.disable();">
            </div>
            <div class="layer_content">
                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="130">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <th>카테고리</th>
                        <td>{{$category}}</td>
                    </tr>
                    <tr>
                        <th>물품제목</th>
                        <td>{{$user_title}}</td>
                    </tr>
                    @php
                        $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                    @endphp
                    @if($c != 1)
                    <tr>
                        <th>구매수량</th>
                        <td ><span class="trade_money1">{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''}}</span> {{$good_type}}</td>
                     </tr>
                    @endif
                    <tr>
                        <th>구매금액</th>
                        <td>{{number_format($payitem['price'])}} 원 </td>
                    </tr>
                    <tr>
                        <th>구매자 캐릭터명</th>
                        <td class="f_blue1">{{$buyer['character']}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="position-relative height90">
                    <div class="position-absolute border-one-gray w100"></div>
                    <div class="attention position-absolute">거래 사고 주의사항</div>
                </div>
                <ul class="attention_box">
                    <li>1. 다양한 이유로 전달받은 물품을
                        다시 돌려 달라는 사기에 주의하세요.<br> &nbsp;&nbsp;&nbsp;ex) “건네준 아이템이 해킹신고 위험이 있다. 다시 안전한 아이템으로 교환해주겠다” 등
                    </li>
                    <li>2. 구매하려는 물품정보가 본인의 정보가 맞는지 확인해 주세요. (게임/서버/캐릭터명 등)<br> &nbsp;&nbsp;&nbsp;상대방이 유도하는 게임/서버에 또는 캐릭터명으로 거래를 신청 할 경우
                        3자 사기에 의한 피해를 볼 수 있습니다.
                    </li>
                    <li class="g_blue1_b">다른 사람의 정보를 기재하거나, 다른 게임/서버에 구매 신청을 할 경우<br>
                        물품 신청자에게 불이익이 발생할 수 있습니다.
                    </li>
                </ul>

                <div class="g_btn">
                    <a  onclick="fnSubmit()" class="btn-default btn-suc">확인</a>
                    <a  onclick="g_nodeSleep.disable();" class="btn-default btn-cancel">취소</a>
                </div>
            </div>
        </div>
        <!-- ▲ 확인 팝업 //-->
        <!-- ▼ 팝업 레이어 //-->
        <div id="dvPopup" class="g_popup"></div>
        <!-- ▲ 팝업 레이어 //-->

        <div class="g_finish"></div>
    </div>
@endsection
