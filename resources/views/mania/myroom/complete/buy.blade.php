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
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        @include('mania.myroom.aside', ['group'=>'complete_sell', 'part'=>''])
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue"> 종료 <span>내역</span>
                <ul class="g_path">
                    <li>홈</li>
                    <li>마이룸</li>
                    <li>종료 내역</li>
                    <li class="select">구매 종료 내역</li>
                </ul>
            </div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab">
                <div><a href="{{route("complete_sell")}}">판매종료내역</a></div>
                <div class='selected'><a href="{{route("complete_buy")}}">구매종료내역</a></div>
                <div><a href="{{route("complete_report")}}">전체이용내역</a></div>
            </div>
            <div class="search_box">
                <a href="buy>
                    <input type="radio" name="list_type" value="2" checked onclick="location.href='buy.html'"> 최근종료내역</a>
                <a href="before_buy_end class="pdl">
                    <input type="radio" name="list_type" value="1" onclick="location.href='before_buy_end.html'"> 이전종료내역</a>
                <form id="frmSearch" action="" method="post">
                    <ul class="g_right g_sideway">
                        <li class="type_area"> <a href="?type=sell&continue=YTo4OntzOjQ6ImdhbWUiO3M6MDoiIjtzOjk6ImdhbWVfdGV4dCI7czowOiIiO3M6Njoic2VydmVyIjtzOjA6IiI7czoxMToic2VydmVyX3RleHQiO3M6MDoiIjtzOjEyOiJzZWFyY2hfZ29vZHMiO3M6MDoiIjtzOjE2OiJzZWFyY2hfcHJpY2VfbWluIjtzOjA6IiI7czoxNjoic2VhcmNoX3ByaWNlX21heCI7czowOiIiO3M6NzoidXNldHlwZSI7czo4OiJidXllcl9pZCI7fQ=="><span class="f_blue3 f_bold">팝니다 구매한 내역</span></a> | <a href="?type=buy&continue=YTo4OntzOjQ6ImdhbWUiO3M6MDoiIjtzOjk6ImdhbWVfdGV4dCI7czowOiIiO3M6Njoic2VydmVyIjtzOjA6IiI7czoxMToic2VydmVyX3RleHQiO3M6MDoiIjtzOjEyOiJzZWFyY2hfZ29vZHMiO3M6MDoiIjtzOjE2OiJzZWFyY2hfcHJpY2VfbWluIjtzOjA6IiI7czoxNjoic2VhcmNoX3ByaWNlX21heCI7czowOiIiO3M6NzoidXNldHlwZSI7czo4OiJidXllcl9pZCI7fQ=="><span class="">삽니다 구매한 내역</span></a> </li>
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
            <div class="tab_sib g_left">- 최근 1주간 종료된 내역입니다. 이전에 종료된 내역은 '이전종료내역'에서 확인하세요.&nbsp;&nbsp;</div>
            <div class="btn_green2 excel_btn"><a href="complete_excel.html?type=sell&continue=YTo4OntzOjQ6ImdhbWUiO3M6MDoiIjtzOjk6ImdhbWVfdGV4dCI7czowOiIiO3M6Njoic2VydmVyIjtzOjA6IiI7czoxMToic2VydmVyX3RleHQiO3M6MDoiIjtzOjEyOiJzZWFyY2hfZ29vZHMiO3M6MDoiIjtzOjE2OiJzZWFyY2hfcHJpY2VfbWluIjtzOjA6IiI7czoxNjoic2VhcmNoX3ByaWNlX21heCI7czowOiIiO3M6NzoidXNldHlwZSI7czo4OiJidXllcl9pZCI7fQ==">엑셀받기</a></div>
            <table class="g_green_table tb_list">
                <colgroup>
                    <col width="139">
                    <col width="71">
                    <col />
                    <col width="110">
                    <col width="95">
                    <col width="95">
                </colgroup>
                <tr>
                    <th>카테고리</th>
                    <th>분류</th>
                    <th>제목</th>
                    <th>거래금액</th>
                    <th>등록일</th>
                    <th>비고</th>
                </tr>
                <tr>
                    <td colspan="6">구매종료내역이 없습니다.</td>
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
