@php
$user  = Auth::user();
@endphp
@extends('layouts-angel.app-frame')
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
            border: solid 1px #a2a2a2 !important;
            padding: 10px !important;
            text-align: center;
        }
        .market_history_table {
            margin-top: 4px;
            border-spacing: initial !important;
            border: solid 1px #89c1ce !important;
        }
        .verify-status {
            text-align: center;
            display: block;
            border: solid 1px gray;
            margin-left: 10%;
        }
        /*.verify-status:before {*/
        /*    */
        /*}*/
        .verify-status.on:before{
            background-image: url("/assets/img/icons/icon_check.png");
            background-size: 100%;
            display: inline-block;
            width: 14px;
            height: 14px;
            content:"";
            background-repeat: no-repeat;
            margin-right: 5px;
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
            border: 1px solid #999999;
            width: 100%;
        }
    </style>
    <div @class('bg-white')>
        <div>
            @include("angel.myroom.header")
        </div>
        <div>
            @include("aside.myroom",['group'=>''])
            <div class="pagecontainer">
                <div class="content_area content_coupon">
                    <div class="content_box_wrap">
                        <div>
                            <a href="{{route("search")}}">
                                <img src="/angel/img/icons/mine_search.png">
                                <p @class('text-center mt-10 f-14')>나만의 검색 설정</p>
                            </a>
                        </div>
                        <div>
                            <a href="{{route("search")}}">
                                <img src="/angel/img/icons/mine_person.png">
                                <p @class('text-center mt-10 f-14')>개인 환경설정</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="content_area mt-15">
                    <div class="highlight_contextual_nodemon f-16">나의 보안 및 인증상태</div>
                    <div class="my_security_state_wrap">
                        <div>
                            <div class="dflex__half">
                                <div><img src="/assets/img/icons/myroom_secure.png" /></div>
                                <div @class('lh_74')>
                                    <button class="f-13 w80p hb25 bg-gradient-greens text-center text-white">보안센터</button>
                                </div>
                            </div>
                            <div class="f-14" >
                                <div @class('dflex__half mt-10')>
                                    <div @class('lh25')>로그인 보안 설정</div>
                                    <div>
                                        <button @class("bg-transparent w80p hb25 border__gray text-center")>미설정</button>
                                    </div>
                                </div>
                                <div @class('dflex__half mt-10')>
                                    <div @class('lh25')>로그인 알림 설정</div>
                                    <div>
                                        <button @class("bg-transparent w80p hb25 border__gray text-center")>미설정</button>
                                    </div>
                                </div>
                                <div @class('dflex__half mt-10')>
                                    <div @class('lh25')>결제 보안 설정</div>
                                    <div>
                                        <button @class("bg-transparent w80p hb25 border__gray text-center")>미설정</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="dflex__half">
                                <div><img src="/assets/img/icons/myroom_verify.png" /></div>
                                <div @class('lh_74')>
                                    <button class="f-13 w80p hb25 bg-gradient-greens text-center text-white">인증상태</button>
                                </div>
                            </div>
                            <div class="f-14" >
                                <div @class('dflex__half mt-10')>
                                    <div @class('text-center')>
                                        <button class="bg-gradient-wb w80p hb40 border__gray text-center verify-status @if($user['mobile_verified'] == 1) on @endif">휴대폰</button>
                                    </div>
                                    <div @class('text-center')>
                                        <button class="bg-gradient-wb w80p hb40 border__gray text-center verify-status @if($user['bank_verified'] == 1) on @endif">계좌</button>
                                    </div>
                                </div>
                                <div @class('dflex__half mt-10')>
                                    <div @class('text-center')>
                                        <button class="bg-gradient-wb w80p hb40 border__gray text-center verify-status @if($user['pin'] == 1) on @endif">아이핀</button>
                                    </div>
                                    <div @class('text-center')>
                                        <button class="bg-gradient-wb w80p hb40 border__gray text-center verify-status @if(!empty($user['email_verified_at'])) on @endif">이메일</button>
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
        <div class="content_area content_recent_trade mt-20 ml-10">
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
    </div>

@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/js/index.js"></script>
@endsection
