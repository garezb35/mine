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

    <style>

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

            <div class="contextual--title no-border"> ????????? ????????? </div>
            <div class="g_gray_border"></div>


            <div class="react_nav_tab">
                <div class="selected"><a href="{{route('guide_howto')}}">???????????? ??????</a></div>

                <div class=""><a href="{{route('guide_safe')}}">?????? ?????? ?????????</a></div>
                <div class=""><a href="{{route('guide_trade')}}">????????? ????????????</a></div>
                <div class=""><a href="{{route('guide_failed')}}">?????? ?????? ????????? ??????</a></div>
            </div>
            <div class="empty-high"></div>

            <div class="top_menu">
                <a href="{{route('guide_howto')}}"><span class="f_blue3 font-weight-bold">????????? ?????????</span></a> |
                <a href="{{route('guide_howto2')}}"><span class="g_black2">????????? ?????????</span></a>
            </div>
            <div class="empty-high"></div>
            <ul id="guide_sell">
                <li>
                    <a href="{{route('guide_howto')}}" class="blue_arrow_right">
                        <div>?????????<br>?????? ??????</div>
                    </a>
                    <a href="?file=02" class="green_arrow_right2">
                        <div>????????? ??????<br>?????? ??? ????????????</div>
                    </a>
                </li>
                <li>
                    <a href="?file=03" class="blue_arrow1">
                        <div style="padding-right: 0;">????????????<br>????????????</div>
                    </a>
                </li>
                <li>
                    <a href="?file=04" class="blue_arrow2">
                        <div style="padding-right: 0;">?????????<br>????????????</div>
                    </a>
                </li>
                <li>
                    <a href="?file=05" class="blue_arrow3">
                        <div style="padding-right: 0;">???????????? ???<br>????????????</div>
                    </a>
                </li>
                <li>
                    <a href="?file=06" class="blue_arrow4">
                        <div style="padding-right: 0; padding-left: 30px;">????????????<br>????????????</div>
                    </a>
                </li>
            </ul>
            <div class="empty-high"></div>
            <div class="highlight_contextual">????????? ???????????? ??? ????????????</div>
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">??????. </span>?????? ??????????????? ??????/???????????? ???????????????.
            </div>
            <img src="/angel/img/guide/screenshot/img_search_01.png" width="820" height="448" alt="">
            <div class="empty-high"></div>
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">???. </span>????????? ?????? ???????????? ??????????????? ?????? ?????? ???????????? ??? ?????? ????????? ????????? ????????? ???????????????.
            </div>
            <img src="/angel/img/guide/screenshot/img_search_02.png" width="820" height="638" alt="">
            <div class="empty-high"></div>
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">???. </span>??????????????? ??????????????? ?????? ?????? ??? [????????????] ????????? ???????????????.
                <br>??????????????? ????????? ??????????????? ????????? ??????????????? ????????? ????????? ??????????????????.
            </div>
            <img src="/angel/img/guide/screenshot/img_search_03.png" width="820" height="763" alt="">
            <div class="empty-high"></div>
            <div class="divi_line"></div>
            <a href="#top">
                <img class="float__right" src="/angel/img/icons/Scroll-to-top.png" width="61" height="60">
            </a>
            <div class="empty-high"></div>
            <div class="btn-groups_angel">
                <a class="btn-arrow-right" href="{{route('guide_howto')}}?file=03" style="padding: 14px 50px; background: #07819C; color: white; font-size: 16px;">???????????? ????????????</a>
            </div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
