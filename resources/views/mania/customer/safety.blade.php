@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211102">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/menu.css?190220" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/_report_top.css?210503" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/trade/css/trade_common.css?210901" />
    <link type="text/css" rel="stylesheet" href="/mania/customer/css/customer_common.css?210901" />
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21050316"></script>
    <script type="text/javascript" src="/mania/_js/_screenshot.js?v=190220"></script>
    <script type="text/javascript" src="/mania/customer/trade/js/trade_common.js?211005"></script>
    <script type="text/javascript">
        function __init() {
            strThisCode = 'A101';
            fnCreateDom('ACS', '01');
        }
    </script>
@endsection

@section('content')
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        <style>
            .aside .notice {
                height: 24px;
                margin-top: 20px;
                font-weight: bold;
                border-bottom: 1px solid #E1E1E1
            }

            .aside .notice img {
                margin: 5px 3px 0 0
            }

            .aside .notice_list {
                margin: 0 0 30px;
                padding-top: 10px;
                background: none;
                border: 0
            }

            .aside .notice_list li {
                margin-left: 10px;
                margin-bottom: 3px;
                color: #767676;
                font-size: 12px
            }

            .aside .img_wrap {
                box-sizing: border-box;
                width: 214px;
                margin-bottom: 10px;
                padding: 10px 0;
                text-align: center;
                border: 1px solid #E1E1E1
            }
            .g_big_box1 {
                height: 64px;
                background-color: #e3f0f3;
            }
            .btn_search {
                font-size: 12px;
                padding: 4px 15px;
                background: #4997af;
                color: white;
            }
        </style>
        @include('mania.customer.aside', ['group'=>'safety', 'part'=>''])
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue no-border"> 안전거래 </div>
            <div class="f-22 f-bold" style="margin-top: 20px; margin-bottom: 14px;">안전한 거래를 위하여 꼭 지켜주세요!!</div>
            <img src="/mania/img/bkg/safety1.png" width="812" height="496" />
            <div style="height: 20px;"></div>
            <img src="/mania/img/bkg/safety2.png" width="812" height="579" />
            <div style="height: 60px;"></div>
        </div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
