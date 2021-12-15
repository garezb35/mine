@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/mileage/my_mileage/css/calendar.css?190220">

    <script type="text/javascript" src="/angel/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/mileage/my_mileage/js/calendar.js?190220"></script>
    <script type='text/javascript'>
        var t_SearchScope = {
            start: { year:'2016', month:'4' },
            end: { year:'{{$DateY}}', month:'{{$DateM}}' }
        }


    </script>
@endsection

@section('content')

<div class="container_fulids" id="module-teaser-fullscreen">
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
    </style>
    @include('aside.myroom',['group'=>'mileage'])
    <div class="pagecontainer">

        <div class="contextual--title no-border"> 내 마일리지</div>


        <div class="react_nav_tab f-14">
            <div class=""><a href="{{route('my_mileage_index_c')}}">마일리지 충전</a></div>
            <div class=""><a href="{{route('my_mileage_index_e')}}">마일리지 출금</a></div>
            <div class="selected"><a href="{{route('my_mileage_calendar')}}">마일리지 달력보기</a></div>
            <div class=""><a href="{{route('my_mileage_detail_list')}}">상세내역보기</a></div>
        </div>


        <form name="frmData" id="frmData" method="POST" action="">
            <input type="hidden" id="date_Y" name="date_Y" value="{{$DateY}}">
            <input type="hidden" id="date_M" name="date_M" value="{{$DateM}}">
            <ul id="mile_year">
                <li><img src="/angel/img/icons/btn_previous.gif" width="16" height="26" alt="이전" id="before" class="g_button g_icon"></li>
                <li class="center">{{$DateY}}년</li>
                <li><img src="/angel/img/icons/btn_next1.gif" width="16" height="26" alt="다음" id="after" class="g_button g_icon"></li>
            </ul>


            <ul id="mile_month" class="float-left g_sideway">
                <li name="1">1월</li>
                <li name="2">2월</li>
                <li name="3">3월</li>
                <li name="4">4월</li>
                <li name="5">5월</li>
                <li name="6">6월</li>
                <li name="7">7월</li>
                <li name="8">8월</li>
                <li name="9">9월</li>
                <li name="10">10월</li>
                <li class='selected' name="11">11월</li>
                <li name="12">12월</li>
            </ul>
            <div class="empty-high"></div>
            <ul id="month_mile" class="g_black2_b">
                <li><span class="g_blue2_b">10월 적립된 마일리지 : </span> 4,286,320원</li>
                <li><span class="g_blue2_b">10월 사용된 마일리지 : </span> 4,459,200원</li>
            </ul>
        </form>


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
                    <div class="float__right">1</div>
                    <div class="empty-high"></div>
                    <div class='in'>724,950</div>
                    <div class='out'>830,000</div>
                </td>
                <td class='saterday'>
                    <div class="float__right">2</div>
                    <div class="empty-high"></div>
                    <div class='in'>716,590</div>
                </td>
            </tr>
            <tr>
                <td class='sunday'>
                    <div class="float__right">3</div>
                    <div class="empty-high"></div>
                    <div class='in'>1,121,000</div>
                    <div class='out'>1,519,000</div>
                </td>
                <td>
                    <div class="float__right">4</div>
                    <div class="empty-high"></div>
                    <div class='out'>380,000</div>
                </td>
                <td>
                    <div class="float__right">5</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">6</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">7</div>
                    <div class="empty-high"></div>
                    <div class='in'>497,800</div>
                </td>
                <td>
                    <div class="float__right">8</div>
                    <div class="empty-high"></div>
                    <div class='in'>664,240</div>
                    <div class='out'>1,170,000</div>
                </td>
                <td class='saterday'>
                    <div class="float__right">9</div>
                    <div class="empty-high"></div>
                </td>
            </tr>
            <tr>
                <td class='sunday'>
                    <div class="float__right">10</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">11</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">12</div>
                    <div class="empty-high"></div>
                    <div class='in'>561,740</div>
                </td>
                <td>
                    <div class="float__right">13</div>
                    <div class="empty-high"></div>
                    <div class='out'>560,200</div>
                </td>
                <td>
                    <div class="float__right">14</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">15</div>
                    <div class="empty-high"></div>
                </td>
                <td class='saterday'>
                    <div class="float__right">16</div>
                    <div class="empty-high"></div>
                </td>
            </tr>
            <tr>
                <td class='sunday'>
                    <div class="float__right">17</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">18</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">19</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">20</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">21</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">22</div>
                    <div class="empty-high"></div>
                </td>
                <td class='saterday'>
                    <div class="float__right">23</div>
                    <div class="empty-high"></div>
                </td>
            </tr>
            <tr>
                <td class='sunday'>
                    <div class="float__right">24</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">25</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">26</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">27</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">28</div>
                    <div class="empty-high"></div>
                </td>
                <td>
                    <div class="float__right">29</div>
                    <div class="empty-high"></div>
                </td>
                <td class='saterday'>
                    <div class="float__right">30</div>
                    <div class="empty-high"></div>
                </td>
            </tr>
            <tr>
                <td class='sunday'>
                    <div class="float__right">31</div>
                    <div class="empty-high"></div>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>

        <div class="float-left g_black3_11">- 조회기간은 전년기준 5년까지 조회 가능합니다.</div>
        <div class="float__right g_black3_11">(단위:원)</div>
        <div class="empty-high"></div>

        <div class="g_notice">알아두기</div>
        <ul class="g_notice_box1 g_list">
            <li>사용 전용 마일리지(유효기간 有)는 이벤트나 기타 사유로 인해 지급된 마일리지로 사용 가능한 유효기간이 존재합니다.</li>
            <li>사용 전용 마일리지(유효기간 有/유효기간 無)는 마일리지 출금 및 상품권몰, M마일리지로 사용이 불가합니다.</li>
            <li>출금 전용 마일리지는 아이템 구매와 같은 서비스 이용이 불가하며 출금 서비스만 이용 가능합니다.</li>
        </ul>

    </div>
    <div class="empty-high"></div>
</div>

@endsection
