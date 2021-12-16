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
.
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

            <div class="contextual--title">거래취소/신고</div>
            <div class="g_gray_border"></div>


            <div class="react_nav_tab">
                <div class=""><a href="{{route('guide_cancel_cancel')}}">거래취소</a></div>
                {{--                <div><a href="trade_acc.html">거래문제 발생</a></div>--}}
                <div class="selected"><a href="{{route('guide_cancel_bad')}}">비거래 물품 신고</a></div>
            </div>
            <div class="empty-high"></div>

            <div class="highlight_contextual">비거래 물품 신고</div>
            <span class="g_blue1">등록된 물품 중에 연락처 기재나 직거래 유도글, 사기글 기재 시  비거래 물품 신고하시면 관리자가 확인 후  처리해 드립니다.</span>
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">하나. </span>고객센터 &gt; 1:1상담하기 &gt;&nbsp;[비거래물품 신고하기]&nbsp;를 클릭합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_bad_01.png" width="820" height="" alt="">
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">둘. </span>신고할 내용을 자세히 적으신 후
                <span class="font-weight-bold">[신고하기] </span>버튼을 클릭하면 비거래물품 신고가 완료 됩니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_bad_02.png" width="820" height="" alt="">
            <div class="divi_line"></div>
            <a href="#top"><img class="float__right" src="/angel/img/icons/Scroll-to-top.png" width="61" height="60"></a>
            </span>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
