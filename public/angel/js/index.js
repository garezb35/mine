

function _init(){


}

function fnTradePage(url){
    if(url) {
        location.href = url;
    }
}

function fnipin()
{
    $("#reqCBAForm").submit();
}

function fnemail(){
    if (confirm($('#user_email').val() + 'ì— ì¸ì¦ë©”ì¼ ë°œì†¡ í•˜ì‹œê² ìŠµë‹ˆê¹Œ?')) {
        fnAjax('/certify/email/sendmail.php', 'xml', 'POST', '', {
            complete: function (res) {
                if ($(res).find('result').attr('type') == 'fail') {
                    alert($(res).find('result').attr('message'));
                } else if ($(res).find('result').attr('type') == 'success') {
                    _window.open('auth_mail', '/certify/email/sendmail_ok.php', 440, 260);
                }
            },
            error: function () {
                alert('ì‹œìŠ¤í…œ ì ê²€ì¤‘ìž…ë‹ˆë‹¤. ìž ì‹œ í›„ ì´ìš©í•´ ì£¼ì„¸ìš”.');
            }
        });
    }else{
        location.href='/myroom/myinfo/myinfo_check.html';
    }
}

function cardauth(mode)
{
    alert("ì„œë¹„ìŠ¤ ì ê²€ì¤‘ìž…ë‹ˆë‹¤.");
    //_window.open('mobile_certify','/certify/ini_pubauth/pub_auth_request.php?wis=MI',430,700);
}
