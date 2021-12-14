@php
    $user_phone1 = $user_phone2 = $user_phone3 = "";
    $split_number = explode("-", $cuser['number']);
    if(sizeof($split_number) == 3){
        $user_phone1 = $split_number[0];
        $user_phone2 = $split_number[1];
        $user_phone3 = $split_number[2];
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
@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css" />
    <link type="text/css" rel="stylesheet" href="/angel/sell/css/sell_ing_view.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/buy/css/common_list.css" />
    <script type="text/javascript" src="/angel/advertise/advertise_code_head.js"></script>
    <script type="text/javascript" src="/angel/_banner/js/banner_module.js"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/sell/js/sell_ing_view.js"></script>
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
        @include("aside.myroom",['group'=>'sell'])
        <input type="hidden" id="screenshot_info" value="TiUzQg==">
        <div class="g_content">
            <a name="top"></a>
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue noborder">
                판매중인 <span>물품</span>
            </div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <form id="frmIngView" name="frmIngView" method="post">
                @csrf
                <input type="hidden" id="id" name="id" value="{{$orderNo}}">
                <input type="hidden" id="process" name="process">
                <input type="hidden" id="trade_type" name="trade_type" value="c2VsbA==">
                <input type="hidden" id="answer" name="answer">
            </form>
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
                        {{$user_text}}
                    </td>
                </tr>
                <tr>
                    <th>거래번호</th>
                    <td>#{{$orderNo}}</td>
                    <th>등록일시</th>
                    <td>2021-10-25 17:31:04</td>
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
                    <td @if($c ==1)colspan="3" @endif>{{number_format($payitem['price'])}} 원 </td>
                </tr>
                <tr>
                    <th>판매자 캐릭터명</th>
                    <td colspan="3">{{$sell_character}}</td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 물품정보 //-->
            <!-- ▼ 구매자 정보 //-->
            <div class="g_subtitle">구매자 정보</div>
            <table class="table-striped table-green1">
                <colgroup>
                    <col width="160">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th>이름</th>
                    <td>{{$user['name']}}</td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td>
                        {{$user['home']}} / {{$user['number']}}</span>
                    </td>
                </tr>
                <tr>
                    <th>구매자 캐릭터명</th>
                    <td>
                        <form id="frmDiffer" name="frmDiffer" method="post"></form>
                        {{$buy_character}}
                    </td>
                </tr>
                <tr>
                    <th>구매자 거래정보</th>
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
                    </td>
                </tr>
                </tbody>
            </table>
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
                    <td>{{$cuser['name']}}</td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td>
                        {{$cuser['home']}} / {{$cuser['number']}} <span class="f_green2"></span>
                    </td>
                </tr>
                </tbody>
            </table>
            <!-- ▲ 내 개인정보 //-->
            <!-- ▲ 내 개인정보 //-->
            <!-- ▼ 1:1 채팅 //-->
            <link rel="stylesheet" href="/angel/myroom/chat/css/chat.css">
{{--            <script type="text/javascript" src="../chat/js/socket.io.js"></script>--}}
{{--            <script type="text/javascript" src="../chat/js/connect.js"></script>--}}
            <table class="noborder mt-15">
                <colgroup>
                    <col width="50%">
                </colgroup>
                <tbody>
                <td class="vt p-left-0">
                    <!-- ▼ 상세설명 //-->
                    <div class="g_subtitle gray mt-0 p-left-10">상세설명</div>
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
                        <input id="CHAT_USER" type="hidden" value="seller">
                        <input id="CHAT_FIRST" type="hidden" value="@if(!empty($privateMessage)){{1}}@else{{0}}@endif">
                        <input id="CHAT_FILTER" type="hidden" value="YTo3OntzOjk6InVzZXJfdHlwZSI7czoxOiJTIjtzOjg6InRyYWRlX2lkIjtzOjE2OiIyMDIxMTAyNTA4NDQ0OTQyIjtzOjExOiJ0cmFkZV9tb25leSI7czo0OiI0MDAwIjtzOjg6ImJ1eWVyX2lkIjtzOjk6ImRsd2tkMTY0MCI7czo3OiJnc19uYW1lIjtzOjE5OiJBRkvslYTroIjrgph86riw7YOAIjtzOjk6ImdhbWVfY29kZSI7czo0OiI0NDQyIjtzOjExOiJzZXJ2ZXJfY29kZSI7czo1OiIxNjgxMCI7fQ==">
                        <div id="chat_notice">
                            <span>(1:1 채팅) 거래 시 상대방과 통화후 거래 요망!</span>
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
                </tbody>
            </table>

            <!-- ▲ 1:1 채팅 //-->
            <!-- ▼ 거래진행상황 //-->
            <!-- ▼ 판매진행안내 //-->
            <div class="trade_progress">
                <div class="g_subtitle">
                    거래 진행 상황
                    <div class="g_right">
                        <img id="msg_box" src="http://img3.itemmania.com/images/btn/btn_1vs1_talk.gif" width="71" height="20" alt="1:1 대화함" class="g_button" onclick="_window.open('talk','/myroom/include/live.html?info=YQgPJ51PTFZv0crookaS|s4y4Vlxlu5t|gOnPKwN3APvgSA66Le0dDIuMlfbJV3lt44n8pv8txg|hi2Ja8wWvmRYn6YsvuMShaFqgKHL26jwPPTcCWfg1PLd/ksyGcZ2PmlWhK2QO9LX3Z1HH50FDOLy3Y/8GjaEToYYduZv54v6IkpA7Thc6qgNBP5Ar/ZIaSzNlNBXUw|8nbpR7yZkZcc0rf3MTZHpHWz3tftrQoMOsQvN00UW8tlp5oxK1eRdJjykuTJH6wXvzDNUp6W|JIUSr0sD2/owvdjjobmVgCbSzBhIh7lY0m2VKU|7RlhlA2efjoR1ZM5bWZcugLpfxJug3BumyNqvgevJv5HFmezOZvK7Iy3KjkM4vyMdAVuKCXDm/clvTDx3fHrzpW5l46mOowcY3bezFd|g34T35Ln1CKb0ULBsRmtcOiThsqeabYee9lDGOW6hH2zQrrrcq/2xCVNan|Cl2FgLvF76nFS6diqS74NPLfRxNnaZbQHsK6Ut3|X0/gEUweBg031GZmexmv/qTzIdVTxexYUSIkIuzBjRsxJhpVd/dnvQk0IDz0bdWJ68gCGcPhA/OalN5taX4DW5FTvNFfo4LVoqjP3Fi2jT|7EFotFdGk9tKORabgUVg4ik8AchwB4HTwk6UFBDapBQvzOHkIgJW3pv6J/niq3AJMt7Z4vFCWXQZkgESudTT2/bBobd/E3uP0KX01WusmLX7AmvCmXxesy|HglWV/DsBrB1D/Y0nEXsjKu4JTCJuF7S5g0LMYBZl5E6ppL|zQGyn40rkxIpqSb9M7khx2iUswrIRn2UwwEd3FeRdCxI3pHZDEUsP8H1yQ/MoA==',625,550);" style="display: none;">
                    </div>
                </div>
                <div class="trade_progress_content">
                    <div class="guide_wrap">
                        <div class="guide_set">
                            <span class="SpGroup pay_wait_icon"></span>
                            <span class="state">입금대기</span>
                            <p>구매자가 구매신청 후<br>입금을 준비하고 있습니다.<br>입금완료 후, 판매중 상태가<br>되면 거래를 시작해주세요.</p>
                            <i class="SpGroup arr_mini"></i>
                        </div>
                        <div class="guide_set  @if(($status == 1) || (!str_contains($status, '3')  && $status != 10 && $status !=32 && $status !=23 )) {{'active'}}@endif">
                            <span class="SpGroup sell_ing_icon"></span>
                            <span class="state">판매중</span>
                            <p>현재 구매자와 거래중입니다.<br>구매자와 반드시 전화통화로<br>거래할 캐릭터명을 확인 후<br>물품을 건네시기 바랍니다.
                            </p>
                            <i class="SpGroup arr_mini"></i>
                        </div>
                        <div class="guide_set @if($status == 3) {{'active'}} @endif">
                            <span class="SpGroup trade_icon"></span>
                            <span class="state">인계완료</span>
                            <p>거래종료 예정입니다.<br>구매자가 인수할때까지<br>기다려주세요.</p>
                            <i class="SpGroup arr_mini"></i>
                        </div>
                        <div class="guide_set @if($status == 23 || $status == 32) {{'active'}} @endif">
                            <span class="SpGroup sell_complete_icon"></span>
                            <span class="state">판매완료</span>
                            <p>거래가 정상적으로<br>종료되었습니다.<br>문제 발생 시<br>고객센터로 문의해주세요.</p>
                            <i class="SpGroup arr_mini"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ▲ 판매진행안내 //-->        <!-- ▲ 거래진행상황 //-->
            <!-- ▲ 거래필수정보 //-->
            <!-- ▼ 거래진행상황 //-->
            <!--
               <div style="">
                   <img src="/images/banner/etc/20150108_790_139_bitcoin.jpg" width="760" height="139" alt="비트코인 상품권 입점기념 EVENT" title="비트코인 상품권 입점기념 EVENT" usemap="#20150108_790_139_bitcoin">
                   <map name="20150108_790_139_bitcoin">
                       <area shape="rect" coords="521,82,697,118" href="http://giftcard.itemmania.com/portal/giftcard/bitcoin/" alt="상품권 발급받으러 가기" title="상품권 발급받으러 가기" />
                   </map>
               </div>
               <div class="g_finish"></div>
               -->        <!-- ▲ 거래진행상황 //-->
            <div class="g_finish"></div>
            <!-- ▼ 물품인계시 주의사항 //-->
            <dl id="transfer_info" class="notice_box">
                <dt>물품을 넘겨주기전에 꼭 읽어보세요!</dt>
                <dd>1. 구매자의 연락처가 다를경우 거래를 중지하시고 고객센터를 통해 문의해 주시기 바랍니다.</dd>
                <dd>2. 게임상에서 거래할 캐릭터명이 위의 구매자 캐릭터명과 같은지 확인하시기 바랍니다.</dd>
                <dd>3. 거래시에는 게임상에서 채팅이나 귓말은 삼가하시고 가능하면 전화통화를 유지하시기 바랍니다.</dd>
                <dd>4. 반드시 물품을 정상적으로 인계하신 후 물품인계확인을 하시기 바랍니다.</dd>
                <dd>5. 거래취소 SMS 수신 후 1시간 이내 인계확인이 되지 않을 경우 거래가 자동취소 될 수 있으니 유의하시기 바랍니다.</dd>
            </dl>
            <!-- ▲ 물품인계시 주의사항 //-->
            <div class="g_btn">
                @if(!str_contains($status, 3))
                    <a  class="first btn-default btn-suc" id="trade_btn" onclick="popLayer_2('dvTradeSellCheck');">물품인계확인</a>
                @endif
                @if($status != 23 && $status != 32 )
                        <a   id="cancel_btn" onclick="popLayer('trade_cancel');" class="btn-default btn-cancel">거래취소</a>
                @endif
            </div>

        </div>
        <form id="creditForm" name="creditForm" method="post">
            <input type="hidden" id="infoId" value="a68e5ed758fe86e630c7f30c1dbb221b">
            <input type="hidden" name="id" id="encryptId">
            <input type="hidden" name="type" id="encryptType">
        </form>
        <!-- ▼ 팝업 레이어 //-->
        <!-- ▼ 물품 인계 확인 //-->
        <div class="g_popup" id="dvTradeSellCheck">
            <div class="layer_title">
                물품 인계 확인
                <img class="btn_close" src="http://img2.itemmania.com/images/icon/popup_x.gif" width="15" height="15" alt="닫기" onclick="g_nodeSleep.disable();">
            </div>
            <form name="moneyreceipt" id="moneyreceipt">
                @csrf
                <input type="hidden" id="process" name="process">
                <input type="hidden" id="answer" name="answer">
                <div class="layer_content">
                    <div style="height: 86px;border: 1px solid #BBBBBB;">
                        <div id="goods_img" class="g_left"><img src="/angel/img/icons/cash-receipt.png" width="106" height="85" alt=""></div>
                        <ul id="goods_info" class="g_left g_black2">
                            <li><span class="bold_txt">구매자에게 물품을 건네주셨습니까?</span></li>
                            <li><span class="bold_txt g_blue1_b">물품 인계 확인</span>은 구매자에게 물품을 건네주신 후 하시기 바랍니다.</li>
                        </ul>
                    </div>
                    <div class="gray-div">
                        현금영수증
                    </div>
                    <div class="g_finish"></div>
                    <!-- ▼ 물품인계 버튼 //-->

                    <!-- ▲ 물품인계 버튼 //-->
                    <!-- ▼ 현금영수증 발급 폼 //-->
                    <table class="table-green1 mt-5">
                        <colgroup>
                            <col width="164">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th>신청구분</th>
                            <td>
                                <input type="radio" id="moneyreceipt_check1" name="moneyreceipt_check" value="ok" class="g_radio"><label for="moneyreceipt_check1">발급</label>&nbsp;&nbsp;
                                <input type="radio" id="moneyreceipt_check2" name="moneyreceipt_check" value="no" class="g_radio" checked=""><label for="moneyreceipt_check2">미발급</label>
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
                                    휴대폰번호&nbsp;&nbsp;&nbsp;
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
                        <a  class="first btn-default btn-suc" onclick="TradeComplete('Y29tcGxldGU=','{{$orderNo}}','check','N');">물품인계 확인</a>
                        <a  class="btn-default btn-cancel"  onclick="g_nodeSleep.disable();">취소</a>
                    </div>
                </div>
            </form>
        </div>
        <!-- ▲ 물품 인계 확인 //-->
        <!-- ▼ 거래 취소시 //-->
        <div id="trade_cancel" class="g_popup">
            <form id="frmIngViewCancel" name="frmIngViewCancel" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="2021111401457996">
                <input type="hidden" name="process">
                <input type="hidden" name="trade_type" value="c2VsbA==">
                <input type="hidden" name="trade_rereg">
                <div class="layer_title">
                    <img src="http://img3.itemmania.com/images/myroom/title/titles_deal_cancel.gif" width="72" height="19" alt="거래 취소">
                    <img class="btn_close" src="http://img4.itemmania.com/images/icon/popup_x.gif" width="15" height="15" alt="닫기" onclick="g_nodeSleep.disable();">
                </div>
                <div class="layer_content">
                    <div class="gray_box">판매자의 거래 취소는 즉시 취소가 됩니다.</div>
                    <div class="g_finish"></div>
                    <table class="g_blue_table table-striped">
                        <colgroup>
                            <col width="160">
                            <col width="350">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th>거래번호</th>
                            <td>#{{$orderNo}}&nbsp;</td>
                        </tr>
                        <tr>
                            <th>취소사유</th>
                            <td>
                                <select id="SELECT_CANCEL" name="cancel_contents" class="g_hidden" onchange="cancel_select(arguments[0])">
                                    <option value="">선택해 주세요</option>
                                    <option value="1">상대방 연락 안됨</option>
                                    <option value="2">이미 팔린 물품</option>
                                    <option value="3">잘못 등록 또는 신청한 물품</option>
                                    <option value="4">상대방이 직거래 유도</option>
                                    <option value="5">상대방이 타사이트 거래 유도</option>
                                    <option value="6">상대방이 가격 흥정 요청</option>
                                    <option value="7">기타 사유</option>
                                </select>
                            </td>
                        </tr>
                        <tr id="cancelDetail" style="display:none;">
                            <th>사유내용</th>
                            <td>
                                <textarea name="CANCEL_DETAIL_CONTENT" id="CANCEL_DETAIL_CONTENT" cols="42" rows="5" class="g_textarea"></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <ul class="g_list">
                        <li>흥정거래 프리미엄 등록 물품은 거래 취소 시 등록된 물품이 삭제 처리됩니다.</li>
                    </ul>
                    <div class="g_btn">
                        <a  href="javascript:void(0)" alt="거래취소" class="btn-default btn-suc" onclick="TraceCancel('order_cancel','{{$orderNo}}');">거래취소</a>
                        <a  href="javascript:void(0)" class="btn-default btn-cancel" onclick="g_nodeSleep.disable();">닫기</a>
                    </div>
                </div>
            </form>
        </div>
        <!-- ▲ 거래 취소시 //-->
        <div id="trade_reserve" class="g_popup">
            <div class="layer_title">
                <img src="http://img3.itemmania.com/images/myroom/title/pop_title_selling.gif" width="108" height="20" alt="판매금액 적립">
                <img class="btn_close" src="http://img4.itemmania.com/images/icon/popup_x.gif" width="15" height="15" alt="닫기" onclick="g_nodeSleep.disable();">
            </div>
            <div class="layer_content">
                <div>거래 종료 후 판매 금액의 적립 방법을 선택해 주시기 바랍니다.</div>
                <table class="g_blue_table">
                    <colgroup>
                        <col width="210">
                        <col width="420">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th>
                            <input type="radio" name="sell_reserve" id="sell_reserve1" value="milage" class="g_radio" checked="checked">
                            <label for="sell_reserve1">마일리지로 적립하기</label>
                        </th>
                        <td>회원님의 아이디에 마일리지가 즉시 적립됩니다.</td>
                    </tr>
                    <tr>
                        <th>
                            <input type="radio" name="sell_reserve" id="sell_reserve2" value="phone" class="g_radio">
                            <label for="sell_reserve2">휴대폰 번호로 즉시 출금하기</label>
                        </th>
                        <td>
                            등록된 휴대폰 번호 <span class="g_red1_b">010-2614-3654</span> 으로 즉시 출금 됩니다.<br>
                            <img src="http://img3.itemmania.com/images/btn/btn_phone2.gif" width="149" height="22" alt="등록된 휴대폰번호 변경하기" class="g_button" onclick="fnPaymentPhone('2021102508444942', 'sell');">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="g_notice_box1" style="margin-top:10px">
                    <div class="g_black2_b">[알아두기]</div>
                    "휴대폰 번호로 즉시 출금하기" 서비스의 경우 Tcash(티캐시) APP 설치가 이루어져야 합니다.<br>
                    "휴대폰 번호로 즉시 출금하기” 서비스는 최종 거래 종료 시점 기준 아래 사항에 해당하는 경우 마일리지로 적립 될 수 있는 점 참고 바랍니다.<br>
                    1. TCash 정기 점검(23:30 ~ 익일 00:30) 또는 긴급 점검 시<br>
                    2. 통신실패 및 서버에러 발생 시<br>
                    3. 휴대폰번호 출금한도 월 2,000만원 초과 시
                </div>
                <div class="g_btn">
                    <img src="http://img3.itemmania.com/images/btn/btn_popup_enter.gif" width="63" height="34" alt="확인" class="first" id="btn_reserve" onclick="popLayer_2('dvTradeSellCheck');">
                    <img src="http://img2.itemmania.com/images/btn/btn_popup_cancel.gif" width="63" height="34" alt="취소" onclick="g_nodeSleep.disable();">
                </div>
            </div>
        </div>

        <!-- ▲ 팝업 레이어 //-->
        <div class="g_finish"></div>
    </div>
@endsection
