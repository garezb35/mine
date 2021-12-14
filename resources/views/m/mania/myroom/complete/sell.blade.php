@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/complete/css/common.css?700101" />
    <!--<script type="text/javascript" src="/angel/advertise/advertise_code_head.js?v=200727"></script>-->
    <script type="text/javascript" src="/angel/_banner/js/banner_module.js?v=210209"></script>
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
        @include('angel.myroom.aside', ['group'=>'complete_sell', 'part'=>''])
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue no-border"> 종료 <span>내역</span>
                <ul class="g_path">
                    <li>홈</li>
                    <li>마이룸</li>
                    <li>종료 내역</li>
                    <li class="select">판매 종료 내역</li>
                </ul>
            </div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab">
                <div class='selected'><a href="{{route("complete_sell")}}">판매종료내역</a></div>
                <div><a href="{{route("complete_buy")}}">구매종료내역</a></div>
                <div><a href="{{route("complete_report")}}">전체이용내역</a></div>
            </div>
            <div class="search_box">
                <a href="sell.html">
                    <input type="radio" name="list_type" value="2" checked onclick="location.href='sell.html'"> 최근종료내역</a>
                <a href="before_sell_end.html" class="pdl">
                    <input type="radio" name="list_type" value="1" onclick="location.href='before_sell_end.html'"> 이전종료내역</a>
                <form id="frmSearch" action="" method="post">
                    <ul class="g_right g_sideway">
                        <li class="type_area"> <a href="?type=sell&continue=YTo4OntzOjQ6ImdhbWUiO3M6MDoiIjtzOjk6ImdhbWVfdGV4dCI7czowOiIiO3M6Njoic2VydmVyIjtzOjA6IiI7czoxMToic2VydmVyX3RleHQiO3M6MDoiIjtzOjEyOiJzZWFyY2hfZ29vZHMiO3M6MDoiIjtzOjE2OiJzZWFyY2hfcHJpY2VfbWluIjtzOjA6IiI7czoxNjoic2VhcmNoX3ByaWNlX21heCI7czowOiIiO3M6NzoidXNldHlwZSI7czo5OiJzZWxsZXJfaWQiO30="><span class="f_blue3 f_bold">팝니다 판매한 내역</span></a> | <a href="?type=buy&continue=YTo4OntzOjQ6ImdhbWUiO3M6MDoiIjtzOjk6ImdhbWVfdGV4dCI7czowOiIiO3M6Njoic2VydmVyIjtzOjA6IiI7czoxMToic2VydmVyX3RleHQiO3M6MDoiIjtzOjEyOiJzZWFyY2hfZ29vZHMiO3M6MDoiIjtzOjE2OiJzZWFyY2hfcHJpY2VfbWluIjtzOjA6IiI7czoxNjoic2VhcmNoX3ByaWNlX21heCI7czowOiIiO3M6NzoidXNldHlwZSI7czo5OiJzZWxsZXJfaWQiO30="><span class="">삽니다 판매한 내역</span></a> </li>
                        <li>
                            <select id="dbMonth" name="search_month">
                                <option value="2021">2021년</option>
                                <option value="2020">2020년</option>
                                <option value="2019">2019년</option>
                                <option value="2018">2018년</option>
                                <option value="2017">2017년</option>
                                <option value="2016">2016년</option>
                            </select>
                        </li>
                        <li>
                            <input type="submit" value="검색" class="btn_blue3"> </li>
                    </ul>
                </form>
            </div>
            <!-- ▲ 메뉴탭 //-->
            <div class="tab_sib g_left f-13">- 최근 1주간 종료된 내역입니다. 이전에 종료된 내역은 '이전종료내역'에서 확인하세요.&nbsp;&nbsp;</div>
            <div class="btn_blue4 excel_btn"><a href="complete_excel.html?type=sell&continue=YTo4OntzOjQ6ImdhbWUiO3M6MDoiIjtzOjk6ImdhbWVfdGV4dCI7czowOiIiO3M6Njoic2VydmVyIjtzOjA6IiI7czoxMToic2VydmVyX3RleHQiO3M6MDoiIjtzOjEyOiJzZWFyY2hfZ29vZHMiO3M6MDoiIjtzOjE2OiJzZWFyY2hfcHJpY2VfbWluIjtzOjA6IiI7czoxNjoic2VhcmNoX3ByaWNlX21heCI7czowOiIiO3M6NzoidXNldHlwZSI7czo5OiJzZWxsZXJfaWQiO30=">엑셀받기</a></div>
            <div class="g_finish"></div>
            <table
