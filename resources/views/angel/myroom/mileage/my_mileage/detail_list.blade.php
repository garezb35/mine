@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/mileage/my_mileage/css/detail_list.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
@endsection

@section('foot_attach')
    <script type='text/javascript'>
        var t_SearchScope = {
            start: { year:'2016', month:'4' },
            end: { year:'{{date("Y")}}', month:'{{(int)date("m")}}' }
        }
    </script>
    <script type="text/javascript" src="/angel/myroom/mileage/my_mileage/js/detail_list.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

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
        .tb_list th {
            font-size: 14px;
        }
        .tb_list td {
            font-size: 13px;
        }
        /*.table-primary tr th {*/
        /*    background-color: #e3f0f3;*/
        /*}*/
        /*.table-primary,*/
        /*.table-primary tr th,*/
        /*.table-primary tr td {*/
        /*    border: solid 1px #89c1ce;*/
        /*}*/
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
    <div @class('bg-white')>
        <div>
            @include("angel.myroom.header")
        </div>
        <div class="ml-10">
            @include('aside.myroom',['group'=>'mileage'])
            <div class="pagecontainer">
                <div class="react_nav_tab navs__pops">
                    <div class=""><a href="{{route('my_mileage_index_c')}}">마일리지 충전</a></div>
                    <div class=""><a href="{{route('my_mileage_index_e')}}">마일리지 출금</a></div>
                    <div class=""><a href="{{route('my_mileage_calendar')}}">달력보기</a></div>
                    <div class="selected"><a href="{{route('my_mileage_detail_list')}}">상세내역보기</a></div>
                </div>

                <div class="brl brb global_milwage pt-10">
                    <form id="frmPeriod" name="frmPeriod" action="" method="post">
                        @csrf
                            <table class="table-primary" id="search_table">
                                <colgroup>
                                    <col width="80">
                                    <col>
                                </colgroup>
                                <tr>
                                    <th rowspan="2">조회기간</th>
                                    <td id="search_date" style="padding-left: 5px">
                                        <div class="float-left">
                                            <input type="text" name="date_start" class="datepicker" value="{{$date_start}}"> ~
                                            <input type="text" name="date_end" class="datepicker" value="{{$date_end}}">
                                        </div>
                                        <div class="float__right"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px">
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
                                            <input type="submit" id="btn_search" width="64" height="18" value="조회하기" alt="조회하기">
                                        </div>
                                        {{--                                <div class="float__right">--}}
                                        {{--                                    <input type="submit" id="btn_search" width="64" height="18" value="조회하기" alt="조회하기">--}}
                                        {{--                                </div>--}}
                                    </td>
                                </tr>
                            </table>
                    </form>
                    <table class="table-primary tb_list">
                        <tr>
                            <th class="first">일자</th>
                            <th>분류</th>
                            <th>내용</th>
                            <th>증가된 마일리지</th>
                            <th>감소된 마일리지</th>
                            <th>현재 마일리지</th>
                            <th>상태</th>
                        </tr>
                        @if($payRecord->total() == 0)
                        <tr>
                            <td colspan="7">자료가 비었습니다.</td>
                        </tr>
                        @endif
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

                    <div class="empty-high"></div>

                    <div class="pagination__bootstrap">
                        <ul class="g_paging">
                            {{$payRecord->withQueryString()->links()}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="empty-high"></div>
        </div>
    </div>


@endsection
