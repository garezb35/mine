
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>아이템천사</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="아이템천사,아이템거래,아이템,천사,아이템천사주소,아이템천사바로가기">
    <meta name="description" content="">
    <meta name="referrer" content="no-referrer-when-downgrade" />
    <link rel="shortcut icon" href="/favicon.ico">
    <link type="text/css" rel="stylesheet" href="/angel/_css/webpack.css">
    <link type="text/css" rel="stylesheet" href="/angel/global_h/css/_head_popup.css">
    <link type="text/css" rel="stylesheet" href="/angel/css/user_certify.css" />
</head>
<body>
<div id="global_root" class="mainEntity d-none">
    <div id="thirdys" class="fluid-div"></div>
</div>
<div id="angel">
    <div class="myotp_id_layer_wrapper">
        <div class="inner"></div>
    </div>
    <div class="model_titlebar">본인 휴대폰 인증</div>
    <div id="g_POPUP2">

        <div class="box_wrap">
            <div class="box">
                <p class="title">본인 휴대폰 인증</p>
                <div class="auth_info">
                    <img src="/angel/img/icons/Smartphone-4-icon.png" width="60" height="54" alt="본인 휴대폰 인증">
                    <div class="txt">본인명의의<br>휴대폰번호로 인증</div>
                    <a href="javascript:fnCertifyCheck('hpp');" class="btn_blue3">인증받기</a>
                </div>
            </div>
        </div>

        <form name="ini_hpp" id="ini_hpp" method="post">
            <input type="hidden" name="wis" value=""/>
            <input type="hidden" id="bTalkCheck" value=""/>
            <input type="hidden" name="user_mobile_type">
            <input type="hidden" name="user_mobileA">
            <input type="hidden" name="user_mobileB">
            <input type="hidden" name="user_mobileC">
        </form>
    </div>
</div>
<script type="text/javascript" src="/angel/_js/jquery.js"></script>
<script type="text/javascript" src="/angel/_js/webpack.js"></script>
<script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
<script type="text/javascript" src="/angel/js/user_certify.js"></script>
<script>

    loadGlobalItems()
</script>
</body>
</html>

