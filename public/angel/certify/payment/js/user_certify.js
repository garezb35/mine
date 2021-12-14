/*
 * @title		ë¬¼í’ˆë“±ë¡íŒì—…[íŒë‹ˆë‹¤]
 * @author		ê¹€í˜„ì§„
 * @date		2012.03.22
 * @update		ìˆ˜ì •ë‚ ì§œ(ìˆ˜ì •ìž)
 * @description
 */

function _init() {
    g_fnSECURITY2();

    var opSleep = window.opener.$('#g_SLEEP');

    window.onload = function() {
        if(window.opener.closed == false) {
            opSleep.show();
            if(opSleep.hasClass('g_hidden')) {
                opSleep.removeClass('g_hidden');
            }
        }
    }
    window.onbeforeunload = function() {
        if(window.opener.closed == false) {
            opSleep.hide();
        }
    }
    window.onunload = function() {
        if(window.opener.closed == false) {
            opSleep.hide();
        }
    }
}


function fnOpenerCheck() {
    if($('#submit_type').val() === '1' && window.opener.closed == true) {
        alert('다시 시도하여 주시기 바랍니다.');
        self.close();
        return;
    }
    return true;
}
/* â–² ì˜¤í”„ë„ˆ ì²´í¬ */

function fnCertifyCheck(t) {
    var mobileA = $('#mobile_numberA');
    var mobileB = $('#mobile_numberB');
    var mobileC = $('#mobile_numberC');
    fnOpenerCheck();
    fnOpenerSubmit();
    //$('#ini_hpp').attr('action', '/certify/ini_hpp_certify/user_certify_form_v2_request').submit();
}
/* â–¼ íœ´ëŒ€í° ì¸ì¦ */
//user_certify2
function fnINIhpp2() {
    fnOpenerCheck();
    var f = $('#ini_hpp');
    f.attr('action', '/certify/ini_modi_authcenter/user_certify_form.html');
    f.submit();
}
/* â–² íœ´ëŒ€í° ì¸ì¦ */

/* â–¼ ê³µì¸ì¸ì¦ì„œ ì¸ì¦ */
//user_certify2
function cardauth2() {
    fnOpenerCheck();
    var frm = $('#ini_pub');
    frm.attr('action', '/certify/ini_pubauth/pub_auth_request.php');
    frm.submit();
}
/* â–² ê³µì¸ì¸ì¦ì„œ ì¸ì¦ */

/* â–¼ ë¡œê·¸ì¸í†¡ ì¸ì¦ */
function fnlogintalk() {
    fnOpenerCheck();
    var f = $('#ini_hpp');
    f.attr('action', '/certify/logintalk/logintalk_request.php');
    f.submit();
}
/* â–² ë¡œê·¸ì¸í†¡ ì¸ì¦ */

/* â–¼ ì „í™” ì¸ì¦ */
var check_tel = 0;
function fnTelCertify2(k, t) {
    if(check_tel >= 1) {
        alert('ì´ë¯¸ ì²˜ë¦¬ì¤‘ìž…ë‹ˆë‹¤. ìž ì‹œë§Œ ê¸°ë‹¤ë ¤ ì£¼ì„¸ìš”.');
        return;
    }

    var authTelNo;
    if(k === 'ctel') {
        authTelNo = $('#tel_numberA').val() + $('#tel_numberB').val() + $('#tel_numberC').val();
    }
    else if(k === 'chpp') {
        authTelNo = $('#mobile_numberA').val() + $('#mobile_numberB').val() + $('#mobile_numberC').val();
    }

    var ajaxUrl = '/certify/payment/thinkat.req.php';
    if(t === 'm') {
        ajaxUrl = '/certify/payment/thinkat_mileage.req.php';
    }

    check_tel++;

    ajaxRequest({
        url : ajaxUrl,
        type : 'post',
        dataType : 'text',
        data : "try_kind=" + k + "&authTelNo=" + authTelNo + "&buyType=" + $('#buyType').val(),
        success : function(request) {
            if(window.opener.closed == false) {
                window.opener.$('#g_SLEEP').show();
            }
            check_tel = 0;
            g_nodeSleep.enable($("#dvPopup"));
            var returnData = request.split("|");
            switch(returnData[0]) {
                case "S" :
                    window.opener.$('#g_SLEEP').show();
                    window.setTimeout("fnThinkat(" + returnData[3] + ")", 2000);
                    break;
                case "F" :
                    alert("ì¸ì¦ì´ ì‹¤íŒ¨ í•˜ì˜€ìŠµë‹ˆë‹¤.\në‹¤ë¥¸ ì¸ì¦ ìˆ˜ë‹¨ì„ ì´ìš©í•˜ì—¬ ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.");
                    g_nodeSleep.disable($("#dvPopup"));
                    break;
                default:
                    alert("ì „í™”ì¸ì¦ì— ì‹¤íŒ¨í•˜ì˜€ìŠµë‹ˆë‹¤. \në‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”. [E" + returnData[0] + "]");
                    window.opener.$('#g_SLEEP').hide();
                    self.close();
                    break;
            }
        }
    });
}

function fnTelCertify() {
    if (check_tel >= 1) {
        alert('ì´ë¯¸ ì²˜ë¦¬ì¤‘ìž…ë‹ˆë‹¤. ìž ì‹œë§Œ ê¸°ë‹¤ë ¤ ì£¼ì„¸ìš”.');
        return ;
    }
    var try_kind = $('[name="try_kind[]"]');
    for(var i=0; i<try_kind.length; i++) {
        if(try_kind[i] != undefined && try_kind[i].checked == true) {
            try_kind = try_kind[i].value;
        }
    }
    var authTelNo;
    if(try_kind == 'ctel') authTelNo = $('#tel_numberA').val() + $('#tel_numberB').val() + $('#tel_numberC').val();
    else if(try_kind == 'chpp') authTelNo = $('#mobile_numberA').val() + $('#mobile_numberB').val() + $('#mobile_numberC').val();
    check_tel++;

    var params = "try_kind="+try_kind+"&authTelNo="+authTelNo+"&buyType="+$('#buyType').val();
    fnAjax('/certify/payment/thinkat.req.php', 'text', 'post', params, {
        complete : function (request){
            if(window.opener.closed == false) { window.opener.$('#g_SLEEP').show();	}
            check_tel = 0;
            g_nodeSleep.enable($("#dvPopup"));
            var returnData = request.split("|");
            switch (returnData[0]) {
                case "S" :
                    window.opener.$('#g_SLEEP').show();
                    window.setTimeout("fnThinkat(" + returnData[3] + ")", 2000);
                    break;
                case "F" :
                    alert("ì¸ì¦ì´ ì‹¤íŒ¨ í•˜ì˜€ìŠµë‹ˆë‹¤.\në‹¤ë¥¸ ì¸ì¦ ìˆ˜ë‹¨ì„ ì´ìš©í•˜ì—¬ ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.");
                    g_nodeSleep.disable($("#dvPopup"));
                    break;
                default:
                    alert("ì „í™”ì¸ì¦ì— ì‹¤íŒ¨í•˜ì˜€ìŠµë‹ˆë‹¤. \në‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”. [E" + returnData[0] + "]");
                    window.opener.$('#g_SLEEP').hide();
                    self.close();
                    break;
            }
        }
    });
}

function fnThinkat(tid) {
    ajaxRequest({
        url : '/certify/payment/thinkat.prc.php',
        type : 'post',
        dataType : 'text',
        data : "tran_id=" + tid,
        success : function(request) {
            if(window.opener.closed == false) {
                window.opener.$('#g_SLEEP').show();
            }
            var returnData = request.split("|");
            switch(returnData[0]) {
                case "R" :
                default: //ëŒ€ê¸°
                    window.setTimeout("fnThinkat(" + tid + ")", 2000);
                    break;
                case "F3" : //ì •ìƒì ì¸ê²½ë¡œ
                    alert("ì •ìƒì ì¸ ê²½ë¡œë¥¼ ì´ìš©í•´ì£¼ì„¸ìš”.");
                    g_nodeSleep.disable($("#dvPopup"));
                    break;
                case "F4" : //ì‹¤íŒ¨
                    alert("ì¸ì¦ì´ ì‹¤íŒ¨ í•˜ì˜€ìŠµë‹ˆë‹¤.\në‹¤ë¥¸ ì¸ì¦ ìˆ˜ë‹¨ì„ ì´ìš©í•˜ì—¬ ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.");
                    g_nodeSleep.disable($("#dvPopup"));
                    break;
                case "F6" : //ì‹¤íŒ¨
                    alert("ì¸ì¦ì´ ì‹¤íŒ¨ í•˜ì˜€ìŠµë‹ˆë‹¤.\në‹¤ë¥¸ ì¸ì¦ ìˆ˜ë‹¨ì„ ì´ìš©í•˜ì—¬ ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.");
                    g_nodeSleep.disable($("#dvPopup"));
                    break;
                case "F7" : //ì‹¤íŒ¨
                    alert("ì¸ì¦ì‹œê°„ì´ ì´ˆê³¼í•˜ì˜€ìŠµë‹ˆë‹¤.\në‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.");
                    g_nodeSleep.disable($("#dvPopup"));
                    break;
                case "F8" : //ì‹¤íŒ¨
                    alert("ì¸ì¦ì‹œê°„ì´ ì´ˆê³¼í•˜ì˜€ìŠµë‹ˆë‹¤.\në‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.[ex00]");
                    g_nodeSleep.disable($("#dvPopup"));
                    break;
                case "S" : //ì„±ê³µ
                    fnOpenerSubmit();
                    break;
            }
        },
        error : function() {
            g_nodeSleep.disable($("#dvPopup"));
        }
    });
}
/* â–² ì „í™” ì¸ì¦ */

function fnWinClose() {
    window.opener.$('#g_SLEEP').hide();
    _window.close();
}

// ì¸ì¦ë²ˆí˜¸ ì²´í¬ (user_certify_number)
function fnNumberCheck() {
    if($('#submit_type').val() === '1' && window.opener.closed === true) {
        alert('ë‹¤ì‹œ ì‹œë„í•˜ì—¬ ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.');
        window.close();
        return;
    }
    var frm = $('#frmNumber');
    if($('[name="certkey"]').val().isEmpty()) {
        alert('ì¸ì¦ë²ˆí˜¸ë¥¼ ìž…ë ¥í•´ì£¼ì„¸ìš”.');
        $('[name="certkey"]').val('').focus();
        return;
    }
    frm.attr({action : 'INIauth.php', onsubmit : ''}).submit();
}


/* â–¼ ì¹´ì¹´ì˜¤í†¡ ì¸ì¦ */
var check_kakaopay = 0;
function fnKakaopayCertify(k) {

    if(check_kakaopay >= 1) {
        alert('ì²˜ë¦¬ì¤‘ìž…ë‹ˆë‹¤. ìž ì‹œ í›„ ë‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.');
        return;
    }

    var ajaxUrl = '/certify/kakaopay_auth/kakaopay_check.php';
    check_kakaopay++;

    ajaxRequest({
        url : ajaxUrl,
        type : 'post',
        dataType : 'text',
        data : "wls=payment&step=" + k,
        success : function(request) {
            if(window.opener.closed == false) {
                window.opener.$('#g_SLEEP').show();
            }
            check_kakaopay = 0;
            var returnData = request.split("|");

            if(k == "step1"){
                if(returnData[0] != "S" ){
                    alert(returnData[1]);
                    return;
                }
                g_nodeSleep.enable($("#dvPopup2"));

            } else if(k == "step2"){
                switch(returnData[0]) {
                    case "W" :
                    default: //ëŒ€ê¸°
                        alert("ì¹´ì¹´ì˜¤íŽ˜ì´ ì¸ì¦ ì™„ë£Œ í›„ í™•ì¸í•´ ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.");
                        break;
                    case "F" : //ì •ìƒì ì¸ê²½ë¡œ
                        alert(returnData[1]);
                        g_nodeSleep.disable($("#dvPopup"));
                        break;
                    case "S" : //ì„±ê³µ
                        alert("ì¸ì¦ì´ ì™„ë£Œ ë˜ì—ˆìŠµë‹ˆë‹¤.");
                        fnOpenerSubmit();
                        break;
                }
            } else {
                alert("ìž˜ëª»ëœ ì ‘ê·¼ìž…ë‹ˆë‹¤.");
                g_nodeSleep.disable($("#dvPopup"));
            }
        },
        error : function() {
            g_nodeSleep.disable($("#dvPopup"));
        }
    });
}
