@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/complete/css/common.css?700101" />
    <!--<script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>-->
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
@endsection

@section('content')
    <style>
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
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        @include('mania.myroom.aside', ['group'=>'cancel_sell', 'part'=>''])
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue no-border"> 취소 <span>내역</span>
                <ul class="g_path">
                    <li>홈</li>
                    <li>마이룸</li>
                    <li>취소 내역</li>
                    <li class="select">판매 취소 내역</li>
                </ul>
            </div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab">
                <div class='selected'><a href="/myroom/complete/cancel_sell>판매취소내역</a></div>
                <div><a href="/myroom/complete/cancel_buy>구매취소내역</a></div>
            </div>
            <div class="search_box"> <a href="?type=sell&continue=YTo3OntzOjQ6ImdhbWUiO3M6MDoiIjtzOjk6ImdhbWVfdGV4dCI7czowOiIiO3M6Njoic2VydmVyIjtzOjA6IiI7czoxMToic2VydmVyX3RleHQiO3M6MDoiIjtzOjEyOiJzZWFyY2hfZ29vZHMiO3M6MDoiIjtzOjE2OiJzZWFyY2hfcHJpY2VfbWluIjtzOjA6IiI7czoxNjoic2VhcmNoX3ByaWNlX21heCI7czowOiIiO30="><span class="f_blue3 f_bold">팝니다 취소한 내역</span></a> | <a href="?type=buy&continue=YTo3OntzOjQ6ImdhbWUiO3M6MDoiIjtzOjk6ImdhbWVfdGV4dCI7czowOiIiO3M6Njoic2VydmVyIjtzOjA6IiI7czoxMToic2VydmVyX3RleHQiO3M6MDoiIjtzOjEyOiJzZWFyY2hfZ29vZHMiO3M6MDoiIjtzOjE2OiJzZWFyY2hfcHJpY2VfbWluIjtzOjA6IiI7czoxNjoic2VhcmNoX3ByaWNlX21heCI7czowOiIiO30="><span class="">삽니다 취소한 내역</span></a> </div>
            <!-- ▲ 메뉴탭 //-->
            <div class="tab_sib f-13">- 최근 24시간 동안 취소된 물품만 확인하실 수 있습니다.</div>
            <table class="g_blue_table tb_list">
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
            <!-- ▼ 페이징 //-->
            <div class="dvPaging">
                <ul class="g_paging"> </ul>
            </div>
            <!-- ▲ 페이징 //-->
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection


