@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/guide/css/index.css?v=210810">
@endsection

@section('foot_attach')
    <script type='text/javascript'>


    </script>
@endsection

@section('content')

    <div class="container_fulids" id="module-teaser-fullscreen">
        <style>
            .aside .img_wrap {
                width: 214px;
                height: 98px;
                box-sizing: border-box;
                text-align: center;
                margin: 10px 0;
                border: 1px solid #E1E1E1;
            }

            .aside .img_wrap > .title {
                width: 182px;
                height: 30px;
                margin: 0 auto 10px;
                font-size: 13px;
                font-weight: bold;
                color: #636363;
                border-bottom: 1px solid #F1F1F1;
                line-height: 30px;
            }


            .aside .img_wrap > .content {
                font-size: 12px;
                font-weight: bold;
                color: #767676;
            }

            .aside .callme {
                display: block;
                height: auto;
                padding: 15px 0;
                background-color: #EBF2F8
            }

            .aside .callme > .img_callme {
                display: inline-block;
                width: 43px;
                height: 35px;
                background-position: -826px -545px;
                margin: 0 3px 0 15px;
            }

            .aside .callme > .callme_title {
                margin-top: -2px;
                font-size: 13px;
                font-weight: bold;
                color: #0081DB;
                border: none;
                height: auto;
            }

            .aside .callme > .callme_title > span {
                font-size: 16px;
                font-weight: bold;
                color: #1D1D1D;
            }

            .aside .callme > .callme_title .go_btn {
                display: inline-block;
                width: 57px;
                height: 19px;
                margin-left: 6px;
                font-size: 11px;
                font-weight: bold;
                color: #FFF;
                background-color: #216ED7;
                text-align: center;
                line-height: 19px;
                vertical-align: text-bottom;
            }

            .ft_orange {
                color: #FF4E00;
            }
            .notice-part {
                padding: 20px;
                background: #eefafd;
                border: solid 1px #A7D1DA;
            }
            .notice-title {
                font-size: 26px;
                font-weight: bold;
                color: #E26D00;
            }
            .notice-main-menu td {
                border: none;
            }
            .notice-main-menu td a {
                border: solid 1px #A7D1DA;
                display: block;
                text-align: center;
                padding: 10px;
                font-size: 14px;
                background-color: white;
            }
            .fv_menu > a {
                height: 110px;
            }
            .fv_menu > a .title {
                font-size: 14px;
                font-weight: bold;
                padding-left: 20px;
            }
            .fv_menu > .join:hover, .fv_menu > .charge:hover, .fv_menu > .payment:hover, .fv_menu > .cancel:hover {
                background-color: #eefafd;
                color: black;
            }
            .main_service > dt {
                background: #eefafd;
            }
            .main_service > dt, .main_service > dd {
                border-bottom: 1px solid #A7D1DA;
            }
            .main_service > dd > a:hover {
                color: #195e6c;
            }
        </style>
        @include('angel.guide.aside', ['group'=>'guide', 'part'=>''])
        <div class="pagecontainer">
            <div class="g_title">이용안내</div>
            <div class="notice-part d-flex">
                <div style="width: 60%;">
                    <div class="notice-title">
                        <img src="/assets/img/icons/notice.png" />
                        처음이신가요?
                    </div>
                    <div style="margin-left: 56px; margin-top: 6px;">쉽게 이해하고 편리하게 사용하실수 있도록 도와드리는 가이드입니다.</div>
                    <div style="margin-left: 56px; margin-top: 6px;">초보자 가이드에게 거래를 하는 방법에 대한 궁금증을 해결하세요.</div>
                </div>
                <div style="width: 40%;">
                    <table class="notice-main-menu no-border">
                        <tbody>
                        <tr>
                            <td><a href="{{route('guide_howto')}}">거래 방법 안내</a></td>
                            <td><a href="#">안전보호 시스템</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">혜택</a></td>
                            <td><a href="#">거래 주의사항</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="fv_menu">
                <a href="/guide/join/join.html" class="join">
                    <div class="align-center" style="padding-top: 30px;">
                        <img src="/assets/img/icons/user_regist.png"><span class="title">회원가입</span>
                    </div>
                </a>
                <a href="/guide/charge/mileage.html" class="charge">
                    <div class="align-center" style="padding-top: 30px;">
                        <img src="/assets/img/icons/mileage.png"><span class="title">마일리지</span>
                    </div>
                </a>
                <a href="/guide/withdraw/withdraw.html" class="payment">
                    <div class="align-center" style="padding-top: 30px;">
                        <img src="/assets/img/icons/security.png"><span class="title">보안서비스</span>
                    </div>
                </a>
                <a href="/guide/cancel/cancel.html" class="cancel">
                    <div class="align-center" style="padding-top: 30px;">
                        <img src="/assets/img/icons/setting.png"><span class="title">거래정지/해제</span>
                    </div>
                </a>
            </div>

            <div class="sms_alias f-15">주요서비스 한 눈에 보기</div>
            <dl class="main_service"> <dt>회원관련</dt>
                <dd> <a href="/guide/join/join.html">회원가입</a> <a href="/guide/myroom/myroom.html">마이룸</a> <a href="/guide/safe_grade/safe_grade.html">신용등급/인증센터</a> </dd> <dt>거래관련</dt>
                <dd> <a href="/guide/cancel/cancel.html">거래취소/신고</a> <a href="/guide/brokerage/brokerage.html">수수료</a> <a href="/guide/direct/index.html">즉시구매</a> <a href="/guide/char_trade/index.html?file=02">캐릭터 거래</a> <a href="/guide/div_trade/index.html">분할거래</a> <a href="/guide/bar_trade/sell_reg.html">흥정거래</a> </dd> <dt>결제관련</dt>
                <dd> <a href="/guide/charge/mileage.html">마일리지 충전</a> <a href="/guide/charge/credit_card.html">신용카드 결제</a> <a href="/guide/charge/cell_phone.html">휴대폰 결제</a> <a href="/guide/charge/tcash.html">티캐시 결제</a> </dd> <dt>출금관련</dt>
                <dd> <a href="/guide/withdraw/withdraw.html">은행계좌 출금</a> </dd> <dt>보상관련</dt>
                <dd> <a href="/guide/compe/compe_info.html">회원보상제도</a> <a href="/guide/compe/compe_120_incident.html">200% 사고 보상</a> </dd> <dt>보안관련</dt>
                <dd> <a href="/guide/protect/pay_plus.html">로그인 플러스</a> <a href="/guide/protect/pay_login.html">로그인 도용방지</a> <a href="/guide/protect/pay_sms.html">SMS 알림</a> <a href="/guide/protect/pay_pc.html">PC등록 인증</a> <a href="/guide/protect/pay_ip.html">결제IP 인증</a> </dd> <dt>편의관련</dt>
                <dd> <a href="/guide/convnce/talk_box.html">1:1 대화함</a> <a href="/guide/convnce/hide_func.html">숨김기능</a> <a href="/guide/convnce/howto_search.html">물품 검색 방법</a> </dd> <dt>부가관련</dt>
                <dd> <a href="/guide/add/coupon.html">할인쿠폰</a> <a href="/guide/add/security_number.html">안심번호</a> <a href="/guide/add/security_number_plus.html">안심번호 플러스</a> </dd> <dt>모바일관련</dt>
                <dd> <a href="/guide/mobile/web.html">모바일웹</a> <a href="/guide/mobile/app.html">모바일앱</a> <a href="/guide/mobile/sise_app.html">시세앱</a> <a href="/guide/mobile/push.html">앱 PUSH 알림</a> </dd>
            </dl>

        </div>
        <div class="empty-high"></div>
    </div>

@endsection
