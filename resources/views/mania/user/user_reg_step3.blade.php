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
            padding-bottom: 60px;
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
        #emailCheckBtn {
            padding: 4px 10px;
            font-size: 12px;
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
            <div class="div-each w-100 active">
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
            <div class="div-each w-100">
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

        <form id="certifyForm" method="post">
            <input type="hidden" name="certify_info" value="YToyOntzOjk6ImZvcm1fbmFtZSI7czo3OiJmcm1JbmZvIjtzOjEwOiJzdWJtaXRfdXJsIjtzOjU1OiJodHRwczovL3d3dy5pdGVtbWFuaWEuY29tL3BvcnRhbC91c2VyL2pvaW5fZm9ybV9vay5odG1sIjt9">
            <input type="hidden" name="user_name" value="윤경한">
            <input type="hidden" name="user_birth" value="19770828">
            <input type="hidden" name="user_gender" value="1">
            <input type="hidden" name="user_nation" value="1">
            <input type="hidden" name="user_mobile_type">
            <input type="hidden" name="user_mobileA">
            <input type="hidden" name="user_mobileB">
            <input type="hidden" name="user_mobileC">
        </form>
        <form id="frmInfo" action="{{route('user_reg_step4')}}" method="post">
            @csrf
            <input type="hidden" name="join_type" value="">
            <input type="hidden" id="user_agreement" name="user_agreement" value="11">
            <input type="hidden" name="user_name" value="{{$userName}}">
            <input type="hidden" name="user_id_check" value="N">
            <input type="hidden" name="captcha_check" id="captcha_check" value="">
            <input type="hidden" name="user_email_check" id="user_email_check">
            <input type="hidden" name="ipin_no" value="">
            <input type="hidden" name="di" value="MC0GCCqGSIb3DQIJAyEAJNDBWPSxYXLvzYjvD+LFcDqvvA0hCOYuJ5Mlikc2jdQ=">
            <input type="hidden" name="ci" value="d0UQCMoMEDxsC9nyKfU456OSptEFI+XA/YRyaYNAx1WsmQx8K132BtjZpc8BW4s4n6GhkayLfuSjaDFuIoKd5A==">
            <input type="hidden" name="ci_v" value="3">
            <input type="hidden" name="birth" value="{{$userBirth}}">
            <input type="hidden" name="user_type" value="{{$userType}}">
            <input type="hidden" name="sex" value="1">
            <input type="hidden" name="fgn" value="1">
            <input type="hidden" name="protector_agreement" value="">
            <input type="hidden" name="protector_certify_type" value="">
            <input type="hidden" name="foreign_agree" value="">
            <input type="hidden" name="user_service_use_agree" value="1">
            <input type="hidden" name="user_auth_agree" value="d28374de639f17297d21d0c463aa8e62">
            <table id="tbl_user_profile">
                <colgroup>
                    <col width="206">
                    <col>
                </colgroup>
                <tbody><tr>
                    <th>이름</th>
                    <td>{{$userName}}</td>
                </tr>
                <tr>
                    <th>아이디</th>
                    <td>
                        <div class="guide_add2">
                            <input type="text" name="user_id" class="g_text" id="user_id" maxlength="12" required>
{{--                            <span class="id_check" id="idCheck">아이디를 입력하세요.</span>--}}
                        </div>
{{--                        <div class="g_hidden captcha" id="captcha_area" style="display: none !important;">--}}
{{--                            <input type="hidden" name="captcha_data" id="captcha_data" value="e19e49a513a7b4e6f29d4725d261ee12213a765edb773f645524d2cfe0be0922073ff0f59639f89c2911ee2e264e6b474a8f0c62d3c03ec22ed71e857e848514">--}}
{{--                            <ul class="g_left">--}}
{{--                                <li>--}}
{{--                                    <span class="f_black3">* 아래 보이는 숫자를 공백 없이 입력해주세요.</span>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <img id="captcha_image" src="/images/captcha/captcha_images_num.php?t=1637922685" width="200">--}}
{{--                                    <span class="reset" onclick="captchaResets()">새로고침</span>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <input type="text" id="captcha_text" name="captcha_text" class="g_text">--}}
{{--                                    <input type="button" value="중복확인" id="idCheckBtn" class="btn_blue3">--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </td>
                </tr>
                <tr>
                    <th>닉네임</th>
                    <td>
                        <div class="guide_add">
                            <input type="text" name="user_nickname" class="g_text" id="user_nickname" maxlength="16" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>비밀번호</th>
                    <td>
                        <div class="guide_add">
                            <input type="password" name="user_password" class="g_password" id="user_password" maxlength="16" required>
                            <div class="password_help" id="password_help"></div>
                        </div>
                        <div class="muser_password" id="muser_password"></div>
                    </td>
                </tr>
                <tr>
                    <th>비밀번호 확인</th>
                    <td>
                        <div class="guide_add">
                            <input type="password" name="user_password_validate" class="g_password" id="user_password_validate" maxlength="16" required>
                            <div class="password_help" id="password_help2"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>연락처(휴대폰)</th>
                    <td class="mobile_area">
                        <select id="slctMobile_type" name="user_mobile_type">
                            <option @if ($phoneType == 1) selected @endif value="1">SKT</option>
                            <option @if ($phoneType == 2) selected @endif value="2">KT</option>
                            <option @if ($phoneType == 3) selected @endif value="3">LG U+</option>
                            <option @if ($phoneType == 4) selected @endif value="4">SKT-A</option>
                            <option @if ($phoneType == 5) selected @endif value="5">KT-A</option>
                            <option @if ($phoneType == 6) selected @endif value="6">LG-A</option>
                            <option value="N">휴대폰없음</option>
                        </select>
                        <select name="user_mobileA" id="user_mobileA">
                            <option @if ($phoneNum1 == '010') selected @endif value="010">010</option>
                            <option @if ($phoneNum1 == '011') selected @endif value="011">011</option>
                            <option @if ($phoneNum1 == '016') selected @endif value="016">016</option>
                            <option @if ($phoneNum1 == '017') selected @endif value="017">017</option>
                            <option @if ($phoneNum1 == '018') selected @endif value="018">018</option>
                            <option @if ($phoneNum1 == '019') selected @endif value="019">019</option>
                        </select>
                        -
                        <input type="text" name="user_mobileB" id="user_mobileB" maxlength="4" class="g_text" value="{{$phoneNum2}}" readonly="">
                        -
                        <input type="text" name="user_mobileC" id="user_mobileC" maxlength="4" class="g_text" value="{{$phoneNum3}}" readonly="">
                        <span class="f_black3">※ SMS 수신거부는 가입 후 마이룸에서 가능합니다.</span>
                    </td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td class="email_area">
                        <input type="text" name="user_email" maxlength="30" class="g_text" required> @
                        <input type="text" name="user_email_direct" value="" maxlength="30" class="g_text">
                        <select id="slctEmail_host" name="user_email_host">
                            <option value="direct">직접입력</option>
                            <option value="naver.com">naver.com</option>
                            <option value="daum.net">daum.net</option>
                            <option value="hotmail.com">hotmail.com</option>
                            <option value="nate.com">nate.com</option>
                            <option value="yahoo.co.kr">yahoo.co.kr</option>
                            <option value="paran.com">paran.com</option>
                            <option value="empas.com">empas.com</option>
                            <option value="dreamwiz.com">dreamwiz.com</option>
                            <option value="freechal.com">freechal.com</option>
                            <option value="lycos.co.kr">lycos.co.kr</option>
                            <option value="korea.com">korea.com</option>
                            <option value="gmail.com">gmail.com</option>
                            <option value="hanmir.com">hanmir.com</option>
                        </select>
                        <input type="button" value="중복확인" id="emailCheckBtn" class="btn_blue3">
                    </td>
                </tr>

                </tbody></table>

            <div class="g_btn">
                <input type="submit" value="회원가입" class="btn_blue3 big_btn">
            </div>
        </form>

        <div class="g_finish"></div>
    </div>
@endsection
