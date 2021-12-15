@php
    $mobile_a = $mobile_b = $mobile_c = '';
    $home_a = $home_b = $home_c = '';
    $home_array = $number_array = array();
    if(!empty($number)){
        $number_array = explode('-',$number);
        $mobile_a = $number_array[0];
        $mobile_b = $number_array[1];
        $mobile_c = $number_array[2];
    }
    if(!empty($home)){
        $home_array = explode('-',$home);
        $home_a = $home_array[0];
        $home_b = $home_array[1];
        $home_c = $home_array[2];
    }
@endphp
<!DOCTYPE html>
<html lang="ko">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
    <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css">
    <link type="text/css" rel="stylesheet" href="/angel/_css/_table_list.css">
    <link type="text/css" rel="stylesheet" href="/angel/global_h/css/contact_edit.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script type="text/javascript" src="/assets/js/angel/webpack.js"></script>
    <script type="text/javascript" src="/assets/js/angel/_gs_control.js"></script>
    <script type="text/javascript" src="/assets/js/angel/banner_module.js"></script>

</head>

<body>
<div id="global_root" class="mainEntity d-none ">
    <div id="thirdys" class="fluid-div"></div>
</div>
<div id="angel">
    <div id="model_titlebar"><img src="https://img2.itemmania.com/images/user/titlep_hp_edit.gif" width="89" height="19" alt="연락처 수정" /></div>
    <div id="g_POPUP">
        <form id="certifyForm" action="/user/contact_edit_ok" method="post">
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{$id}}">
            <input type="hidden" name="user_name" value="{{$name}}" />
            <input type="hidden" name="user_birth" value="{{!empty($birthday) ? date("Ymd",strtotime($birthday)) : ""}}">
            <input type="hidden" name="user_gender" value="1">
            <input type="hidden" name="user_nation" value="1">
            <input type="hidden" name="user_mobile_type">
            <input type="hidden" name="user_mobileA">
            <input type="hidden" name="user_mobileB">
            <input type="hidden" name="user_mobileC"> </form>
        <form id="frmContact" action="https://trade.itemmania.com/user/contact_edit_ok method="post">
            <input type="hidden" name="check" value="true">
            <input type="hidden" name="security_service_userinfo" value="N">
            <input type="hidden" name="security_type" value="none">
            <input type="hidden" name="security_code">
            <input type="hidden" name="security_number">
            <table class="table-primary">
                <colgroup>
                    <col width="120" />
                    <col width="" />
                </colgroup>

                <tr>
                    <th>자택/직장</th>
                    <td>
                        <select id="slctContact" name="user_contactA" class="d-none" onchange="setContactMode(arguments[0])">
                            <option value="02">02</option>
                            <option value="031">031</option>
                            <option value="032">032</option>
                            <option value="033">033</option>
                            <option value="041">041</option>
                            <option value="042">042</option>
                            <option value="043">043</option>
                            <option value="044">044</option>
                            <option value="051">051</option>
                            <option value="052">052</option>
                            <option value="053">053</option>
                            <option value="054">054</option>
                            <option value="055">055</option>
                            <option value="061">061</option>
                            <option value="062">062</option>
                            <option value="063">063</option>
                            <option value="064">064</option>
                            <option value="070">070</option>
                            <option value="N" selected>연락처없음</option>
                        </select> -
                        <input type="text" name="user_contactB" id="user_contactB" maxlength="4" class="angel__text" value="{{$mobile_b}}" /> -
                        <input type="text" name="user_contactC" id="user_contactC" maxlength="4" class="angel__text" value="{{$mobile_c}}" /> </td>
                </tr>
                <tr>
                    <th>휴대폰</th>
                    <td>
                        <select id="user_mobileA" name="user_mobileA" class="d-none">
                            <option value="010">010</option>
                            <option value="011">011</option>
                            <option value="016">016</option>
                            <option value="017">017</option>
                            <option value="018">018</option>
                            <option value="019">019</option>
                        </select> -
                        <input type="text" name="user_mobileB" id="user_mobileB" maxlength="4" class="angel__text" value="{{$home_b}}" /> -
                        <input type="text" name="user_mobileC" id="user_mobileC" maxlength="4" class="angel__text" value="{{$home_c}}" /> </td>
                </tr>
            </table> <span class="g_red1">※</span> <span class="g_red1_11">013으로 시작되는 번호는 연락처 등록이 불가 합니다.</span>
            <div class="btn-groups_angel">
                <a class="btn-default btn-suc"  href="javascript:void(0);">확인</a>
                <a href="#" onclick="self.close();" class="btn-default btn-cancel">취소</a>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="/assets/js/angel/modal/_form_check.js"></script>
<script type="text/javascript" src="/assets/js/angel/modal/contact_edit.js"></script>
<script type="text/javascript" src="/assets/js/angel/_window.js?v=190220"></script>
<script type="text/javascript">
    _window.resize(496, 350);
</script>
<script>
    loadGlobalItems()
</script>
</body>

</html>
