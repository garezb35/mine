@php

    $goods = 'money';
    $goods_label = '게임머니';
    if($good_type != '기타')
        $goods_label = $good_type;
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

    if($good_type == '기타')
        $goods = 'etc';
    if($good_type == '아이템')
        $goods = 'item';
    if($good_type == '캐릭터')
        $goods = 'character';
    $mobile_a = $mobile_b = $mobile_c = '';
    $home_a = $home_b = $home_c = '';
    $home_array = $number_array = array();
    if(!empty($cuser['number'])){
        $number_array = explode('-',$cuser['number']);
        $mobile_a = $number_array[0];
        $mobile_b = $number_array[1];
        $mobile_c = $number_array[2];
    }
    if(!empty($cuser['home'])){
        $home_array = explode('-',$cuser['home']);
        $home_a = $home_array[0];
        $home_b = $home_array[1];
        $home_c = $home_array[2];
    }
@endphp
@extends('layouts-mania.app')
@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/sell/css/application.css?v=201221">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/buy_pay_wait_view.css?v=210427">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.min.js?v=21100816"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type='text/javascript' src='/mania/sell/js/application.js?v=210802'></script>
    <script type='text/javascript'>
        g_trade_info.curr_mileage = Number({{$cuser['mileage']}});
        g_trade_info.sale	= '{{$user_goods_type}}';
        g_trade_info.goods	= '{{$goods}}';
        g_trade_info.id		= '{{$orderNo}}';
        g_trade_info.subject= '{{$user_title}}';
        g_trade_info.trade_kind	= '{{$goods}}';
        @if($user_goods_type == 'general')
            g_trade_info.price	= {{$user_price}};
            g_trade_info.payment_price	= {{$user_price}};
            g_trade_info.trade_money = {{$user_price}};
        @elseif($user_goods_type == 'division')
            g_trade_info.price	= {{$user_division_price}};
            g_trade_info.payment_price	= {{$user_division_price}};
            g_trade_info.trade_money = {{$user_division_price}};
            g_trade_info.div_unit = {{$user_division_unit}};
            g_trade_info.min_unit = {{$user_quantity_min*$user_quantity}};
            g_trade_info.max_unit = {{$user_quantity_max*$user_quantity}};
            g_trade_info.curr_unit = {{$user_quantity_max*$user_quantity}};
            g_trade_info.min_quantity = {{$user_quantity_min/$user_division_unit}};
            g_trade_info.max_quantity = {{$user_quantity_max/$user_division_unit}};
            g_trade_info.quantity = {{$user_quantity_min/$user_division_unit}};

            g_trade_info.discount_use='{{$discount_use == 1 ? 'Y' : 'N'}}';
            g_trade_info.discount_start={{$discount_quantity}};
            g_trade_info.discount_cnt={{$discount_quantity_cnt}};
            g_trade_info.discount_money={{$discount_price}};
        @else

        @endif

    </script>
@endsection

@section('content')
<!--▼▼▼ 캐릭터 등록 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    <div class="aside">
        <div class="title_blue">안전거래수칙</div>
        <div class="menu_know">
            <p>결제전에 이것만은 꼭!!</p>
            <dl class="g_list"> <dt>판매자 연락처,캐릭터명 확인</dt>
                <dd>상대 거래자의 연락처, 캐릭터명을 반드시 확인합니다. 결제가 완료
                    <br>되면 마이룸에서 판매자 정보를
                    <br>확인하실 수 있습니다.</dd> <dt>게임 상에서 채팅은 금물!</dt>
                <dd>게임상에서 채팅은 금물입니다.
                    <br>전화 통화 또는 1:1 대화함으로
                    <br>거래를 하시기 바랍니다.</dd> <dt>받은 물품 되돌려 주지 않기!</dt>
                <dd>판매자가 물품을 인계한 후 다시
                    <br>물품을 돌려달라고 하는 경우,
                    <br>절대 물품을 돌려주지 마시고,
                    <br>고객감동센터로 문의해 주시기
                    <br>바랍니다.</dd> <dt>고의적 취소,직거래유도 주의</dt>
                <dd>고의적인 취소 또는 직거래를
                    <br>유도할 경우 사이트 이용에
                    <br>제한을 받으실 수 있습니다.</dd>
            </dl>
            <div class="f_blue3 f_small"> * 다른사람의 정보를 기재하거나
                <br>다른 게임 서버에 거래신청을 하여
                <br>문제가 발생할 경우, 거래신청자에게
                <br>책임이 있습니다. </div>
        </div>
    </div>
    <div class="g_content">
        <!-- ▼ 타이틀 //-->
        <div class="g_title_noborder"> 구매정보 확인
        </div>
        <!-- ▲ 타이틀 //-->
        <form id="frmSell" name="frmSell" action="/application_ok" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$orderNo}}">
            <input type="hidden" name="cur_mileage" value="{{$cuser['mileage']}}">
            <input type="hidden" name="pay_mileage" value="">
            <input type="hidden" id="security_type" name="security_type" value="ITEM">
            <input type="hidden" name="trade_kind_code" id="trade_kind_code" value="etc">
            <input type="hidden" name="code" id="code">
            <input type="hidden" name="user_without" id="user_without" value="1">
            <input type="hidden" name="game_code" id="game_code" value="{{$game_code}}">
            <!-- ▼ 안심번호서비스 //-->
            <input type="hidden" name="user_cell_auth" id="user_cell_auth" value="1">
            <input type="hidden" name="user_cell_num" id="user_cell_num" value="{{$cuser['number']}}">
            <input type="hidden" name="user_safety_type" id="user_safety_type" value="2">
            <input type="hidden" name="safety_using_flag" id="safety_using_flag" value="true">
            <!-- ▼ 안심번호서비스 //-->
            <!-- 마일리지 결제 인증 변수 -->
            <!-- ▼ 물품정보 //-->
            <div class="g_subtitle">물품정보</div>
            @if($user_goods_type == 'general')
                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="160">
                        <col width="250">
                        <col width="160">
                        <col>
                    </colgroup>
                    <tr>
                        <th>카테고리</th>
                        <td colspan="3">{{$category}}</td>
                    </tr>
                    <tr>
                        <th>물품제목</th>
                        <td colspan="3" class="table_goods_subject"> {{$user_title}}
                        <!-- 퀵 아이콘 -->
                        </td>
                    </tr>
                    <tr>
                        <th>거래번호</th>
                        <td>#{{$orderNo}}</td>
                        <th>등록일시</th>
                        <td>{{date("Y-m-d H:i:s",strtotime($created_at ?? ''))}}</td>
                    </tr>

                    <tr>
                        @php
                        $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                        @endphp
                        @if($c != 1)
                            <th>구매수량</th>
                            <td ><span class="trade_money1">{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''}}</span> {{$good_type}}</td>
                        @endif
                        <th>구매금액</th>
                        <td @if($c == 1)colspan="3" @endif><span class="trade_money1"></span>{{number_format($user_price)}} 원</td>
                    </tr>
                </table>
            @endif
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
                        <td colspan="3" class="table_goods_subject">
                            {{$user_title}}

                        </td>
                    </tr>
                    <tr>
                        <th>거래번호</th>
                        <td>#{{$orderNo}}</td>
                        <th>등록일시</th>
                        <td>{{date("Y-m-d H:i:s",strtotime($created_at ?? ''))}}</td>
                    </tr>
                    <tr>
                        <th>최소구매수량</th>
                        <td>{{number_format($user_quantity_min)}} {{$goods_label}}</td>
                        <th>최대구매수량</th>
                        <td>{{number_format($user_quantity_max)}} {{$goods_label}}</td>
                    </tr>
                    <tr>
                        <th>구매수량</th>
                        <td>
                            <input type="text" id="buy_quantity" name="buy_quantity" class="g_text buy_quantity" value="0"> 번 (<span id="spnQuantity_Unit">{{$user_division_unit}}</span> x
                            <span id="spnQuantity"></span>번 =
                            <span id="spnQuantity_total"></span> {{$goods_label}})
                        </td>
                        <th>단위금액</th>
                        <td>{{$user_division_unit}}당 {{number_format($user_division_price)}}원</td>
                    </tr>
                    <tr>
                        <th>복수구매할인</th>
                        <td>- <span id="discount_money"></span> 원 ({{$discount_quantity_cnt * $discount_quantity}}{{$goods_label}} 당 {{$discount_price}}원 할인)</td>
                        <th>예상결제금액</th>
                        <td><span class="trade_money1">33,750</span> 원</td>
                    </tr>
                    </tbody>
                </table>
            @endif
                <!-- ▲ 물품정보 //-->
            <!-- ▼ 개인정보 //-->
            <style>
                .SafetyNumber_plus {
                    display: none;
                }
            </style>
            <!-- ▼ 연락처 중복 //-->
            <input type="hidden" name="user_contactA" id="user_contactA" value="{{$home_a}}">
            <input type="hidden" name="user_contactB" id="user_contactB" value="{{$home_b}}">
            <input type="hidden" name="user_contactC" id="user_contactC" value="{{$home_c}}">
            <input type="hidden" name="slctMobile_type" id="slctMobile_type" value="3">
            <input type="hidden" name="user_mobileA" id="user_mobileA" value="{{$mobile_a}}">
            <input type="hidden" name="user_mobileB" id="user_mobileB" value="{{$mobile_b}}">
            <input type="hidden" name="user_mobileC" id="user_mobileC" value="{{$mobile_c}}">
            <!-- ▲ 연락처 중복 //-->
            <div class="g_subtitle">내 거래정보</div>
            <table class="table-striped table-green1">
                <colgroup>
                    <col width="160">
                    <col/> </colgroup>
                <tr>
                    <th>이름</th>
                    <td>{{$cuser['name']}}</td>
                </tr>
                <tr>
                    <th>구매자 캐릭터명</th>
                    <td>
                        <div class="g_left">
                            <input type="text" name="user_character" id="user_character" class="g_text" maxlength="30" tabindex="2"> 물품을 전달 받으실 본인의 캐릭터명 </div>
                        <div class="character_noti"> * 본인이 사용하는 서버/캐릭터 명 <em>미 선택 및 미 기재 시</em> 문제가 발생될 수 있으며, 거래신청자에게 책임이 있습니다. </div>
                    </td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td> <span id="spnUserPhone">
                {{$cuser['home']}}  </span> (
                        <label>
                            <input type="checkbox" class="g_checkbox" name="user_cell_check" id="user_cell_check" value="on" checked> 자택번호안내</label> ) / <span id="spnUserCell">{{$cuser['number']}}</span>  </td>
                </tr>
                <tr class="SafetyNumber">
                    <th>안심번호</th>
                    <td> 개인정보보호 및 사고예방을 위해
                        <br> 고객님의 휴대폰으로 거래 시 0508로 시작하는 무료안심번호가 휴대폰으로 부여되어 상대방에게 안내됩니다.
                        <div class="safe_area"> <a href="javascript:;" class="guide_txt" id="safe_guide">안심번호란?</a>
                            <div class="g_msgbox blue" id="safe_layer" style="right:0;margin-top:-14px;">
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
                                <div class="btn"> <a href="/guide/add/security_number.html" class="btn_blue4">안심번호 이용안내 ></a> </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="SafetyNumber_plus">
                    <th>안심번호 플러스</th>
                    <td> 개인정보보호 및 사고예방을 위해
                        <br> 고객님의 휴대폰으로 거래 시 02-1234-1234 형태의 번호가 부과되어 상대방에게 안내됩니다.
                        <div class="safe_area"> <a href="javascript:;" class="guide_txt" id="safe_plus_guide">안심번호 플러스란?</a>
                            <div class="g_msgbox blue" id="safe_plus_layer" style="right:0;margin-top:-14px;">
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
                                <div class="btn"> <a href="/guide/add/security_number_plus.html" class="btn_blue4">이용안내 ></a> </div>
                            </div>
                        </div>
                    </td>
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
            <input type="hidden" name="my_mileage" value="{{$cuser['mileage']}}">
            <input type="hidden" id="other_pay" name="use_creditcard" value="{{number_format($user_price)}}">
            <div class="g_subtitle">결제정보</div>

            <div>
                <div class="card text-white bg-success mb-3 fl" style="max-width: 18rem;">
                    <div class="card-header">
                        구매금액
                        <span class="h_price fr">{{number_format($user_price)}}원</span>
                    </div>
                    <div class="card-body">
                        <div style="clear: both;margin-bottom: 10px;height: 20px">
                            <span class="fl">물품금액</span>
                            <span class="fr">{{number_format($user_price)}}원</span>
                        </div>
                        <div style="clear: both;height: 20px">
                            <span class="fl">구매보상 서비스 금액</span>
                            <span class="fr">{{number_format(0)}}원</span>
                        </div>
                    </div>
                </div>
                <div class="card text-white bg-success mb-3 fr" style="max-width: 18rem;">
                    <div class="card-header">
                        총 결제금액
                        <span class="h_price fr text-red">{{number_format($user_price)}}원</span>
                    </div>
                    <div class="card-body">
                        <div style="clear: both;margin-bottom: 10px;height: 20px">
                            <span class="fl">내 마일리지</span>
                            <span class="fr">{{number_format($cuser['mileage'])}}원</span>
                        </div>
                        <div style="clear: both;height: 20px;margin-bottom: 10px">
                            <span class="fl">게임 마일리지</span>
                            <span class="fr">{{number_format(0)}}원</span>
                        </div>
                        <div style="clear: both;height: 20px">
                            <span class="fl">사용할 마일리지</span>
                            <span class="fr"><input style="width: 100px" type="text" class="g_text" id="use_mileage" name="use_mileage" value="{{number_format($user_price)}}" readonly disabled>원</span>
                        </div>
                    </div>
                </div>
            </div>

{{--            <table class="g_blue_table price_info">--}}
{{--                <colgroup>--}}
{{--                    <col width="286">--}}
{{--                    <col width="246">--}}
{{--                    <col>--}}
{{--                </colgroup>--}}
{{--                <tr>--}}
{{--                    <th> <span>구매금액</span> <span class="price_font" id="trade_money">{{number_format($user_price)}}</span> <span class="won">원</span> </th>--}}
{{--                    <th></th>--}}
{{--                    <th> <span>총 결제금액</span> <span id="pay_mileage" class="price_font f_red1">{{number_format($user_price)}}</span> <span class="won">원</span> </th>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td> </td>--}}
{{--                    <td class="bd_cell">--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <dl class="my_mileage"> <dt>내 마일리지</dt>--}}
{{--                            <dd id="span_cur_mile">{{number_format($cuser['mileage'])}} 원</dd> <dt>사용할 마일리지</dt>--}}
{{--                            <dd>--}}
{{--                                <input type="text" class="g_text" id="use_mileage" name="use_mileage" value="{{number_format($user_price)}}" readonly disabled>원 </dd>--}}
{{--                        </dl>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            </table>--}}
            <table class="table-greenwith payment_table mt-10">
                <colgroup>
                    <col width="160">
                    <col>
                </colgroup>
                <tr>
                    <th>결제방식</th>
                    <td>
                        <label for="rd_mileage">
                            <input type="radio" name="payment_type" class="g_radio" value="mileage" id="rd_mileage" checked>마일리지</label>
                        <div id="sub_samsungpay" class="sub_samsungpay g_hidden">
                            <p> ※ 결제하실 삼성페이 결제방법을 선택해 주세요.!! </p>
                            <label>
                                <input type="radio" name="samsungpay_tmp" class="g_radio" value="s">신용카드</label>
                            <label>
                                <input type="radio" name="samsungpay_tmp" class="g_radio" value="k">휴대폰</label>
                        </div>
                        <div id="sub_creditcard" class="sub_creditcard g_hidden">
                            <p> ※ 결제하실 신용카드를 선택해주세요.!! </p>
                            <label>
                                <input type="radio" name="creditcard_tmp" class="g_radio" value="si">신한</label>
                            <label>
                                <input type="radio" name="creditcard_tmp" class="g_radio" value="bc">BC</label>
                            <label>
                                <input type="radio" name="creditcard_tmp" class="g_radio" value="hd">현대</label>
                            <label>
                                <input type="radio" name="creditcard_tmp" class="g_radio" value="lt">롯데</label>
                            <label>
                                <input type="radio" name="creditcard_tmp" class="g_radio" value="hn">하나</label>
                            <label>
                                <select name="creditcard_tmp">
                                    <option value="" selected>카드사 더보기</option>
                                    <option value="wh">외환</option>
                                    <option value="wr">우리</option>
                                    <option value="nh">농협NH</option>
                                    <option value="ss">삼성</option>
                                    <option value="ct">씨티</option>
                                    <option value="gj">광주</option>
                                    <option value="jb">전북</option>
                                    <option value="jj">제주</option>
                                    <option value="sh">수협</option>
                                    <option value="su">산업</option>
                                    <option value="kb">KB국민</option>
                                </select>
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="pay_text">마일리지</th>
                    <td class="mile_td">
                        <a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/index', 701, 900);" class="btn btn-outline-secondary btn-sm">마일리지 충전 ></a>
                    </td>
                </tr>
            </table>
            <ul class="add_charge g_hidden" id="add_charge">
                <li> <span class="bold_txt">추가 결제해야할 금액</span> </li>
                <li id="add_pay" class="price_font2">3,000</li>
                <li> <span class="bold_txt">원</span> (<span class="pay_text"></span> 방식으로 해당 추가금액을 결제합니다.) </li>
            </ul>
            <div class="g_finish"></div>
            <dl class="box8 notice_box"> <dt class="f_bold f15">
                    &nbsp;&nbsp;&nbsp;<img src="/mania/img/icons/add.png" />
                    판매자로부터 받은 물품을 다시 돌려달라는 사기에 주의 하세요</dt>
                <dd>판매자로부터 물품 받은 후 게임머니(아이템)에 문제가 있으니 다른 것으로 바꿔 주겠다며 물품을 요구하는 경우가 있습니다.</dd>
                <dd>절대 물품을 돌려주지 마시고 판매자 또는 고객센터로 문의 주시기 바랍니다.</dd>
            </dl>
            <div class="g_btn_wrap">
                <a id="buy_btn" onclick="fnApplication(0);" class="btn-default btn-suc">구매신청</a>
                <a href="/sell/view?id={{$orderNo}}" class="btn-default btn-cancel">취소</a>
            </div>
        </form>
    </div>
    <!-- ▼ 확인 팝업 //-->
    <div id="dvGoodsInfo" class="g_layer blue dvGoodsInfo">
        <div class="inner">
            <div class="title"> 물품신청정보
                <a href="javascript:;" class="close_w" data-close="true"></a>
            </div>
            <div class="cont">
                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="122">
                        <col /> </colgroup>
                    <tr>
                        <th>카테고리</th>
                        <td>{{$category}}</td>
                    </tr>
                </table>
                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="122">
                        <col /> </colgroup>
                    <tr>
                        <th>물품제목</th>
                        <td>{{$user_title}}</td>
                    </tr>
                    <tr>
                        <th>구매금액</th>
                        <td>{{number_format($user_price)}}원</td>
                    </tr>
                    <tr>
                        <th>구매자 캐릭터명</th>
                        <td><span id="layer_character" class="f_blue3 f_bold"></span> (물품을 전달 받으실 본인의 캐릭터명)</td>
                    </tr>
                </table>
                <div class="position-relative height90">
                    <div class="position-absolute border-one-gray w100"></div>
                    <div class="attention position-absolute">거래 사고 주의사항</div>
                </div>
                <ul class="attention_box">
                    <li>1. 전달받은 물품은 절대 돌려주지 마세요.</li>
                    <li>2. 구매 등록시 반드시 본인 정보(게임명/서버/캐릭터)를 등록하세요.</li>
                    <li>&nbsp;&nbsp;&nbsp;타인 게임정보 기재 또는, 다른 게임/서버에 구매 신청할 경우 물품신청자에게 불이익이 발생할 수 있습니다.</li>
                </ul>
                <div class="g_btn_wrap">
                    <a href="javascript:void(0)" onclick="fnSubmit();" class="btn-default btn-suc">확인</a>
                    <a href="javascript:void(0)" data-close="true" class="btn-default btn-cancel">취소</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ▲ 확인 팝업 //-->
    <form action="https://bill.tcash.co.kr/PublicWeb/TCashDeposit.aspx" method="post" target="tcash_charge" id="tcash_frm">
        <input type="hidden" name="REQUEST" value="">
        <input type="hidden" name="YMD" value="">
        <input type="hidden" name="HH24" value="">
        <input type="hidden" id="tcash_payment_phone" value=""> </form>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection

<style>
    .character_noti{clear:both;font-size:12px;color:#FF2400;}
</style>
