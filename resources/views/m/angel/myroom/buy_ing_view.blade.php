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
@extends('layouts-angel.app')

@section('head_attach')

    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/buy/css/buy_ing_view.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/buy/css/common_list.css" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/buy/js/buy_ing_view.js"></script>
    <script>
        $(document).ready(function(){
            $("#request_cancel").click(function(){
                $("#Form_table").css('display','block');
            });
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
        })

    </script>
@endsection

@section('content')

    <div class="container_fulids" id="module-teaser-fullscreen">
        @include('aside.myroom',['group'=>'buy'])
        <div class="pagecontainer">
            <a name="top"></a>
            <div class="text-green_moderation">
                구매중인 <span>물품</span>
            </div>

            <form id="frmIngView" name="frmIngView" method="post">
                <input type="hidden" id="id" name="id" value="{{$orderNo}}" />
            </form>

            <div class="highlight_contextual_nodemon first">물품정보</div>
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
            <div class="highlight_contextual_nodemon">판매자 정보</div>
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
                            <img src="/angel/img/level/{{$user['roles']['icon']}}" width="37"/>
                            <span class="f_green4 font-weight-bold">{{$user['roles']['alias']}}회원</span>&nbsp;&nbsp;&nbsp; (거래점수 : {{number_format($user['point'])}}점)
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
                        <div class="float__right">
                            <a href="javascript:fnCreditViewCheck()"></a>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="highlight_contextual_nodemon">내 거래정보</div>
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
            <link rel="stylesheet" href="/angel/myroom/chat/css/chat.css" />
            <table class="noborder mt-15">
                <colgroup>
                    <col width="50%" />
                </colgroup>
                <tbody>
                    <tr>
                        <td class="vt p-left-0">

                            <div class="highlight_contextual_nodemon gray mt-0 p-left-10">상세설명</div>
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
                        </td>
                        <td class="vt">
                            <script type="text/javascript" src="/angel/socket/socket.io.js"></script>
                            <script type="text/javascript" src="/angel/socket/connect.js"></script>
                            <div id="chat_wrapper" style="display: block;margin: 0px auto;">
                                <input id="CHAT_TOKEN" type="hidden" value="{{$orderNo}}">
                                <input id="CHAT_IMAGE" type="hidden" value="{{$cuser['rimage']}}" />
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
            <div class="trade_progress buy">
                <div class="highlight_contextual_nodemon">
                    거래 진행 상황
                </div>
                <div class="trade_progress_content">
                    <div class="guide_wrap">
                        <div class="guide_set @if($status == 0) {{'active'}}@endif">
                            <span class="has-sprite pay_wait_icon"></span>
                            <span class="state">입금대기</span>
                            <p>구매자가 입금을<br>준비하고 있습니다.<br>입금완료 후, 구매중 상태가<br>되면 거래를 시작해주세요.</p>
                            <i class="has-sprite arr_mini"></i>
                        </div>
                        <div class="guide_set @if(($status == 1) || (!str_contains($status, '2')  && $status != 10 && $status !=32 && $status !=23 && $status != 0)) {{'active'}}@endif">
                            <span class="has-sprite buy_ing_icon"></span>
                            <span class="state">구매중</span>
                            <p>
                                현재 판매자와 거래중입니다.<br />
                                판매자와 반드시 전화통화로<br />
                                거래하시기 바랍니다.<br />
                                [통화 불가 시 1:1대화함 사용]
                            </p>
                            <i class="has-sprite arr_mini"></i>
                        </div>
                        <div class="guide_set @if($status == 2) {{'active'}}@endif">
                            <span class="has-sprite trade_icon"></span>
                            <span class="state">인수완료</span>
                            <p>
                                거래종료 예정입니다.<br />
                                판매자가 인계확인 할 때까지<br />
                                기다려주세요.
                            </p>
                            <i class="has-sprite arr_mini"></i>
                        </div>
                        <div class="guide_set @if($status == 23 || $status == 32) {{'active'}}@endif">
                            <span class="has-sprite buy_complete_icon"></span>
                            <span class="state">구매완료</span>
                            <p>
                                거래가 정상적으로<br />
                                종료되었습니다.<br />
                                문제 발생 시<br />
                                고객센터로 문의해주세요.
                            </p>
                            <i class="has-sprite arr_mini"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal_dialog" id="dvTradeSellCheck">
                <div class="modal__title">
                    물품 인수 확인
                    <span class="modal__close" onclick="nodemonPopup.disable();">닫기</span>
                </div>

                <form name="moneyreceipt" id="moneyreceipt" method="POST">
                    @csrf
                    <input type="hidden" name="process">
                    <input type="hidden" id="answer" name="answer">
                    <input type="hidden" id="character_sign" name="character_sign">
                    <div class="modal--content">
                        <div style="height: 86px;border: 1px solid #BBBBBB;">
                            <div id="goods_img" class="float-left"><img src="/angel/img/icons/cash-receipt.png" width="106" height="85" alt=""></div>
                            <ul id="goods_info" class="float-left g_black2">
                                <li><span class="bold_txt">판매자에게 물품을 받으셨습니까?</span></li>
                                <li>
                                    <span class="text-blue_modern font-weight-bold">물품 인수 확인</span> 후에는 거래 취소가 불가능합니다.<br>
                                    <span style="font-size:12px;">(물품 인수 확인은 판매자로부터 물품을 받으신 후 하시기 바랍니다.)</span>
                                </li>
                            </ul>
                        </div>
                        <div class="gray-div">
                            현금영수증
                        </div>
                        <div class="empty-high"></div>



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
                                        <input type="radio" name="moneyreceipt_type" value="u" class="angel_game_sel" checked="" onclick="inputChange(1);"> 소득공제용 (일반개인용)
                                    </td>
                                </tr>
                                <tr>
                                    <th>신청자 성명</th>
                                    <td>
                                        <input type="text" name="moneyreceipt_name" class="angel__text" value="{{$cuser['name']}}">
                                    </td>
                                </tr>
                                <tr id="juminnumber">
                                    <th>신청자 정보</th>
                                    <td>
                                        <div id="info_phone_div" class="sub_div">
                                            <input type="radio" name="member_info" id="info_phone" class="g_radio" value="p" checked="">
                                            <label for="info_phone">휴대폰 번호</label>
                                            <input type="text" name="user_phone1" id="user_phone1" class="angel__text w50" maxlength="3" value="{{$user_phone1}}"> -
                                            <input type="text" name="user_phone2" id="user_phone2" class="angel__text w50" maxlength="4" value="{{$user_phone2}}"> -
                                            <input type="text" name="user_phone3" id="user_phone3" class="angel__text w50" maxlength="4" value="{{$user_phone3}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr style="border-bottom:1px solid #E2E2E2">
                                    <th>신청자 이메일</th>
                                    <td>
                                        <input type="text" class="angel__text" name="moneyreceipt_email" size="23" style="width:200px;" value="{{$cuser['email']}}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="position-relative height30">
                            <div class="position-absolute border-one-gray w100"></div>
                            <div class="attention position-absolute"
                                 style="bottom: -6px;background: #fff; font-size: 14px;left: 217px;padding-left: 10px;padding-right: 10px;">현금영수증 발급 안내 & 조회</div>
                        </div>


                        <ul class="box6 g_list">
                            <li class="list_non">* 현금영수증 미발급 시 승인번호만 발급됩니다. (마이룸 &gt; 현금영수증 발급에서 확인 가능)</li>
                            <li class="list_non">* 현금영수증 발급 안내 사항</li>
                            <li>보유하신 물품 판매시 판매수수료에 대한 현금영수증이 자동 발급됩니다.</li>
                            <li>이전에 발행 신청하신 고객님의 명의로 자동 발급됩니다.<br>(판매 시 현금영수증 신청 정보를 변경하실 수 있습니다.)</li>
                            <li class="list_non">* 현금영수증 조회</li>
                            <li>발급된 현금영수증은 '마이룸&gt;현금영수증' 메뉴 및 국세청 현금영수증 홈페이지에서 확인하실 수 있습니다.<br><span class="g_red1_b">(2일 후 반영됨)</span>
                            </li>
                        </ul>

                        <div class="empty-high"></div>
                        <div class="btn-groups_angel">
                            <a  class="first btn-default btn-suc" onclick="TradeComplete('',{{$payitem['price']}},'m','{{$orderNo}}','check','N');">물품 인수 확인</a>
                            <a  class="btn-default btn-cancel" onclick="nodemonPopup.disable()">취소</a>
                        </div>
                    </div>
                </form>
            </div>
            <dl class="notice_box">
                <dt class="first">물품을 받기전에 꼭 읽어보세요!</dt>
                <dd>1. 판매자의 연락처가 다를 경우 거래를 중지하시고 고객센터를 통해 문의해 주시기 바랍니다.</dd>
                <dd>2. 게임상에서 거래할 캐릭터명이 위의 판매자 캐릭터명과 같은지 확인하시기 바랍니다.</dd>
                <dd>3. 거래시에는 게임상에서 채팅이나 귓말은 삼가하시고 가능하면 전화통화를 유지하시기 바랍니다.</dd>
                <dd>4. 반드시 물품을 정상적으로 인수하신 후 물품인수확인을 하시기 바랍니다.</dd>
            </dl>

            <div class="btn-groups_angel">
                @if(!str_contains($status,2) && !str_contains($status,5) && !str_contains($status,6)  && !str_contains($status,-1))
                <a href="javascript:void(0)" id="trade_btn" class="btn-default btn-suc">물품인수확인</a>
                @elseif($status == -1)
                <a href="javascript:void(0)" class="btn-default btn-suc disabled" disabled>거래취소됨</a>
                @endif
                @if($status == 0)
                <a href="/buy/trade_cancel?id={{$orderNo}}" class="btn-default btn-cancel">
                    거래취소
                </a>
                @elseif($status != 23 && $status !=32 && $status != -1 && $accept_flag == 0)
                <a href="javascript:;" class="btn-default btn-cancel" id="request_cancel">
                    취소요청
                </a>
                @elseif($accept_flag == 1)
                <a href="javascript:;" class="btn-default btn-cancel disabled" disabled>
                    취소요청됨
                </a>
                @endif
            </div>
            <div id="Form_table" style="display: none">
                <form name="form_member" id="form_member" method="post" enctype="multipart/form-data" action="/customer/report">
                    @csrf
                    <input type="hidden" name="a_code" value="A1" />
                    <input type="hidden" name="b_code" value="01" />
                    <input type="hidden" name="c_code" value="01" />
                    <input type="hidden" name="trade_num" value="" />
                    <input type="hidden" name="game_code" value="" />
                    <input type="hidden" name="server_code" value="" />
                    <input type="hidden" name="gs_name" value="" />
                    <table id="goods_table" class="g_gray_tb g_sky_table">
                        <colgroup>
                            <col width="130" />
                            <col width="690" /> </colgroup>
                        <tr>
                            <th>접수분야</th>
                            <td>
                                종료요청
                                <input type="hidden" name="type" value="1" >
                                <input type="hidden" name="orderNo" value="{{$orderNo}}" id="tradeNum2">
                            </td>
                        </tr>
                        <tr>
                            <th>이름</th>
                            <td>{{$cuser['name']}}</td>
                        </tr>
                        <tr>
                            <th>연락처</th>
                            <td class="h_auto">
                                <div id="myinfo" class="float-left g_black3_11"> 집(직장) : N{{$cuser['home']}}&nbsp;&nbsp;휴대폰 :
                                    {{$cuser['number']}}
                                    <br /> 정확한 연락처로 신고해 주세요.
                                    <br /> 연락처가 틀릴 경우 상담이 원활히 이루어지지 않을 수 있습니다. </div>
                                <div class="float__right"></div>
                            </td>
                        </tr>
                        <tr id="TR_trade_num">
                            <th>거래번호</th>
                            <td>#{{$orderNo}}<span id="tradeNum"></span></td>
                        </tr>
                        <tr class="m_tmp">
                            <th>취소이유</th>
                            <td class="h_auto">
                                <input type="radio" name="privates" value="상대방과 연락이 안됩니다." class="g_radio" checked>상대방과 연락이 안됩니다.
                                <br>
                                <input type="radio" name="privates" value="이미 팔린 물품 입니다" class="g_radio">이미 팔린 물품 입니다
                                <br>
                                <input type="radio" name="privates" value="잘못 등록 또는 신청한 물품 입니다" class="g_radio">잘못 등록 또는 신청한 물품 입니다
                                <br>
                                <input type="radio" name="privates" value="상대방이 직거래를 유도 합니다" class="g_radio">상대방이 직거래를 유도 합니다
                                <br>
                                <input type="radio" name="privates" value="상대방이 타사이트 거래를 유도 합니다" class="g_radio">상대방이 타사이트 거래를 유도 합니다
                                <br>
                                <input type="radio" name="privates" value="상대방이 가격 흥정을 합니다" class="g_radio">상대방이 가격 흥정을 합니다
                                <br>
                                <input type="radio" name="privates" value="기타 사유" class="g_radio">기타 사유 &nbsp; <input type="text" name="privates_txt">
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <th>통화가능번호</th>
                            <td>
                                <input type="text" name="user_phone1" class="angel__text" id="phone1" maxlength="3" /> -
                                <input type="text" name="user_phone2" class="angel__text" id="phone2" maxlength="4" /> -
                                <input type="text" name="user_phone3" class="angel__text" id="phone3" maxlength="4" /> <span class="g_black3_11">현재 통화 가능한 연락처를 남겨주세요.</span></td>
                        </tr>
                    </table>


                    <div class="btn-groups_angel">
                        <button class="btn-blue-img btn-color-img" type="submit">확인</button>
                        <button class="btn-gray-img btn-color-img" type="button">취소</button>
                    </div>

                </form>
            </div>
            <div class="empty-high"></div>
        </div>

        <div class="empty-high"></div>
    </div>

@endsection



