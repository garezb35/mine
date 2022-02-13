@extends('layouts-angel.app-frame')

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
                heightResize()
            });
            $('#dvGames').select2({
                dropdownAutoWidth: true,
                placeholder: '게임명',
                width: 'calc(100% - 10px)'
            });
            $("#dvServers").select2({
                dropdownAutoWidth: true,
                placeholder: '서버명',
                width: 'calc(100% - 10px)'
            })
            $("#dvGames").on("select2:select", function (e) {
                let game_id = e.params.data.id;
                if(game_id == 0 || game_id == '' || game_id == null){
                    return false
                }
                let dvServers = $('#dvServers');
                ajaxRequest({
                    url: '/api/game_list',
                    type: 'POST',
                    data: {api_token: a_token, game: game_id},
                    dataType:'json',
                    success: function(res) {
                        dvServers.html('')
                        dvServers.select2({
                            dropdownAutoWidth: true,
                            placeholder: '서버명',
                            width: 'calc(100% - 10px)',
                            data: res
                        });
                    }
                })
            })
        });
        function goCloseReqest() {
            location.href = "{{route('customer_report')}}?type={{Request::get('type')}}";
        }
        function goEndReqest() {
            location.href = "{{route('customer_report_end')}}?type={{Request::get('type')}}";
        }
    </script>
@endsection

@section('content')
    <div class="bg-white">
        <div>
        </div>
        <div >
            <style>
                .select__div>div:first-child{
                    margin-top: 1px;
                }
                .select__div>div:last-child{
                    margin-top: 4px;
                }
                .select2-container .select2-selection--single{
                    height: 26px;
                }
                .select2-container--default .select2-selection--single{
                    border-radius: 0px;
                }
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
            <div class="pagecontainer">
                <table class="category_tb noborder" id="category_tb">
                    <tr>
                        <th>거래 취소/종료</th>
                        <td>
                            <ul class="g_sideway" data-type="A1">
                                <li>
                                    <input type="radio" name="b_code" value="01" class="g_radio" id="a10101" onclick="goCloseReqest()">
                                    <label for="a10101">취소요청</label>
                                </li>
                                <li>
                                    <input type="radio" name="b_code" value="01" class="g_radio" checked id="a10102" onclick="goEndReqest()">
                                    <label for="a10102">종료요청</label>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>

                <div class="empty-high"></div>
                <div class="g_big_box1">
                    <form id="frmSearch" action="" method="get">
                        @csrf
                        <input type="hidden" name="type" value="{{Request::get('type') ?? 'sell'}}" />
                            <div @class('report_btns')>
                            <div>
                                <a class="f-14 report_btn  {{$typeTxt == 'sell' ? 'selected' : ''}}" href="{{route("customer_report_end")}}?type=sell">판매중 물품 </a>
                                <a class="f-14 report_btn {{$typeTxt == 'buy' ? 'selected' : ''}}" href="{{route("customer_report_end")}}?type=buy">구매중 물품 </a>
                            </div>
                            <div @class('select__div')>
                                <div>
                                    <select id="dvGames" name="game" @class('sel2 game_sel')>
                                        @if(!empty($games_list))
                                            <option value="0">선택하세요</option>
                                            @foreach($games_list as $g)
                                                <option value="{{$g['id']}}" @if($g['id'] == Request::get('game')) selected @endif>{{$g['game']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div>
                                    <select id="dvServers" name="server__g" @class('sel2 game_sel')>
                                        @if(!empty($servers_list))
                                            <option value="0">선택하세요</option>
                                            @foreach($servers_list as $g)
                                                <option value="{{$g['id']}}" @if($g['id'] == Request::get('server__g')) selected @endif>{{$g['game']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <strong class="f-12">금액 : </strong>
                                    <input type="text" name="search_price_min" maxlength="13" class="f_control_txt"  value="{{$search_price_min}}" /> ~
                                    <input type="text" name="search_price_max" maxlength="13" class="f_control_txt"  value="{{$search_price_max}}" />
                                </div>
                                <div>
                                    <input type="submit"  alt="검색" class="f_search" value="검색" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

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
                            <td class="f_blue3 font-weight-bold">
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
                            <td class="text-rock right">{{number_format($record['payitem']['price'])}}원</td>
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
                <div class="pagination__bootstrap"></div>
                <div class="empty-high"></div>
                <div id="Form_table" style="display: none">
                    <form name="form_member" id="form_member" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="api_token" value="{{$me['api_token']}}" />
                        <input type="hidden" name="a_code" value="A1" />
                        <input type="hidden" name="b_code" value="01" />
                        <input type="hidden" name="c_code" value="01" />
                        <input type="hidden" name="trade_num" value="" />
                        <input type="hidden" name="game_code" value="" />
                        <input type="hidden" name="server_code" value="" />
                        <input type="hidden" name="gs_name" value="" />
                        <input type="hidden" name="types" value="{{Request::get('type') ?? 'sell'}}">
                        <input type="hidden" name="types_order" value="end">
                        <div class="s_subtitle">상담서 작성하기</div>
                        <table id="goods_table" class="table-striped table-green1">
                            <tr>
                                <th>접수분야</th>
                                <td>
                                    종료요청
                                    <input type="hidden" name="type" value="1" >
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
                                    <div id="myinfo" class="float-left g_black3_11"> 집(직장) : N{{$user['home']}}&nbsp;&nbsp;휴대폰 :
                                        {{$user->phone}}
                                        <br /> 정확한 연락처로 신고해 주세요.
                                        <br /> 연락처가 틀릴 경우 상담이 원활히 이루어지지 않을 수 있습니다. </div>
                                    <div class="float__right"></div>
                                </td>
                            </tr>
                            <tr id="TR_trade_num">
                                <th>거래번호</th>
                                <td>#<span id="tradeNum"></span></td>
                            </tr>
                            <tr class="m_tmp">
                                <th>거래번호</th>
                                <td class="h_auto">
                                    <input type="radio" name="privates" value="물품 인계 후 구매자 연락 안됨" class="g_radio" checked>물품 인계 후 구매자 연락 안됨
                                    <br>
                                    <input type="radio" name="privates" value="물품 인계 후 구매자 물품인수확인 안됨" class="g_radio">물품 인계 후 구매자 물품인수확인 안됨
                                    <br>
                                    <input type="radio" name="privates" value="물품 인계 후 종료안됨" class="g_radio">물품 인계 후 종료안됨
                                    <br>
                                    <input type="radio" name="privates" value="기타 사유" class="g_radio">기타 사유 &nbsp; <input type="text" name="privates_txt" class="mw-200 angel__text mode-active text__new__green input__height__30 border__new_green"/>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <th>통화가능번호</th>
                                <td>
                                    <input type="text" name="user_phone1" class="w60 angel__text mode-active text__new__green input__height__30 border__new_green" id="phone1" maxlength="3" /> -
                                    <input type="text" name="user_phone2" class="w60 angel__text mode-active text__new__green input__height__30 border__new_green" id="phone2" maxlength="4" /> -
                                    <input type="text" name="user_phone3" class="w60 angel__text mode-active text__new__green input__height__30 border__new_green" id="phone3" maxlength="4" />
                                    <span class="g_black3_11">현재 통화 가능한 연락처를 남겨주세요.</span></td>
                            </tr>
                        </table>
                        <div class="btn-groups_angel">
                            <a class="button-success" onclick="orangeReport()">확인</a>
                            <button class="button-cancel" type="button">취소</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="empty-high"></div>
        </div>
    </div>
@endsection

