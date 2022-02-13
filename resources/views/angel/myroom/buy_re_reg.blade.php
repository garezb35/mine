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
@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css" />
    <link type="text/css" rel="stylesheet" href="/angel/buy/css/index.css">
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/buy/js/buy_re_reg.js"></script>
    <script type="text/javascript">
        var useMileage = '{{$cuser['mileage']}}';
        angel_enable_type.goods = "{{$user_goods}}";
        angel_enable_type.sale = "{{$user_goods_type}}";
        function __init() {
            angel_enable_type.goods = "{{$user_goods}}";
            angel_enable_type.sale = "{{$user_goods_type}}";
        }
        angel_premiun_items.premium = {{$premium}};
        angel_premiun_items.highlight = {{$highlight}} / 12;
        angel_premiun_items.quickIcon = {{$quickicon}};
    </script>

@endsection

@section('content')
    <div class="bg-white">
        <div>
            @include('aside.myroom',['group'=>'buy'])
            <div class="pagecontainer">
                <div class="contextual--title noborder">
                    <div class="g_title_noborder"> 재 등록할 <span>물품</span> </div>
                </div>

                <div class="g_gray_border"></div>
                <form id="frmBuy" name="frmBuy" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{$orderNo}}">
                    <input type="hidden" id="user_goods" name="user_goods" value="{{$user_goods}}">
                    <input type="hidden" id="user_goods_type" name="user_goods_type" value="{{$user_goods_type}}">
                    <input type="hidden" id="game_code" name="game_code" value="{{$game_code}}">
                    <input type="hidden" id="server_code" name="server_code" value="{{$server_code}}">
                    <input type="hidden" id="gs_name" name="gs_name" value="AOS레전드 > 기타">
                    <input type="hidden" id="unit" name="unit" value="기타">
                    <input type="hidden" id="security_type" name="security_type" value="INCS">
                    <input type="hidden" id="security_number" name="security_number">
                    <input type="hidden" id="security_code" name="security_code">
                    <input type="hidden" name="user_premium_use" id="user_premium_use">
                    <input type="hidden" name="user_quick_icon_use" id="user_quick_icon_use">
                    <input type="hidden" name="user_charge" id="user_charge">
                    <div class="highlight_contextual_nodemon first g__tab__title">물품정보</div>
                    <div class="ml-15 mr-15">
                        @if($user_goods_type == 'general')
                            <table class="table-primary border--gap border-top-0 sell__buy__table P__r">
                                <colgroup>
                                    <col width="130">
                                    <col>
                                </colgroup>
                                <tr>
                                    <th  class="border-top">카테고리</th>
                                    <td  class="border-top">{{$category}}</td>
                                </tr>
                                <tr>
                                    <th  class="border-top">구매유형</th>
                                    <td  class="border-top">일반</td>
                                </tr>
                                <tbody id="sr-template">
                                @php
                                    $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                                @endphp
                                @if($c != 1)
                                    <tr>
                                        <th class="border-top">구매수량</th>
                                        <td class="border-top"><span class="trade_money1">
                                                <input type="text" name="user_quantity" id="user_quantity" maxlength="10" class="mw-200 angel__text mode-active text__new__green input__height__30 border__new_green" value="{{number_format($user_quantity)}}">
                                                {{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''}}</span> {{$good_type}}
                                        </td>
                                    </tr>
                                @endif
                                    <tr>
                                        <th class="border-top">구매금액</th>
                                        <td class="border-top">
                                            <input type="text" name="user_price" id="user_price" maxlength="10" class="mw-200 angel__text mode-active text__new__green input__height__30 border__new_green" value="{{number_format($user_price)}}"> 원 (3,000원 이상, 10원 단위 등록 가능)
                                            <div id="coms_area" class="coms_area">수수료 5% : <span class="text-rock" id="commission_price">0</span>원 | 실 수령액 : <span class="text-rock" id="receive_price">0</span>원 </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <th class="border-top">캐릭터명</th>
                                    <td class="border-top">
                                        <div class="float-left">
                                            <input type="text" class="mw-200 angel__text mode-active text__new__green input__height__30 border__new_green" name="user_character" id="user_character" value="{{$user_character}}"> 물품을 전달 받으실 본인의 캐릭터명 </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border-top">즉시구매</th>
                                    <td class="border-top">
                                        <div>
                                            <label>
                                                <input type="checkbox" class="angel_game_sel" id="direct_reg_trade" name="direct_reg_trade" value="1"> 즉시구매 등록</label>
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
                                    <th class="border-top">물품제목</th>
                                    <td class="border-top">
                                        <div class="item_detail_opts">
                                            <label class="d-none">
                                                <input type="checkbox" name="fixed_trade_subject" id="fixed_trade_subject" class="angel_game_sel"> 물품제목 기본값 :
                                            </label>
                                            <span id="trade_sign_txt">{{$title}}</span>
                                            <a href="javascript:_window.open('fixed_title', '/sell/fixed_trade_subject', 500, 300);">+설정</a> </div>
                                        <input type="text" class="w-100 f-14 text__new__green input__height__30 border__new_green" name="user_title" id="user_title" maxlength="40" value="{{$user_title}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border-top">상세설명</th>
                                    <td class="border-top">
                                        <textarea id="user_text" name="user_text" class="txtarea w100 border__new_green">{{$user_text}}</textarea>
                                    </td>
                                </tr>
                            </table>
                        @endif
                        @if($user_goods_type == 'division')
                            <table class="table-primary border--gap border-top-0 sell__buy__table P__r">
                                <colgroup>
                                    <col width="130">
                                    <col>
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th class="border-top">카테고리</th>
                                        <td class="border-top">{{$category}}</td>
                                    </tr>
                                    <tr>
                                        <th class="border-top">구매유형</th>
                                        <td class="border-top">분할</td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <th class="border-top">구매수량</th>
                                        <td class="border-top">
                                            <div class="parts__01" id="sr-template">
                                                <div class="h130">
                                                    <div style="overflow: auto">
                                                        <p class="fl ml-15 font-weight-bold mt-15">구매수량</p>
                                                    </div>
                                                    <div class="ml-5 mr-10">
                                                        <div id="game_money">
                                                            <input type="text" name="user_quantity_min" id="user_quantity_min" maxlength="7" class="angel__text text_right f-14 text__new__green input__height__30 border__new_green m-t-10" value="{{number_format($user_quantity_min)}}">
                                                            <input type="text" name="user_quantity_max" id="user_quantity_max" maxlength="7" class="angel__text text_right f-14 text__new__green input__height__30 border__new_green m-t-10" value="{{number_format($user_quantity_max)}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="h130">
                                                    <div class="o__auto">
                                                        <p class="fl ml-15 font-weight-bold mt-15">구매금액</p>
                                                    </div>
                                                    <div class="ml-5 mr-10 mt-12">
                                                        <input type="text" name="user_division_unit" id="user_division_unit" maxlength="7" class="angel__text text_right f-14 text__new__green input__height__30 border__new_green" value="{{number_format($user_division_unit)}}" size="18">
                                                        <input type="text" name="user_division_price" id="user_division_price" maxlength="10" class="angel__text text_right f-14 text__new__green input__height__30 border__new_green m-t-10" value="{{number_format($user_division_price)}}" size="18">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="border-top">캐릭터명</th>
                                        <td class="border-top">
                                            <div class="dfServer" id="dfServer">
                                            </div>
                                            <div class="float-left">
                                                <input type="text" class="angel__text mode-active text__new__green input__height__30 border__new_green" name="user_character" maxlength="30" value="{{$user_character}}" id="user_character">
                                                <span id="sub_text" class="text-rock"></span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <th class="border-top">물품제목</th>
                                        <td class="border-top">
                                            <div class="item_detail_opts">
                                                <label class="d-none">
                                                    <input type="checkbox" name="fixed_trade_subject" id="fixed_trade_subject" class="angel_game_sel"> 물품제목 기본값 :
                                                </label>
                                                <span id="trade_sign_txt">{{$title}}</span>
                                                <a href="javascript:_window.open('fixed_title', '/sell/fixed_trade_subject', 500, 300);">+설정</a>
                                            </div>
                                            <input type="text" class="w-100 f-14 text__new__green input__height__30 border__new_green" name="user_title" id="user_title" maxlength="40" value="{{$user_title}}">
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="border-top">상세설명</th>
                                        <td class="border-top">
                                    <textarea id="user_text" name="user_text" class="txtarea w100 border__new_green">{{$user_text}}</textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="highlight_contextual_nodemon euro-service">
                        <div style="position: relative">
                            <div class="service__line"></div>
                        </div>
                        <span class="euro-title">유료 등록 서비스</span>
                        <div class="charge_service">
                            <dl>
                                <div>
                                    <p class="text-center bg-gradient-wb pt-5 pb-5">프리미엄등록</p>
                                    <dd>
                                        <table class="noborder nopadding">
                                            <colgroup>
                                                <col width="50%"/>
                                            </colgroup>
                                            <tr>
                                                <td style="vertical-align: top">
                                                    <div>
                                                        <div class="charge_price">
                                                            <strong> 100원 / 1시간</strong>
                                                        </div>
                                                        <div class="text-center mt-36">
                                                            <div>
                                                                <label @class('custom-select__1 height30 first')>
                                                                    <select id="user_premium_time" name="user_premium_time">
                                                                        <option value="">미설정</option>
                                                                        <option value="1">1시간</option><option value="2">2시간</option><option value="3">3시간</option><option value="4">4시간</option><option value="5">5시간</option><option value="6">6시간</option><option value="7">7시간</option><option value="8">8시간</option><option value="9">9시간</option><option value="10">10시간</option><option value="11">11시간</option><option value="12">12시간</option><option value="13">13시간</option><option value="14">14시간</option><option value="15">15시간</option><option value="16">16시간</option><option value="17">17시간</option><option value="18">18시간</option><option value="19">19시간</option><option value="20">20시간</option><option value="21">21시간</option><option value="22">22시간</option><option value="23">23시간</option><option value="24">24시간</option>
                                                                    </select>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: top" @class('text-center')>
                                                    <div @class('text-center premiumss')>
                                                        <div class="sub_txt text-center">
                                                            프리미엄 잔여시간이 많을수록<br>물품리스트 상단에 노출됩니다.
                                                        </div>
                                                        <a class="free_view btn-premium" href="javascript:_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list?free_use_item=premium',440,450)">무료이용권 &nbsp;&nbsp;
                                                            <i class="fa fa-angle-right text-white"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </dd>
                                </div>
                            </dl>
                            <dl @class('d-none')>
                                <div>
                                    <p class="text-center">물품강조</p>
                                    <dt class="border-bottom-2 border-blue"></dt>
                                    <dd>
                                        <table class="noborder">
                                            <colgroup>
                                                <col width="50%"/>
                                            </colgroup>
                                            <tr>
                                                <td>
                                                    <div class="charge_price">
                                                        <strong> 100원 / 12시간</strong>
                                                    </div>
                                                    <div class="goods_emphasis">
                                                        <label for="user_icon_use" class="font-weight-bold">굵은체</label>
                                                        <select name="user_icon_use" id="user_icon_use">
                                                            <option value="">미설정</option>
                                                            <option value="12">12시간</option><option value="24">24시간</option><option value="36">36시간</option><option value="48">48시간</option><option value="60">60시간</option><option value="72">72시간</option>
                                                        </select>
                                                        <span id="charge_apply" style="display: none">게임머니 삽니다.</span>
                                                        <div class="mailbox__list blue" id="premium_layer" style="display: none !important;">
                                                            <div class="cont">
                                                                ※ 유료등록 서비스는 선불로 부과되며 거래성사여부, 취소여부, 삭제여부, 이용정지여부 등과<br>
                                                                관계 없이 환불, 취소, 교환, 반환 등이 되지 않으니 신중하게 구매해 주시기 바랍니다.
                                                            </div>
                                                            <div class="btn">
                                                                <a href="javascript:;" id="premium_close" class="close btn_blue4">확인</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div  class="goods_emphasis">
                                                        <label for="user_bluepen_use" class="text-blue_modern">파란펜</label>
                                                        <select name="user_bluepen_use" id="user_bluepen_use">
                                                            <option value="">미설정</option>
                                                            <option value="12">12시간</option><option value="24">24시간</option><option value="36">36시간</option><option value="48">48시간</option><option value="60">60시간</option><option value="72">72시간</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="free_view btn-goods" href="javascript:_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list?free_use_item=highlight',440,450)">무료이용권 &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right text-white"></i></a>
                                                    <div style="margin-top:10px">(게임머니 <span class="text-blue_modern">팝니다</span>)</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </dd>
                                </div>
                            </dl @class('d-none') >
                            <dl @class('d-none')>
                                <div>
                                    <p class="text-center">스피드 거래</p>
                                    <dt class="border-bottom-2 border-gray"></dt>
                                    <dd>
                                        <div class="charge_price">
                                            <strong> 100원 / 1시간</strong>
                                        </div>
                                        <select id="user_quickicon_use" name="user_quickicon_use">
                                            <option value="">미설정</option>
                                            <option value="1">1시간</option><option value="2">2시간</option><option value="3">3시간</option><option value="4">4시간</option><option value="5">5시간</option><option value="6">6시간</option><option value="7">7시간</option><option value="8">8시간</option><option value="9">9시간</option><option value="10">10시간</option><option value="11">11시간</option><option value="12">12시간</option><option value="13">13시간</option><option value="14">14시간</option><option value="15">15시간</option><option value="16">16시간</option><option value="17">17시간</option><option value="18">18시간</option><option value="19">19시간</option><option value="20">20시간</option><option value="21">21시간</option><option value="22">22시간</option><option value="23">23시간</option><option value="24">24시간</option>                        </select>
                                        <div class="sub_txt m-t-35">
                                            물품리스트에 스피드 거래 <br /> 아이콘이 현시 됩니다.
                                        </div>
                                        <a class="free_view btn-speeds" href="javascript:_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list?free_use_item=quickicon',440,450)">무료이용권 &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right text-white"></i></a>
                                    </dd>
                                </div>
                            </dl>
                            <dl>
                                <div>
                                    <p class="text-center bg-gradient-wb pt-5 pb-5">자동재등록</p>
                                    <dd class="rere">
                                        <table class="noborder nopadding">
                                            <colgroup>
                                                <col width="50%"/>
                                            </colgroup>
                                            <tr>
                                                <td style="vertical-align: top">
                                                    <div>
                                                        <div class="charge_price charge_price__more">
                                                            <strong> 100원 / 3회</strong>
                                                        </div>
                                                        <div @class('mb-5')>
                                                            <label for="rereg_count" class="f_black4 font-weight-bold">횟수</label>
                                                            <label @class('custom-select__1 height30 d-inline-block')>
                                                                <select name="rereg_count" id="rereg_count">
                                                                    <option value="">미설정</option>
                                                                    <option value="3">3회</option>
                                                                    <option value="6">6회</option>
                                                                    <option value="9">9회</option>
                                                                </select>
                                                            </label>

                                                        </div>
                                                        <div>
                                                            <label for="rereg_time" class="f_black4 font-weight-bold">시간</label>
                                                            <label @class('custom-select__1 height30 d-inline-block')>
                                                                <select id="rereg_time" name="rereg_time">
                                                                    <option value="5">5분</option>
                                                                    <option value="10">10분</option>
                                                                </select>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: top" @class('text-center')>
                                                    <div class="exp">
                                                        <div class="sub_txt">
                                                            <p>(적용시 : 예)<br>0분 간격으로 0회 재등록</p>
                                                        </div>
                                                    </div>
                                                    <a class="free_view btn-auto" href="javascript:alert('죄송합니다.\n서비스 준비중입니다.')">무료이용권&nbsp;&nbsp;&nbsp; <i class="fa fa-angle-right text-white"></i></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    <div class="total_charge">
                        <strong class="total_label">총 결제금액 : </strong>
                        <strong class="total_charge_money text-rock" id="total_charge_money">0원</strong>
                        <span class="f-small">
                            (내 사용가능한 마일리지 :
                            <strong id="txtCurrentMileage" class="text-rock">{{number_format($cuser['mileage'])}}원</strong>)
                        </span>
                    </div>
                    <style>
                        .SafetyNumber_plus {
                            display: none;
                        }
                    </style>

                    <input type="hidden" name="user_contactA" id="user_contactA" value="{{$home_a}}">
                    <input type="hidden" name="user_contactB" id="user_contactB" value="{{$home_b}}">
                    <input type="hidden" name="user_contactC" id="user_contactC" value="{{$home_c}}">
                    <input type="hidden" name="slctMobile_type" id="slctMobile_type" value="3">
                    <input type="hidden" name="user_mobileA" id="user_mobileA" value="{{$mobile_a}}">
                    <input type="hidden" name="user_mobileB" id="user_mobileB" value="{{$mobile_b}}">
                    <input type="hidden" name="user_mobileC" id="user_mobileC" value="{{$mobile_c}}">
                    <div class="angel__part ml-15 mr-15">
                        <table class="table_angel_secondary user__contact">
                            <colgroup>
                                <col width="74">
                                <col width="200"/>
                                <col width="85"/>
                                <col width="*"/>
                            </colgroup>
                            <tr>
                                <th>이름</th>
                                <td>{{$cuser['name']}}</td>
                                <th class="visible_sell_buy_off">연락처</th>
                                <td class="visible_sell_buy_off">
                                    <span id="spnUserPhone">
                                        {{$cuser['home']}}
                                    </span>
                                    ( <label><input type="checkbox" class="angel_game_sel" name="user_cell_check" id="chk_user_cell_check" value="on" checked> 자택번호안내</label> ) /
                                    <span id="spnUserCell">{{$cuser['number']}}</span>
                                    <a href="javascript:_window.open('private_edit', '/user/contact_edit?check=true', 496, 350);" class="btn-light-modern after">연락처 수정</a>
                                </td>
                            </tr>
                            <tr class="visible_sell_buy_on">
                                <th>연락처</th>
                                <td colspan="3">
                                    <span id="spnUserPhone">
                                        {{$cuser['home']}}
                                    </span>
                                    ( <label><input type="checkbox" class="angel_game_sel" name="user_cell_check" id="chk_user_cell_check" value="on" checked> 자택번호안내</label> ) /
                                    <span id="spnUserCell">{{$cuser['number']}}</span>
                                    <a href="javascript:_window.open('private_edit', '/user/contact_edit?check=true', 496, 350);" class="btn-light-modern after">연락처 수정</a>
                                </td>
                            </tr>
                            <tr>
                                <th>거래알림</th>
                                <td>
                                    카카오톡 ,채널/문자 알림
                                </td>
                                <th class="visible_sell_buy_off">우수회원인증</th>
                                <td class="text-center visible_sell_buy_off">
                                    <ul class="excellent">
                                        <li class="cert_state">
                                            @if($cuser['mobile_verified'] == 1)
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-close" aria-hidden="true"></i>
                                            @endif
                                            휴대폰
                                        </li>

                                        <li class="cert_state">
                                            @if(!empty($cuser['email_verified_at']))
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-close" aria-hidden="true"></i>
                                            @endif
                                            이메일</li>
                                        <li class="cert_state">
                                            @if($cuser['bank_verified'] ==1 )
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-close" aria-hidden="true"></i>
                                            @endif
                                            출금계좌</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="visible_sell_buy_on">
                                <th >우수회원인증</th>
                                <td colspan="3">
                                    <ul class="excellent">
                                        <li class="cert_state">
                                            @if($cuser['mobile_verified'] == 1)
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-close" aria-hidden="true"></i>
                                            @endif
                                            휴대폰
                                        </li>

                                        <li class="cert_state">
                                            @if(!empty($cuser['email_verified_at']))
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-close" aria-hidden="true"></i>
                                            @endif
                                            이메일</li>
                                        <li class="cert_state">
                                            @if($cuser['bank_verified'] ==1 )
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-close" aria-hidden="true"></i>
                                            @endif
                                            출금계좌</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="SafetyNumber">
                                <th>안심번호</th>
                                <td colspan="3">
                                    개인정보보호 및 사고예방을 위해<br> 고객님의 휴대폰으로 거래시 502로 시작하는 무료안심번호가 휴대폰으로 부여되어 상대방에게 안내됩니다.
                                    <div class="safe_area">
                                        {{--                                <a href="javascript:;" class="guide_txt" id="safe_guide">안심번호란?</a>--}}
                                        <div class="mailbox__list blue" id="safe_layer">
                                            <div class="title">
                                                안심번호란?
                                                <a href="javascript:;" class="close"></a>
                                            </div>
                                            <div class="cont">
                                                고객님의 개인정보 보호를 위해 휴대폰번호에 안심번호를 부여하여 실제 휴대폰번호 대신<br> 가상의 안심번호를 상대 거래자에게 노출시켜주는 무료 서비스 입니다.
                                                <ul class="text-rock">
                                                    <strong>안심번호 서비스 사용 시 주의사항</strong><br> 1) 부여받은 안심번호로도 문자 수신이 가능합니다.(발신시에는 부여받은 안심번호 사용)<br> 2) 상대거래자가 안심번호 서비스를 사용하지 않는 상태에서 발신한 경우 실제 번호가 표시됩니다.<br> 3) 부여 받은 안심번호는 거래가 종료되는 시점에 자동 회수되며, 회수된 이후에는 연락이 불가능합니다.<br> 4) 안심번호 사용 후 48시간을 초과하거나 거래종료 후 문제발생 시 실제 전화번호가 노출됩니다.
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="SafetyNumber_plus">
                                <th>안심번호 플러스</th>
                                <td>
                                    개인정보보호 및 사고예방을 위해<br> 고객님의 휴대폰으로 거래 시 02-1234-1234 형태의 번호가 부과되어 상대방에게 안내됩니다.
                                    <div class="safe_area">
                                        <a href="javascript:;" class="guide_txt" id="safe_plus_guide">안심번호 플러스란?</a>
                                        <div class="mailbox__list blue" id="safe_plus_layer">
                                            <div class="title">
                                                안심번호 플러스란?
                                                <a href="javascript:;" class="close"></a>
                                            </div>
                                            <div class="cont">
                                                고객님의 개인정보 보호를 위해 휴대폰번호에 안심번호를 부여하여 실제 휴대폰번호 대신<br> 가상의 안심번호를 상대 거래자에게 노출시켜주는 무료 서비스 입니다.
                                                <ul class="text-rock">
                                                    <strong>안심번호 플러스 사용 시 주의사항</strong><br> 1) 부여받은 안심번호로 통화 시 수신자에게 10초에 20원의 이용료가 부과됩니다.<br> 2) 안심번호 플러스로 문자 수신은 불가능합니다.<br> 3) 부여 받은 안심번호 플러스는 거래가 종료되는 시점에 자동 회수되며, 회수된 이후에는 연락이 불가능합니다.<br> 4) 가상 번호 사용 후 24시간을 초과하거나 거래종료 후 문제발생 시 실제 전화번호가 노출됩니다.
                                                </ul>
                                            </div>
                                            <div class="btn">
                                                <a href="/guide/add/security_number_plus" class="btn_blue4"> 이용안내 ></a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <script>
                        window.onload = function() {
                            if(document.getElementById('safe_guide') !== null) {
                                KeepAlivesRaw({
                                    el: document.getElementById('safe_guide'),
                                    layer: document.getElementById('safe_layer'),
                                    close_btn: document.getElementById('safe_layer').querySelector('.close'),
                                    mask: false,
                                    type: 'style'
                                });
                            }
                            if(document.getElementById('safe_plus_guide') !== null) {
                                KeepAlivesRaw({
                                    el: document.getElementById('safe_plus_guide'),
                                    layer: document.getElementById('safe_plus_layer'),
                                    close_btn: document.getElementById('safe_plus_layer').querySelector('.close'),
                                    mask: false,
                                    type: 'style'
                                });
                            }
                        };
                    </script>

                    <div class="b_input_group">
                        <button type="submit" href="javascript:;" class="button-success" id="ok_btn">재등록</button>
                        <a href="/homepage" class="button-cancel">등록 취소</a> </div>
                </form>
                <div class="class__j7uy7ssd" id="class__j7uy7ssd"></div>
            </div>

            <div id="premiumPart" class="react___gatsby green premium_info">
                <div class="inner">
                    <div class="w__500">
                        <div class="title">프리미엄 등록안내</div>
                        <div class="middle_text">프리미엄 물품 등록을 하시면 물품 리스트 상단에 판매 물품 노출이 가능합니다.
                            <br/>빠른 거래를 원하신다면 프리미엄 등록서비스를 이용하시기 바랍니다. </div>
                        <div class="clearfix mt-10 mb-10 text-center">프리미엄 잔여시간이 많을수록 물품리스트 상단에 노출됩니다.</div>
                        <div class="mileage_sea">(내 사용가능한 마일리지 : <span id="alias__mileage_span" class="text-orange">{{number_format($cuser['mileage'])}}</span> 원) </div>
                        <div class="mt-40 text-center premium__footer">
                            <div>
                                <a href="javascript:;_window.open('FREE_REMAINDER_LIST','/myroom/coupon/free_remainder_list?free_use_item=premium',440,450)" class="btn_gray">프리미엄 무료이용권 보기</a>
                            </div>
                            <div class="premiumPart--content">
                                <div> <strong class="service_title">프리미엄 등록</strong><br>
                                     이용료<strong class="text-customgray"> 100원 </strong> / 1시간
                                </div>
                            </div>
                            <div>
                                <select id="pop_user_premium_time" name="pop_user_premium_time" class="height30 bg-gradient-gray">
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
                            </div>
                        </div>
                        <div class="b_input_group">
                            <a href="javascript:;" id="actionPremium" class="btn-default btn-suc">확인</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="empty-high"></div>
        </div>
    </div>


@endsection
