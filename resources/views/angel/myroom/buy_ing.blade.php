@extends('layouts-angel.app-frame')
@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/buy/css/common_list.css" />
@endsection
@section('foot_attach')
@endsection
@section('content')

    <div @class('bg-white')>
        <div>
            @include("angel.myroom.header")
        </div>
        <div @class('ml-10')>
            @include('aside.myroom',['group'=>'buy'])
            <div class="pagecontainer">
                @include('tab.g_tab',['category'=>'buy','group'=>'buy_ing'])
                <div @class('table-responsive brl')>
                    <table class="table-primary tb_list thbn tdbn min600 btnone">
                        <colgroup>
                            <col width="150">
                            <col width="70">
                            <col/>
                            <col width="114">
                            <col width="114">
                        </colgroup>
                        <tr>
                            <th>카테고리</th>
                            <th>분류</th>
                            <th>제목</th>
                            <th>거래금액</th>
                            <th>등록일시</th>
                        </tr>
                        @include('template.myroom_buy',['game'=>$games,'type'=>3])
                    </table>
                </div>
                <div class="empty-high"></div>

                <div class="trade_progress">
                    <div class="highlight_contextual_nodemon">구매진행 안내</div>
                    <div class="trade_progress_content">
                        <div class="guide_wrap">
                            <div class="guide_set">
                                <span class="has-sprite buy_regist_icon"></span> <span class="state">구매물품 등록</span>
                                <p>삽니다에 구매물품이 등록된 상태로 판매신청이 들어오면 구매자에게 SMS 발송</p>
                            </div>
                            <div class="guide_set">
                                <span class="has-sprite pay_wait_icon"></span> <span class="state">입금대기</span>
                                <p>판매신청 접수 후 입금 확인이 이루어지지 않은 단계</p>
                                <i class="has-sprite arr_mini"></i>
                            </div>
                            <div class="guide_set">
                                <span class="has-sprite buy_ing_icon"></span> <span class="state">구매중</span>
                                <p>판매자의 정보를 확인 가능,게임상에서 거래의 진행이 가능합니다.</p>
                                </p> <i class="has-sprite arr_mini"></i>
                            </div>
                            <div class="guide_set">
                                <span class="has-sprite trade_icon"></span> <span class="state">인수</span>
                                <p>판매자에게 물품을 넘겨 받았다면, 인수확인을 완료합니다.</p>
                                <i class="has-sprite arr_mini"></i>
                            </div>
                            <div class="guide_set">
                                <span class="has-sprite buy_complete_icon"></span> <span class="state">구매종료</span>
                                <p>판매자가 인계확인을 완료하면, 거래는 즉시 종료됩니다.</p>
                                <i class="has-sprite arr_mini"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
