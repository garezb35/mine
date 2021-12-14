@php
$user_mobileA = $user_mobileB = $user_mobileC = "";
$splited_mobile = explode("-",$number);
$user_mobileA = !empty($splited_mobile[0]) ? $splited_mobile[0] : "";
$user_mobileB = !empty($splited_mobile[1]) ? $splited_mobile[1] : "";
$user_mobileC = !empty($splited_mobile[2]) ? $splited_mobile[2] : "";

$user_contactA = $user_contactB = $user_contactC = "";
$splited_mobile = explode("-",$home);
$user_contactA = !empty($splited_mobile[0]) ? $splited_mobile[0] : "";
$user_contactB = !empty($splited_mobile[1]) ? $splited_mobile[1] : "";
$user_contactC = !empty($splited_mobile[2]) ? $splited_mobile[2] : "";
@endphp
@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/myinfo/css/check.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/myinfo/css/myinfo_modify.css" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/myinfo/js/myinfo_modify.js"></script>
@endsection
@section('content')
    <div class="g_container" id="g_CONTENT">
        <div class="g_remocon_l">
        </div>
        @include('aside.myroom',['group'=>'person'])
        <form id="certifyForm" method="post">
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="pejjwh">
            <input type="hidden" name="user_name" value="{{$name}}">
            <input type="hidden" name="user_birth" value="{{!empty($birthday) ? date('Ymd',strtotime($birthday)) : ''}}">
            <input type="hidden" name="user_gender" value="{{$gender}}">
            <input type="hidden" name="user_mobile_type">
            <input type="hidden" name="user_mobileA">
            <input type="hidden" name="user_mobileB">
            <input type="hidden" name="user_mobileC">
        </form>
        <div class="g_content">
            <div class="g_title_blue noborder">
                개인정보 <span>수정</span>
            </div>
            {{--        <div class="g_tab">--}}
            {{--            <div class="selected">기본정보수정</div>--}}
            {{--            <div><a href="/myroom/myinfo/myinfo_passwd_modify>비밀번호수정</a></div>--}}

            {{--        </div>--}}
            <form id="frmInfo" name="frmInfo" method="post" action="/myroom/myinfo/myinfo_modify_ok">
                @csrf
                <input type="hidden" name="user_Mobile_auth" value="{{$mobile_verified ==1 ? 'Y': 'N'}}">
                <input type="hidden" name="before_user_mobileA" value="{{$user_mobileA}}">
                <input type="hidden" name="before_user_mobileB" value="{{$user_mobileB}}">
                <input type="hidden" name="before_user_mobileC" value="{{$user_mobileC}}">
                <input type="hidden" id="bTalkCheck" value="">
                <input type="hidden" id="user_emai_check" value="{{$email}}">
                <div class="g_subtitle">개인 정보</div>
                <table class="g_blue_table">
                    <colgroup>
                        <col width="140">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <th>이름</th>
                        <td>
                            {{$name}}<a href="#" onclick="_window.open('name_change', '/certify/name_change/name_change', 410, 430);">
                                <img src="https://img4.itemmania.com/images/btn/btn_change_name.gif" width="61" height="20" alt="이름변경" class="margin_15">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>아이디</th>
                        <td>
                            {{$loginId}}
                        </td>
                    </tr>
                    <tr>
                        <th rowspan="2">연락처</th>
                        <td class="cell_num">
                            <div class="s_label">휴대폰 번호</div>
                            <div class="g_selectbox mobile_type" id="slctMobile_type" style="width: 92px;">
                                <input type="hidden" name="user_mobile_type" value="1">
                                <div class="value">SKT</div>
                                <div class="arrow_img"></div>
                            </div>
                            <div class="g_selectbox" id="user_mobileA" style="width: 55px;">
                                <input type="hidden" name="user_mobileA" value="{{$user_mobileA}}">
                                <div class="value">{{$user_mobileA}}</div>
                                <div class="arrow_img"></div>
                            </div>
                            <div class="g_left margin_5">-
                                <input type="text" name="user_mobileB" id="user_mobileB" maxlength="4" class="g_text" value="{{$user_mobileB}}"> -
                                <input type="text" name="user_mobileC" id="user_mobileC" maxlength="4" class="g_text" value="{{$user_mobileC}}">
                                <img src="https://img2.itemmania.com/images/btn/btn_certifi.gif" width="57" height="20" alt="인증받기" class="g_button" id="cellphone_auth_pop">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell_num">
                            <div class="g_left g_black2_b">자택/직장</div>
                            <div class="g_left margin_5">
                                <div class="g_selectbox user_contactA" id="user_contactA" style="width: 92px;">
                                    <input type="hidden" name="user_contactA" value="Y">
                                    <div class="value">{{$user_contactA}}</div>
                                    <div class="arrow_img"></div>
                                </div>
                            </div>
                            <div class="g_left margin_5">-
                                <input type="text" name="user_contactB" id="user_contactB" maxlength="4" class="g_text" value="{{$user_contactB}}" > -
                                <input type="text" name="user_contactC" id="user_contactC" maxlength="4" class="g_text" value="{{$user_contactC}}" >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>이메일</th>
                        <td class="email_info">
                            <div class="email_block">
                                <input type="text" name="user_email" id="user_email " class="g_text" value="{{explode("@",$email)[0] ?? ""}}">  @
                                <input type="text" name="user_email2" id="user_email2" class="g_text" value="{{explode("@",$email)[1] ?? ""}}">
                                <img src="https://img2.itemmania.com/images/btn/btn_certifi.gif" width="57" height="20" alt="인증받기" class="g_button email_auth_btn" id="email_auth_btn">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>광고정보<br>수신동의</th>
                        <td class="sms_info">
                            <div>
                                <input type="checkbox" class="g_checkbox" name="sms_agree" id="sms_agree" value="Y" checked=""> <label for="sms_agree">SMS 수신동의</label>
                                <input type="checkbox" class="g_checkbox" name="email_agree" id="email_agree" value="Y" checked=""> <label for="email_agree">이메일 수신동의</label>
                                <input type="checkbox" class="g_checkbox" name="naver_smart_alarm" id="naver_smart_alarm" value="Y"> <label for="naver_smart_alarm">네이버 스마트 알림톡 서비스 수신동의</label>
                            </div>
                            <div class="g_finish"></div>
                            <div class="f_org1">
                                * 거래정보와 관련된 내용은 고객님의 거래안전을 위하여 수신동의 여부와 관계없이 SMS 발송 될 수 있습니다.<br>
                                * 광고 알림건에 대해서는 '수신거부'로 변경하여도 수정 전에 예약발송 SMS가 설정되어 있어 약 5일 동안은 SMS가 발송될 수 있습니다.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th rowspan="2">주소</th>
                        <td class="myinfo_address">
                            <input type="text" name="user_zipcode" id="user_zipcode" class="g_text" readonly="" value="{{$ZIP}}">
                            <a href="javascript:" id="find_address">
                                <img src="https://img4.itemmania.com/images/btn/btn_post_no.gif" width="80" height="20" alt="우편번호 찾기">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="myinfo_address_detail">
                            <input type="text" name="user_addressA" id="user_addressA" class="g_text" readonly="" value="{{$address}}">
                        </td>
                    </tr>
                    <tr>
                        <th>은행명</th>
                        <td>{{$bank_information['accAlias'] ?? ""}}</td>
                    </tr>
                    <tr>
                        <th>계좌번호</th>
                        <td>{{$bank_information['accNumber'] ?? ""}}</td>
                    </tr>
                    <tr>
                        <th>예금주</th>
                        <td>{{$bank_information['accName'] ?? ""}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="tb_bt_txt">※ <span class="f_small">고객님의 소중한 개인정보가 노출되지 않도록 모든 작업을 마치셨다면 반드시 다른 페이지로 이동하여 주시기 바랍니다.</span></div>
                <div class="g_btn">
                    <input type="submit" value="정보 수정하기" class="btn-default btn-suc">
                    <a href="/myroom/myinfo/myinfo_check" class="btn-default btn-cancel">취소 하기</a>
                </div>
            </form>

        </div>
        <div class="g_finish"></div>
    </div>

@endsection
