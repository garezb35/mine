@extends('layouts-angel-mobile.app')

@section('head_attach')
    <link rel="stylesheet" href="/angel_mobile/customer/css/report.css" />
@endsection

@section('foot_attach')
    <script>
        $(document).ready(function() {
            $("#trade_list").on("click", ".btn_red1", function() {
                var orderNo = $(this).data("order");
                $("#tradeNum").text(orderNo);
                $("#tradeNum2").val(orderNo);
                $("#Form_table").show();
            });
        });
    </script>
@endsection

@section('content')
    <div class="g_BODY" id="g_BODY" style="opacity: 1;">
        @include('m.angel.aside.nav', ['user' => $me])
        <div class="header">
            <div class="h_tit bkg-white">
                <a href="javascript:history.back()" class="back_btn" id="back_btn"></a>
                <h1 class="c-black">거래취소요청</h1>
                <button class="btn_menu" id="btn_menu"><em>메뉴</em></button>
            </div>
        </div>
        <div class="container">
            @php
                $isLogined = '';
                if (Auth::check()) {
                    $isLogined = 1;
                }
            @endphp
            <input id="_LOGINCHECK" type="hidden" value="{{$isLogined}}">
            <div class="content">
                <div class="g_tab2 buy_tab">
                    <div @if ($typeTxt == "sell") class="selected" @endif>
                        <a href="{{route('customer_report')}}?type=sell">판매중 물품</a>
                    </div>
                    <div @if ($typeTxt == "buy") class="selected" @endif>
                        <a href="{{route('customer_report')}}?type=buy">구매중 물품</a>
                    </div>
                </div>
                <div class="g_title mg0 fs-16">
                    @if ($typeTxt == "sell")
                        판매중 물품
                    @else
                        구매중 물품
                    @endif
                </div>
                <div class="mb_tbl_part">
                    <table id="trade_list" class="g_sky_table">
                        <colgroup>
                            <col width="50">
                            <col width="169">
                            <col width="67">
                            <col>
                            <col width="75">
                            <col width="90">
                            <col width="70">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="first">구분</th>
                                <th>카테고리</th>
                                <th>분류</th>
                                <th>제목</th>
                                <th>금액</th>
                                <th>등록일</th>
                                <th>상담</th>
                            </tr>
                            @if (count($sellingRecord) == 0)
                                <tr>
                                    <td colspan="7">
                                        <div class="align-center">등록된 물품이 없습니다.</div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($sellingRecord as $record)
                                    <tr>
                                        <td class="f_blue3 font-weight-bold align-center">
                                            {{$typeTxt == 'sell' ? '판매' : '구매'}}
                                        </td>
                                        <td>{{$record['game']['game']}} >...</td>
                                        <td class="align-center">{{$record['good_type']}}</td>
                                        <td class="left">
                                            <a href="/myroom/sell/sell_ing_view?id={{$record['orderNo']}}&type={{$record['type']}}">
                                                @switch ($record['status'])
                                                    @case (1)
                                                    <span class='f-12 c-white' style='background: #4b80d1; padding: 2px 4px;'>거래중</span>
                                                    @break;
                                                    @case (2)
                                                    @case (3)
                                                    <span class='f-12 c-white' style='background: #2def33; padding: 2px 4px;'>종료예정</span>
                                                    @break;
                                                    @default:
                                                    @break;
                                                @endswitch
                                                &#160;{{$record['user_title']}}</td>
                                        <td class="text-rock right align-right">{{number_format($record['payitem']['price'])}}원</td>
                                        <td class="align-center">{{date("m-d H:i",strtotime($record['created_at']))}}</td>
                                        <td class="align-center">
                                            @if ($record['accept_flag'] == 0)
                                                <div class="btn_red1" data-order="{{$record['orderNo']}}" onclick="">접수</div>
                                            @elseif ($record['accept_flag'] == 1)
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div id="Form_table" style="display: none;">
                    <form name="form_member" id="form_member" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="g_title mg0 fs-16" style="margin-top: 4px;">상담서 작성하기</div>
                        <div style="border: solid 1px #d1d1d1;">
                            <div class="head_part">접수분야</div>
                            <div class="content_part">
                                취소요청
                                <input type="hidden" name="type" value="0">
                                <input type="hidden" name="orderNo" value="2021121025545569" id="tradeNum2">
                            </div>
                            <div class="head_part">이름</div>
                            <div class="content_part">
                                {{$me['name']}}
                            </div>
                            <div class="head_part">연락처</div>
                            <div class="content_part">집(직장) : N070-3595-6151
                                <br> 휴대폰 :
                                <br> 정확한 연락처로 신고해 주세요.
                                <br> 연락처가 틀릴 경우 상담이 원활히 이루어지지 않을 수 있습니다.
                            </div>
                            <div class="head_part">거래번호</div>
                            <div class="content_part">
                                #<span id="tradeNum"></span>
                            </div>
                            <div class="head_part">취소이유</div>
                            <div class="content_part reason_part">
                                <input id="reason01" type="radio" name="privates" value="상대방과 연락이 안됩니다." class="g_radio">
                                <label for="reason01">상대방과 연락이 안됩니다.</label>
                                <br>
                                <input id="reason02" type="radio" name="privates" value="이미 팔린 물품 입니다" class="g_radio">
                                <label for="reason02">이미 팔린 물품 입니다.</label>
                                <br>
                                <input id="reason03" type="radio" name="privates" value="잘못 등록 또는 신청한 물품 입니다" class="g_radio">
                                <label for="reason03">잘못 등록 또는 신청한 물품 입니다.</label>
                                <br>
                                <input id="reason04" type="radio" name="privates" value="상대방이 직거래를 유도 합니다" class="g_radio">
                                <label for="reason04">상대방이 직거래를 유도 합니다.</label>
                                <br>
                                <input id="reason05" type="radio" name="privates" value="상대방이 타사이트 거래를 유도 합니다" class="g_radio">
                                <label for="reason05">상대방이 타사이트 거래를 유도 합니다.</label>
                                <br>
                                <input id="reason06" type="radio" name="privates" value="상대방이 가격 흥정을 합니다" class="g_radio">
                                <label for="reason06">상대방이 가격 흥정을 합니다.</label>
                                <br>
                                <input id="reason07" type="radio" name="privates" value="기타 사유" class="g_radio">
                                <label for="reason07">기타 사유</label> &nbsp; <input type="text" name="privates_txt" class="privates_txt">
                                <br>
                            </div>
                            <div class="head_part">통화가능번호</div>
                            <div class="content_part">
                                <input type="text" name="user_phone1" class="angel__text" id="phone1" maxlength="3"> -
                                <input type="text" name="user_phone2" class="angel__text" id="phone2" maxlength="4"> -
                                <input type="text" name="user_phone3" class="angel__text" id="phone3" maxlength="4">
                                <br><span class="g_black3_11">현재 통화 가능한 연락처를 남겨주세요.</span>
                            </div>
                            <div class="btn-groups_angel align-center">
                                <button class="btn-blue-img btn-color-img" type="submit">확인</button>
                                <button class="btn-gray-img btn-color-img" type="button">취소</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
