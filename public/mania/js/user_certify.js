
function _init() {
    _window.resize(360, 290);

    setMobileCertyEvent();
}

function fnCertifyCheck(t) {
    if (t === 'logintalk') {
        if ($('#bTalkCheck').val() == true) {
            $('#ini_hpp').attr('action', '/certify/logintalk/logintalk_areement').submit();
        } else {
            $('#ini_hpp').attr('action', '/certify/logintalk/logintalk_request?wis=HA').submit();
        }
    } else if (t === 'hpp') {
        $('#ini_hpp').attr('action', '/certify/ini_modi_authcenter/user_certify_form').submit();
    }
}

function setMobileCertyEvent() {
    if ($("#authFin") != undefined) {
        $("#authFin").click(function() {
            //			parent.opener.location.reload();
            parent.opener.reloadFrm.submit();
            parent.window.close();
        });
    }
}
