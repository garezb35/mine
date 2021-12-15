@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/complete/css/common.css?700101" />
@endsection

@section('foot_attach')
@endsection

@section('content')

<div class="container_fulids" id="module-teaser-fullscreen">
    @include('aside.myroom',['group'=>'cancel'])
    <div class="pagecontainer">

        <div class="contextual--title noborder"> 취소 <span>내역</span>
        </div>


        <div class="react_nav_tab navs__pops">
            <div class='selected'><a href="/myroom/complete/cancel_sell">판매취소내역</a></div>
            <div><a href="/myroom/complete/cancel_buy">구매취소내역</a></div>
        </div>
        <div class="navtabs__react">
            <a href="/myroom/complete/cancel_sell?type=sell"><span @if($type == 'sell') class="f_blue3 font-weight-bold" @endif>팝니다 취소한 내역</span></a> |
            <a href="/myroom/complete/cancel_sell?type=buy"><span @if($type == 'buy') class="f_blue3 font-weight-bold" @endif>삽니다 취소한 내역</span></a> </div>

        <div class="tab_sib">- 최근 24시간 동안 취소된 물품만 확인하실 수 있습니다.</div>
        <table class="table-modern-primary tb_list">
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
            @foreach($games as $v)
                <tr>
                    <th>
                        <a href="/sell/list_search?search_type={{$type}}&amp;filtered_items=all&amp;filtered_game_id={{$v['game']['id']}}&amp;filtered_game_alias={{$v['game']['game']}}&amp;filtered_child_id={{$v['server']['id']}}&amp;filtered_child_alias={{$v['server']['game']}}"><strong>{{$v['game']['game']}}</strong>  <br>{{$v['server']['game']}}</a>
                    </th>
                    <th>{{$v['good_type']}}</th>
                    <th>{{$v['user_title']}}</th>
                    <th>{{number_format($v['payitem']['price'])}}</th>
                    <th>{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}</th>
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


