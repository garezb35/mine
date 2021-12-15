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
        .contextual--title {
            margin-left: 20px;
        }
        .react_nav_tab>* {
            background-color: #e3f0f3;
            border-bottom: 2px solid #0081b9;
        }
        .react_nav_tab>.selected {
            border: 2px solid #0081b9;
            border-bottom: 0;
        }
        .react_nav_tab>*>a {
            font-size: 14px;
        }
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

    <div class="container_fulids" id="module-teaser-fullscreen">
        @include('aside.myroom',['group'=>'mileage'])
        <div class="pagecontainer">

            <div class="contextual--title no-border"> 내 마일리지 </div>


            <div class="react_nav_tab">
                <div class=""><a href="{{route('my_mileage_index_c')}}">마일리지 충전</a></div>
                <div class=""><a href="{{route('my_mileage_index_e')}}">마일리지 출금</a></div>
                <div class=""><a href="{{route('my_mileage_calendar')}}">마일리지 달력보기</a></div>
                <div class="selected"><a href="{{route('my_mileage_detail_list')}}">상세내역보기</a></div>
            </div>


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
                            <div class="float-left">

                                <input type="text" name="date_start" class="datepicker" value="{{$date_start}}"> ~
                                <input type="text" name="date_end" class="datepicker" value="{{$date_end}}">
                            </div>
                            <div class="float__right"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="float-left">
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
                            <div class="float__right">
                                <input type="submit" id="btn_search" width="64" height="18" value="조회하기" alt="조회하기">
                            </div>
                        </td>
                    </tr>
                </table>
            </form>


            <table class="table-primary tb_list">
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

            <div class="tb_bt_txt f_black2">
                <div class="float-left">- 조회기간은 전년기준 5년까지 조회 가능합니다.</div>
                <div class="float__right">(단위:원)</div>
            </div>
            <div class="empty-high"></div>

            <div class="pagination__bootstrap">
                <ul class="g_paging">
                    {{$payRecord->withQueryString()->links()}}
                </ul>
            </div>

        </div>
        <div class="empty-high"></div>
    </div>

@endsection
