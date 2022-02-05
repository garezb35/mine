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
@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/myinfo/css/check.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/myinfo/css/myinfo_modify.css" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/myinfo/js/myinfo_modify.js"></script>
@endsection
@section('content')
    <div class="bg-white">
        <div>
            @include("angel.myroom.header")
        </div>
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
        <div @class('ml-10')>
            @include("aside.myroom",['group'=>'person'])
            <div class="pagecontainer">
                <div @class('mb-30')>
                    @include('tab.member',['group'=>'check'])
                </div>
                <form id="frmInfo" name="frmInfo" method="post" action="/myroom/myinfo/myinfo_modify_ok">
                    @csrf
                    <input type="hidden" name="user_Mobile_auth" value="{{$mobile_verified ==1 ? 'Y': 'N'}}">
                    <input type="hidden" name="before_user_mobileA" value="{{$user_mobileA}}">
                    <input type="hidden" name="before_user_mobileB" value="{{$user_mobileB}}">
                    <input type="hidden" name="before_user_mobileC" value="{{$user_mobileC}}">
                    <input type="hidden" id="bTalkCheck" value="">
                    <input type="hidden" id="user_emai_check" value="{{$email}}">
                    <table class="table-primary th30">
                        <colgroup>
                            <col width="140">
                            <col>
                        </colgroup>
                        <tbody>
                        <tr>
                            <th>이름</th>
                            <td>
                                {{$name}}<a href="#" onclick="_window.open('name_change', '/certify/name_change/name_change', 410, 430);">
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
                                <div class="g_selectbox mobile_type" id="slctMobile_type" >
                                    <input type="hidden" name="user_mobile_type" value="1">
                                    <div class="value">SKT</div>
                                    <div class="arrow_img"></div>
                                </div>
                                <div class="g_selectbox" id="user_mobileA">
                                    <input type="hidden" name="user_mobileA" value="{{$user_mobileA}}">
                                    <div class="value">{{$user_mobileA}}</div>
                                    <div class="arrow_img"></div>
                                </div>
                                <div class="float-left margin_5">
                                    <input type="text" name="user_mobileB" id="user_mobileB" maxlength="4" class="angel__text" value="{{$user_mobileB}}">
                                    <input type="text" name="user_mobileC" id="user_mobileC" maxlength="4" class="angel__text" value="{{$user_mobileC}}">
                                    <a href="javascript:;"  id="cellphone_auth_pop" class="text-pa">인증받기</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="cell_num">
                                <div class="float-left g_black2_b">자택/직장</div>
                                <div class="float-left margin_5">
                                    <div class="g_selectbox user_contactA" id="user_contactA">
                                        <input type="hidden" name="user_contactA" value="Y">
                                        <div class="value">{{$user_contactA}}</div>
                                        <div class="arrow_img"></div>
                                    </div>
                                </div>
                                <div class="float-left margin_5">
                                    <input type="text" name="user_contactB" id="user_contactB" maxlength="4" class="angel__text" value="{{$user_contactB}}" >
                                    <input type="text" name="user_contactC" id="user_contactC" maxlength="4" class="angel__text" value="{{$user_contactC}}" >
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>이메일</th>
                            <td class="email_info">
                                <div class="email_block">
                                    <input type="text" name="user_email" id="user_email " class="angel__text" value="{{explode("@",$email)[0] ?? ""}}">  @
                                    <input type="text" name="user_email2" id="user_email2" class="angel__text" value="{{explode("@",$email)[1] ?? ""}}">
                                    <a href="javascript:;" class="text-pa" id="email_auth_btn">인증받기</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>광고정보 수신동의</th>
                            <td class="sms_info">
                                <div>
                                    <input type="checkbox" class="angel_game_sel" name="sms_agree" id="sms_agree" value="Y" checked=""> <label for="sms_agree">SMS 수신동의</label>
                                    <input type="checkbox" class="angel_game_sel" name="email_agree" id="email_agree" value="Y" checked=""> <label for="email_agree">이메일 수신동의</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>은행명</th>
                            <td>
                                {{$bank_information['accAlias'] ?? ""}}&nbsp;&nbsp;
                                <a href="javascript:;" class="text-pa" id="putbank">출금계좌 수정하기</a>
                            </td>
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
                    <div class="btn-groups_angel">
                        <input type="submit" value="저장하기" class="btn-default-medium_w btn-yes">
                        <a href="/myroom/myinfo/myinfo_check" class="btn-default-medium_w btn-no">취소 하기</a>
                    </div>
                </form>

            </div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
