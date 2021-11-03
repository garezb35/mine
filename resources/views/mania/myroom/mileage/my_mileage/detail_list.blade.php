@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/mileage/my_mileage/css/detail_list.css?190220">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/myroom/mileage/my_mileage/js/detail_list.js?190220"></script>
    <script type='text/javascript'>
        var t_SearchScope = {
            start: { year:'2016', month:'4' },
            end: { year:'2021', month:'10' }
        }
        var gsVersion = '2110141801';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    @include('mania.myroom.aside', ['group'=>'mileage', 'part'=>'my_mileage'])
    <div class="g_content">
        <!-- ▼ 타이틀 //-->
        <div class="g_title_blue"> 내 마일리지
            <ul class="g_path">
                <li>홈</li>
                <li>마이룸</li>
                <li>마일리지</li>
                <li class="select">내 마일리지</li>
            </ul>
        </div>
        <!-- ▲ 타이틀 //-->
        <!-- ▼ 메뉴탭 //-->
        <div class="g_tab">
            <div class=""><a href="/myroom/mileage/my_mileage/index.html">마일리지 현황</a></div>
            <div class=""><a href="/myroom/mileage/my_mileage/calendar.html">마일리지 달력보기</a></div>
            <div class="selected"><a href="/myroom/mileage/my_mileage/detail_list.html">상세내역보기</a></div>
        </div>
        <!-- ▲ 메뉴탭 //-->
        <!-- ▼ 조회기간 //-->
        <form id="frmPeriod" name="frmPeriod" action="detail_list.html" method="post">
            <table class="g_blue_table" id="search_table">
                <colgroup>
                    <col width="130">
                    <col>
                </colgroup>
                <tr>
                    <th rowspan="2">조회기간</th>
                    <td id="search_date">
                        <div class="g_left">
                            <!-- ▼ 시작 날짜 //-->
                            <select id="search_year" name="search_year" class="g_hidden" onchange="fnGetDate(0)">
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021" selected>2021</option>
                            </select>
                            <div class="g_left date_text">년</div>
                            <select id="search_month" name="search_month" class="g_hidden" onchange="fnGetDate(0)">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10" selected>10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <div class="g_left date_text">월</div>
                            <select id="search_day" name="search_day" class="g_hidden">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14" selected>14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                            <div class="g_left date_text">일 ~</div>
                            <!-- ▲ 시작날짜 //-->
                            <!-- ▼ 마지막날짜 //-->
                            <select id="search_year_end" name="search_year_end" class="g_hidden" onchange="fnGetDate(1)">
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021" selected>2021</option>
                            </select>
                            <div class="g_left date_text">년</div>
                            <select id="search_month_end" name="search_month_end" class="g_hidden" onchange="fnGetDate(1)">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10" selected>10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <div class="g_left date_text">월</div>
                            <select id="search_day_end" name="search_day_end" class="g_hidden">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14" selected>14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                            <div class="g_left date_text">일</div>
                        </div>
                        <div class="g_right">
                            <a href="javascript:$.date_scope(1);"><img src="http://img3.itemmania.com/images/btn/btn_today.gif" width="34" height="18" alt="당일"></a>
                            <a href="javascript:$.date_scope(3);"><img src="http://img4.itemmania.com/images/btn/btn_3day.gif" width="34" height="18" alt="3일"></a>
                            <a href="javascript:$.date_scope(7);"><img src="http://img2.itemmania.com/images/btn/btn_7day.gif" width="34" height="18" alt="7일"></a>
                            <a href="javascript:$.date_scope(15);"><img src="http://img3.itemmania.com/images/btn/btn_15day.gif" width="34" height="18" alt="15일"></a>
                            <a href="javascript:$.date_scope(30);"><img src="http://img4.itemmania.com/images/btn/btn_30day.gif" width="34" height="18" alt="30일"></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="g_left">
                            <input type="radio" name="search_select" id="search_select1" value="all" class="g_radio" checked onclick="document.frmPeriod.submit();">
                            <label for="search_select1">전체</label>
                            <input type="radio" name="search_select" id="search_select2" value="increase" class="g_radio" onclick="document.frmPeriod.submit();">
                            <label for="search_select2">증가된 마일리지</label>
                            <input type="radio" name="search_select" id="search_select3" value="decrease" class="g_radio" onclick="document.frmPeriod.submit();">
                            <label for="search_select3">감소된 마일리지</label>
                        </div>
                        <div class="g_right">
                            <input type="image" src="http://img2.itemmania.com/images/btn/btn_check1.gif" width="64" height="18" alt="조회하기"> </div>
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
            </colgroup>
            <tr>
                <th class="first">일자</th>
                <th>분류</th>
                <th>내용</th>
                <th>증가된 마일리지(+)</th>
                <th>감소된 마일리지(-)</th>
                <th>현재 마일리지</th>
            </tr>
            <tr>
                <td class="first">2021-10-14 01:15:50</td>
                <td>구매</td>
                <td>#2021101311248963 구매</td>
                <td class="s_right">0</td>
                <td class="s_right">3,000</td>
                <td class="s_right">245</td>
            </tr>
        </table>
        <!-- ▲ 상세내역 //-->
        <div class="tb_bt_txt f_black2">
            <div class="g_left">- 조회기간은 전년기준 5년까지 조회 가능합니다.</div>
            <div class="g_right">(단위:원)</div>
        </div>
        <div class="g_finish"></div>
        <!-- ▼ 페이징 //-->
        <div class="dvPaging">
            <ul class="g_paging"> </ul>
        </div>
        <!-- ▲ 페이징 //-->
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
