@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/sell/css/common_list.css?210114" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/sell/js/sell_regist.js"></script>
@endsection

@section('content')

<div class="g_container" id="g_CONTENT">
    @include('aside.myroom',['group'=>'sell'])
    <div class="g_content">
        <div class="g_title_blue noborder"> 판매 <span>관련</span></div>
        @include('tab.bs_content',[
                'group'=>'sell',
                'selling_register'=>$selling_register,
                'bargain_request'=>$bargain_request,
                'pay_pending'=>$pay_pending,
                'selling_count'=>$selling_count
                ])
        @include('tab.g_tab',['group'=>'sell_regist'])

        <ul class="tab_sib">
            <li id="icon_info" class="g_left"> - 등록물품은 7일 후 자동으로 삭제됩니다. (캐릭터거래의 경우 30일) </li>
        </ul>
        <div class="g_finish"></div>
        <form id="reInsertFrm" method="POST">
            @csrf
            <input type="hidden" name="id" />
        </form>
        <form id="frmList" method="POST">
            @csrf
            <input type="hidden" id="process" name="process">
            <input type="hidden" id="trade_id" name="trade_id">
            <table class="g_green_table1 tb_list">
                <colgroup>
                    <col width="150" />
                    <col width="70" />
                    <col />
                    <col width="95" />
                    <col width="114" />
                    <col width="110" />
                </colgroup>
                <tr>
                    <th>카테고리</th>
                    <th>분류</th>
                    <th>제목</th>
                    <th>거래금액</th>
                    <th>등록일시</th>
                    <th>구분</th>
                </tr>
                @include('template.myroom',['game'=>$games,'type'=>0])

            </table>
         </form>
        <!-- ▼ 페이징 //-->
        <div class="dvPaging">
            {{$games->links()}}
        </div>
        <!-- ▲ 페이징 //-->
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
                    <div class="guide_set"> <span class="SpGroup trade_icon"></span> <span class="state">인계완료</span>
                        <p>구매자에게 물품을
                            <br/>건네주었다면
                            <br/>인계확인을 완료합니다.</p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup sell_complete_icon"></span> <span class="state">판매완료</span>
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
