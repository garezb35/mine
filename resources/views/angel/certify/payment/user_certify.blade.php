<html lang="ko">

<head>
    <title>아이템천사</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="아이템천사,아이템거래,아이템,천사,아이템천사주소,아이템천사바로가기">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <link rel="shortcut icon" href="/favicon.ico">
    <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
    <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css">
    <link type="text/css" rel="stylesheet" href="/angel/certify/payment/css/user_certify.css"> </head>

<body>
<div id="global_root" class="mainEntity d-none">
    <div id="thirdys" class="fluid-div"></div>
</div>
<div id="angel">
    <div class="myotp_id_layer_wrapper">
        <div class="inner"></div>
    </div>
    <div class="model_titlebar">인증</div>
    <div id="g_POPUP2">
        <input type="hidden" id="submit_type" value="1">

        <div class="subtitle">서비스 이용 시 인증확인이 필요합니다.
            <br>아래 인증수단을 이용하여 인증확인을 받아주시기 바랍니다.</div>
        <div class="box_wrap" id="pub_auth_a">

            <div class="box">
                <p class="title">본인 휴대폰 인증</p>
                <div class="auth_info"> <img src="/angel/img/icons/Smartphone-4-icon.png" width="60" height="54" alt="본인 휴대폰 인증">
                    <br>
                    <div class="txt">본인명의의
                        <br>휴대폰번호로 인증</div> <a href="javascript:fnCertifyCheck('hpp');" class="do-certify">인증받기</a> </div>
            </div>

        </div>
        <div class="btn-groups_angel"> <a href="javascript:;" onclick="fnWinClose()" class="btn-default-medium btn-cancel-rect">취소</a> </div>
</div>
<script type="text/javascript" src="/angel/_js/jquery.js"></script>
<script type="text/javascript" src="/angel/_js/webpack.js"></script>
<script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
<script type="text/javascript">
    setTimeout(function() {
        window.moveTo(0, 0);
        _window.resize(525, 700);
    }, 1);

    function fnOpenerSubmit() {
        fnOpenerCheck();
        opener.$('#frmSell').attr({
            target: '_parent',
            action: '/sell/application_ok',
            onsubmit: ''
        }).off('submit').submit();
        self.close();
    }

    function fnCounselView() {
        $('#tagPopup').attr({
            src: IMG_DOMAIN2 + '/images/certify/title_idcard.gif',
            alt: '신분증인증',
            width: 90,
            height: 19
        });
        $('#auth_methods').css('display', 'none');
        $('#tbl_auth').css('display', 'block');
        $('#inform_auth').css('display', 'none');
        $('#inform_counsel').css('display', 'block');
        $('#btnGenAuth').css('display', 'none');
        $('#btnCounsel').css('display', 'block');
        var nSum = 0;
        var kind_counsel = document.getElementsByName('kind_counsel');
        for(var i = 0; i < kind_counsel.length; i++) {
            if(kind_counsel[i].checked == true) {
                if(kind_counsel[i].value == 1) {
                    $('#user_rdate').val('');
                    $('#user_rdate').val('');
                    $('#lbl_drive_th').css('display', 'none');
                    $('#lbl_drive_td').css('display', 'none');
                    $('#lbl_rdate_th').css('display', 'block');
                    $('#lbl_rdate_td').css('display', 'block');
                } else if(kind_counsel[i].value == 2) {
                    $('#user_drive_1').val('');
                    $('#user_drive_2').val('');
                    $('#user_drive_3').val('');
                    $('#lbl_drive_th').css('display', 'block');
                    $('#lbl_drive_td').css('display', 'block');
                    $('#lbl_rdate_th').css('display', 'none');
                    $('#lbl_rdate_td').css('display', 'none');
                }
                break;
            }
        }
    }

    function fnCounsel() {
        var frm = $('#frmCertify');
        if($('#lbl_rdate_td').css('display') == 'block') {
            if($('#user_rdate').val().split(' ').join('').length != 8) {
                alert('정확하게 발급일자를 입력하세요');
                $('#user_rdate').focus();
                return false;
            }
            frm.find("[name='certFlag']").val('counsel_j');
        }
        if($('#lbl_drive_td').css('display') == 'block') {
            if($('#user_drive_1').val().split(' ').join('').length != 2) {
                alert('면허번호를 입력하세요');
                $('#user_drive_1').focus();
                return false;
            }
            if($('#user_drive_2').val().split(' ').join('').length != 6) {
                alert('면허번호를 입력하세요');
                $('#user_drive_2').focus();
                return false;
            }
            if($('#user_drive_3').val().split(' ').join('').length != 2) {
                alert('면허번호를 입력하세요');
                $('#user_drive_3').focus();
                return false;
            }
            frm.find("[name='certFlag']").val('counsel_d');
        }
        $('#frmCertify').attr('onsubmit', '');
        $('#frmCertify').submit();
    }
</script>
<script type="text/javascript" src="/angel/certify/payment/js/user_certify.js?v=210531"></script>
<script>
    loadGlobalItems()
</script>
</body>

</html>
