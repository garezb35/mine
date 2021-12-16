@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/complete/css/common.css?700101" />
@endsection

@section('foot_attach')

@endsection

@section('content')

<div class="container_fulids" id="module-teaser-fullscreen">
    @include('aside.myroom',['group'=>'end'])
    <div class="pagecontainer">

        <div class="contextual--title noborder"> 종료 <span>내역</span>
        </div>


        <div class="react_nav_tab navs__pops">
            <div class='selected'><a href="/myroom/complete/sell">판매종료내역</a></div>
            <div><a href="/myroom/complete/buy">구매종료내역</a></div>
            <div><a href="/myroom/complete/report">전체이용내역</a></div>
        </div>
        <div class="navtabs__react">
            <a href="/myroom/complete/sell?type={{Request::get('type')}}&search_month={{Request::get('search_month')}}">
                <input type="radio" name="list_type" value="2" @if(Request::get('search_type') != 'previous') checked @endif onclick="location.href='/myroom/complete/sell'"> 최근종료내역</a>
            <a href="javascript:void(0)" onclick="location.href='/myroom/complete/sell?search_type=previous&type={{Request::get('type')}}'" class="pdl">
                <input type="radio" name="list_type" value="1" @if(Request::get('search_type') == 'previous') checked @endif onclick="location.href='/myroom/complete/sell?search_type=previous'"> 이전종료내역</a>
            <form id="frmSearch" action="" method="get">
                @csrf
                <ul class="float__right g_sideway">
                    <li class="type_area">
                        <a href="?type=sell&search_type={{Request::get('search_type')}}&search_month={{Request::get('search_month')}}"><span @if(Request::get('type') != 'buy') class="f_blue3 font-weight-bold" @endif>팝니다 판매한 내역</span></a> |
                        <a href="?type=buy&search_type={{Request::get('search_type')}}&search_month={{Request::get('search_month')}}"><span @if(Request::get('type') == 'buy') class="f_blue3 font-weight-bold" @endif>삽니다 판매한 내역</span></a> </li>
                    <li>
                        <select id="dbMonth" name="search_month">
                            @for($i = date("Y") ; $i >=date("Y")-4 ; $i--)
                            <option value="{{$i}}" @if((Request::get('search_month') == $i) || (empty(Request::get('search_month')) && $i == date("Y"))) selected @endif>{{$i}}년</option>
                            @endfor

                        </select>
                    </li>
                    <li>
                        <input type="submit" value="검색" class="btn_blue3"> </li>
                </ul>
            </form>
        </div>

        <div class="tab_sib float-left">- 최근 1주간 종료된 내역입니다. 이전에 종료된 내역은 '이전종료내역'에서 확인하세요.&nbsp;&nbsp;</div>
        <div class="empty-high"></div>
        <table class="table-modern-primary tb_list">
            <colgroup>
                <col width="139">
                <col width="71">
                <col/>
                <col width="110">
                <col width="120">
            </colgroup>
            <tr>
                <th>카테고리</th>
                <th>분류</th>
                <th>제목</th>
                <th>거래금액</th>
                <th>등록일</th>
            </tr>
            @foreach($games as $v)
                @php
                $user_goods_type = '일반';
                if($v['user_goods_type'] == 'division')
                    $user_goods_type = '분할';
                if($v['user_goods_type'] == 'bargain')
                    $user_goods_type = '할인';
                $gamemoney_unit = !empty($gamemoney_unit) && $gamemoney_unit != 1 ? $gamemoney_unit : '';
                $heads = "";
                if($v['user_quantity'] > 1){
                    $heads = "[수량 : ".number_format($v['user_quantity']).$gamemoney_unit."]";
                }
                if($v['user_goods_type'] == 'division')
                {
                    $heads = "[수량 : ".number_format($v['payitem']['buy_quantity'] * $v['user_division_unit']).$gamemoney_unit."]";
                }
                @endphp
            <tr>
                <td>{{$v['game']['game']}}
                    <br>{{$v['server']['game']}}</td>
                <td>{{$v['good_type']}}</td>
                <td class="left">
                    <div class="list_trade_title"> <a href="/sell/view?id={{$v['orderNo']}}&type={{$v['type']}}">{{$heads}} {{$v['user_title']}}-{{$user_goods_type}}</a> </div>
                </td>
                <td class="right text-rock">{{number_format($v['payitem']['price'])}}원</td>
                <td>{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}</td>
            </tr>
            @endforeach

        </table>

        <div class="pagination__bootstrap">
            {{$games->withQueryString()->links()}}
        </div>

    </div>
    <div class="empty-high"></div>
</div>

@endsection
