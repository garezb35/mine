@php
    $price = str_replace(",","",$user_price);
    $goods = 'money';
    $goods_label = '게임머니';
    if($good_type != '기타')
        $goods_label = $good_type;
    $selltype = '일반';
    if(!empty($user_goods_type) && $user_goods_type == 'division'){
        $selltype = '분할';
         $price = str_replace(",",'',$user_division_price) * str_replace(",","",$user_quantity_min) / str_replace(",","",$user_division_unit);
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

$submit_condition = 1;
$direct_condition_credit = empty($direct_condition_credit) ? 0: $direct_condition_credit;
if($cuser['role'] < $direct_condition_credit || ($direct_condition_hpp == 1 && $cuser['mobile_verified'] !=1) || ($direct_condition_acc == 1 && empty($cuser['bank_verified']))){
    $submit_condition = 0;
}
@endphp
@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type='text/css' rel='stylesheet' href='/angel/buy/css/application.css'>
@endsection

@section('foot_attach')
    <script type='text/javascript' src='/angel/buy/js/application.js'></script>
@endsection

@section('content')
    <script>
        @if($selltype == '분할')
        var user_division_price = {{$user_division_price}};
        var user_quantity_min = {{$user_quantity_min}};
        var user_division_unit=  {{$user_division_unit}};
        @endif
        var submit_condition = {{$submit_condition}};
    </script>
    <div class="bg-white">
        <div></div>
        <div>
            <div class="pagecontainer">
                <div class="text-green_moderation noborder"> 판매정보 <span>확인</span>
                </div>
                <div class="g_gray_border"></div>

                <a name="top"></a>
                <form id="frmSell" name="frmSell" action="/buy/application_ok" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$orderNo}}">
                    <input type="hidden" name="inputList" value="">
                    <input type="hidden" name="inputContinue" value="">
                    <input type="hidden" id="security_service_userinfo" name="security_service_userinfo" value="N">
                    <input type="hidden" id="security_type" name="security_type" value="none">
                    <input type="hidden" name="user_without" id="user_without" value="1">
                    <input type="hidden" name="user_goods" id="user_goods" value="etc">
                    <input type="hidden" name="user_goods_type" id="user_goods_type" value="{{$user_goods_type}}">
                    <input type="hidden" name="use_creditcard" id="use_creditcard" value="{{$price}}">

                    <input type="hidden" name="user_cell_auth" id="user_cell_auth" value="1">
                    <input type="hidden" name="user_cell_num" id="user_cell_num" value="{{$cuser['number']}}">
                    <input type="hidden" name="user_safety_type" id="user_safety_type" value="2">
                    <input type="hidden" name="safety_using_flag" id="safety_using_flag" value="true">
                    <input type="hidden" name="game_code" id="game_code" value="{{$game_code}}">


                    <div class="highlight_contextual_nodemon first">물품정보</div>
                    @if($user_goods_type == 'general')
                        <table class="table-striped table-green1 P__r">
                            <colgroup>
                                <col width="100">
                                <col width="250">
                                <col width="100">
                                <col>
                            </colgroup>
                            <tr>
                                <th>카테고리</th>
                                <td colspan="3">{{$category}}</td>
                            </tr>
                            <tr>
                                <th>물품제목</th>
                                <td colspan="3" class="table_goods_subject"> {{$user_title}}</td>
                            </tr>
                            <tr>
                                <th>거래번호</th>
                                <td class="e--pc">#{{$orderNo}}</td>
                                <th class="visible--table--pc">등록일시</th>
                                <td class="visible--table--pc">{{date("Y-m-d H:i:s",strtotime($created_at ?? ''))}}</td>
                            </tr>
                            <tr class="visible--table-m">
                                <th>등록일시</th>
                                <td colspan="3">{{date("Y-m-d H:i:s",strtotime($created_at ?? ''))}}</td>
                            </tr>
                            <tr>
                                @php
                                    $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                                @endphp
                                @if($c != 1)
                                    <th>판매수량</th>
                                    <td class="e--pc"><span class="trade_money1">{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''}}</span> {{$good_type}}</td>
                                @endif
                                <th @if($c != 1) class="visible--table--pc" @endif>판매금액</th>
                                <td @if($c == 1)colspan="3" @else class="visible--table--pc" @endif><span class="trade_money1"></span>{{number_format($user_price)}} 원</td>
                            </tr>
                            @if($c != 1)
                            <tr class="visible--table-m">
                                <th>판매금액</th>
                                <td colspan="3"><span class="trade_money1"></span>{{number_format($user_price)}} 원</td>
                            </tr>
                            @endif
                        </table>
                    @endif
                    @if($user_goods_type == 'division')
                        <table class="table-striped table-green1 P__r">
                            <colgroup>
                                <col width="100">
                                <col width="250">
                                <col width="100">
                                <col>
                            </colgroup>
                            <tbody>
                                <tr>
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
                                    <td class="e--pc">#{{$orderNo}}</td>
                                    <th class="visible--table--pc">등록일시</th>
                                    <td class="visible--table--pc">{{date("Y-m-d H:i:s",strtotime($created_at ?? ''))}}</td>
                                </tr>
                                <tr class="visible--table-m">
                                    <th >등록일시</th>
                                    <td colspan="3">{{date("Y-m-d H:i:s",strtotime($created_at ?? ''))}}</td>
                                </tr>
                                <tr>
                                    <th>최소판매수량</th>
                                    <td class="e--pc">{{number_format($user_quantity_min)}} {{$goods_label}}</td>
                                    <th class="visible--table--pc">최대판매수량</th>
                                    <td class="visible--table--pc">{{number_format($user_quantity_max)}} {{$goods_label}}</td>
                                </tr>
                                <tr class="visible--table-m">
                                    <th>최대판매수량</th>
                                    <td colspan="3">{{number_format($user_quantity_max)}} {{$goods_label}}</td>
                                </tr>
                                <tr>
                                    <th>판매수량</th>
                                    <td class='e--pc'>
                                        <input type="text" id="buy_quantity" name="buy_quantity" class="angel__text mode-active text__new__green input__height__30 border__new_green" value="{{str_replace(",","",$user_quantity_min) / str_replace(",","",$user_division_unit)}}" onchange="changeP()"> 번 (<span id="spnQuantity_Unit">{{$user_division_unit}}</span> x
                                        <span id="spnQuantity"></span>번 =
                                        <span id="spnQuantity_total"></span> {{$goods_label}})
                                    </td>
                                    <th class="visible--table--pc">단위금액</th>
                                    <td  class="visible--table--pc">{{$user_division_unit}}당 {{number_format($user_division_price)}}원</td>
                                </tr>
                                <tr class="visible--table-m">
                                    <th>단위금액</th>
                                    <td colspan="3">{{$user_division_unit}}당 {{number_format($user_division_price)}}원</td>
                                </tr>
                                <tr>
                                    <th>복수구매할인</th>
                                    <td class="e--pc">- <span id="discount_money"></span> 원 ({{$discount_quantity_cnt * $discount_quantity}}{{$goods_label}} 당 {{$discount_price}}원 할인)</td>
                                    <th class="visible--table--pc">예상결제금액</th>
                                    <td class="visible--table--pc"><span class="trade_money1">{{number_format($price)}}</span> 원</td>
                                </tr>
                            <tr class="visible--table-m">
                                <th>예상결제금액</th>
                                <td colspan="3"><span class="trade_money1">{{number_format($price)}}</span> 원</td>
                            </tr>
                            </tbody>
                        </table>
                    @endif

                    <div class="highlight_contextual_nodemon mt-10"> 구매자정보</div>
                    <div class="selling_middle">
                        <div class="pr-5">
                            <div class="border-gray2 pl-10" style="padding-bottom: 56px">
                                <div class="d-flex">
                                    <img src="/angel/img/level/gold.png" width="37">
                                    <div class="mt-5 ml-5">
                                        <p class="f-13">{{$cuser['roles']['alias']}}회원</p><p class="f-13">거래점수 : {{number_format($cuser['point'])}}점</p>
                                    </div>
                                </div>
                                <dl class="add_info mt-15">
                                    <dd>
                                        <span class="con w60 btn_state @if($cuser['mobile_verified'] == 1)  bg-redi text-white @endif">휴대폰</span>
                                        <span class="on w60 btn_state @if($cuser['bank_verified'] == 1)  bg-redi text-white @endif">계좌</span>
                                        <span class="on w60 btn_state @if($cuser['pin'] == 1)  bg-redi text-white @endif">아이핀</span>
                                        <span class="w60 btn_state @if(!empty($cuser['email_verified_at'])) bg-redi text-white @endif ">이메일</span>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div>
                            <div class="highlight_contextual_nodemon gray pt-5 p-left-10"> 상세설명 <a href="javascript:;" class="wideview" id="wideview">열기▼</a> </div>
                            <div class="detail_info" id="detail_info" style="height: 59px">
                                <div class="detail_text" style="height: 58px">{{$user_text}}</div>
                            </div>
                        </div>
                    </div>
{{--                    <table class="table-greenwith">--}}

{{--                        <tbody>--}}
{{--                        --}}
{{--                        <tr>--}}
{{--                            <th class="p-left-10">--}}
{{--                                <div>--}}
{{--                                    <img src="/angel/img/level/{{$cuser['roles']['icon']}}" width="37"/>--}}
{{--                                    <span class="f_green4 font-weight-bold">{{$cuser['roles']['alias']}}회원</span>&nbsp;&nbsp;&nbsp; (거래점수 : {{number_format($cuser['point'])}}점)--}}
{{--                                </div>--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                <dl class="add_info">--}}
{{--                                    <dd>--}}
{{--                                        <span class="w80 cert_state">인증상태</span>--}}
{{--                                        <span class="con w80 btn_state">--}}
{{--                                        @if($cuser['mobile_verified'] == 1)--}}
{{--                                                <img src="/angel/img/icons/icon_check.png" width="14">--}}
{{--                                            @else--}}
{{--                                                <img src="/angel/img/icons/icon_nocheck.png" width="14">--}}
{{--                                            @endif휴대폰</span>--}}
{{--                                        <span class="on w80 btn_state">--}}
{{--                                        @if($cuser['bank_verified'] == 1)--}}
{{--                                                <img src="/angel/img/icons/icon_check.png" width="14">--}}
{{--                                            @else--}}
{{--                                                <img src="/angel/img/icons/icon_nocheck.png" width="14">--}}
{{--                                            @endif계좌</span>--}}
{{--                                        <span class="on w80 btn_state">--}}
{{--                                        @if($cuser['pin'] == 1)--}}
{{--                                                <img src="/angel/img/icons/icon_check.png" width="14">--}}
{{--                                            @else--}}
{{--                                                <img src="/angel/img/icons/icon_nocheck.png" width="14">--}}
{{--                                            @endif아이핀</span>--}}
{{--                                        <span class="w80 btn_state">--}}
{{--                                        @if(!empty($cuser['email_verified_at']))--}}
{{--                                                <img src="/angel/img/icons/icon_check.png" width="14">--}}
{{--                                            @else--}}
{{--                                                <img src="/angel/img/icons/icon_nocheck.png" width="14">--}}
{{--                                            @endif이메일</span>--}}

{{--                                    </dd>--}}
{{--                                </dl>--}}
{{--                                <div class="float__right">--}}
{{--                                    <a href="javascript:fnCreditViewCheck()"></a>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}

                    <style>
                        .SafetyNumber_plus {
                            display: none;
                        }
                    </style>

                    <input type="hidden" name="user_contactA" id="user_contactA" value="{{$home_a}}">
                    <input type="hidden" name="user_contactB" id="user_contactB" value="{{$home_b}}">
                    <input type="hidden" name="user_contactC" id="user_contactC" value="{{$home_c}}">
                    <input type="hidden" name="slctMobile_type" id="slctMobile_type" value="1">
                    <input type="hidden" name="user_mobileA" id="user_mobileA" value="{{$mobile_a}}">
                    <input type="hidden" name="user_mobileB" id="user_mobileB" value="{{$mobile_b}}">
                    <input type="hidden" name="user_mobileC" id="user_mobileC" value="{{$mobile_c}}">

                    <div class="highlight_contextual_nodemon mt-10">내 거래정보</div>
                    <table class="table-striped table-green1 P__r">
                        <colgroup>
                            <col width="120"><col/>
                        </colgroup>
                        <tr>
                            <th>이름</th>
                            <td>{{$cuser['name']}}</td>
                        </tr>
                        <tr>
                            <th>판매자 캐릭터명</th>
                            <td>
                                <div class="float-left">
                                    <input type="text" name="user_character" id="user_character" class="angel__text mode-active text__new__green input__height__30 border__new_green" maxlength="30" tabindex="2"> 물품을 전달 하실 본인의 캐릭터명
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>연락처</th>
                            <td> <span id="spnUserPhone">
                                    자택번호 없음
                                </span> (
                                <label>
                                    <input type="checkbox" class="angel_game_sel" name="user_cell_check" id="user_cell_check" value="on" checked> 자택번호안내</label> ) / <span id="spnUserCell">010-4797-3690</span> <a href="javascript:_window.open('private_edit', '/user/contact_edit', 496, 350);" class="btn-light-modern after">연락처 수정</a> </td>
                        </tr>
                        <tr class="SafetyNumber">
                            <th>안심번호</th>
                            <td> 개인정보보호 및 사고예방을 위해
                                <br> 고객님의 휴대폰으로 거래 시 0508로 시작하는 무료안심번호가 휴대폰으로 부여되어 상대방에게 안내됩니다.
                                <div class="safe_area">
                                    <div class="mailbox__list green" id="safe_layer" style="right:0;margin-top:-14px;">
                                        <div class="cont"> 고객님의 개인정보 보호를 위해 휴대폰번호에 안심번호를 부여하여 실제 휴대폰번호 대신
                                            <br> 가상의 안심번호를 상대 거래자에게 노출시켜주는 무료 서비스 입니다.
                                            <ul class="text-rock"> <strong>안심번호 서비스 사용 시 주의사항</strong>
                                                <br> 1) 부여받은 안심번호로도 문자 수신이 가능합니다.(발신시에는 부여받은 안심번호 사용)
                                                <br> 2) 상대거래자가 안심번호 서비스를 사용하지 않는 상태에서 발신한 경우 실제 번호가 표시됩니다.
                                                <br> 3) 부여 받은 안심번호는 거래가 종료되는 시점에 자동 회수되며, 회수된 이후에는 연락이 불가능합니다.
                                                <br> 4) 안심번호 사용 후 48시간을 초과하거나 거래종료 후 문제발생 시 실제 전화번호가 노출됩니다. </ul>
                                        </div>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="SafetyNumber_plus">
                            <th>안심번호 플러스</th>
                            <td> 개인정보보호 및 사고예방을 위해
                                <br> 고객님의 휴대폰으로 거래 시 02-1234-1234 형태의 번호가 부과되어 상대방에게 안내됩니다.
                                <div class="safe_area"> <a href="javascript:;" class="guide_txt" id="safe_plus_guide">안심번호 플러스란?</a>
                                    <div class="mailbox__list green" id="safe_plus_layer" style="right:0;margin-top:-14px;">
                                        <div class="title"> 안심번호 플러스란?
                                            <a href="javascript:;" class="close"></a>
                                        </div>
                                        <div class="cont"> 고객님의 개인정보 보호를 위해 휴대폰번호에 안심번호를 부여하여 실제 휴대폰번호 대신
                                            <br> 가상의 안심번호를 상대 거래자에게 노출시켜주는 무료 서비스 입니다.
                                            <ul class="text-rock"> <strong>안심번호 플러스 사용 시 주의사항</strong>
                                                <br> 1) 부여받은 안심번호로 통화 시 수신자에게 10초에 20원의 이용료가 부과됩니다.
                                                <br> 2) 안심번호 플러스로 문자 수신은 불가능합니다.
                                                <br> 3) 부여 받은 안심번호 플러스는 거래가 종료되는 시점에 자동 회수되며, 회수된 이후에는 연락이 불가능합니다.
                                                <br> 4) 가상 번호 사용 후 24시간을 초과하거나 거래종료 후 문제발생 시 실제 전화번호가 노출됩니다. </ul>
                                        </div>
                                        <div class="btn"> <a href="/guide/add/security_number_plus class="btn_green2">이용안내 ></a> </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
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

                    <div class="empty-high"></div>
                    <div class="btn-groups_angel">
                        <a  class="button-success" onclick="fnFormChecker();">판매 신청</a>
                    </div>
                </form>


            </div>

            <div id="dvGoodsInfo" class="modal_dialog green dvGoodsInfo">
                <div class="modal__title">물품신청정보 <span class="modal__close" onclick="nodemonPopup.disable();">닫기</span> </div>
                <div class="modal--content">
                    <table class="table-striped table-green1 P__r">
                        <colgroup>
                            <col width="100"> <col>
                        </colgroup>
                        <tr>
                            <th>카테고리</th>
                            <td>{{$category}}</td>
                        </tr>
                        <tr>
                            <th>물품제목</th>
                            <td>{{$user_title}}</td>
                        </tr>
                        <tr>
                            <th>판매금액</th>
                            <td><span class="trade_money1">{{number_format($user_price)}}</span>원</td>
                        </tr>
                        <tr>
                            <th>판매자 캐릭터명</th>
                            <td> <span id="layer_character" class="text-blue_modern font-weight-bold"></span> (물품을 전달 하실 본인의 캐릭터명) </td>
                        </tr>
                    </table>
                    <div class="position-relative height90">
                        <div class="position-absolute border-one-gray w100"></div>
                        <div class="attention position-absolute">거래 사고 주의사항</div>
                    </div>
                    <ul class="box6 notice_box">
                        <li>판매물품의 해킹, 복사, 사기 등의 문제가 발생할 때 민/형사상 책임은 판매자에게 있음을 동의합니다.</li>
                        <li>거래 교환 창 스크린샷과 완료 스크린샷을 보유하시기 바랍니다.</li>
                    </ul>
                    <div class="btn-groups_angel">
                        <a  onclick="$('#frmSell').submit();"  class="btn-default btn-suc">확인</a>
                        <a  onclick="nodemonPopup.disable();" class="btn-default btn-cancel">취소</a>
                    </div>
                </div>
            </div>

            <form id="creditForm" name="creditForm" method="post">
                <input type="hidden" id="infoId" value="a68e5ed758fe86e630c7f30c1dbb221b">
                <input type="hidden" name="id" id="encryptId">
                <input type="hidden" name="type" id="encryptType"> </form>
            <div class="empty-high"></div>
        </div>
    </div>
@endsection


