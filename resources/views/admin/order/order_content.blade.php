@php

        $category = '> > 기타';
        if(!empty($item['game']['game'])){
            $category = $item['game']['game']." > ";
        }
        if(!empty($item['server']['game'])){
            $category .= $item['server']['game']." > ";
        }

    $category .= $item['good_type'];
    $unit_type = empty($item['unit_type']) || $item['unit_type'] == 1 ? $item['unit_type'] : "";

@endphp
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', '관리자') }}</title>
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css" rel="stylesheet">
        <link rel="stylesheet" href="/angel/myroom/chat/css/chat.css">
        <script>
            var  server_domain = "210.112.174.178";
            var a_token = "{{$user['api_token']}}";
        </script>
    </head>
    <body>
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 mb-5 mb-xl-0">
                        <div class="card shadow">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">거래내용
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table-striped table-green1 table table-bordered">
                                    <colgroup>
                                        <col width="160" />
                                        <col width="250" />
                                        <col width="160" />
                                        <col />
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <th>카테고리</th>
                                            <td colspan="3">{{$category}}</td>
                                        </tr>
                                        <tr>
                                            <th>물품제목</th>
                                            <td colspan="3">
                                                {{$item['user_text']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>거래유형</th>
                                            <td>
                                                {{ordersType($item['user_goods_type'])}}
                                            </td>
                                            <th>물품유형</th>
                                            <td>
                                                {{$item['type'] == 'sell' ? '판매물품':'구매물품'}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>거래번호</th>
                                            <td>#{{$item['orderNo']}}</td>
                                            <th>등록일시</th>
                                            <td>{{date("Y-m-d H:i:s",strtotime($item['created_at']))}}</td>
                                        </tr>
                                        <tr>
                                        @if(!empty($item['payitem']) && $item['payitem']['status'] == 1)
                                            <th>거래금액</th>
                                            <td colspan="3">{{number_format($item['payitem']['buy_quantity'])}} {{$item['good_type']}} {{number_format($item['payitem']['price'])}}원</td>
                                        @endif
                                        @if(!empty($item['payitem']) && $item['payitem']['status'] == 0)
                                            <th>입금대기중</th>
                                            <td colspan="3">{{number_format($item['payitem']['buy_quantity'])}} {{$item['good_type']}} {{number_format($item['payitem']['price'])}}원</td>
                                        @endif
                                        @if(!empty($item['payitem']) && $item['payitem']['status'] == 2)
                                            <th>거래완료</th>
                                            <td colspan="3">{{number_format($item['payitem']['buy_quantity'])}} {{$item['good_type']}} {{number_format($item['payitem']['price'])}}원</td>
                                        @endif
                                        @if($item['status'] == 0)
                                            @php
                                                $quantity= "";
                                                $gamemoney_unit = "";
                                                if(empty($item["gamemoney_unit"]) || $item["gamemoney_unit"] == 1){
                                                    $gamemoney_unit == "";
                                                }
                                                else{
                                                    $gamemoney_unit = $item["gamemoney_unit"];
                                                }
                                            @endphp
                                            <th>거래금액</th>
                                            <td colspan="3">
                                                @if($item['user_goods_type'] == 'general')
                                                    @php
                                                    if($item['user_quantity'] > 1 || !empty($gamemoney_unit)){
                                                    $quantity = $item['user_quantity'].$gamemoney_unit;
                                                    }
                                                    @endphp

                                                    @if(!empty($quantity)) {{$quantity}} {{$item['good_type']}} @endif{{number_format($item['user_price'])}}원
                                                @elseif($item['user_goods_type'] == 'division')
                                                    최소 {{number_format($item['user_quantity_min'])}} 최대 {{number_format($item['user_quantity_m'])}} {{$item['good_type']}} {{number_format($item["user_division_price"])}}원
                                                @else
                                                    @if(!empty($quantity)) {{$quantity}} {{$item['good_type']}} @endif   즉시판매금액 {{number_format($item['user_price'])}}원 최소판매금액 {{number_format($item['user_price_limit'])}}원
                                                @endif
                                            </td>
                                        @endif
                                        </tr>
                                    </tbody>
                                </table>
                                @if(!empty($buyer['u']))
                                <div class="highlight_contextual_nodemon">구매자 정보</div>
                                <table class="table-striped table table-bordered table-green1">
                                    <colgroup>
                                        <col width="160">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                    <tr>
                                        <th>이름</th>
                                        <td>{{$buyer['u']['name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>연락처</th>
                                        <td>
                                            {{$buyer['u']['home']}} / {{$buyer['u']['number']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>구매자 캐릭터명</th>
                                        <td>
                                            <form id="frmDiffer" name="frmDiffer" method="post"></form>
                                            {{$buyer['c']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>구매자 거래정보</th>
                                        <td>
                                            <dl class="add_info">
                                                <dd>
                                                    <span class="w80 cert_state">인증상태</span>
                                                    <span class="con w80 btn_state">
                                                        @if($buyer['u']['mobile_verified'] == 1)
                                                            <img src="/angel/img/icons/icon_check.png" width="14">
                                                        @else
                                                            <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                        @endif

                                                        휴대폰
                                                    </span>
                                                    <span class="on w80 btn_state">
                                                        @if($buyer['u']['mobile_verified'] == 1)
                                                            <img src="/angel/img/icons/icon_check.png" width="14">
                                                        @else
                                                            <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                        @endif

                                                        계좌
                                                    </span>
                                                    <span class="on w80 btn_state">
                                                        @if($buyer['u']['pin'] == 1)
                                                          <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                        @else
                                                            <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                        @endif
                                                    아이핀
                                                    </span>
                                                    <span class="w80 btn_state">
                                                        @if( !empty($buyer['u']['email_verfied_at']))
                                                         <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                        @else
                                                            <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                        @endif
                                                        이메일
                                                    </span>
                                                </dd>
                                            </dl>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                @endif
                                @if(!empty($seller['u']))
                                <div class="highlight_contextual_nodemon">판매자 정보</div>
                                <table class="table-striped table table-bordered table-green1">
                                        <colgroup>
                                            <col width="160">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th>이름</th>
                                            <td>구모서</td>
                                        </tr>
                                        <tr>
                                            <th>연락처</th>
                                            <td>
                                                070-3595-6151 / 010-2424-0956
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>구매자 캐릭터명</th>
                                            <td>
                                                <form id="frmDiffer" name="frmDiffer" method="post"></form>
                                                ddd
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>구매자 거래정보</th>
                                            <td>
                                                <dl class="add_info">
                                                    <dd>
                                                        <span class="w80 cert_state">인증상태</span>
                                                        <span class="con w80 btn_state">
                                                        @if($seller['u']['mobile_verified'] == 1)
                                                                <img src="/angel/img/icons/icon_check.png" width="14">
                                                            @else
                                                                <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                            @endif

                                                        휴대폰
                                                    </span>
                                                        <span class="on w80 btn_state">
                                                        @if($seller['u']['mobile_verified'] == 1)
                                                                <img src="/angel/img/icons/icon_check.png" width="14">
                                                            @else
                                                                <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                            @endif

                                                        계좌
                                                    </span>
                                                        <span class="on w80 btn_state">
                                                        @if($seller['u']['pin'] == 1)
                                                                <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                            @else
                                                                <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                            @endif
                                                    아이핀
                                                    </span>
                                                        <span class="w80 btn_state">
                                                        @if( !empty($seller['u']['email_verfied_at']))
                                                                <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                            @else
                                                                <img src="/angel/img/icons/icon_nocheck.png" width="14">
                                                            @endif
                                                        이메일
                                                    </span>
                                                    </dd>
                                                </dl>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
                                <table class="noborder mt-15  table">
                                    <colgroup>
                                        <col width="50%">
                                    </colgroup>
                                    <tbody>
                                        <td class="vt p-left-0">
                                            <div class="highlight_contextual_nodemon gray mt-0 p-left-10">상세설명</div>
                                            <div class="detail_info">
                                                <div class="detail_text">
                                                    <div id="js-gallery" class="mb-5">
                                                        @foreach (\File::glob(public_path('assets/images/angel/'.$item['id']).'/*') as $file)
                                                            <a href="/{{ str_replace(public_path()."\\", '', $file) }}" class="slide">
                                                                <img src="/{{ str_replace(public_path()."\\", '', $file) }}" class="g_top">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                    {{$item['user_text']}}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="vt">
                                            <script type="text/javascript" src="/angel/socket/socket.io.js"></script>
                                            <script type="text/javascript" src="/angel/socket/admin_connect.js"></script>
                                            <div id="chat_wrapper" style="display: block;margin: 0px auto;">
                                                <input id="CHAT_TOKEN" type="hidden" value="{{$item['orderNo']}}">
                                                <input id="CHAT_USER" type="hidden" value="seller">
                                                <div id="chat_notice">
                                                    <button class="btn btn-sm btn-secondary">1:1채팅청소</button>
                                                </div>
                                                <div id="chat_content_wrapper" style="height: 247px">
                                                    <div id="chat_content" class="clear_fix">
                                                        <ul id="chat_list_wrapper"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tbody>
                                </table>
                                @if($item['user_goods_type'] == 'bargain' && $item['status'] == 0 && empty($item['toId']) && !empty($item['bargains']))
                                    <div class="highlight_contextual_nodemon">흥정거래 정보</div>
                                    <table class="g_green_table2 table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>흥정일시</th>
                                                <th>흥정제시금액</th>
                                                <th>흥정상태</th>
                                            </tr>
                                        @foreach($item['bargains'] as $value)
                                            <tr>
                                                <td>{{date("Y-m-d H:i:s",strtotime($value['created_at']))}}</td>
                                                <td>{{number_format($value['price'])}} 원</td>
                                                @if($value['status'] == 0)
                                                    <td>흥정중</td>
                                                @elseif($value['status'] == 1)
                                                    <td>재흥정중({{number_format($value['price1'])}}원)</td>
                                                @elseif($value['status'] == 3)
                                                    <td>흥정거절</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="trade_progress">
                                        <div class="highlight_contextual_nodemon">
                                            거래 진행 상황
                                        </div>
                                        <div class="trade_progress_content">
                                            <div class="guide_wrap">
                                                <div class="guide_set @if($item['status'] == 0 && !empty($item['payitem']) && $item['payitem']['status'] ==0) active @endif">
                                                    <span class="has-sprite pay_wait_icon"></span>
                                                    <span class="state">입금대기</span>
                                                </div>

                                                <div class="guide_set  @if(($item['status'] == 1)) {{'active'}}@endif">
                                                    <span class="has-sprite sell_ing_icon"></span>
                                                    <span class="state">판매중</span>
                                                </div>
                                                <div class="guide_set @if($item['status'] == 3) {{'active'}} @endif">
                                                    <span class="has-sprite trade_icon"></span>
                                                    <span class="state">인계완료</span>
                                                </div>
                                                <div class="guide_set @if($item['status'] == 2) {{'active'}}@endif">
                                                    <span class="has-sprite trade_icon"></span>
                                                    <span class="state">인수완료</span>
                                                </div>
                                                <div class="guide_set @if($item['status'] == 23 || $item['status'] == 32) {{'active'}} @endif">
                                                    <span class="has-sprite sell_complete_icon"></span>
                                                    <span class="state">판매완료</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($item['status'] != 23 && $item['stauts'] != 32)
                                <div class="mt-4">
                                    <a href="javascript:;" class="btn btn-primary" id="end_order" onclick="controlOrder({{$item['orderNo']}},'end')">
                                        거래종료
                                    </a>
                                    <a href="javascript:;" class="btn btn-secondary" id="cancel_order" onclick="controlOrder({{$item['orderNo']}},'cancel')">
                                        거래취소
                                    </a>
                                    <a href="javascript:;" class="btn btn-danger" id="delete_order" onclick="controlOrder({{$item['orderNo']}},'delete')">
                                        삭제
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('argon') }}/js/common.js"></script>
    <script src="{{ asset('argon') }}/select2/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/packery/1.4.3/packery.pkgd.min.js"></script>
    <script type="text/javascript" src="/angel/photoswipe/js/jquery.photoswipe-global.js"></script>
    <style>
        #chat_input_wrapper #send_btn{
            line-height: 45px;
        }
        #chat_content #chat_list_wrapper {
            margin: 16px 14px 16px 6px;
        }
        #chat_content .chat_info .list_content .chat_ballon{

        }
    </style>
    <script>
        $('#js-gallery')
            .packery({
            itemSelector: '.slide',
            gutter: 10
        })
            .photoSwipe('.slide', {bgOpacity: 0.8, shareEl: false}, {
            close: function () {
            console.log('closed');
        }
        });

    </script>
</html>
