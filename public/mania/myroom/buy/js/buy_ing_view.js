var simpleTradeParams = null;
function _init() {

    var screenshot = document.getElementsByClassName('screenshot');
    var scLen = screenshot.length;
    for (var i = 0; i < scLen; i++) {
        screenshot[i].getElementsByTagName('a')[0].addEventListener('click', function(evt) {
            var idx = this.getAttribute('data-idx');
            var info = document.getElementById('screenshot_info').value;
            _window.open('imgview', '/myroom/sell/image_viewer.html?idx=' + idx + '&info=' + info, 2000, 1000, 'scrollbars=yes');
        })
    }

    if (document.getElementById('trade_btn') !== null) {
        if (document.getElementById('elt_contract') !== null) {
            document.getElementById('sign_btn').addEventListener('click', function(ev) {
                if(this.getAttribute('data-state') == 'u') {
                    alert('수정요청 취소 후 전자서명이 가능합니다.');
                    return;
                }
                document.getElementById('character_sign').value = 'Y';
                g_nodeSleep.disable();
                popLayer_2('dvTradeSellCheck');
            });
            document.getElementById('modify_btn').addEventListener('click', function(ev) {
                if(this.getAttribute('data-state') === 'u') {
                    if(confirm('전자계약서 수정요청을 취소 하겠습니까?') === true) {
                        ajaxRequest({
                            url: 'popup/character_id_change_ok.php',
                            type: 'POST',
                            data:'type=cancel&trade_id='+$('#id').val(),
                            success: function(res) {
                                var rgResult = res.split('|');
                                if (rgResult[0] === 'SUCCESS') {
                                    alert('전자 계약서 취소 요청이 완료되었습니다.');
                                    location.reload();
                                    return;
                                }
                                if (rgResult[0] === 'FAIL') {
                                    if (rgResult[1]) {
                                        alert(rgResult[1]);
                                        location.reload();
                                    }
                                }
                            }
                        })
                    }
                } else {
                    _window.open('character_id_change', 'popup/character_id_change.html?id='+$("#id").val(), 300, 300);
                }
            });
        }

        document.getElementById('trade_btn').addEventListener('click', function(ev) {
            if (document.getElementById('elt_contract') !== null) {
                //캐릭터 거래인경우 수정요청이 처리되었는지를 체크 한다!!!
                if (document.getElementById('elt_contract') !== null) {
                    ajaxRequest({
                        url: 'popup/character_id_change_ok.php',
                        type: 'POST',
                        data:'type=check&trade_id='+$('#id').val(),
                        success: function(res) {
                            if (res === 'CHANGE') {
                                $('#modify_btn').html("수정요청하기");
                                $('#modify_btn').attr('data-state', 'd');
                            }
                        }
                    })
                }
                g_nodeSleep.enable($('#elt_contract'));
            } else {
                popLayer_2('dvTradeSellCheck');
            }
        });
    }
}

function popLayer(elementID, params) {
    g_nodeSleep.enable($("#" + elementID));
    if (params) {
        _form.addValues($("#" + elementID).find('form').eq(0), params);
    }
}

//물품인수 확인
function popLayer_2(elementID) {
    var params = {
        id: $("#id").val(),
        trade_type: $("#trade_type").val()
    };

    popLayer(elementID, params);
}

/* ▼ 거래보류해제 */
function TradeCheck(process, tid) {
    var frm = $('#frmIngView');

    frm.find('input[name="process"]').val(process);
    frm.attr('action', "buy_ing_ok.php?tid=" + tid).submit();
}

/* ▲ 거래보류해제 */

/* ▼ 물품인수확인 */
function TradeComplete(process, money, type, tid, tMode, sUserType) {
    var frm = $('#moneyreceipt');
    var returnValue = true;

    if (type == 'm' && sUserType == "N") {
        var returnValue = moneyreceipt_ck();
    }

    if (returnValue != false) {
        var strConfirmMsg = '물품 인수 확인을 하시겠습니까?';
        // if($('#trade_kind').val() === '6') {
        // 	strConfirmMsg = '전자 서명을 하시겠습니까?\n' +
        // 					'전자 서명 완료 시 물품 인수 확인이 완료 됩니다.\n';
        // }
        if (!confirm(strConfirmMsg)) {
            return;
        }

        frm.find('input[name="process"]').val(process);
        if ($('#security_type').val() != "PASS" && type == 'm' && $('#trade_type2').val() == 'buy') {
            _window.open('buy_to', '', 600, 400);
            $('#frmCertify').attr({target: "buy_to", action: "/certify/payment/user_certify.html"}).submit();
        } else {
            frm.attr({
                method: "POST",
                action: "/buy_ing_ok?tid=" + tid + "&mode=" + tMode
            }).submit();
        }
    }
}

/* ▲ 물품인수확인 */

/* ▼ 현금영수증 */
function inputChange(su) {
    if (su == 1) {
        $('#juminnumber').show();
        $('#jobnumber').hide();
    } else if (su == 2) {
        $('#juminnumber').hide();
        $('#jobnumber').show();
    }
}

function moneyreceipt_ck() {
    var frm = $('#moneyreceipt');
    if (frm.find('input[name="moneyreceipt_check"]:checked').val() == 'ok') {

        if (frm.find('[name="moneyreceipt_name"]').val().isEmpty()) {
            alert('신청자 성명을 입력해주세요.');
            frm.find('[name="moneyreceipt_name"]').focus();
            return false;
        }

        if (frm.find('input[name="moneyreceipt_type"]:checked').val() == 'u') {

            if (frm.find('[name="member_info"]:checked').val() == 'p') {
                if (frm.find('#user_phone1').val().isEmpty()) {
                    alert('휴대폰 번호를 입력해주세요.');
                    frm.find('#user_phone1').focus();
                    return false;
                }
                if (frm.find('#user_phone2').val().isEmpty()) {
                    alert('휴대폰 번호를 입력해주세요.');
                    frm.find('#user_phone2').focus();
                    return false;
                }
                if (frm.find('#user_phone3').val().isEmpty()) {
                    alert('휴대폰 번호를 입력해주세요.');
                    frm.find('#user_phone3').focus();
                    return false;
                }
                if (frm.find('[name*="user_phone"]').val().length < 3) {
                    alert('올바른 휴대폰 번호가 아닙니다.');
                    frm.find('[name*="user_phone"]').val('');
                    frm.find('#user_phone1').focus();
                    return false;
                }
                if (frm.find('#user_phone3').val().length < 4) {
                    alert('올바른 휴대폰 번호가 아닙니다.');
                    frm.find('#user_phone3').val('');
                    frm.find('#user_phone3').focus();
                    return false;
                }
            }
        } else if (frm.find('input[name="moneyreceipt_type"]:checked').val() == 'j') {

            if (frm.find('input[name="taxnumber1"]').val().length != 3 || frm.find('input[name="taxnumber2"]').val().length != 2 || frm.find('input[name="taxnumber3"]').val().length != 5) {
                alert("사업자번호를 입력하세요!");
                return false;
            }

            if (!check_busino(frm.find('input[name="taxnumber1"]').val() + frm.find('input[name="taxnumber2"]').val() + frm.find('input[name="taxnumber3"]').val())) {
                alert("잘못된 사업자등록번호입니다!\n\n다시입력하세요!");
                return false;
            }
        }
    }
}

$(function() {
    $('#juminnumber .g_radio').change(function() {
        $('.sub_div').hide();
        $('#' + $(this).attr('id') + '_div').show();
    });

    _form.protect.number($('[name*="user_phone"]'));
    _form.protect.number($('[name*="moneyreceipt_jumin"]'));

    _form.autotab($('#user_phone1'), $('#user_phone2'));
    _form.autotab($('#user_phone2'), $('#user_phone3'));
    _form.autotab($('#user_phone3'), $('[name="moneyreceipt_email"]'));
    _form.autotab($('#moneyreceipt_jumin1'), $('#moneyreceipt_jumin2'));
    _form.autotab($('#moneyreceipt_jumin2'), $('[name="moneyreceipt_email"]'));
});
/* ▲ 현금영수증 */

/* ▼ 주민등록번호 체크 */
function check_jumin(val1, val2) {
    //앞자리가 일자인지 체크
    var tmp1, tmp2
    var t1, t2, t3, t4, t5, t6, t7
    var ok = true;
    tmp1 = val1.substring(2, 4);
    tmp2 = val1.substring(4);

    if ((tmp1 < "01") || (tmp1 > "12")) {
        ok = false;
        return ok;
    }
    if ((tmp2 < "01") || (tmp2 > "31")) {
        ok = false;
        return ok;
    }

    //뒷자리 체크
    t1 = val1.substring(0, 1);
    t2 = val1.substring(1, 2);
    t3 = val1.substring(2, 3);
    t4 = val1.substring(3, 4);
    t5 = val1.substring(4, 5);
    t6 = val1.substring(5, 6);

    t11 = val2.substring(0, 1);
    t12 = val2.substring(1, 2);
    t13 = val2.substring(2, 3);
    t14 = val2.substring(3, 4);
    t15 = val2.substring(4, 5);
    t16 = val2.substring(5, 6);
    t17 = val2.substring(6, 7);

    var tot = t1 * 2 + t2 * 3 + t3 * 4 + t4 * 5 + t5 * 6 + t6 * 7;
    tot = tot + t11 * 8 + t12 * 9 + t13 * 2 + t14 * 3 + t15 * 4 + t16 * 5;

    var result = tot % 11;
    result = (11 - result) % 10;
    if (result != t17) {
        ok = false;
        return ok;
    }

    return ok;

}

/* ▲ 주민등록번호 체크 */

/* ▼ 사업자등록번호 체크 */
function check_busino(vencod) {
    var sum = 0;
    var getlist = new Array(10);
    var chkvalue = new Array("1", "3", "7", "1", "3", "7", "1", "3", "5");
    try {
        for (var i = 0; i < 10; i++) {
            getlist[i] = vencod.substring(i, i + 1);
        }
        for (var i = 0; i < 9; i++) {
            sum += getlist[i] * chkvalue[i];
        }
        sum = sum + parseInt((getlist[8] * 5) / 10);
        sidliy = sum % 10;
        sidchk = 0;

        if (sidliy != 0) {
            sidchk = 10 - sidliy;
        } else {
            sidchk = 0;
        }

        if (sidchk != getlist[9]) {
            return false;
        }
        return true;
    } catch (e) {
        return false;
    }
}

/* ▲ 사업자등록번호 체크 */

/* ▼ 다른글꼴로보기 */
function fnDifferentFacePopup(sellercharacter) {
    if (arguments.length != 1 || arguments[0] === 'undefiend') return;

    var sellerid = null;
    var INPUT = null;
    var frm = null;
    this.sellerid = sellercharacter;

    frm = $("#frmDiffer");

    INPUT = $('<INPUT />', {
        type: "hidden",
        name: "seller_id",
        value: this.sellerid
    }).appendTo(frm);

    _window.open('selleridview', '', 440, 240);
    frm.attr({
        target: "selleridview",
        action: "buy_ing_view_name.html"
    }).submit();
}

/* ▲ 다른글꼴로보기 */

function fnCreditViewCheck() {
    var infoId = $('#infoId').val();
    var params = 'id=' + infoId;

    fnAjax('/user/credit_ajax.php?t=' + (new Date()).getTime(), 'text', 'POST', params, {
        complete: function(res) {
            var rgResult = res.split('|');
            if (rgResult[0] == 'SUCCESS') {
                $('#encryptId').val(rgResult[1]);
                if (rgResult[2] && !rgResult[2].isEmpty()) {
                    $('#encryptType').val(rgResult[2]);
                }
                _window.open('credit_view', '', 570, 640);
                $('#creditForm').attr({
                    'target': 'credit_view',
                    'action': '/user/credit_view.html'
                }).submit();
            } else {
                alert(rgResult[1]);
            }
        }
    });
}
