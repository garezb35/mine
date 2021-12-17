@extends('layouts-angel.app')

@section('head_attach')
    <link type='text/css' rel='stylesheet' href='/angel/guide/css/common.css'>
    <link type='text/css' rel='stylesheet' href='/angel/guide/frshmn_guide/css/frshmn.css'>
    <link type="text/css" rel="stylesheet" href="/angel/dev/guide_arrow.css">
@endsection

@section('foot_attach')
    <script type='text/javascript' src='/angel/guide/frshmn_guide/js/common.js'></script>
    <script type='text/javascript'></script>
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
            <div class="contextual--title">거래취소/신고</div>
            <div class="g_gray_border"></div>
            <div class="react_nav_tab">
                <div class="selected"><a href="{{route('guide_cancel_cancel')}}">거래취소</a></div>
                <div class="last"><a href="{{route('guide_cancel_bad')}}">비거래 물품 신고</a></div>
            </div>
            <div class="empty-high"></div>
            <div class="highlight_contextual">판매자의 판매중인 물품 거래취소</div>
            판매자의 거래취소는 마이룸 &gt; 판매관련 &gt; 판매중인 물품의 [거래취소] 버튼이나, 고객센터 &gt; 1:1 상담하기 &gt; 거래취소 요청을 통해 거래취소를
            할 수 있습니다. (판매자의 거래취소는 신청 즉시 거래가 취소됩니다.)
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">하나. </span>고객센터 &gt; 1:1상담하기 &gt; [거래취소/종료] 에서&nbsp;‘취소요청’ 선택 후  판매중인 물품에서 취소하실 물품의&nbsp;[접수하기] 를 클릭 합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_cancel2_03.png" width="820" height="" alt="">
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">둘. </span>취소 요청 창에서 취소사유를 선택하신 후 <span class="font-weight-bold">[취소요청] </span>버튼을 클릭하면 거래는 즉시 취소됩니다.
            </div>
            <div class="divi_line"></div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection