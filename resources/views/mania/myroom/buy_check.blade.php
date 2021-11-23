@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/buy/css/common_list.css?210512" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')

@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    @include('aside.myroom',['group'=>'buy'])
    <div class="g_content">
        <div class="g_title_green noborder"> 구매 <span>관련</span></div>
        @include('tab.bs_content',['group'=>'buy'])
        @include('tab.g_tab',['category'=>'buy','group'=>'buy_check'])
        <div class="tab_sib">- 구매자가 흥정을 신청한 상태 또는 판매자가 재흥정한 상태의 물품입니다.</div>
        <table class="g_green_table1 tb_list">
            <colgroup>
                <col width="150">
                <col width="70">
                <col />
                <col width="114">
                <col width="114">
                <col width="100">
            </colgroup>
            <tr>
                <th>카테고리</th>
                <th>분류</th>
                <th>제목</th>
                <th>금액</th>
                <th>등록일시</th>
                <th>구분</th>
            </tr>
            @include('template.myroom_buy',['game'=>$games,'type'=>1])
        </table>
        <div class="dvPaging">
            {{$games->links()}}
        </div>
        <dl class="notice_box"> <dt>흥정거래 알아두기</dt>
            <dd> <span class="f_green2">흥정 신청이란?</span> 팝니다에 등록된 흥정거래 가능 물품에 신청한 상태이며, 1시간 이내 판매자가 수락하지 않는 경우 거래는 취소됩니다. </dd>
            <dd> <span class="f_green2">흥정 수락이란?</span> 판매자가 흥정 요청을 수락한 상태이며, 확인 후 마일리지 결제를 하시면 됩니다. </dd>
            <dd> <span class="f_green2">재흥정이란?</span> 판매자가 재흥정 가격을 제시하는 거래 방식이며, 30분이내 수락이 없거나 거부할 경우 거래가 취소됩니다. </dd>
        </dl>

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
        <!-- ▲ 구매진행안내 //-->
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
