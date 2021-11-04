@php
    $price = str_replace(",","",$user_price);
    $selltype = '일반';
    if(!empty($user_goods_type) && $user_goods_type == 'division'){
        $selltype = '분할';
        $price = str_replace(",",'',$user_division_price) * str_replace(",","",$user_quantity_min) / str_replace(",","",$user_division_unit);
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
@endphp
@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211007">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/buy/css/index_view.css?v=190220">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21100816"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript">
        function _init() {
            $('#btn_list').delay(1200).fadeIn(500);
        }
    </script>

@endsection

@section('content')
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <div class="aside">
            <div class="title_green">알아두기</div>
            <div class="menu_know">
                <p>구매물품 쉽게 등록하기</p> <img src="http://img2.itemmania.com/new_images/sell/sell_left_know.gif" width="192" height="224" alt="팝니다 쉽게 등록하기">
                <p>구매물품 등록 시 알아둘 점</p>
                <ul class="g_list">
                    <li>등록자는 등록한 물품의 문제 발생 시 민/형사상의 모든 책임을 질 것에 동의하는 것으로 간주됩니다.</li>
                    <li>현재 연락처로 꼭 수정해주세요.
                        <br>연락처가 불분명 시 거래에 불이익을 받으실 수 있습니다.</li>
                    <li>[나만의 검색메뉴]를 이용하시면 간편하게 물품등록을 할 수 있습니다.</li>
                </ul>
            </div>
        </div>
        <div class="g_content">
            <div class="g_title_gree nobordern"> 삽니다 <span>등록</span>
            </div>
            <div class="box6"> <span class="reg_icon"></span>
                @if(!empty($user_goods_type))
                    <p class="complete_txt">축하합니다<br>물품이 정상적으로 등록되었습니다.</p> 현재 연락처로 꼭 수정해주세요!
                    <br> 연락처가 불분명 시 거래에 불이익을 받을 수 있습니다. </div>
            @endif
            <div class="g_subtitle">물품정보</div>
            <table class="g_green_table">
                <colgroup>
                    <col width="130">
                    <col>
                </colgroup>
                <tr>
                    <th>카테고리</th>
                    <td colspan="1">{{$category}}</td>
                </tr>
                <tr>
                    <th>제목</th>
                    <td colspan="1">{{$user_title ?? ''}}</td>
                </tr>
                <tr>
                    <th>거래번호</th>
                    <td>#{{$orderNo ?? '#'}}</td>
                </tr>
                <tr>
                    <th>등록일시</th>
                    <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                </tr>
                <tr>
                    <th>물품종류</th>
                    <td>{{$good_type ?? ''}}</td>
                </tr>
                <tr>
                    <th>거래유형</th>
                    <td>{{$selltype ?? '일반'}}판매</td>
                </tr>
                @php
                    $gamemoney_unit = $gamemoney_unit ?? '';
                    $user_quantity = $user_quantity ?? '';
                    $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                @endphp
                @if($c != 1)
                    <tr>
                        <th class="bg-white">구매수량</th>
                        <td>{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit : ''}} {{$good_type ?? ''}}</td>
                    </tr>
                @endif
                <tr>
                    <th>구매금액</th>
                    <td>{{number_format($price)}}원</td>
                </tr>
            </table>
            <div id="btn_list" class="g_btn_wrap btn_list">
                <a href="/myroom/buy/buy_regist_view?id={{$orderNo ?? ''}}" class="btn-default btn-suc" >등록 물품보기</a>
{{--                <a href="/buy/list_search?pinit=1" class="btn-default btn-suc" style="font-size: 16px">등록 물품알아보기</a>--}}
                <a href="/index" class="btn-default btn-cancel">메인으로 가기</a>
                <a href="/myroom/buy/buy_regist"class="btn-default btn-cancel">마이룸으로 가기</a>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
