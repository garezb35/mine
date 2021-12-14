@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/myinfo/css/check.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/myinfo/css/myinfo_modify.css" />

@endsection

@section('foot_attach')
<script src="/angel/myroom/cash_receipt/js/cash_receipt_list.js" type="text/javascript" ></script>
@endsection
@section('content')
    <div class="g_container" id="g_CONTENT">
        <div class="g_remocon_l">
        </div>
        @include('aside.myroom',['group'=>'money'])
        <div class="g_content">
            <div class="g_title_blue noborder">
                현금영수증
            </div>
            <div class="f_bold f-14 mb-5">
                거래관련
            </div>
            <!-- ▼ 현금영수증 테이블 //-->
            <table class="g_green_table1 tb_list">
                <colgroup>
                    <col width="58">
                    <col width="120">
                    <col width="120">
                    <col>
                    <col width="104">
                    <col width="105">
                </colgroup>
                <tbody>
                <tr>
                    <th class="first">번호</th>
                    <th>거래번호</th>
                    <th>게임</th>
                    <th>제목</th>
                    <th>가격</th>
                    <th>완료</th>
                </tr>
                @foreach($cash as $key=>$v)

                    @php
                        $moneyiss = 'A';
                        $moneyAlias = '승인번호 확인';
                        $count_alias = "";
                        if($v['item']['usr_goods_type'] == 'division')
                            $count_alias = '수량 '.number_format($v['payitem']['buy_quantity']).' ';
                        elseif($v['item']['user_quantity'] > 1)
                            $count_alias = '수량 '.number_format($v['item']['user_quantity']).' ';
                    @endphp
                    @if($v['status'] == 2)
                        @php $moneyiss = 'U';$moneyAlias = '영수증보기'; @endphp
                    @endif
                <tr>
                    <td class="first">{{$key+1}}</td>
                    <td>{{$v['orderNo']}}</td>
                    <td>
                        {{$v['item']['game']['game']}}
                    </td>
                    <td>{{$count_alias}}{{$v['item']['user_title']}}</td>
                    <td>￦{{number_format($v['payitem']['price'])}}</td>
                    <td class="h_auto">
                        {{date("Y-m-d",strtotime($v['updated_at']))}}
                        <a class="btn-secondary btn btn-sm" href="javascript:moneyissPoP('{{$moneyiss}}','{{$v['orderNo']}}','cashreceipt_issue_{{date("Ym",strtotime($v['created_at']))}}');">{{$moneyAlias}}</a>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            <!-- ▼ 페이징 //-->
            <div class="dvPaging mt-5">
                {{$cash->withQueryString()->links()}}
            </div>
            <!-- ▲ 페이징 //-->
            <!-- ▼ 알아두기 //-->
            <ul class="g_notice_box1 g_list">
                <li>"<span class="f_red1">승인번호 확인</span>"은 구매자께서 현금영수증을 신청하지 않아 자진발급된 현금영수증 발급내역입니다.</li>
                <li>자진 발급된 현금영수증을 등록하시려면 <span class="f_red1">국세청 홈페이지 "사용내역조회&gt;자진발급분 사용자등록"</span>에서 승인번호를 등록하시면 됩니다.
                </li>
                <li>현금영수증은 결제 시 마일리지 사용한 내역에 대해서만 발급받으실 수 있습니다.</li>
                <li>ARS로 충전된 마일리지 사용금액은 현금영수증 발급이 되지 않습니다.</li>
                <li>발급된 현금영수증은 발급 2일 후 국세청 현금영수증 홈페이지에서도 확인 가능합니다.</li>
                <li>발급된 현금영수증은 거래 일자의 익일로 조회하셔야 확인 가능합니다 (ex. 2016-01-01 거래종료시 2016-01-02 발급내역 조회)</li>
                <li>이밖에 발급된 현금영수증 내역이 보이지 않으실 때에는 고객센터로 문의 해 주십시오.</li>
            </ul>
            <!-- ▲ 알아두기 //-->
        </div>
        <div class="g_finish"></div>
    </div>
@endsection
