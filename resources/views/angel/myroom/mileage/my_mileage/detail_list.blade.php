@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/mileage/my_mileage/css/detail_list.css?190220">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
@endsection

@section('foot_attach')

    <script type="text/javascript" src="/angel/myroom/mileage/my_mileage/js/detail_list.js?190220"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script type='text/javascript'>
        var t_SearchScope = {
            start: { year:'2016', month:'4' },
            end: { year:'2021', month:'10' }
        }


    </script>

    <script>
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
@endsection

@section('content')
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
        .datepicker {
            padding: 4px 10px 6px;
            width: 110px;
            border: solid 1px #bfbfbf;
            border-radius: 2px;
        }
        #btn_search {
            background-color: #216574;
            color: white;
            padding: 3px 8px;
            font-size: 12px;
            border-radius: 2px;
        }
    </style>
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        @include('aside.myroom',['group'=>'mileage'])
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue no-border"> 내 마일리지 </div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab">
                <div class=""><a href="{{route('my_mileage_index_c')}}">마일리지 충전</a></div>
                <div class=""><a href="{{route('my_mileage_index_e')}}">마일리지 출금</a></div>
                <div class=""><a href="{{route('my_mileage_calendar')}}">마일리지 달력보기</a></div>
                <div class="selected"><a href="{{route('my_mileage_detail_list')}}">상세내역보기</a></div>
            </div>
            <!-- ▲ 메뉴탭 //-->
            <!-- ▼ 조회기간 //-->
            <form id="frmPeriod" name="frmPeriod" action="" method="post">
                @csrf
                <table class="g_sky_table" id="search_table">
                    <colgroup>
                        <col width="130">
                        <col>
                    </colgroup>
                    <tr>
                        <th rowspan="2">조회기간</th>
                        <td id="search_date">
                            <div class="g_left">
                                <!-- ▼ 시작 날짜 //-->
                                <input type="text" name="date_start" class="datepicker" value="{{$date_start}}"> ~
                                <input type="text" name="date_end" class="datepicker" value="{{$date_end}}">
                            </div>
                            <div class="g_right"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="g_left">
                                <input type="radio" name="search_select" id="search_select1" value="0" class="g_radio"
                                       {{ $search_type == 0 ? 'checked' : '' }} onclick="document.frmPeriod.submit();">
                                <label for="search_select1">전체</label>
                                <input type="radio" name="search_select" id="search_select2" value="1" class="g_radio"
                                       {{ $search_type == 1 ? 'checked' : '' }} onclick="document.frmPeriod.submit();">
                                <label for="search_select2">증가된 마일리지</label>
                                <input type="radio" name="search_select" id="search_select3" value="2" class="g_radio"
                                       {{ $search_type == 2 ? 'checked' : '' }} onclick="document.frmPeriod.submit();">
                                <label for="search_select3">감소된 마일리지</label>
                            </div>
                            <div class="g_right">
                                <input type="submit" id="btn_search" width="64" height="18" value="조회하기" alt="조회하기">
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            <!-- ▲ 조회기간 //-->
            <!-- ▼ 상세내역 //-->
            <table class="g_blue_table tb_list">
                <colgroup>
                    <col width="148">
                    <col width="64">
                    <col />
                    <col width="141">
                    <col width="134">
                    <col width="114">
                    <col width="60">
                </colgroup>
                <tr>
                    <th class="first">일자</th>
                    <th>분류</th>
                    <th>내용</th>
                    <th>증가된 마일리지(+)</th>
                    <th>감소된 마일리지(-)</th>
                    <th>현재 마일리지</th>
                    <th>상태</th>
                </tr>
                @foreach ($payRecord as $record)
                    <tr>
                        <td class="first">{{$record['createdByDtm']}}</td>
                        <td>
                            @switch ($record['type'])
                                @case(0)
                                    충전
                                    @break
                                @case(1)
                                    출금
                                    @break
                                @case(2)
                                    ...
                                    @break
                            @endswitch
                        </td>
                        <td>{{$record['memo']}}</td>
                        <td class="s_right">{{$record['type'] == 0 ? number_format($record['money']) : 0}}</td>
                        <td class="s_right">{{$record['type'] == 1 ? number_format($record['money']) : 0}}</td>
                        <td class="s_right">{{number_format($record['keep_money'])}}</td>
                        <td class="align-center f-13">
                            @switch ($record['status'])
                                @case(0)
                                요청중
                                @break
                                @case(1)
                                대기중
                                @break
                                @case(2)
                                완료
                                @break
                                @case(3)
                                취소
                                @break
                            @endswitch
                        </td>
                    </tr>
                @endforeach
            </table>
            <!-- ▲ 상세내역 //-->
            <div class="tb_bt_txt f_black2">
                <div class="g_left">- 조회기간은 전년기준 5년까지 조회 가능합니다.</div>
                <div class="g_right">(단위:원)</div>
            </div>
            <div class="g_finish"></div>
            <!-- ▼ 페이징 //-->
            <div class="dvPaging">
                <ul class="g_paging">
                    {{$payRecord->withQueryString()->links()}}
                </ul>
            </div>
            <!-- ▲ 페이징 //-->
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
