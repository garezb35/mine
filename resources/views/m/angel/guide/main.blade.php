@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/guide/css/index.css?v=210810">
@endsection

@section('foot_attach')
    <script type='text/javascript'>


    </script>
@endsection

@section('content')

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
            .notice-part {
                padding: 20px;
                background: #eefafd;
                border: solid 1px #A7D1DA;
            }
            .notice-title {
                font-size: 26px;
                font-weight: bold;
                color: #E26D00;
            }
            .notice-main-menu td {
                border: none;
            }
            .notice-main-menu td a {
                border: solid 1px #A7D1DA;
                display: block;
                text-align: center;
                padding: 10px;
                font-size: 14px;
                background-color: white;
            }
            .fv_menu > a {
                height: 110px;
            }
            .fv_menu > a .title {
                font-size: 14px;
                font-weight: bold;
                padding-left: 20px;
            }
            .fv_menu > .join:hover, .fv_menu > .charge:hover, .fv_menu > .payment:hover, .fv_menu > .cancel:hover {
                background-color: #eefafd;
                color: black;
            }
            .main_service > dt {
                background: #eefafd;
            }
            .main_service > dt, .main_service > dd {
                border-bottom: 1px solid #A7D1DA;
            }
            .main_service > dd > a:hover {
                color: #195e6c;
            }
        </style>
        @include('angel.guide.aside', ['group'=>'guide', 'part'=>''])
        <div class="pagecontainer">
            <div class="g_title">????????????</div>
            <div class="notice-part d-flex">
                <div style="width: 60%;">
                    <div class="notice-title">
                        <img src="/assets/img/icons/notice.png" />
                        ???????????????????
                    </div>
                    <div style="margin-left: 56px; margin-top: 6px;">?????? ???????????? ???????????? ??????????????? ????????? ??????????????? ??????????????????.</div>
                    <div style="margin-left: 56px; margin-top: 6px;">????????? ??????????????? ????????? ?????? ????????? ?????? ???????????? ???????????????.</div>
                </div>
                <div style="width: 40%;">
                    <table class="notice-main-menu no-border">
                        <tbody>
                        <tr>
                            <td rowspan="2"><a href="{{route('guide_howto')}}" style="padding: 37px 10px;">?????? ?????? ??????</a></td>
                            <td><a href="{{route('guide_safe')}}">???????????? ?????????</a></td>
                        </tr>
                        <tr>
                            <td><a href="{{route('guide_trade')}}">?????? ????????????</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="fv_menu">
                <a href="{{route('guide_join')}}">
                    <div class="align-center" style="padding-top: 30px;">
                        <img src="/assets/img/icons/user_regist.png"><span class="title">????????????</span>
                    </div>
                </a>
                <a href="{{route('guide_charge')}}">
                    <div class="align-center" style="padding-top: 30px;">
                        <img src="/assets/img/icons/mileage.png"><span class="title">????????????</span>
                    </div>
                </a>
{{--                <a href="">--}}
{{--                    <div class="align-center" style="padding-top: 30px;">--}}
{{--                        <img src="/assets/img/icons/security.png"><span class="title">???????????????</span>--}}
{{--                    </div>--}}
{{--                </a>--}}
                <a href="{{route('guide_cancel')}}">
                    <div class="align-center" style="padding-top: 30px;">
                        <img src="/assets/img/icons/setting.png"><span class="title">????????????/??????</span>
                    </div>
                </a>
            </div>

            <div class="sms_alias f-15">??????????????? ??? ?????? ??????</div>
            <dl class="main_service"> <dt>????????????</dt>
                <dd>
                    <a href="{{route('guide_join')}}">????????????</a>
                    <a href="{{route('guide_myroom')}}">?????????</a>
                    <a href="{{route('safe_grade_point')}}">????????????/????????????</a>
                </dd>
                <dt>????????????</dt>
                <dd>
                    <a href="{{route('guide_cancel_cancel')}}">????????????/??????</a>
                    <a href="{{route('safe_char_trade')}}">????????? ??????</a>
                    <a href="{{route('bar_sell_reg')}}">????????????</a>
                </dd>
                <dt>????????????</dt>
                <dd><a href="{{route('guide_charge')}}">???????????? ??????</a>
                    <a href="{{route('guide_withdraw')}}">???????????? ??????</a>
                </dd>
                <dt>????????????</dt>
                <dd>
                    <a href="{{route('talk_box')}}">1:1 ?????????</a>
                    <a href="{{route('howto_search')}}">?????? ?????? ??????</a>
                </dd>
                <dt>????????????</dt>
                <dd>
                    <a href="{{route('security_number')}}">????????????</a>
                    <a href="{{route('security_number_plus')}}">???????????? ?????????</a>
                </dd>
            </dl>

        </div>
        <div class="empty-high"></div>
    </div>

@endsection
