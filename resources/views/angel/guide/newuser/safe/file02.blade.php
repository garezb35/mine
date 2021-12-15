@extends('layouts-angel.app')

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
        .contextual--title {
            margin-left: 20px;
        }
        .react_nav_tab>* {
            background-color: #e3f0f3;
            border-bottom: 2px solid #0081b9;
        }
        .react_nav_tab>.selected {
            border: 2px solid #0081b9;
            border-bottom: 0;
        }
        .react_nav_tab>*>a {
            font-size: 14px;
        }
        .tb_list th {
            font-size: 14px;
        }
        .tb_list td {
            font-size: 13px;
        }
        .table-primary tr th {
            background-color: #e3f0f3;
        }
        .table-primary,
        .table-primary tr th,
        .table-primary tr td {
            border: solid 1px #89c1ce;
        }
    </style>


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
        </style>
        @include('angel.guide.aside', ['group'=>'new_guide', 'part'=>''])
        <div class="pagecontainer">
            <a name="top"></a>

            <div class="contextual--title no-border"> 초보자 가이드 </div>
            <div class="g_gray_border"></div>


            <div class="react_nav_tab">
                <div class=""><a href="{{route('guide_howto')}}">거래방법 보기</a></div>

                <div class="selected"><a href="{{route('guide_safe')}}">안전 거래 시스템</a></div>
                <div class=""><a href="{{route('guide_trade')}}">거래시 주의사항</a></div>
                <div class=""><a href="{{route('guide_failed')}}">거래 사기 실시간 조회</a></div>
            </div>
            <div class="empty-high"></div>

            <div class="top_menu"> <a href="?file=01"><span class="g_black2 ">거래보호 장치</span></a> | <a href="?file=02"><span class="g_black2 f_blue3 font-weight-bold">결제인증</span></a> | <a href="?file=03"><span class="g_black2 ">본인인증</span></a> | <a href="?file=04"><span class="g_black2 ">신용등급 표시제</span></a> | <a href="?file=05"><span class="g_black2 ">개인정보보호</span></a> | <a href="?file=06"><span class="g_black2 ">보안시스템</span></a> </div>
            <div class="empty-high"></div>
            <div class="highlight_contextual">결제인증</div>
            <div class="gray_box">
                <div class="inner_box">
                    <div class="font-weight-bold">▶결제인증이란?</div>
                    <div class="">고객님의 마일리지를 안전하게 보호하기 위해 아이템/상품권 구매결제 시 결제인증 단계를 거쳐 마일리지를 사용하는 시스템입니다.</div>
                </div>
                <div class="divi_line"></div>
                <div class="inner_box">
                    <div class="font-weight-bold">▶결제인증 수단</div>
                    <ul class="g_list">
                        <li><span class="font-weight-bold">휴대폰 인증</span> : 가입자 본인 명의 또는 회원정보의 휴대폰으로 인증이 가능합니다.</li>
                        <li><span class="font-weight-bold">공인인증서 인증</span> :가입자 본인 명의의 범용인증서만 인증이 가능합니다.</li>
                        <li><span class="font-weight-bold">전화 인증</span> : 등록되어있는 휴대폰 및 자택 연락처를 통한 인증이 가능합니다.</li>
                    </ul>
                </div>
                <div class="divi_line"></div>
                <div class="inner_box"> - 결제보안센터 서비스를 이용하시는 회원님은 아이템/상품권 구매 시 결제인증 절차를 거치지 않고, 마일리지 사용이 가능합니다.
                    <br> &nbsp;&nbsp;(결제보안센터 설정은 홈페이지 &gt; 마이룸 &gt; 보안센터에서 설정하시면 됩니다.) </div>
            </div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
