@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211109">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type='text/css' rel='stylesheet' href='/mania/guide/css/common.css'>
    <link type='text/css' rel='stylesheet' href='/mania/guide/frshmn_guide/css/frshmn.css'>
    <link type="text/css" rel="stylesheet" href="/mania/dev/guide_arrow.css">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21110910"></script>
    <script type='text/javascript' src='/mania/guide/frshmn_guide/js/common.js'></script>
    <script type='text/javascript'>
        var gsVersion = '2111181739';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')
    <style>
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
        @include('mania.guide.aside', ['group'=>'new_guide', 'part'=>''])
        <div class="g_content">
            <a name="top"></a>
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue">거래취소/신고</div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab">
                <div class="selected"><a href="{{route('guide_cancel_cancel')}}">거래취소</a></div>
{{--                <div><a href="trade_acc.html">거래문제 발생</a></div>--}}
                <div class="last"><a href="{{route('guide_cancel_bad')}}">비거래 물품 신고</a></div>
            </div>
            <div class="g_finish"></div>
            <!-- ▲ 메뉴탭 //-->
            <div class="g_notice_box1">
                거래 진행중인 물품 중 직접 취소가 되지 않는 물품은 관리자에게 접수하셔야 취소가 가능합니다.<br>
                구매자의 입금을 기다리는 물품은 판매자가 취소할 수 없습니다. 입금된 물품은 구매자가 임의로 취소할 수 없습니다.
            </div>
            <div class="g_subtitle_blue">구매자의 구매중인 물품 거래취소</div>
            구매취소는 마이룸&gt;구매관련&gt;구매중인 물품의 [거래취소] 버튼이나, 고객센터 &gt; 1:1 상담하기 &gt; 거래취소요청으로 가능합니다.
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">하나. </span>고객센터&gt;1:1상담하기&gt; 거래취소/종료요청에서&nbsp;‘취소요청’ 선택하신 후 구매중인 물품에서 취소할 물품의 [접수]&nbsp;버튼을 클릭 합니다.
            </div>
            <img src="/mania/img/guide/screenshot/img_cancel2_01.png" width="820" height="" alt="">
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">둘. </span><span class="f_bold">상담서 작성하기</span>
                <div class="guide_subtxt">거래취소 물품의 상담정보를 입력 하신 후 <span class="f_bold">[확인] </span>버튼을 누르시면 취소접수가 완료됩니다.</div>
            </div>
            <img src="/mania/img/guide/screenshot/img_cancel2_02.png" width="820" height="" alt="">
            <div class="guide_subtxt">* 거래취소는 상대 거래자의 동의를 얻기 위한  시간이 소요됩니다.</div>
            <div class="g_subtitle_blue">판매자의 판매중인 물품 거래취소</div>
            판매자의 거래취소는 마이룸 &gt; 판매관련 &gt; 판매중인 물품의 [거래취소] 버튼이나, 고객센터 &gt; 1:1 상담하기 &gt; 거래취소 요청을 통해 거래취소를
            할 수 있습니다. (판매자의 거래취소는 신청 즉시 거래가 취소됩니다.)
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">하나. </span>고객센터 &gt; 1:1상담하기 &gt; [거래취소/종료] 에서&nbsp;‘취소요청’ 선택 후  판매중인 물품에서 취소하실 물품의&nbsp;[접수하기] 를 클릭 합니다.
            </div>
            <img src="/mania/img/guide/screenshot/img_cancel2_03.png" width="820" height="" alt="">
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">둘. </span>취소 요청 창에서 취소사유를 선택하신 후 <span class="f_bold">[취소요청] </span>버튼을 클릭하면 거래는 즉시 취소됩니다.
            </div>
{{--            <img src="/mania/img/guide/screenshot/img_cancel2_04.gif" width="820" height="420" alt="">--}}
            <div class="divi_line"></div>
            <a href="#top"><img class="g_right" src="http://img2.itemmania.com/images/btn/btn_up2.gif" width="61" height="20" alt="맨위로"></a>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
