@php

    $selltype = '일반';
    if(!empty($user_goods_type) && $user_goods_type == 'division'){
        $selltype = '분할';
    }
    if(!empty($user_goods_type) && $user_goods_type == 'bargain'){
        $selltype = '할인';
    }

    $category = '> > 기타';
    if(!empty($game['game'])){
        $category = $game['game']." > ";
    }
    if(!empty($server['game'])){
        $category .= $server['game']." > ";
    }
    if(!empty($good_type)){
        $category .= $good_type;
    }
    $gamemoney_unit = $gamemoney_unit ?? '';
    $user_quantity = $user_quantity ?? '';
    $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
@endphp
@extends('layouts-angel.app')
@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/sell/css/index_view.css?v=190220">
@endsection

@section('foot_attach')

@endsection

@section('content')
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <div class="aside">
            <div class="title_blue">
                <img src="/angel/img/icons/exclamation-mark-png-exclamation-mark-icon-11563006763v9utxg8tnp 1.png" />
                판매등록 알아보기
            </div>
            <div class="menu_know">
                <p class="heads">판매물품 등록 방법</p>
                <img src="/angel/img/new_images/sell_left_know.png" width="210"  alt="팝니다 쉽게 등록하기">
                <p class="m-t-40 font-weight-bold p-left-15">판매등록 알아두기</p>
                <ul class="g_list p-left-15">
                    <li>* 물품등록 본인은 물품의 문제 발생시 민/형사사상의
                        모든 책임을 질 것에 동의을 한것으로 간주됩니다
                    </li>
                    <li>* 열락처는 현제 사용중인 열락처로 필히 입력해주세요
                        열락처가 불분명시 거래에 불이익이 발생할수있습니다
                    </li>
                </ul>
            </div>
        </div>
        <div class="g_content">
            <div class="g_title_noborder"> 팝니다 <span>등록</span>
            </div>
            <div class="box6">
                <span class="reg_icon"></span>
                @if(!empty($user_goods_type))
                    <p class="complete_txt">축하합니다<br>물품이 정상적으로 등록되었습니다.</p> 현재 연락처로 꼭 수정해주세요!
                    <br> 연락처가 불분명 시 거래에 불이익을 받을 수 있습니다. </div>
            @endif
            <div class="g_subtitle">물품정보</div>
            <table class="g_blue_table">
                <colgroup>
                    <col width="130">
                    <col width="*">
                </colgroup>
                <tr>
                    <th class="bg-white">카테고리</th>
                    <td colspan="1">{{$category}}</td>
                </tr>
                <tr>
                    <th class="bg-white">제목</th>
                    <td colspan="1">{{$user_title ?? ''}}</td>
                </tr>
                <tr>
                    <th class="bg-white">거래번호</th>
                    <td>#{{$orderNo ?? '#'}}</td>
                </tr>
                <tr>
                    <th class="bg-white">물품종류</th>
                    <td>{{$good_type ?? ''}}</td>

                </tr>
                @if($c != 1 && $selltype != '분할')
                <tr>
                    <th class="bg-white">판매수량</th>
                    <td>{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit : ''}} {{$good_type ?? ''}}</td>
                </tr>
                @endif

                @if($selltype == '분할')
                    <tr>
                        <th class="bg-white">판매수량</th>
                        <td>{{number_format($user_quantity_max)}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit : ''}}(최소 {{number_format($user_quantity_min)}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit : ''}}) {{$good_type ?? ''}}</td>
                    </tr>
                @endif
                @if($selltype == '분할')
                <tr>
                    <th class="bg-white">판매금액</th>
                    <td >{{number_format($user_division_unit)}}당 {{number_format($user_division_price ?? '0')}}원</td>
                </tr>
                @else
                <tr>
                    <th class="bg-white">판매금액</th>
                    <td >{{number_format($user_price ?? '0')}}원</td>
                </tr>
                @endif
                <tr>
                    <th class="bg-white">등록일시</th>
                    <td>{{date("Y-m-d H:i:s",strtotime($created_at ?? ''))}}</td>
                </tr>
                <tr>
                    <th class="bg-white">거래유형</th>
                    <td>{{$selltype ?? '일반'}}판매</td>
                </tr>

            </table>
            <div id="btn_list" class="g_btn_wrap btn_list" style="display: block;">
                <a href="/myroom/sell/sell_regist_view?id={{$orderNo ?? ''}}" class="btn-default btn-suc" >등록 물품보기</a>
                <a href="/sell/list_search?pinit=1" class="btn-default btn-suc" style="font-size: 16px">등록 물품알아보기</a>
                <a href="/index" class="btn-default btn-cancel">메인으로 가기</a>
                <a href="/myroom/sell/sell_regist"class="btn-default btn-cancel">마이룸으로 가기</a>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
