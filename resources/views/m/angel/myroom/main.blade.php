@extends('layouts-angel-mobile.app')

@section('head_attach')
    <link rel="stylesheet" href="/angel_mobile/myroom/main/css/index.css" />
@endsection

@section('foot_attach')
@endsection

@section('content')
    <div class="e4rn34RT" id="e4rn34RT" style="opacity: 1;">
{{--        @include('m.angel.aside.nav', ['user' => $me])--}}
{{--        <div class="header">--}}
{{--            <div class="h_tit bg-white">--}}
{{--                <a href="javascript:history.back()" class="back_btn" id="back_btn"></a>--}}
{{--                <h1 class="c-black">마이룸</h1>--}}
{{--                <button class="btn_menu" id="btn_menu"><em>메뉴</em></button>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="container">
            @php
                $isLogined = '';
                if (Auth::check()) {
                    $isLogined = 1;
                }
            @endphp
            <input id="_LOGINCHECK" type="hidden" value="{{$isLogined}}">
            <div class="info_area">
                <div class="credit_area">
                    <div>
                        <span class="sp credit_icon vip"></span>
                        <p class="ft_bold"><span class="name_text">[{{$me['name']}}] </span><span style="font-size: 13px;">회원님</span>
                            <br><span class="vip_txt credit_text">VIP </span><span style="font-size: 14px;">(921점)</span><span class="keep_mileage">마일리지 {{number_format($me['mileage'])}}</span>
                        </p>
                    </div>
                </div>

                <div class="certify_info2">
                    <div>
                        <span id="excellent" class="cert_state">우수인증</span>
                        <span class="cert_state on">휴대폰</span>
                        <span class="cert_state on">이메일</span>
                    </div>
                </div>
                <div class="myroom_info">
                    <table class="tbl_myinfo w-100">
                        <tr>
                            <td class="part-pri align-center">
                                <div>프리미엄</div>
                                <a href="#"><b class="fs-16">20</b>건</a>
                            </td>
                            <td class="part-str align-center">
                                <div>물품강조</div>
                                <a href="#" ><b class="fs-16">20</b>건</a>
                            </td>
                            <td class="part-qik align-center" style="border-right: none;">
                                <div>퀵아이콘</div>
                                <a href="#"><b class="fs-16">20</b>건</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="padding: 24px 0 10px;">
                    <a href="#" class="credit_bnf ft_bold" id="credit_bnf">신용등급 혜택받기</a>
                </div>
                <div class="g_btn_wrap">
                    <a href="{{route('mileage_payment_charge')}}" class="mileage_charge">충전하기</a>
                    <a href="{{route('mileage_payment_exchange')}}" class="mileage_exchange">출금하기</a>
                </div>

                <div class="trade_info_area sell_body">
                    <div class="d-flex w-100">
                        <div class="each_part align-center">
                            <div>판매등록</div>
                            <div><a href="#"><b class="fs-16">20</b>건</a></div>
                        </div>
                        <div class="each_part align-center">
                            <div>흥정신청</div>
                            <div><a href="#"><b class="fs-16">20</b>건</a></div>
                        </div>
                        <div class="each_part align-center">
                            <div>입금대기</div>
                            <div><a href="#"><b class="fs-16">20</b>건</a></div>
                        </div>
                        <div class="each_part align-center">
                            <div>판매중</div>
                            <div><a href="#"><b class="fs-16">20</b>건</a></div>
                        </div>
                    </div>
                </div>

                <div class="trade_info_area buy_body">
                    <div class="d-flex w-100">
                        <div class="each_part align-center">
                            <div>구매등록</div>
                            <div><a href="#"><b class="fs-16">20</b>건</a></div>
                        </div>
                        <div class="each_part align-center">
                            <div>흥정신청</div>
                            <div><a href="#"><b class="fs-16">20</b>건</a></div>
                        </div>
                        <div class="each_part align-center">
                            <div>입금대기</div>
                            <div><a href="#"><b class="fs-16">20</b>건</a></div>
                        </div>
                        <div class="each_part align-center">
                            <div>구매중</div>
                            <div><a href="#"><b class="fs-16">20</b>건</a></div>
                        </div>
                    </div>
                </div>

                <div class="g_title">서비스 정보</div>
                <ul class="snb">
                    <li><a href="#" class="sell">판매관련</a></li>
                    <li><a href="#" class="buy">구매관련</a></li>
                    <li><a href="#" class="complete">종료내역</a></li>
                    <li><a href="#" class="cancel">취소내역</a></li>
                </ul>
            </div>
        </div>
        @include('m.angel.aside.footer')
    </div>
@endsection
