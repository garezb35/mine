@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/myroom/mileage/my_mileage/css/calendar.css?190220">
    <!--<script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>-->
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/myroom/mileage/my_mileage/js/calendar.js?190220"></script>
    <script type='text/javascript'>
        var t_SearchScope = {
            start: { year:'2016', month:'4' },
            end: { year:'{{$DateY}}', month:'{{$MaxMonth}}' }
        }
        var gsVersion = '2110141801';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    <style>
        .g_title_blue {
            margin-left: 20px;
        }
        .g_tab>* {
            background-color: #e3f0f3;
            border-bottom: 2px solid #0081b9;
        }
        .g_tab>.selected {
            border: 2px solid #0081b9;
            border-bottom: 0;
        }
        .g_tab>*>a {
            font-size: 14px;
        }
        .tb_list th {
            font-size: 14px;
        }
        .tb_list td {
            font-size: 13px;
        }
        .g_blue_table tr th {
            background-color: #e3f0f3;
        }
        .g_blue_table,
        .g_blue_table tr th,
        .g_blue_table tr td {
            border: solid 1px #89c1ce;
        }
    </style>
    @include('aside.myroom',['group'=>'mileage'])
    <div class="g_content">
        <!-- ▼ 타이틀 //-->
        <div class="g_title_blue no-border"> 내 마일리지</div>
        <!-- ▲ 타이틀 //-->
        <!-- ▼ 메뉴탭 //-->
        <div class="g_tab f-14">
            <div class=""><a href="{{route('my_mileage_index_c')}}">마일리지 충전</a></div>
            <div class=""><a href="{{route('my_mileage_index_e')}}">마일리지 출금</a></div>
            <div class="selected"><a href="{{route('my_mileage_calendar')}}">마일리지 달력보기</a></div>
            <div class=""><a href="{{route('my_mileage_detail_list')}}">상세내역보기</a></div>
        </div>
        <!-- ▲ 메뉴탭 //-->
        <!-- ▼ 년도 //-->
        <form name="frmData" id="frmData" method="POST" action="">
            @csrf
            <input type="hidden" id="date_Y" name="date_Y" value="{{$DateY}}">
            <input type="hidden" id="date_M" name="date_M" value="{{$DateM}}">
            <ul id="mile_year">
                <li><img src="/mania/img/icons/btn_previous.gif" width="16" height="26" alt="이전" id="before" class="g_button g_icon"></li>
                <li class="center">{{$DateY}}년</li>
                <li><img src="/mania/img/icons/btn_next1.gif" width="16" height="26" alt="다음" id="after" class="g_button g_icon"></li>
            </ul>
            <!-- ▲ 년도 //-->
            <!-- ▼ 월 //-->
            <ul id="mile_month" class="g_left g_sideway">
                @for ($i = 1; $i <= 12; $i++)
                <li @if ($i == $DateM) class='selected' @endif name="{{$i}}">{{$i}}월</li>
                @endfor
            </ul>
            <div class="g_finish"></div>
{{--            <ul id="month_mile" class="g_black2_b">--}}
{{--                <li><span class="g_blue2_b">{{$DateM}}월 적립된 마일리지 : </span> {{number_format($KeepMoney)}}원</li>--}}
{{--                <li><span class="g_blue2_b">{{$DateM}}월 사용된 마일리지 : </span> {{number_format($UseMoney)}}원</li>--}}
{{--            </ul>--}}
        </form>
        <!-- ▲ 월 //-->
        <!-- ▼ 마일리지 달력 //-->
        <table id="mile_calendar">
            <colgroup>
                <col width="109">
                <col width="106">
                <col width="106">
                <col width="106">
                <col width="106">
                <col width="106">
                <col width="113">
            </colgroup>
            <tr>
                <th>일요일</th>
                <th>월요일</th>
                <th>화요일</th>
                <th>수요일</th>
                <th>목요일</th>
                <th>금요일</th>
                <th>토요일</th>
            </tr>
            @php
            for ($i = 0; $i < 42; $i++)
            {
                $snzDayStyle = "";
                if ($i % 7 == 0)
                {
                    if ($i - $DayIndex >= $CountDays)
                        break;
                    echo '<tr>';
                    $snzDayStyle = 'sunday';
                }
                if ($i % 7 == 6)
                    $snzDayStyle = 'saterday';
                if ($i < $DayIndex || $i - $DayIndex >= $CountDays)
                {
                    echo '<td>&nbsp;</td>';
                }
                else
                {
                    $nDay = ($i - $DayIndex + 1);
                    echo '<td class="'.$snzDayStyle.'">';
                    echo '<div class="g_right">'.$nDay.'</div>';
                    echo '<div class="g_finish"></div>';
                    $index = array_search($nDay, array_column($MileageIn, 'dayNum'));
                    if ($index !== false)
                        echo '<div class="in">'.number_format($MileageIn[$index]['sum_money']).'</div>';
                    $index = array_search($nDay, array_column($MileageOut, 'dayNum'));
                    if ($index !== false)
                        echo '<div class="out">'.number_format($MileageOut[$index]['sum_money']).'</div>';
                    echo '</td>';
                }
                if ($i % 7 == 6)
                    echo '</tr>';

            }
            @endphp
        </table>
        <!-- ▲ 마일리지 달력 //-->
        <div class="g_left g_black3_11">- 조회기간은 전년기준 5년까지 조회 가능합니다.</div>
        <div class="g_right g_black3_11">(단위:원)</div>
        <div class="g_finish"></div>
        <!-- ▼ 알아두기 //-->
        <div class="g_notice">알아두기</div>
        <ul class="g_notice_box1 g_list">
            <li>사용 전용 마일리지(유효기간 有)는 이벤트나 기타 사유로 인해 지급된 마일리지로 사용 가능한 유효기간이 존재합니다.</li>
            <li>사용 전용 마일리지(유효기간 有/유효기간 無)는 마일리지 출금 및 상품권몰, M마일리지로 사용이 불가합니다.</li>
            <li>출금 전용 마일리지는 아이템 구매와 같은 서비스 이용이 불가하며 출금 서비스만 이용 가능합니다.</li>
        </ul>
        <!-- ▲ 알아두기 //-->
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
