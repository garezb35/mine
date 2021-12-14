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
    <link type="text/css" rel="stylesheet" href="/angel/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/angel/_head_tail/css/_head_popup.css">
    <link type="text/css" rel="stylesheet" href="/angel/_css/_table_list.css">
    <link type="text/css" rel="stylesheet" href="/angel/css/free_remainder_list.css?v=190220">
    <script type="text/javascript" src="/angel/_js/jquery.js"></script>
    <script type="text/javascript" src="/angel/_js/_comm.js"></script>
    <script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
    <script type="text/javascript" src="/angel/_js/_common_initialize_new.js"></script>
</head>
<body>
<div id="g_SLEEP" class="g_sleep g_hidden ">
    <div id="g_OVERLAY" class="g_overlay"></div>
</div>
<div id="g_BODY">
    <div id="popup_title_bar">무료이용권 잔여수량</div>
    <div id="g_POPUP">
        <table class="table-striped table-green1">
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

        <div class="g_btn">
            <a class="btn-suc btn-default"  onclick="window.close();">확인</a>
        </div>
    </div>
</div>
<script type="text/javascript" src="/angel/_js/_window_new.js"></script>
<script type="text/javascript">_window.resize(440,400)</script>
<script>_initialize();</script>
</body>
</html>
