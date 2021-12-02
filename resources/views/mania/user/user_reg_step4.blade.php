@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/_banner.css?v=210107101945">
@endsection

@section('foot_attach')
@endsection

@section('content')
    <style>
        .g_container {
            padding-top: 30px;
        }
        .g_title_txt {
            font-size: 36px;
            font-weight: bold;
        }
        .g_title_txt span {
            color: #0073DD;
        }
        .part-reg-step .div-each {
            width: 25%;
        }
        .part-reg-step {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .part-reg-step .div-each {
            background-color: #C4C4C4;
            height: 140px;
        }
        .part-reg-step .active {
            background-color: #3A79B4;
        }
        .part-reg-detail .part-text div {
            color: white;
            padding-top: 4px;
        }
        .part-reg-detail {
            padding-left: 45px;
            padding-top: 30px;
        }
        .part-reg-detail .part-text {
            padding-top: 12px;
            padding-left: 14px;
            letter-spacing: 0px;
        }
        .part-reg-detail .img-part img {
            display: inline-block;
            height: 100%;
            object-fit: contain;
        }
        #tbl_user_profile tr th {
            height: 46px;
        }
        .reg-complete-txt {
            color: #646464;
            border-bottom: solid 1px;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        .reg-complete-content {
            padding: 50px 0;
        }
        .color-gray-normal {
            color: gray;
        }
        #btn-login-page {
            background: #036DCE;
            padding: 10px 20px;
            border-radius: 4px;
        }
    </style>

    <div class="g_container" id="g_CONTENT">
        <div class="g_remocon_l">
        </div>
        <div class="g_title_txt">
            <span>회원가입</span> 서비스
        </div>
        <div class="d-flex w-100 part-reg-step">
            <div class="div-each w-100 ">
                <div class="d-flex part-reg-detail">
                    <div class="img-part">
                        <img src="/mania/img/icons/reg_step1.png" height="77" width="77" />
                    </div>
                    <div class="part-text">
                        <div class="f-15">STEP 01</div>
                        <div class="f-16">회원유형선택</div>
                    </div>
                </div>
            </div>
            <div class="div-each w-100">
                <div class="d-flex part-reg-detail">
                    <div class="img-part">
                        <img src="/mania/img/icons/reg_step2.png" height="63" width="74" styl />
                    </div>
                    <div class="part-text">
                        <div class="f-15">STEP 02</div>
                        <div class="f-16">약관동의</div>
                    </div>
                </div>
            </div>
            <div class="div-each w-100 ">
                <div class="d-flex part-reg-detail">
                    <div class="img-part">
                        <img src="/mania/img/icons/reg_step3.png" height="63" width="66" />
                    </div>
                    <div class="part-text">
                        <div class="f-15">STEP 03</div>
                        <div class="f-16">정보입력</div>
                    </div>
                </div>
            </div>
            <div class="div-each w-100 active">
                <div class="d-flex part-reg-detail">
                    <div class="img-part">
                        <img src="/mania/img/icons/reg_step4.png" height="70" width="85" />
                    </div>
                    <div class="part-text">
                        <div class="f-15">STEP 04</div>
                        <div class="f-16">회원가입완료</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="f-16 reg-complete-txt" >회원가입이 완료되였습니다.</div>
        <div class="reg-complete-content align-center">
            <img src="/mania/img/icons/reg_complete.png" width="122" height="122" />
            <div class="f-30 align-center color-gray-normal" style="padding: 20px 0 10px;">taxify <b class="c-black">회원가입이 완료</b>되였습니다.</div>
            <div class="f-15 align-center color-gray-normal" style="padding: 10px 0; margin-bottom: 26px;">회원님은 taxify의 모든 기능을 사용하실수 있습니다. 회원접속 후 사용가능합니다.</div>
            <a href="{{route('login')}}" class="c-white f-14" id="btn-login-page">로그인페이지로 이동</a>
        </div>
        <div style="height: 20px;"></div>
        <div style="height: 1px; border-bottom: solid 1px #646464;"></div>
        <div style="height: 70px;"></div>
        <div class="g_finish"></div>
    </div>
@endsection
