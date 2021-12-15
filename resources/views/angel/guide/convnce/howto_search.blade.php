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
        .trade_category li {
            float: left;
        }
        .trade_category .next_arrow {
            margin: 12px 11px;
        }
        .trade_category img {
            padding: 0;
        }

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

            <div class="contextual--title no-border">거래 편의기능</div>
            <div class="g_gray_border"></div>


            <div class="react_nav_tab">
                <div><a href="{{route('talk_box')}}">1:1 대화함</a></div>
                <div class=""><a href="{{route('hide_func')}}">숨김기능</a></div>
                <div class="last selected"><a href="{{route('howto_search')}}">검색방법</a></div>
            </div>
            <div class="empty-high"></div>

            <div class="highlight_contextual">검색방법</div>
            게임/서버를 목록에서 마우스로 선택 또는 키보드로 직접 입력하여 쉽고 편리하게 검색하실 수 있습니다.
            <div class="guide_subtitle">
                <b>■ 검색바 검색</b><br>
                상단의 검색바에서 마우스로 선택 또는 키보드로 직접 입력하여 쉽고 편리하게 검색하실 수 있습니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_con_s01.png" width="820" height="" alt="">
            <div class="guide_subtitle">
                <b>■ 전체게임서버 카테고리에서 검색</b><br>
                상단의 전체게임서버를 클릭 하여 인기,신규,추천,ㄱ~ㅎ,그외 게임을 마우스로 선택하여 쉽고 편리하게 검색하실 수 있습니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_con_s02.png" width="820" height="" alt="">
            <div class="guide_subtitle">
                <b>■ 거래물품 목록 검색</b><br>
                물품상세검색에서 물품유형, 신용등급, 거래상태 등 원하시는 항목을 선택하여 쉽고 편리하게 검색 하실 수 있습니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_con_s03.png" width="820" height="" alt="">
            <div class="empty-high"></div>
            <div class="f-13">
                1. 물품유형별 검색 : [게임머니+아이템], [게임머니], [아이템], [기타]를 클릭하여 바로 유형에 맞게 검색 가능합니다.<br>
                2. 물품 상세 검색 : 물품수량, 거래금액, 물품유형, 신용등급, 등록시간, 거래상태, 기타조건을 직접 선택하여 검색 가능합니다.
            </div>
            <div class="divi_line"></div>
            <a href="#top"><img class="float__right" src="/angel/img/icons/Scroll-to-top.png" width="61" height="60"></a>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
