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

            <div class="contextual--title no-border">마이룸</div>
            <div class="g_gray_border"></div>

            <div class="g_notice_box1">마이룸에서는 고객님의 거래정보와 마일리지 정보, 개인정보 등을 한눈에 확인 하실 수 있습니다.</div>
            <img src="/angel/img/guide/screenshot/img_my_01.png" width="820" alt="충전">
            <div class="divi_line"></div>
            <div class="guide_subtitle">
                <span class="f_red1 font-weight-bold">하나.</span> 고객님의 신용등급, 거래점수, 마일리지, 할인쿠폰/이용권 등을 확인하실 수 있습니다.
            </div>
            <div class="guide_subtitle">
                <div class="font-weight-bold"><span class="f_red1 font-weight-bold">둘. </span>내 전체 거래현황</div>
                - 모든 거래의 진행상황을 한눈에 확인하실 수 있습니다.
            </div>
            <div class="guide_subtitle">
                <div class="font-weight-bold"><span class="f_red1 font-weight-bold">셋. </span>나의 보안 및 인증상태</div>
                - 보안상태 및 인증상태를 확인하실 수 있습니다.
            </div>
            <div class="guide_subtitle">
                <div class="font-weight-bold"><span class="f_red1 font-weight-bold">넷. </span>나만의 전용 서비스</div>
                - 나만의 서비스 메뉴설정 및 물품등록 검색 시 나만의검색메뉴를 설정하실 수 있으며 기타 개인별 환경설정이 가능합니다.
            </div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
