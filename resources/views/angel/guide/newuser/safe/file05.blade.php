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
            <div class="g_title_blue no-border"> 초보자 가이드 </div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab">
                <div class=""><a href="{{route('guide_howto')}}">거래방법 보기</a></div>
                <!--<div class=""><a href="{{route('guide_movie')}}">동영상 가이드</a></div>-->
                <div class="selected"><a href="{{route('guide_safe')}}">안전 거래 시스템</a></div>
                <div class=""><a href="{{route('guide_trade')}}">거래시 주의사항</a></div>
                <div class=""><a href="{{route('guide_failed')}}">거래 사기 실시간 조회</a></div>
            </div>
            <div class="g_finish"></div>
            <!-- ▲ 메뉴탭 //-->
            <div class="top_menu"> <a href="?file=01"><span class="g_black2 ">거래보호 장치</span></a> | <a href="?file=02"><span class="g_black2 ">결제인증</span></a> | <a href="?file=03"><span class="g_black2 ">본인인증</span></a> | <a href="?file=04"><span class="g_black2 ">신용등급 표시제</span></a> | <a href="?file=05"><span class="g_black2 f_blue3 f_bold">개인정보보호</span></a> | <a href="?file=06"><span class="g_black2 ">보안시스템</span></a> </div>
            <div class="g_finish"></div>
            <div class="g_subtitle_blue">개인정보보호</div>
            <div class="gray_box">
                <div class="inner_box">
                    <div class="f_bold">▶개인정보보호 책임이란?</div>
                    <div class="small_box"> 고객 님의 정보가 외부로 누출되어 고객님이 보유하고 있는 사이버 자산에 피해가 발생했을 경우 이를 실질적으로 보상해 드립니다. 보험은 아이템천사에서 가입하여 관리하며 고객님의 정보 누출에 따른 피해만큼 보상 받으실 수 있습니다. </div>
                </div>
                <div class="divi_line"></div>
                <div class="inner_box">
                    <div class="f_bold">▶보험 세부 내용</div>
                    <ul class="g_list">
                        <li>보험한도액 : 30억원 (최대 30억원 보상)</li>
                        <li>보험사 : AIG</li>
                        <li>보험가입일 : 2015년 04월 26일</li>
                    </ul>
                </div>
                <div class="divi_line"></div>
                <div class="inner_box">
                    <div class="f_bold">▶고객보호 및 거래안전을 위한 노력</div>
                    <ul class="g_list">
                        <li>당사는 게이머 여러분들이 선정한 안전한 거래사이트 1위입니다.</li>
                        <li>고객님의 정보 및 자산을 소중히 생각하는 저희들의 노력이 이제는 물질적인 보상까지도 책임지겠습니다.</li>
                        <li>앞으로도 고객님께서 안전하게 거래를 할 수 있도록 최선을 다하겠습니다.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
