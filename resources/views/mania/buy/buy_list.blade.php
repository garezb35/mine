@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/_banner.css" />
    <link type="text/css" rel="stylesheet" href="/mania/buy/css/list_search.css" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/buy/js/list.js"></script>
@endsection

@section('content')
    <div class="g_container" id="g_CONTENT">
        <!--▼▼▼ 리스트 게임 코드 배너 ▼▼▼ -->
        <div class="spacer_bottom_20"></div>
        <!--▲▲▲ 리스트 게임 코드 배너 ▲▲▲ -->
        <a name="search_top"></a>
        <div class="g_title_green noborder">
            <div class="g_left">
                <ul class="trade_sub_title">
                    <li>삽니다</li>
                    <li class="game_name"> <span>서버전체</span> </li>
                </ul>
            </div>
        </div>
        <!-- ▼ 메뉴탭 //-->
        <div class="g_tab">
            <div  value="money" @if(!empty($search_goods) && $search_goods =='money') class="selected" @endif>게임머니</div>
            <div  value="item" @if(!empty($search_goods) && $search_goods =='item') class="selected" @endif>아이템</div>
            <div  value="character" @if(!empty($search_goods) && $search_goods =='character') class="selected" @endif>캐릭터</div>
            <div  value="etc" @if(!empty($search_goods) && $search_goods =='etc') class="selected" @endif>기타</div>
            <div class="side">
                <ul class="search_word">
                    <li>
                        <input type="text" class="g_text g_text_par" name="word" id="word" value="{{$search_word ?? ""}}" placeholder="물품제목" maxlength="5">
                    </li>
                    <li>
                        <span class="btn_search"><i class="fa fa-search"></i></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="g_finish"></div>
        <!-- ▲ 메뉴탭 //-->
        <!-- ▼ 팝니다 등록 검색 //-->
        <div id="detail_search" class="detail_search">
            <form id="frm_search" name="frm_search" method="POST">
                @csrf
                <input type="hidden" name="game_code" id="game_code" value="{{$search_game ?? ''}}">
                <input type="hidden" name="server_code" id="server_code" value="{{$search_server ?? ''}}">
                <input type="hidden" name="search_game" id="search_game" value="{{$search_game ?? ''}}">
                <input type="hidden" name="search_server" id="search_server" value="{{$search_server}}">
                <input type="hidden" name="search_game_text" id="search_game_text" value="{{$search_game_text}}">
                <input type="hidden" name="search_server_text" id="search_server_text" value="서버전체">
                <input type="hidden" name="search_goods" id="search_goods" value="{{$search_goods}}">
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
        <!-- ▲ 팝니다 등록 검색 //-->
        <div class="g_subtitle">
            <div class="g_left">프리미엄</div>
        </div>
        <div class="search_list_all">
            <ul class="search_list search_list_premium">

            </ul>
            <div class="loading g_hidden"></div>
        </div>
        <div class="g_subtitle">
            <div class="g_left">물품리스트
                <a name="list_top"></a>
                <ul class="opt_list" id="opt_list">
                    <li data-type="all" @if($goods_type == 'all' || empty($goods_type)) class="active" @endif>전체</li>
                    <li data-type="general" @if($goods_type == 'general' || empty($goods_type)) class="active" @endif>일반</li>
                    <li data-type="division" @if($goods_type == 'division' || empty($goods_type)) class="active" @endif>분할</li>
                    <li data-type="bargain" @if($goods_type == 'bargain' || empty($goods_type)) class="active" @endif>흥정</li>
                </ul>
            </div>
            <div class="g_right list_info" id="list_info">
                리프레시
                <i class="list_sprite icon_refresh"></i>
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
        <div class="g_finish"></div>
        <div class="search_list_all">
            <ul class="search_list list_head">
                <li>
                    <div class="col_01">서버종류</div>
                    <div class="col_02">물품제목</div>
                    <div class="col_03">판매금액</div>
                    <div class="col_04">물품정보</div>
                    <div class="col_05">등록시간</div>
                </li>
            </ul>
            <ul class="search_list search_list_normal">
            </ul>
            <div class="loading g_hidden"></div>
            <div class="load_more">
                <div >더보기</div>
                <div class="text-center">
                    <i class="fa fa-angle-down more-btn"></i>
                </div>
            </div>
        </div>
        <div class="g_layer item_regInfo" id="item_regInfo">
            <div class="inner">
                <div class="title"> 물품등록정보
                    <a href="javascript:;" class="close_w"></a>
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
                    <div class="g_btn_wrap"> <a href="#" class="regInfo_btn buyapp" id="appBtn">구매신청</a> <a href="#" class="regInfo_btn detail" id="detailBtn">상세보기</a> </div>
                </div>
            </div>
        </div>

        <p class="spacer_bottom_20"></p>
        <!--▲▲▲ 리스트 하단 배너 ▲▲▲ -->
        <div class="g_finish"></div>
    </div>
@endsection

