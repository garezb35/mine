@extends('layouts-angel.app')

@section('head_attach')
@endsection

@section('foot_attach')
@endsection

@section('content')
    <style>
        .container_fulids {
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

    <div class="container_fulids" id="module-teaser-fullscreen">
        <div class="recommend_e34rf">
        </div>
        <div class="g_title_txt">
            <span>회원가입</span> 서비스
        </div>
        <div class="d-flex w-100 part-reg-step">
            <div class="div-each w-100 ">
                <div class="d-flex part-reg-detail">
                    <div class="img-part">
                        <img src="/angel/img/icons/reg_step1.png" height="77" width="77" />
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
                        <img src="/angel/img/icons/reg_step2.png" height="63" width="74" styl />
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
                        <img src="/angel/img/icons/reg_step3.png" height="63" width="66" />
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
                        <img src="/angel/img/icons/reg_step4.png" height="70" width="85" />
                    </div>
                    <div class="part-text">
                        <div class="f-15">STEP 04</div>
                        <div class="f-16">회원가입완료</div>
                    </div>
                </div>
            </div>
        </div>

        <form id="certifyForm" method="post">
            <input type="hidden" name="user_name" value="">
            <input type="hidden" name="user_birth" value="">
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
            <input type="hidden" name="ci_v" value="3">
            <input type="hidden" name="birth" value="{{$userBirth}}">
            <input type="hidden" name="user_type" value="{{$userType}}">
            <input type="hidden" name="sex" value="1">
            <input type="hidden" name="fgn" value="1">
            <input type="hidden" name="protector_agreement" value="">
            <input type="hidden" name="protector_certify_type" value="">
            <input type="hidden" name="foreign_agree" value="">
            <input type="hidden" name="user_service_use_agree" value="1">
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
                            <input type="text" name="user_id" class="angel__text" id="user_id" maxlength="12" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>닉네임</th>
                    <td>
                        <div class="guide_add">
                            <input type="text" name="user_nickname" class="angel__text" id="user_nickname" maxlength="16" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>비밀번호</th>
                    <td>
                        <div class="guide_add">
                            <input type="password" name="user_password" class="credient_input" id="user_password" maxlength="16" required>
                            <div class="password_help" id="password_help"></div>
                        </div>
                        <div class="muser_password" id="muser_password"></div>
                    </td>
                </tr>
                <tr>
                    <th>비밀번호 확인</th>
                    <td>
                        <div class="guide_add">
                            <input type="password" name="user_password_validate" class="credient_input" id="user_password_validate" maxlength="16" required>
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
                        <input type="text" name="user_mobileB" id="user_mobileB" maxlength="4" class="angel__text" value="{{$phoneNum2}}" readonly="">
                        -
                        <input type="text" name="user_mobileC" id="user_mobileC" maxlength="4" class="angel__text" value="{{$phoneNum3}}" readonly="">
                        <span class="text-customgray">※ SMS 수신거부는 가입 후 마이룸에서 가능합니다.</span>
                    </td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td class="email_area">
                        <input type="text" name="user_email" maxlength="30" class="angel__text" required> @
                        <input type="text" name="user_email_direct" value="" maxlength="30" class="angel__text">
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

            <div class="btn-groups_angel">
                <input type="submit" value="회원가입" class="btn_blue3 big_btn">
            </div>
        </form>

        <div class="empty-high"></div>
    </div>
@endsection
