@extends('layouts-angel.app')
@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/common_myroom.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/css/index.css?">
    <script type="text/javascript" src="/angel/_banner/js/banner_module.js?v=210209"></script>
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
            top: 6px;
        }
        .content_box_wrap {
            padding-top: 12px;
            padding-bottom: 46px;
            border: solid 1px #89c1ce;
            margin-top: 12px;
        }
    </style>
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        @include("aside.myroom",['group'=>''])
        <div class="g_content">
            <div class="content_area content_coupon">
                <div class="myroom_status_part">
                    <div class="user-info-part">
                        <img class="position-abs" style="top: 24px; left: 15px;" src="/angel/img/level/{{$role['icon']}}" />
                        <div class="position-abs f-18 c-blue-title align-center f-bold" style="top: 28px; left: 82px; width: 98px;">{{$role['alias']}} 회원</div>
                        <div class="position-abs f-20 align-right" style="top: 24px; left: 251px; width: 34px;">{{number_format($user['point'])}}</div>
                        <div class="position-abs f-16 align-center" style="top: 64px; left: 90px; width: 85px;">
                            <a class="" href="/myroom/myinfo/credit_rating">혜택보기</a>
                        </div>
{{--                        <div class="position-abs f-16 align-center" style="top: 64px; left: 190px; width: 85px;">--}}
{{--                            <a href="#">승급조건</a>--}}
{{--                        </div>--}}
                    </div>
                    <div class="user-money-info position-abs f-17" style="width:330px; left:350px;">
{{--                        <div class="d-flex w-100" style="margin-top: 12px">--}}
{{--                            <div class="align-left" style="width: 60%; padding-top: 2px;">사용가능 마일리지</div>--}}
{{--                            <div class="c-blue-title align-right" style="width: 40%"><b class="f-20">128,126</b>원</div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex w-100" style="margin-top: 5px">--}}
{{--                            <div class="align-left" style="width: 60%; padding-top: 1px;">구매전용 마일리지</div>--}}
{{--                            <div class="align-right " style="width: 40%"><span class="f-18">128,126</span>원</div>--}}
{{--                        </div>--}}
                        <div class="d-flex w-100" style="margin-top: 25px">
                            <div class="align-left" style="width: 60%; padding-top: 1px;">총 마일리지</div>
                            <div class="align-right " style="width: 40%"><span class="f-18">{{number_format($user['mileage'])}}</span>원</div>
                        </div>
                        <div class="position-abs f-16 align-center" style="top: 22px; left: 358px; width: 82px;">
                            <a href="#">충전하기</a>
                        </div>
                        <div class="position-abs f-16 align-center" style="top: 64px; left: 358px; width: 82px;">
                            <a href="#">출금하기</a>
                        </div>
                    </div>
                    <div class="user-coupon-info position-abs f-15" style="top: 160px; padding-left: 15px; padding-top: 10px;">
                        <div class="d-flex w-100">
                            <div class="each-part">
                                <div class="align-center" style="padding-top:2px;">프리미엄</div>
                                <div class="align-center f-20 c-blue-title">{{$coupon[1]}}</div>
                            </div>
                            <div class="each-part">
                                <div class="align-center" style="padding-top:2px;">물품강조</div>
                                <div class="align-center f-20 c-blue-title">{{$coupon[2]}}</div>
                            </div>
                            <div class="each-part">
                                <div class="align-center" style="padding-top:2px;">스피드 거래</div>
                                <div class="align-center f-20 c-blue-title">{{$coupon[3]}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="user-market-status f-28">
                        <!-- 판매등록 -->
                        <div class="position-abs align-center " style="top: 298px; left: 235px; width: 50px;" title="판매등록">
                            <a class="c-white" href="/myroom/sell/sell_regist?strRelationType=regist">{{$selling_register}}</a>
                        </div>
                        <div class="position-abs align-center" style="top: 355px; left: 235px; width: 50px;" title="흥정신청">
                            <a class="c-white" href="/myroom/sell/sell_check?strRelationType=check">{{$bargain_request_selling}}</a>
                        </div>
                        <div class="position-abs align-center" style="top: 374px; left: 360px; width: 50px;" title="입금대기">
                            <a class="c-white" href="/myroom/sell/sell_pay_wait?strRelationType=pay">{{$pay_pending_selling}}</a>
                        </div>
                        <div class="position-abs align-center" style="top: 374px; left: 520px; width: 50px;" title="판매중">
                            <a class="c-white" href="/myroom/sell/sell_ing?strRelationType=ing">{{$selling_count}}</a>
                        </div>
                        <div class="position-abs align-center f-14" style="top: 380px; left: 685px; width: 86px; padding: 4px 0; background-color: #87c4de;">
                            <a class="c-black" href="/myroom/complete/sell" >자세히보기</a>
                        </div>
                        <!-- 구매등록 -->
                        <div class="position-abs align-center " style="top: 450px; left: 235px; width: 50px;" title="구매등록">
                            <a class="c-white" href="/myroom/buy/buy_regist?strRelationType=regist">{{$buying_register}}</a>
                        </div>
                        <div class="position-abs align-center" style="top: 507px; left: 235px; width: 50px;" title="흥정신청">
                            <a class="c-white" href="/myroom/buy/buy_check?strRelationType=check">{{$bargain_request}}</a>
                        </div>
                        <div class="position-abs align-center" style="top: 526px; left: 360px; width: 50px;" title="입금예정">
                            <a class="c-white" href="/myroom/buy/buy_pay_wait?strRelationType=pay">{{$pay_pending}}</a>
                        </div>
                        <div class="position-abs align-center" style="top: 526px; left: 520px; width: 50px;" title="구매중">
                            <a class="c-white" href="/myroom/buy/buy_ing?strRelationType=ing">{{$buying_count}}</a>
                        </div>
                        <div class="position-abs align-center f-14" style="top: 532px; left: 685px; width: 86px; padding: 4px 0; background-color: #87c4de;">
                            <a class="c-black" href="/myroom/complete/buy" >자세히보기</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_area content_recent_trade">
                <div class="g_subtitle f-16">최근 거래내역</div>
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
                                <td style="background-color: white;" class="c-blue-title">{{$order_alias}}완료</td>
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
                <div class="g_subtitle f-16">나의 보안 및 인증상태</div>
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
            <div class="content_area ">
                <div class="g_subtitle f-16 align-center">즐겨찾기 설정</div>
                <div class="content_box_wrap">
                    <div class="align-center">
                        <img src="/assets/img/bkg/myroom_menu.jpg" />
                        <div class="position-ref">
                            <a class="position-abs btn-favorite-service" href="/myroom/customer/" style="left: 218px;">바로가기</a>
                            <a class="position-abs btn-favorite-service" href="/myroom/customer/search" style="left: 385px;">바로가기</a>
                            <a class="position-abs btn-favorite-service" href="/myroom/customer/" style="left: 532px;">바로가기</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="g_finish"></div>
        </div>
        <form id="reqCBAForm" name="reqCBAForm" method="post" action="/certify/ipin_auth/v3/module/ipin_request.php" target="frmTarget">
            <input type="hidden" name="wis" value="MyAuthState"> </form>
        <iframe src="about:blank" width="0" height="0" name="frmTarget" style="border:none"></iframe>
        <form id="reloadFrm" name="reloadFrm" method="post"> </form>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/js/index.js"></script>
@endsection
