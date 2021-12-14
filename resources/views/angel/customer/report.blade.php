@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/menu.css" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/_report_top.css" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/trade/css/trade_common.css" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/customer_common.css" />
@endsection

@section('foot_attach')

    <script type="text/javascript" src="/angel/_js/_screenshot.js"></script>
    <script type="text/javascript" src="/angel/customer/trade/js/trade_common.js"></script>
    <script type="text/javascript">
        function __init() {
            strThisCode = 'A101';
            fnCreateDom('ACS', '01');
        }
        $(document).ready(function() {
            $("#trade_list").on("click", ".btn_red1", function() {
                var orderNo = $(this).data("order");
                $("#tradeNum").text(orderNo);
                $("#tradeNum2").val(orderNo);
                $("#Form_table").show();
            });
        });
        function goCloseReqest() {
            location.href = "{{route('customer_report')}}";
        }
        function goEndReqest() {
            location.href = "{{route('customer_report_end')}}";
        }
    </script>
@endsection

@section('content')
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <style>
            .aside .notice {
                height: 24px;
                margin-top: 20px;
                font-weight: bold;
                border-bottom: 1px solid #E1E1E1
            }

            .aside .notice img {
                margin: 5px 3px 0 0
            }

            .aside .notice_list {
                margin: 0 0 30px;
                padding-top: 10px;
                background: none;
                border: 0
            }

            .aside .notice_list li {
                margin-left: 10px;
                margin-bottom: 3px;
                color: #767676;
                font-size: 12px
            }

            .aside .img_wrap {
                box-sizing: border-box;
                width: 214px;
                margin-bottom: 10px;
                padding: 10px 0;
                text-align: center;
                border: 1px solid #E1E1E1
            }
            .g_big_box1 {
                height: 64px;
                background-color: #e3f0f3;
            }
            .btn_search {
                font-size: 12px;
                padding: 4px 15px;
                background: #4997af;
                color: white;
            }
            #goods_table th {
                width: 130px;
            }
            #goods_table td {
                width: calc(100% - 130px);
            }
        </style>
        @include('angel.customer.aside', ['group'=>'report', 'part'=>'close'])
        <div class="g_content">
            <div class="g_title_blue no-border"> 1:1 상담하기 </div>
            <div class="s_subtitle">상담 분류 선택</div>
            <table class="g_sky_table category_tb" id="category_tb">
                <colgroup>
                    <col width="130">
                    <col width="630">
                </colgroup>
                <tr>
                    <th>거래 취소/종료</th>
                    <td>
                        <ul class="g_sideway" data-type="A1">
                            <li>
                                <input type="radio" name="b_code" value="01" class="g_radio" checked id="a10101" onclick="goCloseReqest()">
                                <label for="a10101">취소요청</label>
                            </li>
                            <li>
                                <input type="radio" name="b_code" value="01" class="g_radio" id="a10102" onclick="goEndReqest()">
                                <label for="a10102">종료요청</label>
                            </li>
                        </ul>
                    </td>
                </tr>
            </table>
            <div class="g_finish"></div>
            <div class="g_tab onetab">
                <div class="selected f-16"> 거래중 내역 </div>
            </div>
            <div class="g_tab_line"></div>
            <ul id="trade_subtab" class="g_sideway">
                <li> <a class="f-14 {{$typeTxt == 'sell' ? 'f_blue3 f_bold' : ''}}" href="{{route("customer_report")}}?type=sell">판매중 물품 </a> </li>
                <li> |</li>
                <li> <a class="f-14 {{$typeTxt == 'buy' ? 'f_blue3 f_bold' : ''}}" href="{{route("customer_report")}}?type=buy">구매중 물품 </a> </li>
            </ul>
            <div class="g_finish"></div>
            <div class="g_big_box1">
                <form id="frmSearch" action="" method="post">
                    @csrf
                    <input type="hidden" name="a_code" value="A1" />
                    <input type="hidden" name="b_code" value="01" />
                    <input type="hidden" name="c_code" value="01" />
                    <input type="hidden" name="t_type" value="ti" />
                    <input type="hidden" name="m_type" value="sell" />
                    <input type="hidden" name="standard_code" value="A101" />
                    <input type="hidden" name="retry" value="" />
                    <input type="hidden" name="reflag" value="" />
                    <div class="" style="height: 35px;">
                        <div id="dvGame" name="game"><input type="hidden" name="selected" value="{{$game_text}}"/></div>
                        <div id="dvServer" name="gserver"><input type="hidden" name="selected" value="{{$server_text}}"/></div>
                        <select id="dvGoods" name="search_goods" class="g_hidden">
                            <option @if ($search_goods == "all") selected @endif value="all">물품전체</option>
                            <option @if ($search_goods == '3') selected @endif value="3">게임머니</option>
                            <option @if ($search_goods == '1') selected @endif value="1">아이템</option>
                            <option @if ($search_goods == '2') selected @endif value="2">계정</option>
                            <option @if ($search_goods == '4') selected @endif value="4">기타</option>
                        </select>
                    </div>
                    <div class="">
                        <strong class="f-12">금액 : </strong>
                        <input type="text" name="search_price_min" maxlength="13" class="g_text" style="width:140px; text-align: right;" value="{{$search_price_min}}" /> ~
                        <input type="text" name="search_price_max" maxlength="13" class="g_text" style="width:140px; text-align: right;" value="{{$search_price_max}}" />
                        <input type="submit" width="46" height="20" alt="검색" class="g_image btn_search" value="검색" />
                    </div>
                    <div class="g_finish"></div>
                </form>
            </div>
            <!-- ▼ 리스트 //-->
            <table id="trade_list" class="g_sky_table g_sky_tb tb_list">
                <colgroup>
                    <col width="50" />
                    <col width="169" />
                    <col width="67" />
                    <col />
                    <col width="75" />
                    <col width="90" />
                    <col width="70" /> </colgroup>
                <tr>
                    <th class="first">구분</th>
                    <th>카테고리</th>
                    <th>분류</th>
                    <th>제목</th>
                    <th>금액</th>
                    <th>등록일</th>
                    <th>상담</th>
                </tr>
                @foreach ($sellingRecord as $record)
                <tr>
                    <td class="f_blue3 f_bold">
                        {{$typeTxt == 'sell' ? '판매' : '구매'}}
                    </td>
                    <td>{{$record['game']['game']}} >...</td>
                    <td>{{$record['good_type']}}</td>
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
                    <td class="f_red1 right">{{number_format($record['payitem']['price'])}}원</td>
                    <td>{{date("m-d H:i",strtotime($record['created_at']))}}</td>
                    <td>
                        @if ($record['accept_flag'] == 0)
                            <div class="btn_red1" style='display:inline-block' data-order="{{$record['orderNo']}}" onclick="">접수</div>
                        @elseif ($record['accept_flag'] == 1)
                            -
                        @endif
                    </td>

                </tr>
                @endforeach
            </table>

            <div class="dvPaging"></div>
            <div class="g_finish"></div>
            <div id="Form_table" style="display: none">
                <form name="form_member" id="form_member" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="a_code" value="A1" />
                    <input type="hidden" name="b_code" value="01" />
                    <input type="hidden" name="c_code" value="01" />
                    <input type="hidden" name="trade_num" value="" />
                    <input type="hidden" name="game_code" value="" />
                    <input type="hidden" name="server_code" value="" />
                    <input type="hidden" name="gs_name" value="" />
                    <div class="s_subtitle">상담서 작성하기</div>
                    <table id="goods_table" class="g_gray_tb g_sky_table">
                        <colgroup>
                            <col width="130" />
                            <col width="690" /> </colgroup>
                        <tr>
                            <th>접수분야</th>
                            <td>
                                취소요청
                                <input type="hidden" name="type" value="0" >
                                <input type="hidden" name="orderNo" value="" id="tradeNum2">
                            </td>
                        </tr>
                        <tr>
                            <th>이름</th>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th>연락처</th>
                            <td class="h_auto">
                                <div id="myinfo" class="g_left g_black3_11"> 집(직장) : N{{$user['home']}}&nbsp;&nbsp;휴대폰 :
                                    {{$user->phone}}
                                    <br /> 정확한 연락처로 신고해 주세요.
                                    <br /> 연락처가 틀릴 경우 상담이 원활히 이루어지지 않을 수 있습니다. </div>
                                <div class="g_right"></div>
                            </td>
                        </tr>
                        <tr id="TR_trade_num">
                            <th>거래번호</th>
                            <td>#<span id="tradeNum"></span></td>
                        </tr>
                        <tr class="m_tmp">
                            <th>거래번호</th>
                            <td class="h_auto">
                                <input type="radio" name="privates" value="상대방과 연락이 안됩니다." class="g_radio">상대방과 연락이 안됩니다.
                                <br>
                                <input type="radio" name="privates" value="이미 팔린 물품 입니다" class="g_radio">이미 팔린 물품 입니다
                                <br>
                                <input type="radio" name="privates" value="잘못 등록 또는 신청한 물품 입니다" class="g_radio">잘못 등록 또는 신청한 물품 입니다
                                <br>
                                <input type="radio" name="privates" value="상대방이 직거래를 유도 합니다" class="g_radio">상대방이 직거래를 유도 합니다
                                <br>
                                <input type="radio" name="privates" value="상대방이 타사이트 거래를 유도 합니다" class="g_radio">상대방이 타사이트 거래를 유도 합니다
                                <br>
                                <input type="radio" name="privates" value="상대방이 가격 흥정을 합니다" class="g_radio">상대방이 가격 흥정을 합니다
                                <br>
                                <input type="radio" name="privates" value="기타 사유" class="g_radio">기타 사유 &nbsp; <input type="text" name="privates_txt" />
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <th>통화가능번호</th>
                            <td>
                                <input type="text" name="user_phone1" class="g_text" id="phone1" maxlength="3" /> -
                                <input type="text" name="user_phone2" class="g_text" id="phone2" maxlength="4" /> -
                                <input type="text" name="user_phone3" class="g_text" id="phone3" maxlength="4" />
                                <span class="g_black3_11">현재 통화 가능한 연락처를 남겨주세요.</span>
                            </td>
                        </tr>
                    </table>
                    <div class="g_btn">
                        <button class="btn-blue-img btn-color-img" type="submit">확인</button>
                        <button class="btn-gray-img btn-color-img" type="button">취소</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
@endsection
