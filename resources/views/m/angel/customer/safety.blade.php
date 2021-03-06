@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/menu.css?190220" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/_report_top.css?210503" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/trade/css/trade_common.css?210901" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/customer_common.css?210901" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/_js/_screenshot.js?v=190220"></script>
    <script type="text/javascript" src="/angel/customer/trade/js/trade_common.js?211005"></script>
    <script type="text/javascript">
        function __init() {
            strThisCode = 'A101';
            fnCreateDom('ACS', '01');
        }
    </script>
@endsection

@section('content')

    <div class="container_fulids" id="module-teaser-fullscreen">
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
        @include('angel.customer.aside', ['group'=>'safety', 'part'=>''])
        <div class="pagecontainer">

            <div class="contextual--title no-border"> ???????????? </div>
            <div class="f-22 f-bold" style="margin-top: 20px; margin-bottom: 14px;">????????? ????????? ????????? ??? ???????????????!!</div>
            <img src="/angel/img/bkg/safety1.png" width="812" height="496" />
            <div style="height: 20px;"></div>
            <img src="/angel/img/bkg/safety2.png" width="812" height="579" />
            <div style="height: 60px;"></div>
        </div>
    </div>

@endsection
