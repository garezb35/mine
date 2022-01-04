@extends('layouts-angel.app')
@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/index.css?">
    <script type="text/javascript" src="/angel/carsouel_plugin/js/carsouel_plugin.js?v=210209"></script>
@endsection

@section('content')
    <style>
        .myroom_status_part .user-info-part a {
            display: block;
            border: solid 1px #3ab7d3;
            border-radius: 14px;
            text-align: center;
            padding: 4px 4px;
            font-size: 14px;
        }
        .myroom_status_part .user-money-info a {
            display: block;
            border: solid 1px #1a73e8;
            text-align: center;
            padding: 4px 4px;
            color: #1a73e8;
            font-size: 14px;
            background-color: white;
        }
        .user-coupon-info .each-part  {
            width: 110px;
        }
        .user-market-status a {
            display: block;
            text-align: center;
        }
        .market_history_table tr td {
            border: solid 1px #89c1ce !important;
            padding: 10px !important;
        }
        .market_history_table {
            margin-top: 4px;
            border-spacing: initial !important;
            background-color: #e3f0f3;
            border: solid 1px #89c1ce !important;
        }
        .verify-status {
            text-align: center;
            padding: 2px;
            margin-right: 4px;
            margin-bottom: 20px;
            display: block;
            width: 100px;
            border: solid 1px gray;
        }
        .verify-status:before {
            display: inline-block;
            width: 14px;
            height: 14px;
            content:"";
            background-repeat: no-repeat;
        }
        .verify-status.on:before{
            background-image: url("/assets/img/icons/icon_check.png");
            background-size: 100%;
        }
        .btn-favorite-service {
            display: block;
            width: 76px;
            padding: 3px 2px;
            text-align: center;
            font-size: 14px;
            border: solid 1px #55a1ff;
            top: 16px;
        }
        .content_box_wrap {
            vertical-align: top;
            border: 1px solid #89c1ce;
            border-left: none;
            width: 439px;
            padding-top: 12px;
        }
    </style>

    <div class="container_fulids" id="module-teaser-fullscreen">
        @include("aside.myroom",['group'=>''])
        <div class="pagecontainer">
            <div class="fileright">
                <div class="filerighttop">
                    <div class="filerightlf">
                        <div class="filerightlfimg">
                            <a href="/myroom/myinfo/credit_rating"></a>
                            <img src="/angel/img/level/{{$role['icon']}}">
                        </div>
                    </div>
                    <div class="filerightrg">
                        <h3>안녕하세요, 아이템천사에 오신 것을 환영합니다!</h3>
                        <dl><dt>내 이메일: </dt><dd class="clc3">{{$me['email']}}</dd></dl>
                        <dl><dt>등급정보: </dt><dd class="clc3">{{$role['alias']}} 회원</dd></dl>
                        <dl><dt>거래점수:</dt><dd class="clc3">{{number_format($user['point'])}}</dd></dl>
                        <dl><dt>총 마일리지: </dt><dd class="clc3">{{number_format($user['mileage'])}}원</dd></dl>
                        <dl><dt>나의 쿠폰: </dt><dd class="clc3">프리미엄 <span style="color: dodgerblue;font-weight: bold ">{{$coupon[1]}}</span>, 물품강조 <span style="color: dodgerblue;font-weight: bold">{{$coupon[2]}}</span></dd></dl>
                    </div>
                    <div style="clear:both"></div>
                </div>
            </div>

            <div class="content_area content_coupon">
                <table class="table-primary g_sky_table" style="width: 50%;display: inline-table;">
                    <tbody>
                        <tr>
                            <th>판매등록</th>
                            <td><a class="font-weight-bold" href="/myroom/sell/sell_regist?strRelationType=regist">{{$selling_register}}건</a> </td>
                            <th>구매등록</th>
                            <td><a class="font-weight-bold" href="/myroom/buy/buy_regist?strRelationType=regist">{{$buying_register}}건</a> </td>
                        <tr>
                            <th>입금대기</th>
                            <td><a class="font-weight-bold" href="/myroom/sell/sell_pay_wait?strRelationType=pay">{{$pay_pending_selling}}건</a></td>
                            <th>입금예정</th>
                            <td><a class="font-weight-bold" href="/myroom/buy/buy_pay_wait?strRelationType=pay">{{$pay_pending}}건</a> </td>
                        </tr>
                        <tr>
                            <th>판매중</th>
                            <td><a class="font-weight-bold" href="/myroom/sell/sell_ing?strRelationType=ing">{{$selling_count}}건</a></td>
                            <th>구매중</th>
                            <td><a class="font-weight-bold" href="/myroom/buy/buy_ing?strRelationType=ing">{{$buying_count}}건</a></td>
                        </tr>
                        <tr>
                            <th>판매종료</th>
                            <td><a style="display: block;width: 86px;background: #87c4de;padding: 5px" class="c-black" href="/myroom/complete/sell" >자세히보기</a></td>
                            <th>구매종료</th>
                            <td><a style="display: block;width: 86px;background: #87c4de;padding: 5px" class="c-black" href="/myroom/complete/buy" >자세히보기</a></td>
                        </tr>
                    </tbody>
                </table>
                <div class="content_box_wrap">
                    <div class="align-center">
                        <img src="/assets/img/bkg/myroom_menu.jpg" />
                        <div class="position-ref">
                            <a class="position-abs btn-favorite-service" href="/myroom/customer/" style="left: 24px;">바로가기</a>
                            <a class="position-abs btn-favorite-service" href="/myroom/customer/search" style="left: 194px;">바로가기</a>
                            <a class="position-abs btn-favorite-service" href="/myroom/customer/" style="left: 336px;">바로가기</a>
                        </div>
                    </div>
                </div>
{{--                <table class="table-modern-primary tb_list" style="width: 50%">--}}
{{--                    <tbody>--}}
{{--                        <tr>--}}
{{--                            <th>구매등록</th>--}}
{{--                            <th>입금예정</th>--}}
{{--                            <th>구매중</th>--}}
{{--                            <th>구매종료</th>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>{{$buying_register}}</td>--}}
{{--                            <td>{{$pay_pending}}</td>--}}
{{--                            <td>{{$buying_count}}</td>--}}
{{--                            <td><a style="display: block;width: 86px;background: #87c4de" class="c-black" href="/myroom/complete/buy" >자세히보기</a></td>--}}
{{--                        </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
            </div>
            <div class="content_area content_recent_trade">
                <div class="highlight_contextual_nodemon f-16">최근 거래내역</div>
                <div class="content_table_wrap">
                    <table class="market_history_table f-14">
                        <colgroup>
                            <col width="200">
                            <col width="80">
                            <col width="270">
                            <col width="80">
                            <col width="100">
                            <col width="80">
                        </colgroup>
                        <tbody>
                        @foreach($recent_orders as $v)
                            @php
                            $order_alias = '판매';
                            if( ($v['type'] == 'buy' && $v['userId'] == $user['id']) || ($v['type'] == 'sell' && $v['toId'] == $user['id']) )
                                $order_alias = '구매';
                            @endphp
                            <tr>
                                <td>{{$v['game']['game']}} {{$v['server']['game']}}</td>
                                <td>{{$v['good_type']}}</td>
                                <td>{{$v['user_title']}}</td>
                                <td>{{number_format($v['payitem']['price'])}}원</td>
                                <td>{{date("Y/m/d",strtotime($v['updated_at']))}}</td>
                                <td style="background-color: white;" class="text-nodemon">{{$order_alias}}완료</td>
                            </tr>
                        @endforeach
                        @if(sizeof($recent_orders) == 0)
                            <tr>
                                <td colspan="6">최근 거래내역이 없습니다.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="content_area ">
                <div class="highlight_contextual_nodemon f-16">나의 보안 및 인증상태</div>
                <div class="my_security_state_wrap d-flex" style="margin-top: 4px;">
                    <div class="d-flex" style="float:left; width: 49%; height: 160px; ">
                        <div class="align-center" style="width: 150px; border: solid 1px #89c1ce;">
                            <img src="/assets/img/icons/myroom_secure.png" style="margin-top: 14px;"/>
                            <div class="align-center" style="margin-top: 18px;">
                                <a class="f-13" href="#" style="border: solid 1px gray; padding: 4px 14px;">보안센터</a>
                            </div>
                        </div>
                        <div class="f-14" style="width: calc(100% - 150px); border: solid 1px gray;">
                            <div class="d-flex" style="margin: 0 28px; margin-top:24px; padding-bottom: 10px; border-bottom: solid 1px #89c1ce;">
                                <div style="width: calc(100% - 50px)">로그인 보안 설정</div>
                                <div class="align-right" style="width: 50px;">미설정</div>
                            </div>
                            <div class="d-flex" style="margin:0 28px; margin-top:10px; padding-bottom: 10px; border-bottom: solid 1px #89c1ce;">
                                <div style="width: calc(100% - 50px)">로그인 알림 설정</div>
                                <div class="align-right" style="width: 50px;">미설정</div>
                            </div>
                            <div class="d-flex" style="margin:0 28px; margin-top:10px; padding-bottom: 10px; border-bottom: solid 1px #89c1ce;">
                                <div style="width: calc(100% - 50px)">결제 보안 설정</div>
                                <div class="align-right" style="width: 50px;">미설정</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex" style="float:right; width: 49%; margin-left: 2%; height: 160px;">
                        <div class="align-center" style="width: 150px; border: solid 1px #89c1ce;">
                            <img src="/assets/img/icons/myroom_verify.png" style="margin-top: 14px;"/>
                            <div class="align-center" style="margin-top: 18px;">
                                <a class="f-13" href="#" style="border: solid 1px gray; padding: 4px 14px;">인증상태</a>
                            </div>
                        </div>
                        <div class="f-14" style="width: calc(100% - 150px); border: solid 1px gray;">
                            <div style="margin: 46px 35px;">
                                <div class="d-flex">
                                    <span class="verify-status @if($user['mobile_verified'] == 1) on @endif">휴대폰</span>
                                    <span class="verify-status @if($user['bank_verified'] == 1) on @endif">계좌</span>
                                </div>
                                <div class="d-flex">
                                    <span class="verify-status @if($user['pin'] == 1) on @endif">아이핀</span>
                                    <span class="verify-status @if(!empty($user['email_verified_at'])) on @endif">이메일</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="empty-high"></div>
        </div>

        <iframe src="about:blank" width="0" height="0" name="frmTarget" style="border:none"></iframe>
        <form id="reloadFrm" name="reloadFrm" method="post"> </form>
        <div class="empty-high"></div>
    </div>

@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/js/index.js"></script>
@endsection
