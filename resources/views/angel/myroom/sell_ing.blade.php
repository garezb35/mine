@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/sell/css/common_list.css?210114" />
@endsection

@section('foot_attach')
@endsection

@section('content')
<div class="g_container" id="g_CONTENT">
    @include('aside.myroom',['group'=>'sell'])
    <div class="g_content">
        <div class="g_title_blue noborder"> 판매 <span>관련</span></div>
        @include('tab.bs_content',['group'=>'sell'])
        @include('tab.g_tab',['group'=>'sell_ing'])
        <div class="tab_sib">- 구매자가 입금을 완료한 상태입니다. 구매자와 전화통화 또는 1:1대화함으로 거래를 진행해주시기 바랍니다.</div>
        <table class="g_green_table1 tb_list">
            <colgroup>
                <col width="150">
                <col width="70">
                <col />
                <col width="114">
                <col width="114">
{{--                <col width="100">--}}
            </colgroup>
            <tr>
                <th>카테고리</th>
                <th>분류</th>
                <th>제목</th>
                <th>거래금액</th>
                <th>등록일시</th>
{{--                <th>구분</th>--}}
            </tr>
            @include('template.myroom',['game'=>$games,'type'=>3])
        </table>
        <div class="dvPaging">
            {{$games->links()}}
        </div>
        <!-- ▲ 판매중인물품 //-->
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
    <ul id="attention_info" class="g_black5_11 g_hidden">
        <li class="g_blue1_11b">아이템천사가 알려드리는 꼭 지켜야할 안전수칙 !!</li>
        <li>1. 구매자의 <span class="g_org1_11b">연락처를 꼭 확인</span>합니다.
            <br>&nbsp;&nbsp;&nbsp;다른 연락처로 전화가 올 경우 거래취소 또는 고객감동센터로 문의합니다.</li>
        <li>2. 판매자 <span class="g_org1_11b">캐릭터명에 입력했던 캐릭터</span>로 거래 합니다.</li>
        <li>3. 거래 시에는 게임상에서 <span class="g_org1_11b">채팅이나 귓말은 삼가하고 가능한 전화통화를 유지</span>하며 거래합니다.</li>
        <li>4. 반드시 물품을 <span class="g_org1_11b">정상적으로 건네주고 물품 인계확인</span>을 합니다.</li>
    </ul>
    <!-- ▼ 안심번호 서비스란? //-->
    <div id="safety_numinfo" class="g_hidden">
        <div class="g_blue1_b">안심번호 서비스란?</div> 고객님의 개인정보 보호를 위해 휴대폰번호에 안심번호를 부여하여 실제 휴대폰번호 대신
        <br> 가상의 안심번호를 상대 거래자에게 노출시켜주는 무료 서비스
        <ul class="margin10 g_red1_11"> <span class="bold_txt">안심번호 서비스 사용 시 주의사항</span>
            <br> 1) 부여받은 안심번호로도 문자 수신이 가능합니다.(발신시에는 부여받은 안심번호 사용)
            <br> 2) 상대거래자가 안심번호 서비스를 사용하지 않는 상태에서 발싱한 경우 실제 번호가 표시됩니다.
            <br> 3) 부여 받은 안심번호는 거래가 종료되는 시점에 자동 회수되며, 회수된 이후에는 연락이 불가능합니다.
            <br> 4) 안심번호 사용 후 48시간을 초과하거나 거래종료 후 문제발생 시 실제 전화번호가 노출됩니다. </ul>
        <div style="margin-top:10px;text-align:center">
            <a href="/guide/add/security_number><img src="http://img4.itemmania.com/images/btn/btn_safe_numer.gif" width="166" height="25" alt="안심번호서비스 자세히보기"></a>
        </div>
    </div>
    <!-- ▲ 안심번호 서비스란? //-->
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
