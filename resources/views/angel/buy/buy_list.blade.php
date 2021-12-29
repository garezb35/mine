@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel_plugin.css" />
    <link type="text/css" rel="stylesheet" href="/angel/buy/css/list_search.css" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/buy/js/list.js"></script>
@endsection

@section('content')
    <div class="container_fulids" id="module-teaser-fullscreen">
        <div class="spacer_bottom_20"></div>
        <a name="search_top"></a>
        <div class="text-green_moderation noborder">
            <div class="float-left">
                <ul class="trade_sub_title">
                    <li>삽니다</li>
                    <li class="game_name"> <span>서버전체</span> </li>
                </ul>
            </div>
        </div>
        <div class="react_nav_tab">
            <div  value="money" @if(!empty($filtered_items) && $filtered_items =='money') class="selected" @endif>게임머니</div>
            <div  value="item" @if(!empty($filtered_items) && $filtered_items =='item') class="selected" @endif>아이템</div>
            <div  value="character" @if(!empty($filtered_items) && $filtered_items =='character') class="selected" @endif>캐릭터</div>
            <div  value="etc" @if(!empty($filtered_items) && $filtered_items =='etc') class="selected" @endif>기타</div>
            <div class="side">
                <ul class="search_word">
                    <li>
                        <input type="text" class="angel__text angel__text_par" name="word" id="word" value="{{$search_word ?? ""}}" placeholder="물품제목" maxlength="5">
                    </li>
                    <li>
                        <span class="btn_search"><i class="fa fa-search"></i></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="empty-high"></div>
        <div id="detail_search" class="detail_search">
            <form id="frm_search" name="frm_search" method="POST">
                @csrf
                <input type="hidden" name="game_code" id="game_code" value="{{$filtered_game_id ?? ''}}">
                <input type="hidden" name="server_code" id="server_code" value="{{$filtered_child_id ?? ''}}">
                <input type="hidden" name="filtered_game_id" id="filtered_game_id" value="{{$filtered_game_id ?? ''}}">
                <input type="hidden" name="filtered_child_id" id="filtered_child_id" value="{{$filtered_child_id}}">
                <input type="hidden" name="filtered_game_alias" id="filtered_game_alias" value="{{$filtered_game_alias}}">
                <input type="hidden" name="filtered_child_alias" id="filtered_child_alias" value="서버전체">
                <input type="hidden" name="filtered_items" id="filtered_items" value="{{$filtered_items}}">
                <input type="hidden" name="search_word" id="search_word" value="{{$search_word ?? ''}}">
                <input type="hidden" name="search_type" id="search_type" value="buy">
                <input type="hidden" name="money_listOrder" id="money_listOrder" value="">
                <input type="hidden" name="good_listOrder" id="good_listOrder" value="">
                <input type="hidden" name="srch_item_depth1" id="srch_item_depth1" value="">
                <input type="hidden" name="srch_item_depth2" id="srch_item_depth2" value="">
                <input type="hidden" name="srch_item_depth3" id="srch_item_depth3" value="">
                <input type="hidden" name="srch_item_depth4" id="srch_item_depth4" value="">
                <input type="hidden" name="order" id="order" value="{{$order ?? ''}}">
                <input type="hidden" name="srch_char_alarm" id="srch_char_alarm" value="">
                <input type="hidden" name="overlap" id="overlap" value="{{$overlap}}">
                <input type="hidden" name="goods_type" value="{{$goods_type}}"> </form>
        </div>
        <div class="highlight_contextual_nodemon">
            <div class="float-left">프리미엄</div>
        </div>
        <div class="item_filtered__all">
            <ul class="item_filtered item_filtered__premium">

            </ul>
            <div class="loading d-none"></div>
        </div>
        <div class="highlight_contextual_nodemon">
            <div class="float-left">물품리스트
                <a name="list_top"></a>
                <ul class="opt_list" id="opt_list">
                    <li data-type="all" @if($goods_type == 'all' || empty($goods_type)) class="active" @endif>전체</li>
                    <li data-type="general" @if($goods_type == 'general' || empty($goods_type)) class="active" @endif>일반</li>
                    <li data-type="division" @if($goods_type == 'division' || empty($goods_type)) class="active" @endif>분할</li>
                    <li data-type="bargain" @if($goods_type == 'bargain' || empty($goods_type)) class="active" @endif>흥정</li>
                </ul>
            </div>
            <div class="float__right list_info" id="list_info">
                리프레시
                <i class="fa fa-refresh icon_refresh"></i>
                <div class="info_layer">
                    <div class="il_title">물품정보안내란?</div>
                    <div class="list_sprite il_close"></div>
                    <div class="il_row">
                        <div class="il_btn"><i class="list_sprite il_btn_good"></i>우수인증</div> 휴대폰, 이메일, 출금계좌가 모두 인증된 회원 </div>
                    <div class="il_row">
                        <div class="il_btn"><i class="list_sprite il_btn_g200"></i>200% 보상</div> 거래사고 시 판매자가 200% 보상하는 물품 </div>
                    <div class="il_row">
                        <div class="il_btn"><i class="list_sprite il_btn_dc"></i>할인</div> 할인가가 적용된 판매자 상품 </div>
                    <div class="il_row">
                        <div class="il_btn"><i class="list_sprite il_btn_nego"></i>흥정</div> 구매자의 흥정신청이 가능한 물품 </div>
                </div>
            </div>
        </div>
        <div class="empty-high"></div>
        <div class="item_filtered__all">
            <ul class="item_filtered list_head">
                <li>
                    <div class="col_01">서버종류</div>
                    <div class="col_02">물품제목</div>
                    <div class="col_03">판매금액</div>
                    <div class="col_04">물품정보</div>
                    <div class="col_05">등록시간</div>
                </li>
            </ul>
            <ul class="item_filtered item_filtered__average">
            </ul>
            <div class="loading d-none"></div>
            <div class="load_more">
                <div >더보기</div>
                <div class="text-center">
                    <i class="fa fa-angle-down more-btn"></i>
                </div>
            </div>
        </div>
        <div class="react___gatsby item_regInfo" id="item_regInfo">
            <div class="inner">
                <div class="title"> 물품등록정보
                    <a href="javascript:;" class="fade__out"></a>
                </div>
                <div class="cont">
                    <div class="subtitle first">물품 정보</div>
                    <ul class="regInfo_subcontent">
                        <li>
                            <div class="regInfo_subcontent_label">물품종류</div>
                            <div class="regInfo_subcontent_in" id="kind"></div>
                        </li>
                        <li>
                            <div class="regInfo_subcontent_label">거래번호</div>
                            <div class="regInfo_subcontent_in" id="tid"></div>
                        </li>
                        <li>
                            <div class="regInfo_subcontent_label">판매금액</div>
                            <div class="regInfo_subcontent_in" id="money"></div>
                        </li>
                    </ul>
                    <div class="space"></div>
                    <div class="subtitle">판매자 정보</div>
                    <ul class="regInfo_subcontent">
                        <li>
                            <div class="regInfo_subcontent_label">신용등급</div>
                            <div class="regInfo_subcontent_in" id="credit_info"></div>
                        </li>
                        <li>
                            <div class="regInfo_subcontent_label">거래점수</div>
                            <div class="regInfo_subcontent_in" id="credit_point"></div>
                        </li>
                        <li>
                            <div class="regInfo_subcontent_label">인증상태</div>
                            <div class="regInfo_subcontent_in"> <span class="cert_state" id="cell_auth">휴대폰</span> <span class="cert_state" id="email_auth">이메일</span> <span class="cert_state" id="account_auth">출금계좌</span> </div>
                        </li>
                    </ul>
                    <div class="b_input_group"> <a href="#" class="btn-default-medium btn-suc-rect" id="appBtn">구매신청</a> <a href="#" class="regInfo_btn detail" id="detailBtn">상세보기</a> </div>
                </div>
            </div>
        </div>

        <p class="spacer_bottom_20"></p>
        <div class="empty-high"></div>
    </div>
@endsection

