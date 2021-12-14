@extends('layouts-mania.app')

@section('head_attach')

    <link type='text/css' rel='stylesheet' href='/angel/guide/css/common.css'>
    <link type='text/css' rel='stylesheet' href='/angel/guide/frshmn_guide/css/frshmn.css'>
    <link type="text/css" rel="stylesheet" href="/angel/dev/guide_arrow.css">
@endsection

@section('foot_attach')
    <script type='text/javascript' src='/angel/guide/frshmn_guide/js/common.js'></script>
    <script type='text/javascript'>


    </script>
@endsection

@section('content')
    <style>
        .trade_category li {
            float: left;
        }
        .trade_category .next_arrow {
            margin: 12px 11px;
        }
        .trade_category img {
            padding: 0;
        }

        .g_title_blue {
            margin-left: 20px;
        }
        .g_tab>* {
            background-color: #e3f0f3;
            border-bottom: 2px solid #0081b9;
        }
        .g_tab>.selected {
            border: 2px solid #0081b9;
            border-bottom: 0;
        }
        .g_tab>*>a {
            font-size: 14px;
        }
        .tb_list th {
            font-size: 14px;
        }
        .tb_list td {
            font-size: 13px;
        }
        .g_blue_table tr th {
            background-color: #e3f0f3;
        }
        .g_blue_table,
        .g_blue_table tr th,
        .g_blue_table tr td {
            border: solid 1px #89c1ce;
        }
    </style>

    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
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
            .aside .img_wrap > .img_mania_call {
                display: inline-block;
                width: 35px;
                height: 35px;
                background-position: -789px -545px;
                margin: 0 10px 0 15px;
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
        </style>
        @include('angel.guide.aside', ['group'=>'new_guide', 'part'=>''])
        <div class="g_content">
            <a name="top"></a>
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue no-border">부가서비스</div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab">
{{--                <div><a href="coupon.html">할인쿠폰</a></div>--}}
                <div class="selected"><a href="{{route('security_number')}}">안심번호</a></div>
                <div><a href="{{route('security_number_plus')}}">안심번호 플러스</a></div>
            </div>
            <div class="g_finish"></div>
            <!-- ▲ 메뉴탭 //-->
            <div class="g_subtitle_blue">안심번호</div>
            고객님의 개인정보 보호를 위해 휴대폰번호에 안심번호를 부여하여 실제 휴대폰번호 대신 가상의 안심번호를 노출시켜주는 무료 서비스<br>
            - 전화번호가 비정상일 경우 서비스 이용불가<br>
            - 불법적, 악의적 고객 연락처 수집, 보관 행위를 근본적으로 차단<br>
            - 스팸이나 불법 TM 행위 근절<br>
            - 거래 사고 예방 및 직거래 차단 효과
            <div class="guide_subtitle">
                <div class="f_bold">■ 안심번호 이용안내</div>
                1. 판매등록 / 구매신청 시 안심번호가 자동 발급되며, 거래중인 물품에서 상대 거래자에게 실제 전화번호 대신 안심번호로 안내됩니다.<br>
                2. 제공되는 안심번호 서비스의 전화번호는 "0508"로 시작되는 11자리의 가상번호가 부여됩니다.<br>
                3. 거래중인 물품에서 0508로 시작되는 안심번호를 확인 후 상대거래자와 통화&nbsp;하시면서 거래를 진행하시면 됩니다.<br>
                4. 거래중인 물품이 종료되는 경우 안심번호는 자동으로 삭제됩니다.<br>
                5.&nbsp;거래 중 상태가 48시간을 초과하는 경우 비정상적인 거래로 판단하여 강제 회수됩니다.
            </div>
            <div class="guide_subtitle">■ 안심번호 이용방법</div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">하나. </span>판매등록/구매신청 시 안심번호 서비스를 이용하실 수 있습니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_safe_1.gif" width="820" height="411" alt="">
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">둘. </span>안심번호 신청 후 거래중인 상태가 되면 상대 거래자에게 휴대폰 번호가 안심번호로 노출됩니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_safe_2.gif" width="820" height="578" alt="">
            <dl class="notice">
                <dt>[주의사항]</dt>
                <dd>부여받은 안심번호로 통화 시 실제 번호가 표시 됩니다.</dd>
                <dd>서비스 장애 시 거래의 불편함을 없애기 위해 실 번호가 노출될 수 있습니다.</dd>
                <dd>SMS 수신 및 발신 시 실제 연락처가 노출 됩니다.</dd>
            </dl>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
