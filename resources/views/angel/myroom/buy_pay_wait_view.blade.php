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
@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/buy/css/buy_pay_wait_view.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/buy/css/common_list.css" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/buy/js/buy_pay_wait_sell.js"></script>
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

    <div class="bg-white">
        <div>
            @include("angel.myroom.header")
        </div>
        <div >
            @include('aside.myroom',['group'=>'buy'])
            <input type="hidden" id="screenshot_info" value="TiUzQg==">
            <div class="pagecontainer">
                <a name="top"></a>
                <div class="text-green_moderation noborder">
                    입금해야 할 물품
                </div>
                <table class="table-striped table-green1">
                    <tbody>
                        <tr>
                            <th>카테고리</th>
                            <td colspan="3" class="bg-ggray">{{$category}}</td>
                        </tr>
                        <tr>
                            <th>물품제목</th>
                            <td colspan="3">
                                {{$user_title}}
                            </td>
                        </tr>
                        <tr>
                            <th>거래번호</th>
                            <td class="bg-ggray">#{{$orderNo}}</td>
                            <th class="visible--table--pc">등록일시</th>
                            <td class="visible--table--pc bg-ggray">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
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
                            <td><span class="clc3">{{number_format($payitem['price'])}}</span> 원 </td>
                            <th class="visible--table--pc">단위금액</th>
                            <td class="visible--table--pc">-</td>
                        </tr>
                        <tr>
                            <th>구매자 캐릭터명</th>
                            <td colspan="3" class="bg-ggray">{{$buyer['character']}}</td>
                        </tr>
                        <tr class="visible--table-m">
                            <th>등록일시</th>
                            <td colspan="3">{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                        </tr>
                        <tr class="visible--table-m">
                            <th>단위금액</th>
                            <td colspan="3">-</td>
                        </tr>
                    </tbody>
                </table>

                <div class="highlight_contextual_nodemon mt-15">판매자 정보</div>
                <div @class('selling_middle')>
                    <div @class('pr-5')>
                        <div @class('border-gray2 pt-10 pl-10 pb-10')>
                            <div @class('d-flex')>
                                <img src="/angel/img/level/{{$seller['roles']['icon']}}" width="37"/>
                                <div @class('mt-5 ml-5')>
                                    <p @class('f-13')>{{$seller['roles']['alias']}}회원</p><p @class('f-13')>거래점수 : {{number_format($seller['point'])}}점</p>
                                </div>
                            </div>
                            <dl class="add_info mt-15">
                                <dd>
                                    <span class="con w60 btn_state @if($seller['mobile_verified'] == 1) bg-redi text-white @endif">휴대폰</span>
                                    <span class="on w60 btn_state @if($seller['bank_verified'] == 1) bg-redi text-white @endif">계좌</span>
                                    <span class="on w60 btn_state @if($seller['pin'] == 1) bg-redi text-white @endif">아이핀</span>
                                    <span class="w60 btn_state @if(!empty($seller['email_verified_at'])) bg-redi text-white @endif">이메일</span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div>
                        <table class="table-striped table-green1 tdh-50">
                            <colgroup>
                                <col width="80">
                                <col>
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>결제방식</th>
                                    <td>
                                        <span class="lh_30">마일리지</span> @if($buyer['mileage'] < $payitem['price'])<a href="javascript:_window.open('mileage_charge', '/myroom/mileage/charge/index', 701, 900);" class="float__right btn btn-outline-secondary btn-sm" style="margin-right: 10px">마일리지 충전</a> @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>마일리지  </th>
                                    <td @class('f-13')>
                                        @if($buyer['mileage'] < $payitem['price'])
                                            <span class="float-left font-weight-bold">* 현재 결제할 마일리지가 부족합니다.</span>

                                        @else
                                            <span class="float-left font-weight-bold">* 현재 결제할 마일리지가 충분합니다.</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="highlight_contextual_nodemon mt-20">내 거래정보</div>
                <table class="table-striped">
                    <tbody>
                        <tr>
                            <th>이름</th>
                            <td>{{$buyer['name']}}</td>
                            <th class="visible--table--pc">연락처</th>
                            <td class="visible--table--pc">{{$buyer['home']}} / {{$buyer['number']}}</td>
                        </tr>
                        <tr class="visible--table-m">
                            <th>연락처</th>
                            <td colspan="2">{{$buyer['home']}} / {{$buyer['number']}}</td>
                        </tr>
                    </tbody>
                </table>
                <form id="frmPayment" name="frmPayment" action="buy_pay_wait_ok" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$orderNo}}">
                    <input type="hidden" name="nCouponMoney" value="0">
                    <input type="hidden" name="t_type" value="{{$type}}">
                    <input type="hidden" name="p_type" value="m">
                    <input type="hidden" name="bankCode" value="">
                    <input type="hidden" name="code" id="code">
                    <input type="hidden" id="security_type" name="security_type" value="INCS">
                    <input type="hidden" name="price" value="">
                    <input type="hidden" name="mileage" value="0">
                    <input type="hidden" name="my_mileage" value="{{$buyer['mileage']}}">
                    <input type="hidden" id="other_pay" name="use_creditcard" value="{{number_format($buyer['mileage'])}}">
                    <input type="hidden" name="use_creditcard_original" value="{{$buyer['mileage']}}">
                    <div class="highlight_contextual_nodemon mt-15">결제정보</div>
                    <div @class('pay__info')>
                        <div class="card bg-success mb-3 fl" >
                            <div class="card-header">
                                구매금액
                                <span class="h_price fr"><span class="">{{number_format($payitem['price'])}}</span>원</span>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                        <div class="card bg-success mb-3 fr" >
                            <div class="card-header">
                                총 결제금액
                                <span class="h_price fr text-red">{{number_format($payitem['price'])}}원</span>
                            </div>
                            <div class="card-body">
                                <div @class('mb-5') style="clear: both;height: 20px">
                                    <span class="fl">내 마일리지</span>
                                    <span class="fr">{{number_format($buyer['mileage'])}}원</span>
                                </div>
                                <div @class('mb-5') style="clear: both;height: 20px">
                                    <span class="fl">게임 마일리지</span>
                                    <span class="fr">{{number_format(0)}}원</span>
                                </div>
                                <div style="clear: both;height: 20px">
                                    <div>사용할 마일리지</div>
                                    <div @class('mt-5') style="position: relative">
                                        <input style="width: 100%" type="text" class="angel__text text__new__green input__height__30 border__new_green" id="use_mileage" name="use_mileage" value="{{number_format($payitem['price'])}}" readonly disabled>
                                        <span @class('text__new__green') style="      position: absolute;
                                                            right: 8px;
                                                            top: 7px;">원</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

{{--                    <table class="table-striped table-green1">--}}
{{--                        <colgroup>--}}
{{--                            <col width="160">--}}
{{--                            <col>--}}
{{--                        </colgroup>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <th>상세설명</th>--}}
{{--                            <td style="    max-height: 150px;--}}
{{--                                            overflow-y: scroll;--}}
{{--                                            height: 150px;--}}
{{--                                            vertical-align: top;--}}
{{--                                        }">--}}
{{--                                <div id="js-gallery" class="mb-5">--}}
{{--                                    @foreach (\File::glob(public_path('assets/images/angel/'.$id).'/*') as $file)--}}
{{--                                        <a href="/{{ str_replace(public_path()."\\", '', $file) }}" class="slide">--}}
{{--                                            <img src="/{{ str_replace(public_path()."\\", '', $file) }}" class="g_top">--}}
{{--                                        </a>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                                {{$user_text}}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}

                    <div class="empty-high"></div>

                    <div class="highlight_contextual_nodemon gray pl-5 pt-5">상세설명</div>
                    <div class="detail_info">
                        <div class="detail_text">
                            <div id="js-gallery" class="mb-5">
                                @foreach (\File::glob(public_path('assets/images/angel/'.$id).'/*') as $file)
                                    <a href="/{{ str_replace(public_path()."\\", '', $file) }}" class="slide">
                                        <img src="/{{ str_replace(public_path()."\\", '', $file) }}" class="g_top">
                                    </a>
                                @endforeach
                            </div>
                            {{$user_text}}
                        </div>
                    </div>
                    <ul class="add_charge" id="add_charge">
                        <li>
                            <span class="bold_txt">추가 결제해야할 금액</span>
                        </li>
                        <li id="add_pay" class="price_font2">{{number_format($add_price)}}</li>
                        <li>
                            <span class="bold_txt">원</span> (<span class="pay_text">마일리지</span> 방식으로 해당 추가금액을 결제합니다.)
                        </li>
                    </ul>
                    <div class="empty-high"></div>
                    <div class="b_input_group">
                        <a href="javascript:void(0)"  onclick="Payment();" class="button-success">입금확인요청</a>
                        <a href="javascript:void(0)"  onclick="PaymentCancel();" id="cancel_btn"  class="button-cancel">구매취소</a>
                    </div>
                </form>
            </div>
            <form id="creditForm" name="creditForm" method="post">
                <input type="hidden" id="infoId" value="a68e5ed758fe86e630c7f30c1dbb221b">
                <input type="hidden" name="id" id="encryptId">
                <input type="hidden" name="type" id="encryptType">
            </form>
            <div id="dvGoodsInfo" class="modal_dialog green">
                <div class="modal__title">
                    <div class="title">물품신청정보</div>
                    <span class="modal__close" onclick="nodemonPopup.disable();">닫기</span>
                </div>
                <div class="modal--content">
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
                            <td><span class="clc3">{{number_format($payitem['price'])}}</span> 원 </td>
                        </tr>
                        <tr>
                            <th>구매자 캐릭터명</th>
                            <td class="text-blue_modern">{{$buyer['character']}}</td>
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

                    <div class="btn-groups_angel">
                        <a  onclick="fnSubmit()" class="btn-default btn-suc">확인</a>
                        <a  onclick="nodemonPopup.disable();" class="btn-default btn-cancel">취소</a>
                    </div>
                </div>
            </div>
            <div id="dialog_fade" class="modal_dialog"></div>
            <div class="empty-high"></div>
        </div>
    </div>
@endsection
