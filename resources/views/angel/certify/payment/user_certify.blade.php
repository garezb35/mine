<html lang="ko">

<head>
    <title>아이템천사</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="아이템천사,아이템거래,아이템,천사,아이템천사주소,아이템천사바로가기">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <link rel="shortcut icon" href="/favicon.ico">
    <link type="text/css" rel="stylesheet" href="/angel/_css/_comm.css">
    <link type="text/css" rel="stylesheet" href="/angel/_head_tail/css/_head_popup.css">
    <link type="text/css" rel="stylesheet" href="/angel/certify/payment/css/user_certify.css"> </head>

<body>
<div id="g_SLEEP" class="g_sleep g_hidden">
    <div id="g_OVERLAY" class="g_overlay"></div>
</div>
<div id="g_BODY">
    <div class="myotp_id_layer_wrapper">
        <div class="inner"></div>
    </div>
    <div class="popup_title_bar"><img src="http://img1.itemmania.com/images/certify/title_confirm.gif" alt="인증"></div>
    <div id="g_POPUP2">
        <input type="hidden" id="submit_type" value="1">
        <!-- 인증 //-->
        <div class="subtitle">서비스 이용 시 인증확인이 필요합니다.
            <br>아래 인증수단을 이용하여 인증확인을 받아주시기 바랍니다.</div>
        <div class="box_wrap" id="pub_auth_a">

            <div class="box">
                <p class="title">본인 휴대폰 인증</p>
                <div class="auth_info"> <img src="http://img4.itemmania.com/new_images/certify/img_05.jpg" width="80" height="54" alt="본인 휴대폰 인증">
                    <br>
                    <div class="txt">본인명의의
                        <br>휴대폰번호로 인증</div> <a href="javascript:fnCertifyCheck('hpp');" class="btn_blue3">인증받기</a> </div>
            </div>

        </div>
        <div class="box box2" id="pub_auth_b">
            <p class="title">공인인증서 인증</p>
            <ul class="auth_info">
                <li class="pub_img"><img src="http://img4.itemmania.com/images/certify/img_cert04.gif" width="80" height="54" alt=""></li>
                <li class="phone_info"> 공인인증서 인증 진행중입니다.
                    <br>잠시만 기다려 주세요. </li>
            </ul>
        </div>
        <div class="g_btn"> <a href="javascript:;" onclick="fnWinClose()" class="btn_gray3">취소</a> </div>
        <ul class="g_notice_box1 g_list">
            <li>위 인증 수단은 본인 명의로만 인증이 가능합니다.</li>
            <li>보안서비스 PC등록, 결제IP를 이용하실 경우 인증단계 없이 이용이 가능합니다.</li>
            <li class="list_non">(보안서비스는 <strong>마이룸 &gt; 보안센터</strong>에서 설정 가능합니다.)</li>
        </ul>
        <div class="simple_box">
            <a href="http://trade.itemmania.com/myroom/myinfo/my_pin_info target="_blank"><img src="http://img4.itemmania.com/new_images/certify/210602_470X158.jpg" width="470" alt="마일리지 간편결제"></a>
        </div>
        <div id="dvPopup" class="g_popup"> <img src="http://img4.itemmania.com/images/certify/loading_top.gif" width="168" height="74" alt="로딩중"> <img src="http://img4.itemmania.com/images/certify/loading.gif" width="354" height="40" alt="로딩중"> </div>
        <div id="dvPopup2" class="g_popup kakaopay">
            <div class="layer_title">
                <div class="title">카카오페이 간편인증</div> <img class="btn_close" src="http://img4.itemmania.com/images/icon/popup_x.gif" width="15" height="15" alt="닫기" onclick="g_nodeSleep.disable();"> </div>
            <div class="layer_content">
                <div class="top_info"> 카카오톡으로 인증 요청이 발송되었습니다. </div>
                <div class="box2"> 카카오페이 인증을 완료 하신 후 하단의 <span class="f_blue3 f_bold">[확인]</span>버튼을 눌러주세요. </div>
                <div class="g_btn">
                    <a href="javascript:fnKakaopayCertify('step2');"><img src="http://img1.itemmania.com/new_images/btn/pop_btn_ok.gif" alt="확인"></a>
                    <a href="javascript:g_nodeSleep.disable();"><img class="first" src="http://img1.itemmania.com/new_images/btn/pop_btn_cancel.gif" alt="취소"></a>
                </div>
            </div>
        </div>

        <form name="ini_hpp" id="ini_hpp" method="post">
            <input type="hidden" name="wis" value="MP">
            <input type="hidden" id="bTalkCheck" name="bTalkCheck" value="1">
        </form>

    </div>
</div>
<script type="text/javascript" src="/angel/_js/jquery.js?190220"></script>
<script type="text/javascript" src="/angel/_js/_comm.js?v=2110051622"></script>
<script type="text/javascript" src="/angel/_js/angelic-global.js?v=2110081625"></script>
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
    _initialize();
</script>
</body>

</html>
