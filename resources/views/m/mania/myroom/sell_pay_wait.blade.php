@extends('layouts-angel.app')
@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/sell/css/common_list.css?210114" />

    <script type="text/javascript" src="/angel/_banner/js/banner_module.js?v=210209"></script>
@endsection
@section('foot_attach')
@endsection
@section('content')

    <div class="container_fulids" id="module-teaser-fullscreen">
        @include('aside.myroom',['group'=>'sell'])
        <div class="pagecontainer">
            <div class="contextual--title noborder"> 판매 <span>관련</span></div>
            @include('tab.bs_content',['group'=>'sell'])
            @include('tab.g_tab',['group'=>'sell_pay_wait'])
            <div class="tab_sib">
                <span class="f_red1 font-weight-bold">※ 구매자가 아직 입금을 하지 않은 상태입니다.  입금확인이 완료된 후에 거래를 진행하시기 바랍니다.</span>
            </div>

            <div class="empty-high"></div>
            @csrf
            <form id="reInsertFrm" method="POST">
                <input type="hidden" name="id" />
            </form>
            <form id="frmList" method="POST">
                @csrf
                <input type="hidden" id="process" name="process">
                <input type="hidden" id="trade_id" name="trade_id">

                <table class="table-modern-primary tb_list">
                    <colgroup>
                        <col width="150" />
                        <col width="70" />
                        <col />
                        <col width="114" />
                        <col width="114" />
                    </colgroup>
                    <tr>
                        <th>카테고리</th>
                        <th>분류</th>
                        <th>제목</th>
                        <th>거래금액</th>
                        <th>등록일시</th>
                    </tr>
                    @include('template.myroom',['game'=>$games,'type'=>2])
                </table>
            </form>

            <div class="pagination__bootstrap">
                {{$games->links()}}
            </div>

            <div class="empty-high"></div>

            <div class="trade_progress">
                <div class="highlight_contextual_nodemon">판매진행 안내</div>
                <div class="trade_progress_content">
                    <div class="guide_wrap">
                        <div class="guide_set">
                            <span class="has-sprite sell_regist_icon"></span> <span class="state">판매물품 등록</span>
                            <p>팝니다에
                                <br/>판매물품이 등록된
                                <br/>상태입니다.
                            </p>
                        </div>
                        <div class="guide_set">
                            <span class="has-sprite pay_wait_icon"></span> <span class="state">입금대기</span>
                            <p>구매신청 후 입금 확인 단계,
                                <br/>입금 확인 즉시 판매자에게
                                <br/>SMS를 발송합니다.
                            </p>
                            <i class="has-sprite arr_mini"></i>
                        </div>
                        <div class="guide_set">
                            <span class="has-sprite sell_ing_icon"></span> <span class="state">판매중</span>
                            <p>구매자의 정보를 확인 가능,
                                <br/>게임상에서 거래의
                                <br/>진행이 가능합니다.
                            </p>
                            <i class="has-sprite arr_mini"></i>
                        </div>
                        <div class="guide_set">
                            <span class="has-sprite trade_icon"></span> <span class="state">인계완료</span>
                            <p>구매자에게 물품을
                                <br/>건네주었다면
                                <br/>인계확인을 완료합니다.
                            </p>
                            <i class="has-sprite arr_mini"></i>
                        </div>
                        <div class="guide_set">
                            <span class="has-sprite sell_complete_icon"></span> <span class="state">판매완료</span>
                            <p>구매자가 인수확인을
                                <br/>완료하면, 거래는
                                <br/>즉시 종료됩니다.
                            </p>
                            <i class="has-sprite arr_mini"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="empty-high"></div>
    </div>

@endsection
