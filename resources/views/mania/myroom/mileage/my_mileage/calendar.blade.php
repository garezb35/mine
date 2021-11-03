@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.min.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/myroom/mileage/my_mileage/css/calendar.css?190220">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/myroom/mileage/my_mileage/js/calendar.js?190220"></script>
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
            <div class="selected"><a href="/myroom/mileage/my_mileage/calendar.html">마일리지 달력보기</a></div>
            <div class=""><a href="/myroom/mileage/my_mileage/detail_list.html">상세내역보기</a></div>
        </div>
        <!-- ▲ 메뉴탭 //-->
        <!-- ▼ 년도 //-->
        <form name="frmData" id="frmData" method="POST" action="calendar.html">
            <input type="hidden" id="date_Y" name="date_Y" value="2021">
            <input type="hidden" id="date_M" name="date_M" value="10">
            <ul id="mile_year">
                <li><img src="http://img3.itemmania.com/images/btn/btn_previous.gif" width="16" height="26" alt="이전" id="before" class="g_button g_icon"></li>
                <li class="center">2021년</li>
                <li><img src="http://img4.itemmania.com/images/btn/btn_next1.gif" width="16" height="26" alt="다음" id="after" class="g_button g_icon"></li>
            </ul>
            <!-- ▲ 년도 //-->
            <!-- ▼ 월 //-->
            <ul id="mile_month" class="g_left g_sideway">
                <li name="1">1월</li>
                <li name="2">2월</li>
                <li name="3">3월</li>
                <li name="4">4월</li>
                <li name="5">5월</li>
                <li name="6">6월</li>
                <li name="7">7월</li>
                <li name="8">8월</li>
                <li name="9">9월</li>
                <li class='selected' name="10">10월</li>
                <li name="11">11월</li>
                <li name="12">12월</li>
            </ul>
            <div class="g_finish"></div>
            <ul id="month_mile" class="g_black2_b">
                <li><span class="g_blue2_b">10월 적립된 마일리지 : </span> 4,286,320원</li>
                <li><span class="g_blue2_b">10월 사용된 마일리지 : </span> 4,459,200원</li>
            </ul>
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
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                    <div class="g_right">1</div>
                    <div class="g_finish"></div>
                    <div class='in'>724,950</div>
                    <div class='out'>830,000</div>
                </td>
                <td class='saterday'>
                    <div class="g_right">2</div>
                    <div class="g_finish"></div>
                    <div class='in'>716,590</div>
                </td>
            </tr>
            <tr>
                <td class='sunday'>
                    <div class="g_right">3</div>
                    <div class="g_finish"></div>
                    <div class='in'>1,121,000</div>
                    <div class='out'>1,519,000</div>
                </td>
                <td>
                    <div class="g_right">4</div>
                    <div class="g_finish"></div>
                    <div class='out'>380,000</div>
                </td>
                <td>
                    <div class="g_right">5</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">6</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">7</div>
                    <div class="g_finish"></div>
                    <div class='in'>497,800</div>
                </td>
                <td>
                    <div class="g_right">8</div>
                    <div class="g_finish"></div>
                    <div class='in'>664,240</div>
                    <div class='out'>1,170,000</div>
                </td>
                <td class='saterday'>
                    <div class="g_right">9</div>
                    <div class="g_finish"></div>
                </td>
            </tr>
            <tr>
                <td class='sunday'>
                    <div class="g_right">10</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">11</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">12</div>
                    <div class="g_finish"></div>
                    <div class='in'>561,740</div>
                </td>
                <td>
                    <div class="g_right">13</div>
                    <div class="g_finish"></div>
                    <div class='out'>560,200</div>
                </td>
                <td>
                    <div class="g_right">14</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">15</div>
                    <div class="g_finish"></div>
                </td>
                <td class='saterday'>
                    <div class="g_right">16</div>
                    <div class="g_finish"></div>
                </td>
            </tr>
            <tr>
                <td class='sunday'>
                    <div class="g_right">17</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">18</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">19</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">20</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">21</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">22</div>
                    <div class="g_finish"></div>
                </td>
                <td class='saterday'>
                    <div class="g_right">23</div>
                    <div class="g_finish"></div>
                </td>
            </tr>
            <tr>
                <td class='sunday'>
                    <div class="g_right">24</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">25</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">26</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">27</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">28</div>
                    <div class="g_finish"></div>
                </td>
                <td>
                    <div class="g_right">29</div>
                    <div class="g_finish"></div>
                </td>
                <td class='saterday'>
                    <div class="g_right">30</div>
                    <div class="g_finish"></div>
                </td>
            </tr>
            <tr>
                <td class='sunday'>
                    <div class="g_right">31</div>
                    <div class="g_finish"></div>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
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
