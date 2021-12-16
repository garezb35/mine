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

            <div class="contextual--title no-border"> 초보자 가이드 </div>
            <div class="g_gray_border"></div>


            <div class="react_nav_tab">
                <div class=""><a href="{{route('guide_howto')}}">거래방법 보기</a></div>

                <div class="selected"><a href="{{route('guide_safe')}}">안전 거래 시스템</a></div>
                <div class=""><a href="{{route('guide_trade')}}">거래시 주의사항</a></div>
                <div class=""><a href="{{route('guide_failed')}}">거래 사기 실시간 조회</a></div>
            </div>
            <div class="empty-high"></div>

            <div class="top_menu">
                <a href="?file=01"><span class="g_black2 ">거래보호 장치</span></a> |
                <a href="?file=02"><span class="g_black2 ">결제인증</span></a> |
                <a href="?file=03"><span class="g_black2 ">본인인증</span></a> |
                <a href="?file=04"><span class="g_black2 ">신용등급 표시제</span></a> |
                <a href="?file=05"><span class="g_black2 ">개인정보보호</span></a> |
                <a href="?file=06"><span class="g_black2 f_blue3 font-weight-bold">보안시스템</span></a>
            </div>
            <div class="empty-high"></div>
            <div class="highlight_contextual">보안시스템</div>
            <div class="gray_box">
                <div class="inner_box">
                    <div class="font-weight-bold">아이템천사 보안시스템</div><br>
                    <div class="font-weight-bold">1. ISMS 인증을 통해 지속적인 정보보호 관리체계 적합성 유지</div>
                    기업의 주요 정보자산의 안전성 확보를 위한 기술적, 물리적, 관리적 조치가 안전하게 관리되고 있는지 국가로부터 인증받아 정보보호 시스템의 안전성 유지<br><br>
                    <div class="font-weight-bold">2. 침입 탐지 및 차단 시스템을 통한 실시간 공격 행위에 대한 차단</div>
                    해킹에 사용되는 널리 알려진 공격 행위 및 제로데이 공격에 대한 차단 시스템 구축<br><br>
                    <div class="font-weight-bold">3. 개인 정보 유출 차단 시스템을 통한 개인정보 보호</div>
                    중요 개인 정보의 내, 외부 유출을 차단하기 위한 유출 차단 시스템 구축<br><br>
                    <div class="font-weight-bold">4. DDoS 차단 시스템 사용을 통한 서비스 장애 예방</div>
                    DDoS로 인한 서비스의 중단을 예방하기 위해, 서비스 지속성을 위한 DDoS 차단 시스템 사용<br><br>
                    <div class="font-weight-bold">5. Blacklist 차단을 통한 Attacker의 행위 사전 차단</div>
                    해킹 공격이 발생되는 IP를 미리 인지하여 해당 IP를 차단함으로써 안전성 유지<br><br>
                    <div class="font-weight-bold">6. 정기적인 시스템 취약점 점검을 통한 시스템 점검</div>
                    시스템의 정기적인 취약점 점검을 통해 지속적인 보안 강화 및 안전성 유지<br><br>
                    <div class="font-weight-bold">7. Firewall 및 VPN을 통한 서비스 레벨별 접근 차단</div>
                    중요 시스템에 대해 인지된 접근만을 허용, 그 외의 접근은 차단하여 안전성 유지<br><br>
                    <div class="font-weight-bold">8. Anti Virus를 통한 알려진 공격에 대한 차단 시스템 구축</div>
                    실시간 및 정기검사를 통해 시스템의 내, 외부 보안 강화<br><br>
                </div>
                <div class="divi_line"></div>
                <div class="inner_box">
                    그럼에도 불구하고 타 사이트와 같은 아이디, 비밀번호를 사용하시거나 고객님 개인의 PC에 설치된 해킹툴 및 키로그 프로그램에 의해 유출되는<br>
                    정보까지 보호해 드릴 수는 없습니다.
                </div>
            </div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
