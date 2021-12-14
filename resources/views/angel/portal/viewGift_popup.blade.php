@php
$money_range = json_decode($money);
@endphp
<html lang="ko">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link type="text/css" rel="stylesheet" href="/angel/_css/_comm.css">
    <link type="text/css" rel="stylesheet" href="/angel/_head_tail/css/_head_popup.css">
    <link type="text/css" rel="stylesheet" href="/angel/portal/giftcard/css/kspay.css">
    <link type="text/css" rel="stylesheet" href="/angel/_css/_table_list.css">
    <script type="text/javascript" src="/angel/_js/jquery.js"></script>
    <script type="text/javascript" src="/angel/_js/_comm.js"></script>
    <script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
    <link type="text/css" rel="stylesheet" href="/angel/_banner/css/banner_module.css">
    <script type="text/javascript" src="/angel/_banner/js/banner_module.js"></script>
</head>
<body>
<div id="g_SLEEP" class="g_sleep g_hidden ">
    <div id="g_OVERLAY" class="g_overlay"></div>
</div>
<div id="g_BODY">
    <div id="popup_title_bar">문화상품권 구매</div>
    <div id="g_POPUP">
        <form id="buy_form" name="buy_form" method="post" action="/portal/giftcard/giftcard_buy">
            <input type="hidden" name="alias" value="{{$alias}}">
            @csrf
            <!-- 금액선택 //-->
            <div class="g_subtitle_blue" id="first_title">금액선택</div>
            <div id="choice_pay">
                <table class="g_blue_table">
                    <colgroup>
                        <col width="204">
                        <col width="205">
                    </colgroup>
                    <tbody>
                    @if(!empty($money_range) && $money_range !=null && sizeof($money_range) > 0)
                    @foreach($money_range as $v)
                        <tr>
                            <th>{{number_format($v)}}원 권</th>
                            <td>
                                <select name="bill{{$v}}" class="g_select" onchange="CalcMoney('{{$user['mileage']}}');">
                                    <option value="">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                                매
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- 금액선택 //-->
            <!-- 결제정보 //-->
            <div class="g_subtitle_blue">결제정보</div>
            <table class="g_blue_table">
                <colgroup>
                    <col width="204">
                    <col width="205">
                </colgroup>
                <tbody>
                <tr>
                    <th>구매 가능한 마일리지</th>
                    <td><input type="text" class="g_text first" id="mile" value="{{number_format($user['mileage'])}} 원"></td>
                </tr>
                <tr>
                    <th>문화상품권 구매금액</th>
                    <td><input type="text" class="g_text" name="bookWon" value="-"></td>
                </tr>
                <tr>
                    <th>구매 후 내 마일리지</th>
                    <td><input type="text" class="g_text" name="mileageWon" value="-"></td>
                </tr>
                </tbody>
            </table>
            <div id="loding" style="display:none;margin-top:20px;text-align:center">
                <img src="http://img3.itemmania.com/images/portal/gift/loding.gif" width="250" height="40" alt="로딩중">
            </div>
            <div class="g_btn">
                <a  class="btn-default-medium btn-suc-rect" class="g_image first" id="giftcard_btn">구매</a>
                <a  class="btn-default-medium btn-cancel-rect" onclick="self.close();">취소</a>
{{--                <a  class="btn-default-medium btn-cancel-rect" onclick="_window.open('mileage', '/myroom/mileage/charge/index', 701, 900);">마일리지 충전</a>--}}
            </div>
            <!-- 결제정보 //-->
            <!-- 알아두기 //-->
            <div class="g_notice">알아두기</div>
            <ul class="g_notice_box1 g_list">
                <li>문화상품권는(은) 보유하신 사용 및 출금가능 마일리지로만 구매하실 수</li>
                <li class="list_non">있습니다.</li>
                <li>마일리지가 부족하신 경우에는 충전 후 이용 바랍니다.</li>
                <li>구매하신 문화상품권는(은) 마일리지로 환불 받으실 수 없습니다.</li>
            </ul>
            <!-- 알아두기 //-->
        </form>
        <script type="text/javascript"></script>
    </div>
</div>
<script type="text/javascript " src="/angel/_js/_window_new.js "></script>
<script type="text/javascript" src="/angel/portal/giftcard/js/event_promotion.js"></script>
<script type="text/javascript" src="/angel/portal/giftcard/js/kspay.js"></script>
<script type="text/javascript">
    _window.resize(460, 680);
    var user_Totmile = {{$user['mileage']}};

    /* ▼ 할인 이벤트 체크 */
    eventDiscount = '';
    eventPromotion = '';
    /* ▲ 할인 이벤트 체크  */

</script>
<script>_initialize();</script>
</body>
</html>
