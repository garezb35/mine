@php

    $category = '> > 기타';
    if(!empty($game['game'])){
        $category = $game['game']." > ";
    }
    if(!empty($server['game'])){
        $category .= $server['game']." > ";
    }
    if(!empty($good_type)){
        $category .= $good_type;
    }
    $price = 0;
    if($user_goods_type != 'division')
        $price = $user_price;
    if($user_goods_type == 'division')
        $price = $user_division_price;
@endphp
@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/buy/css/common_view.css?210114" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/buy/js/buy_regist.js?v=190426"></script>
    <script type="text/javascript" src="/angel/myroom/buy/js/buy_regist_view.js?v=210512"></script>
    <script type="text/javascript">
        function __init() {
            e_use.premium=7;
            e_use.highlight=7;
        }
    </script>

@endsection

@section('content')

<!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
<div class="g_container" id="g_CONTENT">
    @include('aside.myroom',['group'=>'buy'])
    <div class="g_content">
        <a name="top"></a>
        <div class="g_title_green noborder"> 구매 등록 <span>물품</span> </div>
        <div class="g_subtitle first">물품정보</div>
        @if($user_goods_type == 'general')
            <table class="table-striped table-green1">
                <colgroup>
                    <col width="160">
                    <col width="250">
                    <col width="160">
                    <col /> </colgroup>
                <tr>
                    <th>카테고리</th>
                    <td colspan="3">{{$category}}</td>
                </tr>
                <tr>
                    <th>물품제목</th>
                    <td colspan="3">{{$user_title}}
                    </td>
                </tr>
                <tr>
                    <th>거래번호</th>
                    <td>#{{$orderNo}}</td>
                    <th>등록일시</th>
                    <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                </tr>
                <tr>
                    <th>거래유형</th>
                    <td colspan="3">일반</td>
                </tr>

                <tr>
                    @php
                        $gamemoney_unit = $gamemoney_unit ?? '';
                        $user_quantity = $user_quantity ?? '';
                        $c = str_replace(" ","",$user_quantity.($gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit:''));
                    @endphp
                    @if($c != 1)
                        <th class="bg-white">구매수량</th>
                        <td>{{$user_quantity}}{{$gamemoney_unit != 1 && !empty($gamemoney_unit) ? $gamemoney_unit : ''}} {{$good_type ?? ''}}</td>
                    @endif
                    <th>구매금액</th>
                    <td @if($c == 1) colspan='3' @endif>{{number_format($price)}}원</td>
                </tr>
                <tr>
                    <th>구매자 캐릭터명</th>
                    <td colspan="3">{{$user_character}}</td>
                </tr>
            </table>
        @endif
        @if($user_goods_type == 'division')
            <table class="table-striped table-green1">
                <colgroup>
                    <col width="160">
                    <col width="250">
                    <col width="160">
                    <col>
                </colgroup>
                <tbody>
                    <tr>
                        <th>카테고리</th>
                        <td colspan="3">{{$category}}</td>
                    </tr>
                    <tr>
                        <th>물품제목</th>
                        <td colspan="3">
                        {{$user_title}}
                        <!-- 퀵 아이콘 -->
                        </td>
                    </tr>
                    <tr>
                        <th>거래번호</th>
                        <td>#{{$orderNo}}</td>
                        <th>등록일시</th>
                        <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                    </tr>
                    <tr>
                        <th>거래유형</th>
                        <td colspan="3">분할</td>
                    </tr>
                    <tr>
                        <th>최소구매수량</th>
                        <td>{{$user_quantity_min}}{{$unit}} 개</td>
                        <th>최대구매수량</th>
                        <td>{{$user_quantity_max}}{{$unit}} 개</td>
                    </tr>
                    <tr>
                        <th>단위금액</th>
                        <td>{{$user_division_unit}}개당 {{number_format($user_division_price)}}원</td>
                        <th>구매할인</th>
                        <td>
                            @if($discount_use == 1)
                                {{$discount_quantity_cnt * $user_division_unit}}개 당 {{number_format($discount_price)}}원 할인
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>구매자 캐릭터명</th>
                        <td colspan="3">{{$user_character}}</td>
                    </tr>
                </tbody>
            </table>
        @endif
        @if($user_goods_type == 'bargain')
            <table class="table-striped table-green1">
                <colgroup>
                    <col width="160">
                    <col width="250">
                    <col width="160">
                    <col>
                </colgroup>
                <tbody>
                    <tr>
                        <th>카테고리</th>
                        <td colspan="3">{{$category}}</td>
                    </tr>
                    <tr>
                        <th>물품제목</th>
                        <td colspan="3">
                        {{$user_title}}
                        <!-- 퀵 아이콘 -->
                        </td>
                    </tr>
                    <tr>
                        <th>거래번호</th>
                        <td>#{{$orderNo}}</td>
                        <th>등록일시</th>
                        <td>{{date("Y-m-d H:i:s",strtotime($created_at))}}</td>
                    </tr>
                    <tr>
                        <th>거래유형</th>
                        <td colspan="3">할인</td>
                    </tr>
                    <tr>
                        <th>즉시판매금액</th>
                        <td colspan="3">{{number_format($user_price)}}원</td>
                    </tr>
                    <tr>
                        <th>구매자 캐릭터명</th>
                        <td colspan="3">{{$user_character}}</td>
                    </tr>
                </tbody>
            </table>
        @endif
        <!-- ▲ 물품정보 //-->
        <!-- ▼ 내 개인정보 //-->
        <div class="g_subtitle">내 거래정보</div>
        <table class="table-striped table-green1">
            <colgroup>
                <col width="160">
                <col/> </colgroup>
            <tr>
                <th>이름</th>
                <td>이장훈</td>
            </tr>
            <tr>
                <th class="bd_left">연락처</th>
                <td>자택번호없음 / 010-4797-3690 <span class='f_green2 f_bold'>(SMS수신)</span></td>
            </tr>
        </table>
        <table class="table-striped table-green1">
            <tr>
                <td style="border-left: 1px solid #e1e1e1">상세설명</td>
            </tr>
            <tr>
                <td class="vt" style="border-left: 1px solid #e1e1e1;height: 200px;overflow-y: scroll">{{$user_text}}</td>
            </tr>
        </table>
        <!-- ▲ 내 개인정보 //-->
        <!-- ▼ 거래진행상황 //-->
        <!-- ▼ 판매진행안내 //-->
        <div class="trade_progress buy">
            <div class="g_subtitle"> 거래 진행 상황 </div>
            <div class="trade_progress_content">
                <div class="guide_wrap">
                    <div class="guide_set active"> <span class="SpGroup buy_regist_icon"></span> <span class="state">구매등록</span>
                        <p>구매할 물품을 등록해놓은
                            <br/>[거래대기] 상태입니다.
                            <br/>판매신청이 들어올때까지
                            <br/>기다려주세요.</p>
                    </div>
                    <div class="guide_set"> <span class="SpGroup pay_wait_icon"></span> <span class="state">입금대기</span>
                        <p>구매자가 입금을
                            <br/>준비하고 있습니다.
                            <br/>입금완료 후, 구매중 상태가
                            <br/>되면 거래를 시작해주세요.</p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup buy_ing_icon"></span> <span class="state">구매중</span>
                        <p>현재 판매자와 거래중입니다.
                            <br/>판매자와 반드시 전화통화로
                            <br/>거래하시기 바랍니다.
                            <br/>[통화 불가 시 1:1대화함 사용] </p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup trade_icon"></span> <span class="state">인수완료</span>
                        <p>거래종료 예정입니다.
                            <br/>판매자가 인계확인 할 때까지
                            <br/>기다려주세요.</p> <i class="SpGroup arr_mini"></i> </div>
                    <div class="guide_set"> <span class="SpGroup buy_complete_icon"></span> <span class="state">구매완료</span>
                        <p>거래가 정상적으로
                            <br/>종료되었습니다.
                            <br/>문제 발생 시
                            <br/>고객센터로 문의해주세요.</p> <i class="SpGroup arr_mini"></i> </div>
                </div>
            </div>
        </div>
        <!-- ▲ 판매진행안내 //-->
        <!-- ▲ 거래진행상황 //-->
        <form id="frmList" name="frmList" method="post">
            @csrf
            <input type="hidden" name="trade_id" value="{{$orderNo}}">
            <input type="hidden" id="process" name="process"> </form>
        <div class="g_btn">
            <a href="/myroom/buy/buy_re_reg?id={{$orderNo}}" class="btn-default btn-suc">
                재등록
            </a>
            <a href="javascript:;" onclick="tradeProcess('@if($hide == 0){{'hideSelect'}}@else{{'showSelect'}}@endif')" class="btn-default btn-cancel">
                @if($hide == 0) 숨기기 @else 보이기 @endif
            </a>
            <a href="javascript:void(0)" class="btn-default btn-gray" onclick="tradeProcess('deleteSelect');">
                삭제
            </a>
        </div>
        <!-- ▼ 상세설명 //-->


    </div>
    <div class="g_finish"></div>
</div>
<!-- ▲ 컨텐츠 영역 //-->
@endsection
