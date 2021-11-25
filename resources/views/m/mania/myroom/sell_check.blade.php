@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/myroom/sell/css/common_list.css?210114" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')

@endsection

@section('content')
<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    @include('aside.myroom',['group'=>'sell'])
    <div class="g_content">
        <!-- ▼ 타이틀 //-->
        <div class="g_title_blue noborder"> 판매 <span>관련</span>
        </div>
        @include('tab.bs_content',['group'=>'sell'])
        @include('tab.g_tab',['group'=>'sell_check'])
        <!-- ▲ 메뉴탭 //-->
        <div class="tab_sib">- 구매자가 흥정을 신청한 상태 또는 판매자가 재흥정한 상태의 물품입니다.</div>
        <!-- ▼ 흥정신청된 물품 //-->
        <table class="g_green_table1 tb_list">
            <colgroup>
                <col width="150">
                <col width="70">
                <col />
                <col width="95">
                <col width="114">
                <col width="100">
            </colgroup>
            <tr>
                <th>카테고리</th>
                <th>분류</th>
                <th>제목</th>
                <th>거래금액</th>
                <th>등록일시</th>
                <th>구분</th>
            </tr>
            @include('template.myroom',['game'=>$games,'type'=>1])
        </table>
        <div class="dvPaging">
            {{$games->links()}}
        </div>
        <!-- ▲ 흥정신청된 물품 //-->
        <!-- ▼ 흥정거래 알아두기 //-->
        <dl class="notice_box"> <dt>흥정거래 알아두기</dt>
            <dd> <img src="http://img4.itemmania.com/images/icon/icon_barg_ing.gif" width="62" height="14" alt="흥정신청중"> 구매자가 흥정거래를 요청한 상태로 1시간 이내에 수락하시면 거래가 진행됩니다. 1시간 이내 수락하지 않은 경우 거래는 취소됩니다. </dd>
            <dd> <img src="http://img2.itemmania.com/images/icon/icon_barg_again1.gif" width="39" height="14" alt="재흥정"> 판매자가 구매자에게 재흥정 가격을 제시한 상태로 30분 이내에 재흥정에 대한 구매자의 수락이 없거나 거부할 경우 거래가 취소됩니다. </dd>
        </dl>
        <!-- ▲ 흥정거래 알아두기 //-->
        <div class="g_finish"></div>
        <!-- ▼ 판매진행안내 //-->
        <div class="trade_progress">
            <div class="g_subtitle">판매진행 안내</div>
            <div class="trade_progress_content">
                <div class="guide_wrap">
                    <div class="guide_set"> <span class="SpGroup sell_regist_icon"></span> <span class="state">판매물품 등록</span>
                        <p>팝니다에
                            <br/>판매물품이 등록된
                            <br/>상태입니다.</p>
                    </div>
                    <div class="guide_set"> <span class="SpGroup pay_wait_icon"></span> <span class="state">입금대기</span>
                        <p>구매신청 후 입금 확인 단계,
                            <br/>입금 확인 즉시 판매자에게
                            <br/>SMS를 발송합니다.</p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup sell_ing_icon"></span> <span class="state">판매중</span>
                        <p>구매자의 정보를 확인 가능,
                            <br/>게임상에서 거래의
                            <br/>진행이 가능합니다.</p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup trade_icon"></span> <span class="state">인계</span>
                        <p>구매자에게 물품을
                            <br/>건네주었다면
                            <br/>인계확인을 완료합니다.</p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup sell_complete_icon"></span> <span class="state">판매종료</span>
                        <p>구매자가 인수확인을
                            <br/>완료하면, 거래는
                            <br/>즉시 종료됩니다.</p> <i class="SpGroup arr_mini"></i> </div>
                </div>
            </div>
        </div>
        <!-- ▲ 판매진행안내 //-->
    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection