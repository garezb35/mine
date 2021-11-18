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

$user_phone1 = $user_phone2 = $user_phone3 = "";
$split_number = explode("-", $cuser['number']);
if(sizeof($split_number) == 3){
    $user_phone1 = $split_number[0];
    $user_phone2 = $split_number[1];
    $user_phone3 = $split_number[2];
}
@endphp
@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/css/common_myroom.css" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/buy_ing_view.css" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/common_list.css" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/myroom/buy/js/buy_ing_view.js"></script>
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
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        @include('aside.myroom',['group'=>'buy'])
        <div class="g_content">
            <a name="top"></a>
            <!-- ▼ 타이틀 //-->
            <div class="g_title_green">
                구매중인 <span>물품</span>
            </div>

            <form id="frmIngView" name="frmIngView" method="post">
                <input type="hidden" id="id" name="id" value="{{$orderNo}}" />
            </form>
            <!-- ▼ 물품정보 //-->
            <div class="g_subtitle first">물품정보</div>
            <table class="table-striped table-green1">
                <colgroup>
                    <col width="160" />
                    <col width="250" />
                    <col width="160" />
                    <col />
                </colgroup>
                <tbody>
                <tr>
                    <th>카테고리</th>
                    <td colspan="3">{{$category}}</td>
                </tr>
                <tr>
                    <th>물품제목</th>
                    <td colspan="3">
                        {{$user_text}}
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
                    <th>구매금액</th>
                    <td @if($c ==1) colspan="3" @endif>{{number_format($payitem['price'])}} 원</td>
                </tr>
                <tr>
                    <th>구매자 캐릭터명</th>
                    <td colspan="3">{{$payitem['character']}}</td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 물품정보 //-->
            <!-- ▼ 거래필수정보 //-->
            <div class="g_subtitle">판매자 정보</div>
            <table class="table-striped table-green1">
                <colgroup>
                    <col width="160" />
                    <col />
                </colgroup>
                <tbody>
                <tr>
                    <th>이름</th>
                    <td>{{$user['name']}}</td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td>
                        {{$user['home']}} / {{$user['number']}}
                    </td>
                </tr>
                <tr>
                    <th>판매자 캐릭터명</th>
                    <td>
                        <form id="frmDiffer" name="frmDiffer" method="post"></form>
                        {{$user_character}}
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="table-greenwith">
                <colgroup>
                    <col width="310px" />
                    <col width="*" />
                </colgroup>
                <tr>
                    <th class="p-left-10">
                        <div>
                            <img src="/mania/img/level/{{$user['roles']['icon']}}" width="37"/>
                            <span class="f_green4 f_bold">{{$user['roles']['alias']}}회원</span>&nbsp;&nbsp;&nbsp; (거래점수 : {{number_format($user['point'])}}점)
                        </div>
                    </th>
                    <td>
                        <dl class="add_info">
                            <dd>
                                <span class="w80 cert_state">인증상태</span>
                                <span class="con w80 btn_state">
                                        @if($user['mobile_verified'] == 1)
                                        <img src="/mania/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/mania/img/icons/icon_nocheck.png" width="14">
                                    @endif휴대폰</span>
                                <span class="on w80 btn_state">
                                        @if($user['bank_verified'] == 1)
                                        <img src="/mania/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/mania/img/icons/icon_nocheck.png" width="14">
                                    @endif계좌</span>
                                <span class="on w80 btn_state">
                                        @if($user['pin'] == 1)
                                        <img src="/mania/img/icons/icon_check.png" width="14">
                                    @else
                                        <img src="/mania/img/icons/icon_nocheck.png" width="14">
                                    @endif아이핀</span>
                                <span class="w80 btn_state">
                                        @if(!empty($user['email_verified_at']))
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
            <!-- ▲ 거래필수정보 //-->
            <!-- ▼ 내 개인정보 //-->
            <div class="g_subtitle">내 거래정보</div>
            <table class="table-striped">
                <colgroup>
                    <col width="160" />
                    <col />
                </colgroup>
                <tbody>
                <tr>
                    <th>이름</th>
                    <td>{{$cuser['name']}}</td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td>
                        {{$cuser['home']}} / {{$cuser['number']}}
                    </td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 내 개인정보 //-->
            <!-- ▼ 1:1 채팅 //-->
            <link rel="stylesheet" href="/mania/myroom/chat/css/chat.css" />
{{--            <script type="text/javascript" src="../chat/js/socket.io.js"></script>--}}
{{--            <script type="text/javascript" src="../chat/js/connect.js"></script>--}}
            <table class="noborder mt-15">
                <colgroup>
                    <col width="50%" />
                </colgroup>
                <tbody>
                    <tr>
                        <td class="vt p-left-0">
                            <!-- ▼ 상세설명 //-->
                            <div class="g_subtitle gray mt-0 p-left-10">상세설명</div>
                            <div class="detail_info">
                                <div class="detail_text">
                                    <div id="js-gallery" class="mb-5">
                                        @foreach (\File::glob(public_path('assets/images/mania/'.$id).'/*') as $file)
                                            <a href="/{{ str_replace(public_path()."\\", '', $file) }}" class="slide">
                                                <img src="/{{ str_replace(public_path()."\\", '', $file) }}" class="g_top">
                                            </a>
                                        @endforeach
                                    </div>
                                    {{$user_text}}
                                </div>
                            </div>
                        </td>
                        <td class="vt">
                            <script type="text/javascript" src="/mania/socket/socket.io.js"></script>
                            <script type="text/javascript" src="/mania/socket/connect.js"></script>
                            <div id="chat_wrapper" style="display: block;margin: 0px auto;">
                                <input id="CHAT_TOKEN" type="hidden" value="{{$orderNo}}">
                                <input id="CHAT_USER" type="hidden" value="buyer" />
                                <input id="CHAT_FIRST" type="hidden" value="1" />
                                <input id="CHAT_FILTER" type="hidden" value="YTo3OntzOjk6InVzZXJfdHlwZSI7czoxOiJTIjtzOjg6InRyYWRlX2lkIjtzOjE2OiIyMDIxMTAyNTA4NDQ0OTQyIjtzOjExOiJ0cmFkZV9tb25leSI7czo0OiI0MDAwIjtzOjg6ImJ1eWVyX2lkIjtzOjk6ImRsd2tkMTY0MCI7czo3OiJnc19uYW1lIjtzOjE5OiJBRkvslYTroIjrgph86riw7YOAIjtzOjk6ImdhbWVfY29kZSI7czo0OiI0NDQyIjtzOjExOiJzZXJ2ZXJfY29kZSI7czo1OiIxNjgxMCI7fQ==">
                                <div id="chat_notice">
                                    <span class="">(1:1 채팅) 거래 시 상대방과 통화후 거래 요망!</span>
                                </div>
                                <div id="chat_content_wrapper" style="height: 247px">
                                    <div id="chat_content" class="clear_fix">
                                        <ul id="chat_list_wrapper"></ul>
                                    </div>
                                </div>
                                <div id="chat_input_wrapper">
                                    <textarea id="chat" type="text" @if($status == 23 || $status == 32 || $status == -1) disabled @endif></textarea>
                                    <button id="send_btn">전송</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- ▲ 1:1 채팅 //-->
            <!-- ▼ 거래진행상황 //-->
            <!-- ▼ 판매진행안내 //-->
            <div class="trade_progress buy">
                <div class="g_subtitle">
                    거래 진행 상황
                    <div class="g_right">
                        <img
                            id="msg_box"
                            src="http://img3.itemmania.com/images/btn/btn_1vs1_talk.gif"
                            width="71"
                            height="20"
                            alt="1:1 대화함"
                            class="g_button"
                            onclick="_window.open('talk','/myroom/include/live.html?info=YQgPJ51PTFZv0crookaS|s4y4Vlxlu5tl5kqnayYO/MlE9y7Qs1K09S045soIpxCrQCOVWOvi0Pd3q/8YS3Jq|YLEWklNUPUPF1lHhcULg1zGDDBYIaZIkWS67bLHd4rMsppQa3lRPqOHWT77cBUPJV1pvHVY5gpaNFOMFm1oCvswk4KrPraXUKhl|XJV3Evtt0WSIPhNtWzzCPykoOj215eizUb01WrRAr1IpxzJ9xHPqmB3G8/0xq/TFPbX8UDOdu8/vEdv4nMThijqMfb3wj7V6oQbVM1gevJv5HFmezOZvK7Iy3Kjg93un9Dla5LbYY2y049WMrZaeaMStXkXSY8pLkyR|sFo5hzIz3BTSGTUbZUcGqJKuY|7W96qWFHSKeJuQYqUYTLmbhtG9kY6FNZUgdW/7SHySwx|Lqq7ZDOrww7Rj25WS1bjg7pOYVsAG44iSDK3zq9gRr7WYAwuo1D/jPCjBIQAhlnDaI9u68LMYBZl5E6pq3Qmz7C|o3/2xnVmGhrRWoqIjoYz1cBjQsxgFmXkTqmomm26hlatG8OqtgVOC5Cv6NAfsZPBbzpbgUVg4ik8AcKMMrRvgPH8GkszZTQV1MPGYxbb1Ykn61e05Rmjo7|vu5w1arHIx/xnD4QPzmpTeb|50bES3YDO9viATWMArRxJLAOYTRCNXKbkJslxB3WCoxSdwzhiZY/Nt5ePcv2sUALMYBZl5E6ppL|zQGyn40rkxIpqSb9M7khx2iUswrIRn2UwwEd3FeRdCxI3pHZDEXZz5EHt7lNZo4y3sbwR5lsOKK6NQjvdfYmCdEH6GDyzzaMZbAnC2rq',625,550)"
                            style="display: none;"
                        />
                    </div>
                </div>
                <div class="trade_progress_content">
                    <div class="guide_wrap">
                        <div class="guide_set @if($status == 0) {{'active'}}@endif">
                            <span class="SpGroup pay_wait_icon"></span>
                            <span class="state">입금대기</span>
                            <p>구매자가 입금을<br>준비하고 있습니다.<br>입금완료 후, 구매중 상태가<br>되면 거래를 시작해주세요.</p>
                            <i class="SpGroup arr_mini"></i>
                        </div>
                        <div class="guide_set @if(($status == 1) || (!str_contains($status, '2')  && $status != 10 && $status !=32 && $status !=23 && $status != 0)) {{'active'}}@endif">
                            <span class="SpGroup buy_ing_icon"></span>
                            <span class="state">구매중</span>
                            <p>
                                현재 판매자와 거래중입니다.<br />
                                판매자와 반드시 전화통화로<br />
                                거래하시기 바랍니다.<br />
                                [통화 불가 시 1:1대화함 사용]
                            </p>
                            <i class="SpGroup arr_mini"></i>
                        </div>
                        <div class="guide_set @if($status == 2) {{'active'}}@endif">
                            <span class="SpGroup trade_icon"></span>
                            <span class="state">인수완료</span>
                            <p>
                                거래종료 예정입니다.<br />
                                판매자가 인계확인 할 때까지<br />
                                기다려주세요.
                            </p>
                            <i class="SpGroup arr_mini"></i>
                        </div>
                        <div class="guide_set @if($status == 23 || $status == 32) {{'active'}}@endif">
                            <span class="SpGroup buy_complete_icon"></span>
                            <span class="state">구매완료</span>
                            <p>
                                거래가 정상적으로<br />
                                종료되었습니다.<br />
                                문제 발생 시<br />
                                고객센터로 문의해주세요.
                            </p>
                            <i class="SpGroup arr_mini"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="g_popup" id="dvTradeSellCheck">
                <div class="layer_title">
                    물품 인수 확인
                    <img class="btn_close" src="http://img3.itemmania.com/images/icon/popup_x.gif" width="15" height="15" alt="닫기" onclick="g_nodeSleep.disable();">
                </div>

                <form name="moneyreceipt" id="moneyreceipt" method="POST">
                    @csrf
                    <input type="hidden" name="process">
                    <input type="hidden" id="answer" name="answer">
                    <input type="hidden" id="character_sign" name="character_sign">
                    <div class="layer_content">
                        <div style="height: 86px;border: 1px solid #BBBBBB;">
                            <div id="goods_img" class="g_left"><img src="/mania/img/icons/cash-receipt.png" width="106" height="85" alt=""></div>
                            <ul id="goods_info" class="g_left g_black2">
                                <li><span class="bold_txt">판매자에게 물품을 받으셨습니까?</span></li>
                                <li>
                                    <span class="f_blue1 f_bold">물품 인수 확인</span> 후에는 거래 취소가 불가능합니다.<br>
                                    <span style="font-size:12px;">(물품 인수 확인은 판매자로부터 물품을 받으신 후 하시기 바랍니다.)</span>
                                </li>
                            </ul>
                        </div>
                        <div class="gray-div">
                            현금영수증
                        </div>
                        <div class="g_finish"></div>
                        <!-- ▼ 물품인수 버튼 //-->
                        <!-- ▲ 물품인수 버튼 //-->
                        <!-- ▼ 현금영수증 발급 폼 //-->
                        <table class="table-green1" id="receipt_table">
                            <colgroup>
                                <col width="164">
                                <col>
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>신청구분</th>
                                    <td>
                                        <input type="radio" id="moneyreceipt_check" name="moneyreceipt_check" value="ok" class="g_radio" disabled>
                                        <label for="moneyreceipt_check">발급</label>&nbsp;&nbsp;
                                        <input type="radio" id="moneyreceipt_check2" name="moneyreceipt_check" value="no" class="g_radio" checked="">
                                        <label for="moneyreceipt_check2">미발급</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>발급구분</th>
                                    <td>
                                        <input type="radio" name="moneyreceipt_type" value="u" class="g_checkbox" checked="" onclick="inputChange(1);"> 소득공제용 (일반개인용)
                                    </td>
                                </tr>
                                <tr>
                                    <th>신청자 성명</th>
                                    <td>
                                        <input type="text" name="moneyreceipt_name" class="g_text" value="{{$cuser['name']}}">
                                    </td>
                                </tr>
                                <tr id="juminnumber">
                                    <th>신청자 정보</th>
                                    <td>
                                        <div id="info_phone_div" class="sub_div">
                                            <input type="radio" name="member_info" id="info_phone" class="g_radio" value="p" checked="">
                                            <label for="info_phone">휴대폰 번호</label>
                                            <input type="text" name="user_phone1" id="user_phone1" class="g_text w50" maxlength="3" value="{{$user_phone1}}"> -
                                            <input type="text" name="user_phone2" id="user_phone2" class="g_text w50" maxlength="4" value="{{$user_phone2}}"> -
                                            <input type="text" name="user_phone3" id="user_phone3" class="g_text w50" maxlength="4" value="{{$user_phone3}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr style="border-bottom:1px solid #E2E2E2">
                                    <th>신청자 이메일</th>
                                    <td>
                                        <input type="text" class="g_text" name="moneyreceipt_email" size="23" style="width:200px;" value="{{$cuser['email']}}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="position-relative height30">
                            <div class="position-absolute border-one-gray w100"></div>
                            <div class="attention position-absolute"
                                 style="bottom: -6px;background: #fff; font-size: 14px;left: 217px;padding-left: 10px;padding-right: 10px;">현금영수증 발급 안내 & 조회</div>
                        </div>
                        <!-- ▲ 현금영수증 발급 폼 //-->
                        <!-- ▼ 현금영수증 발급 안내문 //-->
                        <ul class="box6 g_list">
                            <li class="list_non">* 현금영수증 미발급 시 승인번호만 발급됩니다. (마이룸 &gt; 현금영수증 발급에서 확인 가능)</li>
                            <li class="list_non">* 현금영수증 발급 안내 사항</li>
                            <li>보유하신 물품 판매시 판매수수료에 대한 현금영수증이 자동 발급됩니다.</li>
                            <li>이전에 발행 신청하신 고객님의 명의로 자동 발급됩니다.<br>(판매 시 현금영수증 신청 정보를 변경하실 수 있습니다.)</li>
                            <li class="list_non">* 현금영수증 조회</li>
                            <li>발급된 현금영수증은 '마이룸&gt;현금영수증' 메뉴 및 국세청 현금영수증 홈페이지에서 확인하실 수 있습니다.<br><span class="g_red1_b">(2일 후 반영됨)</span>
                            </li>
                        </ul>
                        <!-- ▲ 현금영수증 발급 안내문 //-->
                        <div class="g_finish"></div>
                        <div class="g_btn">
                            <a  class="first btn-default btn-suc" onclick="TradeComplete('',{{$payitem['price']}},'m','{{$orderNo}}','check','N');">물품 인수 확인</a>
                            <a  class="btn-default btn-cancel" onclick="g_nodeSleep.disable()">취소</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- ▲ 판매진행안내 //-->
            <!-- ▲ 거래진행상황 //-->

            <!--
        <div style="">
            <img src="/images/banner/etc/20150108_790_139_bitcoin.jpg" width="760" height="139" alt="비트코인 상품권 입점기념 EVENT" title="비트코인 상품권 입점기념 EVENT" usemap="#20150108_790_139_bitcoin">
            <map name="20150108_790_139_bitcoin">
                <area shape="rect" coords="521,82,697,118" href="http://giftcard.itemmania.com/portal/giftcard/bitcoin/" alt="상품권 발급받으러 가기" title="상품권 발급받으러 가기" />
            </map>
        </div>
        <div class="g_finish"></div>
        -->
            <!-- ▼ 물품인수시 주의사항 //-->
            <dl class="notice_box">
                <dt class="first">물품을 받기전에 꼭 읽어보세요!</dt>
                <dd>1. 판매자의 연락처가 다를 경우 거래를 중지하시고 고객센터를 통해 문의해 주시기 바랍니다.</dd>
                <dd>2. 게임상에서 거래할 캐릭터명이 위의 판매자 캐릭터명과 같은지 확인하시기 바랍니다.</dd>
                <dd>3. 거래시에는 게임상에서 채팅이나 귓말은 삼가하시고 가능하면 전화통화를 유지하시기 바랍니다.</dd>
                <dd>4. 반드시 물품을 정상적으로 인수하신 후 물품인수확인을 하시기 바랍니다.</dd>
            </dl>
            <!-- ▲ 물품인수시 주의사항 //-->
            <div class="g_btn">
                @if(!str_contains($status,2) && !str_contains($status,5) && !str_contains($status,6))
                <a href="javascript:void(0)" id="trade_btn" class="btn-default btn-suc">물품인수확인</a>
                @endif
                @if(!str_contains($status, 2))
                <a href="/buy/trade_cancel?id={{$orderNo}}" class="btn-default btn-cancel">
                    거래취소
                </a>
                @endif
            </div>
            <div class="g_finish"></div>


        </div>

        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
