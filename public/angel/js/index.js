/*
 * @title		ë§ˆì´ë£¸
 * @author		ê¹€ë³´ëžŒ
 * @date		2012.01.19
 * @update		2020.07.21 (ê°•í¬ê²½)
 * @description
 */

function _init(){
// 	g_fnSECURITY2();
//	StartSmartUpdate();

    // $.ajax({
    //     url			: "/_include/_loginbox_security.php",
    //     dataType	: "text",
    //     type		: "get",
    //     data		: null,
    //     success		: function(request) {
    //         reqData = request.split("$");
    //
    //         var strSecuResult = "ë¯¸ì„¤ì •";
    //         var strLoginAlarm = "ë¯¸ì„¤ì •";
    //         var strLoginResult = "ë¯¸ì„¤ì •";
    //         var strUseService = "<span class='f_blue1'>ì„¤ì •ì™„ë£Œ</span>";
    //         if (reqData[0] == true) { strSecuResult = strUseService; }
    //         if (reqData[3] == true) { strLoginResult = strUseService; }
    //         if (reqData[4] == true) { strLoginAlarm = strUseService; }
    //
    //         // $("#login_security_service").html("ë¡œê·¸ì¸ ë³´ì•ˆ ì„œë¹„ìŠ¤ : <b>"+strLoginResult+"</b>");
    //         // $("#login_alert_service").html("ë¡œê·¸ì¸ ì•Œë¦¼ ì„œë¹„ìŠ¤ : <b>"+strLoginAlarm+"</b>");
    //         // $("#payment_security_service").html("ê²°ì œ ë³´ì•ˆ ì„œë¹„ìŠ¤ : <b>"+strSecuResult+"</b>");
    //
    //         $("#login_security_state").html("<b>"+strLoginResult+"</b>");
    //         $("#login_alert_state").html("<b>"+strLoginAlarm+"</b>");
    //         $("#payment_state").html("<b>"+strSecuResult+"</b>");
    //
    //         //$('#loading_img').hide();
    //     },
    //     error : function (xhr) {
    //         alert("ì ‘ì†ì´ ì›í™œí•˜ì§€ ì•ŠìŠµë‹ˆë‹¤."+xhr.status);
    //     }
    // });

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
