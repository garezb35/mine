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
            <div class="g_title_blue no-border"> 초보자 가이드 </div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab">
                <div class=""><a href="{{route('guide_howto')}}">거래방법 보기</a></div>
                <div class=""><a href="{{route('guide_movie')}}">동영상 가이드</a></div>
                <div class=""><a href="{{route('guide_safe')}}">안전 거래 시스템</a></div>
                <div class="selected"><a href="{{route('guide_trade')}}">거래시 주의사항</a></div>
                <div class=""><a href="{{route('guide_failed')}}">거래 사기 실시간 조회</a></div>
            </div>
            <div class="g_finish"></div>
            <div class="g_subtitle_blue">거래시 주의사항</div>
            <div class="gray_box gray_box2">
                <div class="f_bold">▣ 게임상에서 “채팅”은 하지마세요.</div>
                <ul class="g_list">
                    <li>판매자/구매자는 전화상으로만 물품거래를 하시고, 게임상에서 채팅은 하지마세요.</li>
                    <li>만약 해킹 및 기타 사고로 인해 게임사로부터 현금거래에 대한 채팅이 확인되면, 계정정지가 될 수도 있습니다.</li>
                    <li>전화 통화를 유지하면서 거래하시는 것이 안전합니다.</li>
                </ul>
                <div class="f_bold">▣ 구매할 물품의 정보가 맞는지 확인 후 거래신청을 하세요.</div>
                <ul class="g_list">
                    <li>등록물품과 상세내용에 안내된 물품이 다를 경우 거래를 하지 않도록 주의하세요.</li>
                    <li class="list_non">(ex. 등록물품 : '리니지/아덴‘   상세내용: ＇던전앤파이터 아이템 팝니다.')</li>
                </ul>
                <div class="f_bold">▣ SMS 문자와 메신저를 주의하세요.</div>
                <ul class="g_list">
                    <li>게임상 채팅으로 폰번호/메신저 ID를 알아낸 뒤 아이템매니아에 물품을 등록해 놓았다며, 거래를 유도한다면 거래를 하지마세요.</li>
                    <li>아이템매니아에서는 이와 같은 거래에 대해 문제가 발생할 경우 처리가 불가능 합니다.</li>
                </ul>
                <div class="f_bold">▣ 게임상에서 물품거래 하실 때 거래자의 연락처를 통하여 거래 당사자 임을 확인하세요.</div>
                <ul class="g_list">
                    <li>전화상으로 판매자의 게임상 아이디/구매자의 게임상 아이디를 확인하고, 게임 유저들이 있는 곳을 피하여 거래를 하시기 바랍니다.</li>
                    <li>상대방(판매자)가 먼저 전화를 걸어 개인사정으로  휴대폰 및  집전화 수신이 불가능 하다는 말에 현혹되지 않도록 주의하세요.</li>
                    <li>마이룸에서 확인한 거래자 연락처로 거래를 해주시기 바랍니다.</li>
                    <li>판매자 또는 구매자와 유사한 게임상의 아이디가 존재할 수 있으므로 각별한 주의 바랍니다.</li>
                    <li class="list_non">(ex. 아이템매니아 "아이템메니아")</li>
                </ul>
                <div class="f_bold">▣ 직거래 유도에 주의하세요.</div>
                <ul class="g_list">
                    <li>물품대금 및 상세설명란에 연락처/메신저 아이디를 기재하여 직거래를 유도할 경우 거래를 하지 않도록 주의하세요.</li>
                    <li>연락처, 메신저 아이디 등의 기재는 벌점부과 대상이 되며, 직거래에 대한 사고건은 당사에서 책임을 지지 않습니다.</li>
                </ul>
                <div class="f_bold">▣ 제 3자 사기에 주의하세요.</div>
                <ul class="g_list">
                    <li>게임상에서 거래하려는 상대방을 당사 사이트로 유도하여, 거래를 하게 됩니다.</li>
                    <li>마이룸에서 확인한 연락처로만 거래를 해주시고, 상대방 연락처 확인이 안되실 때에는 거래취소를 하시기 바랍니다.</li>
                    <li>이용방법을 숙지하시고 거래를 하시면 사기를 당하지 않습니다.</li>
                </ul>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
