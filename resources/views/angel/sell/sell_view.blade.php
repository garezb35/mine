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
    $price = 0;
    if($user_goods_type != 'division')
        $price = $user_price;
    if($user_goods_type == 'division')
        $price = $user_division_price;
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
    $unit = '';
    if($gamemoney_unit != 1 && !empty($gamemoney_unit)){
        $unit = $gamemoney_unit;
    }
@endphp
@extends('layouts-mania.app')

@section('head_attach')
    <link type='text/css' rel='stylesheet' href='/angel/sell/css/view.css'>
@endsection

@section('foot_attach')
    <script type='text/javascript' src='/angel/sell/js/view.js'></script>
    <script type='text/javascript'>
        g_trade_info.sale = '{{$user_goods_type}}';
        g_trade_info.trade_money = {{$price}};
        function __init() {
            g_trade_info.goods='';
        }
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
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <input type="hidden" id="screenshot_info" value="TiUzQg==">
        @include('aside.sell-buy_view',['group'=>'sell'])
        <div class="g_content">
            <div class="g_title_noborder"> 팝니다
            </div>
            <a name="top"></a>
            <form name="frmSell" id="frmSell">
                <div class="g_subtitle">물품정보 </div>
                @if($user_goods_type == 'general')
                <table class="table-striped table-green1">
                    <colgroup>
                        <col width="160">
                        <col width="250">
                        <col width="160">
                        <col /> </colgroup>
                    <tr>
                        <th>카테고리</th>
                        <td colspan="3">{{$category}}</td>
                    </tr>
                    <tr>
                        <th>물품제목</th>
                        <td colspan="3">{{$user_title}}
                        </td>
                    </tr>
                    <tr>
                        <th>거래번호</th>
                        <td>#{{$orderNo}}</td>
                        <th>등록일시</th>
                        <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                    </tr>
                    <tr>
                        <th>거래유형</th>
                        <td colspan="3">일반</td>
                    </tr>

                    <tr>
                        @php
                            $gamemoney_unit = $gamemoney_unit ?? '';
                            $user_quantity = $user_quantity ?? '';
                            $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                        @endphp
                        @if($c != 1)
                            <th class="bg-white">구매수량</th>
                            <td>{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit : ''}} {{$good_type ?? ''}}</td>
                        @endif
                        <th>구매금액</th>
                        <td @if($c == 1) colspan='3' @endif>{{number_format($price)}}원</td>
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
                        <td colspan="3">
                        {{$user_title}}
                            <!-- 퀵 아이콘 -->
                        </td>
                    </tr>
                    <tr>
                        <th>거래번호</th>
                        <td>#{{$orderNo}}</td>
                        <th>등록일시</th>
                        <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                    </tr>
                    <tr>
                        <th>최소구매수량</th>
                        <td>{{number_format($user_quantity_min)}}{{$unit}} 개</td>
                        <th>최대구매수량</th>
                        <td>{{number_format($user_quantity_max)}}{{$unit}} 개</td>
                    </tr>
                    <tr>
                        <th>단위금액</th>
                        <td>{{number_format($user_division_unit)}}{{$unit}}개당 {{number_format($user_division_price)}}원</td>
                        <th>구매할인</th>
                        <td>
                            @if($discount_use == 1)
                                {{$discount_quantity_cnt * $user_division_unit}}개 당 {{number_format($discount_price)}}원 할인
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
                @endif
                @if($user_goods_type == 'bargain')
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
                            {{$user_title}}
                            <!-- 퀵 아이콘 -->
                        </td>
                    </tr>
                    <tr>
                        <th>거래번호</th>
                        <td>#{{$orderNo}}</td>
                        <th>등록일시</th>
                        <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                    </tr>
                    <tr>
                        <th>즉시판매금액</th>
                        <td colspan="3">{{number_format($user_price)}}원</td>
                    </tr>
                    </tbody>
                </table>
                @endif
            </form>
            <div class="g_subtitle"> 판매자정보
            </div>
            <table class="table-greenwith">
                <colgroup>
                    <col width="310px" />
                    <col width="*" />
                </colgroup>
                <tbody>
                    <tr>
                        <th class="p-left-10">
                            <div>
                                <img src="/angel/img/level/{{$user['roles']['icon']}}" width="37"/>
                                <span class="f_green4 f_bold">{{$user['roles']['alias']}}회원</span>&nbsp;&nbsp;&nbsp; (거래점수 : {{number_format($user['point'])}}점)
                            </div>
                        </th>
                        <td>
                            <dl class="add_info">
                                <dd>
                                    <span class="w80 cert_state">인증상태</span>
                                    <span class="con w80 btn_state">
                                        @if($user['mobile_verified'] == 1)
                                            <img src="/angel/img/icons/icon_check.png" width="14">
                                        @else
                                            <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                        @endif휴대폰</span>
                                    <span class="on w80 btn_state">
                                        @if($user['bank_verified'] == 1)
                                            <img src="/angel/img/icons/icon_check.png" width="14">
                                        @else
                                            <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                        @endif계좌</span>
                                    <span class="on w80 btn_state">
                                        @if($user['pin'] == 1)
                                            <img src="/angel/img/icons/icon_check.png" width="14">
                                        @else
                                            <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                        @endif아이핀</span>
                                    <span class="w80 btn_state">
                                        @if(!empty($user['email_verified_at']))
                                            <img src="/angel/img/icons/icon_check.png" width="14">
                                        @else
                                            <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                        @endif이메일</span>

                                </dd>
                            </dl>
                            <div class="g_right">
                                <a href="javascript:fnCreditViewCheck()"></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="noborder">
                <colgroup>
                    <col width="50%" />
                </colgroup>
                <tbody>
                    <tr>
                        <td class="vt p-left-0">
                            <!-- ▼ 상세설명 //-->
                            <div class="g_subtitle gray mt-0" style="padding-left: 6px"> 상세설명
                                <a href="javascript:;" class="wideview"  id="wideview" style="margin-right: 6px">열기▼</a>
                            </div>
                            <div class="detail_info bg-white" id="detail_info">
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
                            <div class="g_finish"></div>
                        </td>
                        <td class="vt p-right-0">
                            <div class="g_subtitle mt-0">거래 사기 실시간 조회 서비스</div>
                            <div class="trade_fraud" id="trade_fraud">
                                <div class="text-center mb-5"> - 물품등록의 거래사기 피해사례를 확인하세요 <a href="javascript:;" data-type="user" class="srh_btn">조회</a>
                                    <input type="hidden" id="FraudTrade_id" value="2021101408177351"> </div>
                                <div class="direct text-center">
                                    <input type="text" name="srh_txt" id="srh_txt" class="g_text text-left" placeholder="휴대폰번호/계좌번호"> <a href="javascript:;" data-type="direct" class="srh_btn">조회</a> </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="g_btn_wrap">
                @if($user_goods_type == 'general' || $user_goods_type == 'division')
                    <a href="/sell/application?id={{$orderNo}}" class="btn-default btn-suc">구매신청</a>
                @endif
                @if($user_goods_type == 'bargain')
                    <a href="/sell/application?id={{$orderNo}}&amp;" class="btn-default btn-suc">즉시 구매</a>
                    <a href="javascript:void(0);" class="btn-default btn-cancel" onclick="g_nodeSleep.enable($('#dvPopup'));">흥정신청</a>
                @endif
            </div>
        </div>
        @if($user_goods_type == 'bargain')
            <div id="dvPopup" class="g_popup dvPopup">
                <form id="frmbaRequest" name="frmbaRequest" action="/sell/application_ba_ok" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$orderNo}}">
                    <input type="hidden" name="inputList" value="">
                    <input type="hidden" name="inputContinue" value="">
                    <input type="hidden" name="ba_deny_money" value="{{$user_price_limit}}">
                    <input type="hidden" name="user_contactA" id="user_contactA" value="{{$home_a}}">
                    <input type="hidden" name="user_contactB" id="user_contactB" value="{{$home_b}}">
                    <input type="hidden" name="user_contactC" id="user_contactC" value="{{$home_c}}">
                    <input type="hidden" name="slctMobile_type" id="slctMobile_type" value="1">
                    <input type="hidden" name="user_mobileA" id="user_mobileA" value="{{$mobile_a}}">
                    <input type="hidden" name="user_mobileB" id="user_mobileB" value="{{$mobile_b}}">
                    <input type="hidden" name="user_mobileC" id="user_mobileC" value="{{$mobile_c}}">
                    <input type="hidden" name="user_without" id="user_without" value="1">
                    <input type="hidden" name="trade_kind" id="trade_kind" value="1">
                    <div class="layer_title">
                        <div class="title">흥정신청</div>
                        <img class="btn_close" src="http://img1.itemmania.com/images/icon/popup_x.gif" width="15" height="15" alt="닫기" onclick="g_nodeSleep.disable($('#dvPopup'));">
                    </div>
                    <div class="layer_content">
                        <!-- ▼ 주문상품정보 //-->
                        <div class="g_subtitle first">주문상품정보</div>
                        <table class="table-green1">
                            <colgroup>
                                <col width="150">
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
                                <tr>
                                    <th>즉시판매금액</th>
                                    <td>{{number_format($user_price)}}원 (최소흥정 가능금액: {{number_format($user_price_limit)}}원 이상)</td>
                                </tr>
                                <tr>
                                    <th>흥정신청금액</th>
                                    <td>
                                        <input type="text" name="ba_money" maxlength="10" class="g_text" style="text-align:right;"> 원
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- ▲ 주문상품정보 //-->
                        <!-- ▼ 개인정보 //-->
                        <div class="g_subtitle">
                            <div class="g_left">개인정보</div>
{{--                            <div class="g_right">--}}
{{--                                <a href="#" onclick="_window.open('private_edit','/user/contact_edit',420,300);"><img src="http://img4.itemmania.com/images/btn/btn_call_edit.gif" width="84" height="20" alt="연락처 수정"></a>--}}
{{--                            </div>--}}
                        </div>
                        <table class="table-green1">
                            <colgroup>
                                <col width="150">
                                <col>
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>구매자 캐릭터명</th>
                                    <td class="character_area">
                                        <div class="g_left">
                                            <input type="text" name="user_character" class="g_text" maxlength="30" id="user_character"> 물품을 전달 받으실 본인의 캐릭터명
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>연락처</th>
                                    <td>
                                        <div class="g_left">
                                            <span id="spnUserPhone">{{$cuser['home']}}</span> / <span id="spnUserCell">{{$cuser['number']}}</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- ▲ 개인정보 //-->
                        <ul class="box6 g_list mt-10">
                            <li>흥정하기 기능은 마일리지 결제만 가능합니다.</li>
                            <li>판매자가 해당 금액에 흥정을 수락하면 1시간 이내에 결제하셔야 합니다..</li>
                            <li>흥정요청 후 1시간 동안 판매자의 응답이 없을 경우 해당 흥정신청은 자동 취소됩니다.</li>
                            <li>판매자가 흥정신청을 거부하면 재신청이 불가하오니 신중히 신청해주시기 바랍니다.</li>
                        </ul>
                        <div class="g_btn">
                            <a href="javascript:void(0)" class="btn-default btn-suc" onclick="$('#frmbaRequest').submit();">흥정신청</a>
                            <a href="javascript:void(0)" class="btn-default btn-cancel" onclick="g_nodeSleep.disable();">취소</a>
                        </div>
                    </div>
                </form>
            </div>
        @endif

        <form id="creditForm" name="creditForm" method="post">
            <input type="hidden" id="infoId" value="d8b16a8a27778da8792dc32e5d5aaeb7">
            <input type="hidden" name="id" id="encryptId">
            <input type="hidden" name="type" id="encryptType"> </form>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->

@endsection

