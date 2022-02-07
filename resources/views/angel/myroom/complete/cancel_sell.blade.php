@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/complete/css/common.css?700101" />
@endsection

@section('foot_attach')
@endsection

@section('content')
    <style>
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
    </style>

    <div class="container_fulids" id="module-teaser-fullscreen">
        @include('angel.myroom.aside', ['group'=>'cancel_sell', 'part'=>''])
        <div class="pagecontainer">

            <div class="contextual--title no-border"> 취소 <span>내역</span>
                <ul class="g_path">
                    <li>홈</li>
                    <li>마이룸</li>
                    <li>취소 내역</li>
                    <li class="select">판매 취소 내역</li>
                </ul>
            </div>


            <div class="react_nav_tab">
                <div class='selected'><a href="/myroom/complete/cancel_sell">판매취소내역</a></div>
                <div><a href="/myroom/complete/cancel_buy">구매취소내역</a></div>
            </div>
            <div class="navtabs__react"> <a href="?type=sell&continue=YTo3OntzOjQ6ImdhbWUiO3M6MDoiIjtzOjk6ImdhbWVfdGV4dCI7czowOiIiO3M6Njoic2VydmVyIjtzOjA6IiI7czoxMToic2VydmVyX3RleHQiO3M6MDoiIjtzOjEyOiJzZWFyY2hfZ29vZHMiO3M6MDoiIjtzOjE2OiJzZWFyY2hfcHJpY2VfbWluIjtzOjA6IiI7czoxNjoic2VhcmNoX3ByaWNlX21heCI7czowOiIiO30=">
                    <span class="f_blue3 font-weight-bold">팝니다 취소한 내역</span></a> | <a href="?type=buy&continue=YTo3OntzOjQ6ImdhbWUiO3M6MDoiIjtzOjk6ImdhbWVfdGV4dCI7czowOiIiO3M6Njoic2VydmVyIjtzOjA6IiI7czoxMToic2VydmVyX3RleHQiO3M6MDoiIjtzOjEyOiJzZWFyY2hfZ29vZHMiO3M6MDoiIjtzOjE2OiJzZWFyY2hfcHJpY2VfbWluIjtzOjA6IiI7czoxNjoic2VhcmNoX3ByaWNlX21heCI7czowOiIiO30="><span class="">삽니다 취소한 내역</span></a> </div>

            <div class="tab_sib f-13">- 최근 24시간 동안 취소된 물품만 확인하실 수 있습니다.</div>
            <table class="table-primary tb_list">
                <colgroup>
                    <col width="139">
                    <col width="71">
                    <col/>
                    <col width="110">
                    <col width="95">
                </colgroup>
                <tr>
                    <th>카테고리</th>
                    <th>분류</th>
                    <th>제목</th>
                    <th>거래금액</th>
                    <th>등록일</th>
                </tr>
                <tr>
                    <td colspan="5">판매취소내역이 없습니다.</td>
                </tr>
            </table>

            <div class="pagination__bootstrap">
                <ul class="g_paging"> </ul>
            </div>

        </div>
        <div class="empty-high"></div>
    </div>

@endsection


