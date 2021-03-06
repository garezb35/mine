@php
$money_range = json_decode($money);
@endphp
<html lang="ko">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
    <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css">
    <link type="text/css" rel="stylesheet" href="/angel/portal/giftcard/css/kspay.css">
    <link type="text/css" rel="stylesheet" href="/angel/_css/_table_list.css">
    <script type="text/javascript" src="/angel/_js/jquery.js"></script>
    <script type="text/javascript" src="/angel/_js/webpack.js"></script>
    <script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
    <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel_plugin.css">
    <script type="text/javascript" src="/angel/carsouel_plugin/js/carsouel_plugin.js"></script>
</head>
<body>
<div id="global_root" class="mainEntity d-none ">
    <div id="thirdys" class="fluid-div"></div>
</div>
<div id="angel">
    <div id="model_titlebar">문화상품권 구매</div>
    <div id="g_POPUP">
        <form id="buy_form" name="buy_form" method="post" action="/portal/giftcard/giftcard_buy">
            <input type="hidden" name="alias" value="{{$alias}}">
            @csrf

            <div class="highlight_contextual" id="first_title">금액선택</div>
            <div id="choice_pay">
                <table class="table-primary">
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


            <div class="highlight_contextual">결제정보</div>
            <table class="table-primary">
                <colgroup>
                    <col width="204">
                    <col width="205">
                </colgroup>
                <tbody>
                <tr>
                    <th>구매 가능한 마일리지</th>
                    <td><input type="text" class="angel__text first" id="mile" value="{{number_format($user['mileage'])}} 원"></td>
                </tr>
                <tr>
                    <th>문화상품권 구매금액</th>
                    <td><input type="text" class="angel__text" name="bookWon" value="-"></td>
                </tr>
                <tr>
                    <th>구매 후 내 마일리지</th>
                    <td><input type="text" class="angel__text" name="mileageWon" value="-"></td>
                </tr>
                </tbody>
            </table>
            <div class="btn-groups_angel">
                <a  class="btn-default-medium btn-suc-rect" class="v_middle_img first" id="giftcard_btn">구매</a>
                <a  class="btn-default-medium btn-cancel-rect" onclick="self.close();">취소</a>
            </div>


            <div class="g_notice">알아두기</div>
            <ul class="g_notice_box1 g_list">
                <li>문화상품권는(은) 보유하신 사용 및 출금가능 마일리지로만 구매하실 수</li>
                <li class="list_non">있습니다.</li>
                <li>마일리지가 부족하신 경우에는 충전 후 이용 바랍니다.</li>
                <li>구매하신 문화상품권는(은) 마일리지로 환불 받으실 수 없습니다.</li>
            </ul>

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
    eventDiscount = '';
    eventPromotion = '';

</script>
<script>loadGlobalItems()</script>
</body>
</html>
