@extends('layouts-angel.app')

@section('head_attach')
    <link type='text/css' rel='stylesheet' href='/angel/guide/css/common.css'>
    <link type='text/css' rel='stylesheet' href='/angel/guide/frshmn_guide/css/frshmn.css'>
    <link type="text/css" rel="stylesheet" href="/angel/dev/guide_arrow.css">
@endsection

@section('foot_attach')
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

            <div class="contextual--title no-border">회원가입</div>
            <div class="g_gray_border"></div>

            <div class="g_notice_box1">아이템천사 회원가입 절차 방법입니다.</div>
            <div class="guide_subtitle"><span class="text-rock font-weight-bold">하나.</span> 홈페이지 상단에서 [회원가입]을 클릭합니다.</div>
            <img src="/angel/img/guide/screenshot/img_join_01.png" width="820" alt="회원가입">
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">둘. </span>가입 유형을 선택 해주시기 바랍니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_join_02.png" width="820" height="" alt="가입유형 선택">
            <div class="guide_subtxt">
                <span class="font-weight-bold">- 일반회원 : </span> 만 19세 이상 내국인 회원 <br>
                <span class="font-weight-bold">- 주니어회원 : </span> 만 19세 미만 내국인 회원 <br>
                <span class="font-weight-bold">- 외국인 회원 : </span> 국내에 거주하는 외국인 회원
            </div>
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">셋. </span>약관동의/실명확인
                <div class="guide_subtxt">
                    서비스 이용약관, 개인정보 취급 방침 동의는 필수사항입니다. 반드시 읽어보신 후 <span class="font-weight-bold">동의하기</span>를 선택하십시오.<br>
                    실명확인이 되지 않으실 경우 '<a href="http://www.idcheck.co.kr">NICE평가정보(www.idcheck.co.kr)</a>'를 방문하시어 실명확인을 하신 후 다시 회원가입을 해주시기 바랍니다.
                </div>
            </div>
            <img src="/angel/img/guide/screenshot/img_join_03.png" width="820" height="" alt="약관동의/실명확인">
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">넷.</span> 정보 입력
            </div>
            <img src="/angel/img/guide/screenshot/img_join_04.png" width="820" height="" alt="회원정보 입력">
            <div class="guide_subtxt">
                - 아이디는 4~12자의 영문 또는 영문+숫자로 조합되어야 합니다.<br>
                - 비밀번호는 10~16자의 영문+숫자 또는 특수문자가 조합되어야 합니다.<br>
                - 공백은 비밀번호로 사용 불가능합니다.<br>
                - 개인정보로 이루어진 비밀번호는 사용 불가능 합니다.
            </div>
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">다섯. </span>가입완료
            </div>
            <img src="/angel/img/guide/screenshot/img_join_05.png" width="820" height="" alt="추가정보 입력">
            <div class="guide_subtxt">
                - 회원가입이 완료되었습니다.<br>
                - 아이템천사에서 제공하는 다양한 서비스를 이용하실 수 있습니다.
            </div>
            <div class="divi_line"></div>
            <a href="#top"><img class="float__right" src="/angel/img/icons/Scroll-to-top.png" width="61" height="60"></a>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
