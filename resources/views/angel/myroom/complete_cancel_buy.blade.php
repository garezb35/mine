@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/complete/css/common.css" />
@endsection

@section('foot_attach')
@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    @include('aside.myroom',['group'=>'cancel'])
    <div class="g_content">
        <!-- ▼ 타이틀 //-->
        <div class="g_title_blue noborder"> 취소 <span>내역</span>
        </div>
        <!-- ▲ 타이틀 //-->
        <!-- ▼ 메뉴탭 //-->
        <div class="g_tab g_tab_myroom">
            <div><a href="/myroom/complete/cancel_sell">판매취소내역</a></div>
            <div class='selected'><a href="/myroom/complete/cancel_buy">구매취소내역</a></div>
        </div>
        <div class="search_box"> <a href="/myroom/complete/cancel_buy?type=sell"><span @if($type == 'sell')class="f_blue3 f_bold" @endif>팝니다 취소한 내역</span></a> |
            <a href="/myroom/complete/cancel_buy?type=buy"><span @if($type == 'buy')class="f_blue3 f_bold" @endif>삽니다 취소한 내역</span></a> </div>
        <!-- ▲ 메뉴탭 //-->
        <div class="tab_sib">- 최근 24시간 동안 취소된 물품만 확인하실 수 있습니다.</div>
        <table class="g_green_table1 tb_list">
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
                        <a href="/buy/list_search?search_type={{$type}}&amp;search_goods=all&amp;search_game={{$v['game']['id']}}&amp;search_game_text={{$v['game']['game']}}&amp;search_server={{$v['server']['id']}}&amp;search_server_text={{$v['server']['game']}}"><strong>{{$v['game']['game']}}</strong>  <br>{{$v['server']['game']}}</a>
                    </th>
                    <th>{{$v['good_type']}}</th>
                    <th>{{$v['user_title']}}</th>
                    <th>{{number_format($v['payitem']['price'])}}</th>
                    <th>{{date("Y-m-d H:i:s",strtotime($v['created_at']))}}</th>
                </tr>
            @endforeach
        </table>
        <!-- ▼ 페이징 //-->
        <div class="dvPaging">
            {{$games->withQueryString()->links()}}
        </div>
        <!-- ▲ 페이징 //-->
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection