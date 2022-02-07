@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/mileage/my_mileage/css/calendar.css">
@endsection

@section('foot_attach')
    <script type='text/javascript'>
        var t_SearchScope = {
            start: { year:'2016', month:'4' },
            end: { year:'{{date("Y")}}', month:'{{(int)date("m")}}' }
        }
    </script>
    <script type="text/javascript" src="/angel/myroom/mileage/my_mileage/js/calendar.js"></script>

@endsection

@section('content')
    <div @class('bg-white')>
        <div>
            @include("angel.myroom.header")
        </div>
        <div class="ml-10">
            <style>
                .tb_list th {
                    font-size: 14px;
                }
                .tb_list td {
                    font-size: 13px;
                }
                .table-primary tr th {
                    background-color: #e3f0f3;
                }
                .table-primary,
                .table-primary tr th,
                .table-primary tr td {
                    border: solid 1px #89c1ce;
                }
            </style>
            @include('aside.myroom',['group'=>'mileage'])
            <div class="pagecontainer">
                <div class="react_nav_tab navs__pops">
                    <div class=""><a href="{{route('my_mileage_index_c')}}">마일리지 충전</a></div>
                    <div class=""><a href="{{route('my_mileage_index_e')}}">마일리지 출금</a></div>
                    <div class="selected"><a href="{{route('my_mileage_calendar')}}">달력보기</a></div>
                    <div class=""><a href="{{route('my_mileage_detail_list')}}">상세내역보기</a></div>
                </div>
                <div class="brb brl pt-30 pl-10 pr-10 pb-10">
                    <form name="frmData" id="frmData" method="POST" action="">
                        @csrf
                        <input type="hidden" id="date_Y" name="date_Y" value="{{$DateY}}">
                        <input type="hidden" id="date_M" name="date_M" value="{{$DateM}}">
                        <ul id="mile_year">
                            <li><img src="/angel/img/icons/btn_previous.gif" width="16" height="26" alt="이전" id="before" class="g_button g_icon"></li>
                            <li class="center">{{$DateY}}년</li>
                            <li><img src="/angel/img/icons/btn_next1.gif" width="16" height="26" alt="다음" id="after" class="g_button g_icon"></li>
                        </ul>
                        <ul id="mile_month" class="float-left g_sideway mile_month" >
                            @for ($i = 1; $i <= 12; $i++)
                                <li @if ($i == $DateM) class='selected' @endif name="{{$i}}">{{$i}}월</li>
                            @endfor
                        </ul>
                        <div class="empty-high"></div>
                    </form>
                    <div class="calendar__part">
                        <table id="mile_calendar">
                            <colgroup>
                                <col width="67">
                                <col width="67">
                                <col width="67">
                                <col width="67">
                                <col width="67">
                                <col width="67">
                                <col width="67">
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
                                        echo '<div class="float__right">'.$nDay.'</div>';
                                        echo '<div class="empty-high"></div>';
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
                        <div>
                            <ul  class="float-left g_sideway mile_month">
                                @for ($i = 1; $i <= 12; $i++)
                                    <li @if ($i == $DateM) class='selected' @endif name="{{$i}}">{{$i}}월</li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                    <div class="float-left g_black3_11">- 조회기간은 전년기준 5년까지 조회 가능합니다.</div>
                    <div class="float__right g_black3_11">(단위:원)</div>
                    <div class="empty-high"></div>
                </div>
            </div>
            <div class="empty-high"></div>
        </div>
    </div>

@endsection
