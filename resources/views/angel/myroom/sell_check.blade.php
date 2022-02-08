@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/sell/css/common_list.css" />
@endsection

@section('foot_attach')

@endsection

@section('content')

    <div @class('bg-white')>
        <div>
            @include("angel.myroom.header")
        </div>
        <div>
            @include('aside.myroom',['group'=>'sell'])
            <div class="pagecontainer">
                @include('tab.g_tab',['group'=>'sell_check'])
                <div class="tab_sib">- 구매자가 흥정을 신청한 상태 또는 판매자가 재흥정한 상태의 물품입니다.</div>

                <table class="table-primary tb_list tdbn thbn">
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
                <div class="pagination__bootstrap">
                    {{$games->links()}}
                </div>


                <dl class="notice_box"> <dt>흥정거래 알아두기</dt>
                    <dd> 구매자가 흥정거래를 요청한 상태로 1시간 이내에 수락하시면 거래가 진행됩니다. 1시간 이내 수락하지 않은 경우 거래는 취소됩니다. </dd>
                    <dd> 판매자가 구매자에게 재흥정 가격을 제시한 상태로 30분 이내에 재흥정에 대한 구매자의 수락이 없거나 거부할 경우 거래가 취소됩니다. </dd>
                </dl>

                <div class="empty-high"></div>

                <div class="trade_progress">
                    <div class="highlight_contextual_nodemon">판매진행 안내</div>
                    <div class="trade_progress_content">
                        <div class="guide_wrap">
                            <div class="guide_set"> <span class="has-sprite sell_regist_icon"></span> <span class="state">판매물품 등록</span>
                                <p>팝니다에
                                    <br/>판매물품이 등록된
                                    <br/>상태입니다.</p>
                            </div>
                            <div class="guide_set"> <span class="has-sprite pay_wait_icon"></span> <span class="state">입금대기</span>
                                <p>구매신청 후 입금 확인 단계,
                                    <br/>입금 확인 즉시 판매자에게
                                    <br/>SMS를 발송합니다.</p> <i class="has-sprite arr_mini"></i> </div>
                            <div class="guide_set"> <span class="has-sprite sell_ing_icon"></span> <span class="state">판매중</span>
                                <p>구매자의 정보를 확인 가능,
                                    <br/>게임상에서 거래의
                                    <br/>진행이 가능합니다.</p> <i class="has-sprite arr_mini"></i> </div>
                            <div class="guide_set"> <span class="has-sprite trade_icon"></span> <span class="state">인계</span>
                                <p>구매자에게 물품을
                                    <br/>건네주었다면
                                    <br/>인계확인을 완료합니다.</p> <i class="has-sprite arr_mini"></i> </div>
                            <div class="guide_set"> <span class="has-sprite sell_complete_icon"></span> <span class="state">판매종료</span>
                                <p>구매자가 인수확인을
                                    <br/>완료하면, 거래는
                                    <br/>즉시 종료됩니다.</p> <i class="has-sprite arr_mini"></i> </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <div class="empty-high"></div>
    </div>

@endsection
