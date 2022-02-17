@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/carsouel_plugin/css/carsouel_plugin.css" />
    <link type="text/css" rel="stylesheet" href="/angel/buy/css/list_search.css" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/buy/js/list.js?<?=time()?>"></script>
    <script type="text/javascript" src="/angel/buy/js/list_search.js?<?=time()?>"></script>
    <script>
        $(".btn__goods_type").click(function(){
            $("#frm_search #search_type").val($(this).data('value'));
            $("#frm_search").attr('action','/'+$(this).data('value')+'/list_search')
            $("#frm_search").submit()
        })
        $("#server_combo").select2({
            placeholder: '서버명',
            width: '200px'
        })
        $("#server_combo").on("select2:select", function (e) {
            let game_id = e.params.data.id;
            if(game_id == 'all'){
                game_id = "";
            }
            $("#filtered_child_id").val(game_id);
            $("#frm_search").attr('src','/buy/list_search');
            $("#frm_search").submit()
        })
    </script>
@endsection

@section('content')
    <div @class('bg-white')>
        <div></div>
        <div class="ml-10 mr-10">
            <div class="spacer_bottom_20"></div>
            <a name="search_top"></a>
            @if(!empty($g_list))
                <div class="sttl4 default_wrap mt020"><h2><img src="{{$g_list['icon']}}">{{$g_list['game']}}<em></em></h2></div>
                @if(!empty($s_list))
                    <div @class('mt-10 mb-10')> 선택 : <select id="server_combo">
                            <option value="all">서버전체</option>
                            @foreach($s_list as $s)
                                <option value="{{$s['id']}}" @if($s['id'] == $filtered_child_id) selected @endif>{{$s['game']}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            @endif
            <div>
                <ul class="trade_sub_title mb-10">
                    <li class="btn__goods_type" data-value="sell">판매 리스트</li>
                    <li class="btn__goods_type selected" data-value="buy">구매 리스트</li>
                </ul>
            </div>

{{--            <div class="react_nav_tab navs__pops_secondary">--}}
{{--                <div  value="money" @if(!empty($filtered_items) && $filtered_items =='money') class="selected" @endif>게임머니</div>--}}
{{--                <div  value="item" @if(!empty($filtered_items) && $filtered_items =='item') class="selected" @endif>아이템</div>--}}
{{--                <div  value="character" @if(!empty($filtered_items) && $filtered_items =='character') class="selected" @endif>캐릭터</div>--}}
{{--                <div  value="etc" @if(!empty($filtered_items) && $filtered_items =='etc') class="selected" @endif>기타</div>--}}
{{--                <div class="side">--}}
{{--                    <ul class="search_word">--}}
{{--                        <li>--}}
{{--                            <input type="text" class="angel__text angel__text_par" name="word" id="word" value="{{$search_word ?? ""}}" placeholder="물품제목" maxlength="5">--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <span class="btn_search"><i class="fa fa-search"></i></span>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="d-flex">
                <a href="javascript:;" data-value="money" class="search__head_btn @if(!empty($filtered_items) && $filtered_items =='money') selected @endif">게임머니</a>
                <a href="javascript:;" data-value="item" class="search__head_btn @if(!empty($filtered_items) && $filtered_items =='item') selected @endif">아이템</a>
                <a href="javascript:;" data-value="character" class="search__head_btn @if(!empty($filtered_items) && $filtered_items =='character') selected @endif">캐릭터</a>
                <a href="javascript:;" data-value="etc" class="search__head_btn @if(!empty($filtered_items) && $filtered_items =='etc') selected @endif">기타</a>
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
                    <input type="hidden" name="filtered_child_alias" id="filtered_child_alias" value="{{$filtered_child_alias}}">
                    <input type="hidden" name="filtered_items" id="filtered_items" value="{{$filtered_items ?? 'all'}}">
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
                    <div class="table-responsive">
                        <table class="table-striped table-green1 min600">
                            <colgroup>
                                <col width="83px">
                                <col width="*">
                            </colgroup>
                            <tr class="search_row">
                                <th class="search_tit">물품유형</th>
                                <td id="goods">
                                    <li @if($goods_type == 'all' || empty($goods_type)) class="selected" @endif>
                                        <label><input type="radio" name="goods_type" value="all" class="g_btn_white2_radio" @if($goods_type == 'all' || empty($goods_type)) checked @endif>전체</label>
                                    </li>
                                    <li @if($goods_type == 'general') class="selected" @endif>
                                        <label><input type="radio" name="goods_type" value="general" class="g_btn_white2_radio" @if($goods_type == 'general') checked @endif>일반</label>
                                    </li>
                                    <li @if($goods_type == 'division') class="selected" @endif>
                                        <label><input type="radio" name="goods_type" value="division" class="g_btn_white2_radio" @if($goods_type == 'division') checked @endif>분할</label>
                                    </li>
                                </td>
                                <th class="search_tit">거래상태</th>
                                <td id="state">
                                    <li @if($trade_state == 1 || empty($trade_state)) class="selected" @endif>
                                        <label><input type="radio" name="trade_state" value="1" class="g_btn_white2_radio" @if($trade_state == 1 || empty($trade_state))checked @endif>전체</label>
                                    </li>
                                    <li @if($trade_state == 2) class="selected" @endif>
                                        <label><input type="radio" name="trade_state" value="2" class="g_btn_white2_radio" @if($trade_state == 2)checked @endif>거래대기</label>
                                    </li>
                                    <li @if($trade_state == 3) class="selected" @endif>
                                        <label><input type="radio" name="trade_state" value="3" class="g_btn_white2_radio" @if($trade_state == 3)checked @endif>거래종료</label>
                                    </li>
                                </td>
                            </tr>

                            @if($filtered_items == 'item')
{{--                                <tr class="search_row">--}}
{{--                                    <th class="search_tit">분류</th>--}}
{{--                                    <td  colspan="3">--}}
{{--                                        <li @if(!empty($archer)) class="selected" @endif>--}}
{{--                                            <label><input type="checkbox" name="archer" value="궁수"  class="angel_game_sel" @if(!empty($archer)) checked @endif>궁수</label>--}}
{{--                                        </li>--}}
{{--                                        <li @if(!empty($wizard)) class="selected" @endif>--}}
{{--                                            <label><input type="checkbox" name="wizard" value="마법사"  class="angel_game_sel" @if(!empty($wizard)) checked @endif> 마법사</label>--}}
{{--                                        </li>--}}
{{--                                        <li @if(!empty($man)) class="selected" @endif>--}}
{{--                                            <label><input type="checkbox" name="man" value="전사"  class="angel_game_sel"  @if(!empty($man)) checked @endif> 전사</label>--}}
{{--                                        </li>--}}
{{--                                        <li @if(!empty($holy)) class="selected" @endif>--}}
{{--                                            <label><input type="checkbox" name="holy" value="성기사" class="angel_game_sel" @if(!empty($holy)) checked @endif>성기사</label>--}}
{{--                                        </li>--}}
{{--                                        <li @if(!empty($sculptor)) class="selected" @endif>--}}
{{--                                            <label><input type="checkbox" name="sculptor" value="조각사" class="angel_game_sel" @if(!empty($sculptor)) checked @endif>조각사</label>--}}
{{--                                        </li>--}}
{{--                                        <li @if(!empty($alchemy)) class="s">--}}
{{--                                            <label><input type="checkbox" name="alchemy" value="연금술사" class="angel_game_sel" @if(!empty($alchemy)) checked @endif>연금술사</label>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <label><input type="checkbox" name="changi" value="창기사" class="angel_game_sel" @if(!empty($changi)) checked @endif>창기사</label>--}}
{{--                                        </li>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
                            @endif
                            @if($filtered_items == 'character')
                                <tr class="search_row">
                                    <th class="search_tit">계정종류</th>
                                    <td>
                                        <li @if(!empty($google)) class="selected" @endif>
                                            <label><input type="checkbox" name="google"  class="angel_game_sel" @if(!empty($google)) checked @endif>구글</label>
                                        </li>
                                        <li @if(!empty($facebook)) class="selected" @endif>
                                            <label><input type="checkbox" name="facebook"  class="angel_game_sel" @if(!empty($facebook)) checked @endif> 페북</label>
                                        </li>
                                        <li @if(!empty($guest)) class="selected" @endif>
                                            <label><input type="checkbox" name="guest"  class="angel_game_sel"  @if(!empty($guest)) checked @endif> 게스트</label>
                                        </li>
                                        <li @if(!empty($out)) class="selected" @endif>
                                            <label><input type="checkbox" name="out" class="angel_game_sel" @if(!empty($out)) checked @endif>기타</label>
                                        </li>
                                    </td>
                                    <th class="search_tit">구매경로</th>
                                    <td id="etc">
                                        <li @if(empty($purchase_type)) class="selected" @endif>
                                            <label><input type="radio" name="purchase_type" value="" class="g_btn_white2_radio" @if(empty($purchase_type)) checked @endif>전체</label>
                                        </li>
                                        <li @if(!empty($purchase_type) && $purchase_type == 1) class="selected" @endif>
                                            <label><input type="radio" name="purchase_type" value="1"   class="angel_game_sel" @if(!empty($purchase_type) && $purchase_type == 1) checked @endif>본인 1대</label>
                                        </li>
                                        <li @if(!empty($purchase_type) && $purchase_type == 9) class="selected" @endif>
                                            <label><input type="radio" name="purchase_type"  value="9" class="angel_game_sel" @if(!empty($purchase_type) && $purchase_type == 9) checked @endif> 그외</label>
                                        </li>
                                    </td>
                                </tr>
                                <tr class="search_row">
                                    <th class="search_tit">고객번호 유무</th>
                                    <td id="etc">
                                        <li @if(!empty($customer_num) && $customer_num == 1) class="selected" @endif>
                                            <label><input type="radio" name="customer_num" value="1"  class="angel_game_sel" @if(!empty($customer_num) && $customer_num == 1) checked @endif>o</label>
                                        </li>
                                        <li @if(empty($customer_num) || $customer_num == 2) class="selected" @endif>
                                            <label><input type="radio" name="customer_num" value="2" class="angel_game_sel" @if(empty($customer_num) || $customer_num == 2) checked @endif>x</label>
                                        </li>
                                    </td>
                                    <th class="search_tit">결제내역 유무</th>
                                    <td id="etc">
                                        <li @if(empty($payment_existence)) class="selected" @endif>
                                            <label><input type="radio" name="payment_existence" value="" class="angel_game_sel" @if(empty($payment_existence)) checked @endif>전체</label>
                                        </li>
                                        <li @if(!empty($payment_existence) && $payment_existence == 1) class="selected" @endif>
                                            <label><input type="radio" name="payment_existence" value="1"  class="angel_game_sel" @if(!empty($payment_existence) && $payment_existence == 1) checked @endif>o</label>
                                        </li>
                                        <li @if(!empty($payment_existence) && $payment_existence == 2) class="selected" @endif>
                                            <label><input type="radio" name="payment_existence" value="2" class="angel_game_sel" @if(!empty($payment_existence) && $payment_existence == 2) checked @endif>x</label>
                                        </li>
                                    </td>
                                </tr>
                            @endif
                            <tr class="search_row">
                                <th class="search_tit">신용등급</th>
                                <td id="credit" colspan="3">
                                    <li>
                                        <label><input type="radio" name="credit_type" value="0" class="g_btn_white2_radio" @if($credit_type == 0) checked @endif>전체</label>
                                    </li>
                                    @if(!empty($roles))
                                        @foreach($roles as $v)
                                            <li>
                                                <label><input type="radio" name="credit_type" value="{{$v['level']}}" class="g_btn_white2_radio" @if($credit_type == $v['level']) checked @endif>{{$v['alias']}} 이상</label>
                                            </li>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr class="search_row">
                                <th class="search_tit">기타조건</th>
                                <td  colspan="3">
                                    <li>
                                        <label><input type="checkbox" name="excellent" id="excellent" class="angel_game_sel" @if(!empty($excellent)) checked @endif>우수인증 회원</label>
                                    </li>
                                    <li>
                                        <label><input type="checkbox" name="overlap_tmp" id="overlap_tmp" class="angel_game_sel" @if($overlap == 'on') checked @endif> 중복물품제외</label>
                                    </li>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="toggleer"></div>
                </form>
            </div>

            <div class="highlight_contextual_nodemon mt-10">
                <div class="float-left">프리미엄</div>
            </div>
            <div class="table-responsive">
                <ul class="item_filtered list_head min600">
                    <li>
                        <div class="col_01">등급</div>
                        <div class="col_02">물품제목</div>
                        <div class="col_03">판매금액</div>
                        <div class="col_04">물품정보</div>
                        <div class="col_05">등록일</div>
                    </li>
                </ul>
                <ul class="item_filtered item_filtered__premium min600">

                </ul>
            </div>
            <div class="loading d-none"></div>
            <div class="highlight_contextual_nodemon mt-10">
                <div class="float-left">
                    물품리스트<a name="list_top"></a>
{{--                    <ul class="opt_list" id="opt_list">--}}
{{--                        <li data-type="2" @if((!empty($order) && $order ==2) || empty($order)) class="active" @endif>최근등록순</li>--}}
{{--                        <li data-type="1" @if(!empty($order) && $order ==1) class="active" @endif>최저가격순</li>--}}
{{--                    </ul>--}}
                </div>
                <div class="float__right list_info" id="list_info">
                    리프레시
                    <i class="fa fa-refresh icon_refresh"></i>
                    <div class="info_layer">
                        <div class="il_title">물품정보안내란?</div>
                        <div class="list_sprite il_close"></div>
                        <div class="il_row">
                            <div class="il_btn"><i class="list_sprite il_btn_good"></i>우수인증</div>
                            휴대폰, 이메일, 출금계좌가 모두 인증된 회원
                        </div>
                        <div class="il_row">
                            <div class="il_btn"><i class="list_sprite il_btn_dc"></i>할인</div>
                            할인가가 적용된 판매자 상품
                        </div>
                    </div>
                </div>
            </div>
            <div class="empty-high"></div>
            <div class="table-responsive">
                <ul class="item_filtered list_head min600">
                    <li>
                        <div class="col_01">등급</div>
                        <div class="col_02">물품제목</div>
                        <div class="col_03">판매금액</div>
                        <div class="col_04">물품정보</div>
                        <div class="col_05">등록일</div>
                    </li>
                </ul>
                <ul class="item_filtered item_filtered__average min600">

                </ul>
            </div>
            <div class="loading d-none"></div>
            <div class="load_more">
                <div >더보기</div>
                <div class="text-center">
                    <i class="fa fa-angle-down more-btn"></i>
                </div>
            </div>
            <div class="react___gatsby item_regInfo" id="item_regInfo">
                <div class="inner">
                    <div class="title">
                        물품등록정보
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
                                <div class="regInfo_subcontent_in">
                                    <span class="cert_state" id="cell_auth">휴대폰</span>
                                    <span class="cert_state" id="email_auth">이메일</span>
                                    <span class="cert_state" id="account_auth">출금계좌</span>
                                </div>
                            </li>
                        </ul>
                        <div class="b_input_group">
                            <a href="#" class="regInfo_btn buyapp" id="appBtn">구매신청</a>
                            <a href="#" class="regInfo_btn detail" id="detailBtn">상세보기</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
