@php
$type_alias = '무료이용권';
$type = Request::get('free_use_item');
if($type == 'highlight')
    $type_alias = '물품강조';
if($type == 'quickicon')
    $type_alias = '퀵아이콘 ';
@endphp
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css">
    <link type="text/css" rel="stylesheet" href="/angel/_css/_table_list.css">
    <link type="text/css" rel="stylesheet" href="/angel/css/free_remainder_list.css?v=190220">
    <script type="text/javascript" src="/angel/_js/jquery.js"></script>
    <script type="text/javascript" src="/angel/_js/webpack.js"></script>
    <script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
    <script type="text/javascript" src="/angel/_js/loader.js"></script>
</head>
<body>
<div id="global_root" class="mainEntity d-none ">
    <div id="thirdys" class="fluid-div"></div>
</div>
<div id="angel">
    <div id="model_titlebar"><img src="http://img3.itemmania.com/images/myroom/title/title_free_cp.gif" alt="무료이용권 잔여수량" width="162" height="19"></div>
    <div id="g_POPUP">
        <div class="highlight_contextual g_black1_b">무료이용권 잔여수량</div>
        <div class="g_black3">{{$type_alias}} 무료 이용권 잔여수량</div>
        <table class="table-primary">
            <colgroup>
                <col width="135">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th>게임명</th>
                <th>지급</th>
            </tr>
            <tr>
                <td>전체</td>
                <td>{{$time}}</td>
            </tr>
            </tbody>
        </table>

        <div class="btn-groups_angel">
            <a class="btn-suc btn-default"  onclick="window.close();">확인</a>
        </div>
    </div>
</div>
<script type="text/javascript" src="/angel/_js/_window_new.js"></script>
<script type="text/javascript">_window.resize(440,400)</script>
<script>loadGlobalItems()</script>
</body>
</html>
