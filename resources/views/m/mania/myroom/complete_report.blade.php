@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/complete/css/report.css?190220">

    <script type="text/javascript" src="/angel/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/complete/js/_search.js?190220"></script>
@endsection

@section('content')

<div class="container_fulids" id="module-teaser-fullscreen">
    @include('aside.myroom',['group'=>'end'])
    <div class="pagecontainer">

        <div class="contextual--title noborder"> 종료 <span>내역</span>
        </div>


        <div class="react_nav_tab navs__pops">
            <div><a href="/myroom/complete/sell">판매종료내역</a></div>
            <div><a href="/myroom/complete/buy">구매종료내역</a></div>
            <div class='selected'><a href="/myroom/complete/report">전체이용내역</a></div>
        </div>


        <form method="GET">
            <div class="float__right">
                <select name="selectYear" class="d-none">
                    @for($i = date("Y") ; $i >=date("Y")-4 ; $i--)
                        <option value="{{$i}}" @if((Request::get('selectYear') == $i) || (empty(Request::get('selectYear')) && $i == date("Y"))) selected @endif>{{$i}}년</option>
                    @endfor
                </select>
                <input type="image" src="http://img3.itemmania.com/images/btn/btn_find1.gif" width="50" height="20" alt="검색" class="v_middle_img"> </div>
        </form>

        <div class="empty-high"></div>
        <table class="table-modern-primary tb_list">
            <colgroup>
                <col width="64">
                <col width="106">
                <col width="106">
                <col width="106">
                <col width="106">
                <col width="106">
                <col width="165">
            </colgroup>
            <tr>
                <th>월</th>
                <th>판매건수</th>
                <th>판매금액</th>
                <th>수수료</th>
                <th>구매건수</th>
                <th>구매금액</th>
                <th>부가서비스이용료</th>
            </tr>
            @for($i = 1;$i <= 6 ; $i++)
                <tr>
                    <td>{{$i}}월</td>
                    <td>{{!empty($sell_list[$i.'m']['count'])  ? number_format($sell_list[$i.'m']['count']) : 0}}</td>
                    <td>{{!empty($sell_list[$i.'m']['order'])  ? number_format($sell_list[$i.'m']['order']) : 0}}</td>
                    <td>{{!empty($sell_list[$i.'m']['fee'])  ? number_format($sell_list[$i.'m']['fee']) : 0}}</td>
                    <td>{{$buy_list[$i.'m']['count'] ?? 0}}</td>
                    <td>{{!empty($buy_list[$i.'m']['order'])  ? number_format($buy_list[$i.'m']['order']) : 0}}</td>
                    <td>{{!empty($sell_list[$i.'m']['premium'])  ? number_format($sell_list[$i.'m']['premium']) : 0}}</td>
                </tr>
            @endfor

            <tr class="f_blue3 font-weight-bold">
                <td>상반기</td>
                <td>{{!empty($sell_list['up']['count'])  ? number_format($sell_list['up']['count']) : 0}}</td>
                <td>{{!empty($sell_list['up']['order'])  ? number_format($sell_list['up']['order']) : 0}}</td>
                <td>{{!empty($sell_list['up']['fee'])  ? number_format($sell_list['up']['fee']) : 0}}</td>
                <td>{{$buy_list['up']['count'] ?? 0}}</td>
                <td>{{!empty($buy_list['up']['order'])  ? number_format($buy_list['up']['order']) : 0}}</td>
                <td>{{!empty($sell_list['up']['premium'])  ? number_format($sell_list['up']['premium']) : 0}}</td>
            </tr>
            @for($i = 7;$i <= 12 ; $i++)
                <tr>
                    <td>{{$i}}월</td>
                    <td>{{$sell_list[$i.'m']['count'] ?? 0}}</td>
                    <td>{{!empty($sell_list[$i.'m']['order'])  ? number_format($sell_list[$i.'m']['order']) : 0}}</td>
                    <td>{{!empty($sell_list[$i.'m']['fee'])  ? number_format($sell_list[$i.'m']['fee']) : 0}}</td>
                    <td>{{$buy_list[$i.'m']['count'] ?? 0}}</td>
                    <td>{{!empty($buy_list[$i.'m']['order'])  ? number_format($buy_list[$i.'m']['order']) : 0}}</td>
                    <td>{{!empty($sell_list[$i.'m']['premium'])  ? number_format($sell_list[$i.'m']['premium']) : 0}}</td>
                </tr>
            @endfor
            <tr class="font-weight-bold">
                <td>총합계</td>
                <td>{{!empty($sell_list['down']['count'])  ? number_format($sell_list['down']['count']) : 0}}</td>
                <td>{{!empty($sell_list['down']['order'])  ? number_format($sell_list['down']['order']) : 0}}</td>
                <td>{{!empty($sell_list['down']['fee'])  ? number_format($sell_list['down']['fee']) : 0}}</td>
                <td>{{$buy_list['down']['count'] ?? 0}}</td>
                <td>{{!empty($buy_list['down']['order'])  ? number_format($buy_list['down']['order']) : 0}}</td>
                <td>{{!empty($sell_list['down']['premium'])  ? number_format($sell_list['down']['premium']) : 0}}</td>
            </tr>
        </table>

    </div>
    <div class="empty-high"></div>
</div>

@endsection
