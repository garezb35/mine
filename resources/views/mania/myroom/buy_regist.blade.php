@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/common_list.css?210512" />
    <!--<script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>-->
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/myroom/buy/js/buy_regist.js"></script>
@endsection

@section('content')
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        @include('aside.myroom',['group'=>'buy'])
        <div class="g_content">

            <div class="g_title_green noborder"> 구매 <span>관련</span></div>
            @include('tab.bs_content',['group'=>'buy'])
            @include('tab.g_tab',['category'=>'buy','group'=>'buy_regist'])

            <ul class="tab_sib">
                <li id="icon_info" class="g_left"> - 등록물품은 7일 후 자동으로 삭제됩니다. (캐릭터거래의 경우 30일) </li>
            </ul>

            <form id="reInsertFrm" method="POST">
                @csrf
                <input type="hidden" name="id"> </form>
            <form id="frmList" method="post">
                @csrf
                <input type="hidden" id="process" name="process">
                <input type="hidden" id="trade_id" name="trade_id">

                <table class="g_green_table1 tb_list">
                    <colgroup>
                        <col width="150" />
                        <col width="70" />
                        <col/>
                        <col width="95" />
                        <col width="114" />
                        <col width="114" />
                    </colgroup>
                    <tr>
                        <th>카테고리</th>
                        <th>분류</th>
                        <th>제목</th>
                        <th>거래금액</th>
                        <th>등록일시</th>
                        <th>구분</th>
                    </tr>
                    @include('template.myroom_buy',['game'=>$games,'type'=>0])
                </table>
            </form>
            <div class="dvPaging">
                {{$games->links()}}
            </div>
            <div class="g_finish"></div>
            <div class="trade_progress">
                <div class="g_subtitle">구매진행 안내</div>
                <div class="trade_progress_content">
                    <div class="guide_wrap">
                        <div class="guide_set"> <span class="SpGroup buy_regist_icon"></span> <span class="state">구매물품 등록</span>
                            <p>삽니다에 구매물품이 등록된
                                <br/>상태로 판매신청이 들어오면
                                <br/>구매자에게 SMS 발송</p>
                        </div>
                        <div class="guide_set"> <span class="SpGroup pay_wait_icon"></span> <span class="state">입금대기</span>
                            <p>판매신청 접수 후
                                <br/>입금 확인이
                                <br/>이루어지지 않은 단계</p> <i class="SpGroup arr_mini"></i> </div>
                        <div class="guide_set"> <span class="SpGroup buy_ing_icon"></span> <span class="state">구매중</span>
                            <p>판매자의 정보를 확인 가능,
                                <br/>게임상에서 거래의
                                <br/>진행이 가능합니다.</p>
                            </p> <i class="SpGroup arr_mini"></i> </div>
                        <div class="guide_set"> <span class="SpGroup trade_icon"></span> <span class="state">인수</span>
                            <p>판매자에게 물품을
                                <br/>넘겨 받았다면,
                                <br/>인수확인을 완료합니다.</p> <i class="SpGroup arr_mini"></i> </div>
                        <div class="guide_set"> <span class="SpGroup buy_complete_icon"></span> <span class="state">구매종료</span>
                            <p>판매자가 인계확인을
                                <br/>완료하면, 거래는
                                <br/>즉시 종료됩니다.</p> <i class="SpGroup arr_mini"></i> </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="g_finish"></div>
    </div>

@endsection
