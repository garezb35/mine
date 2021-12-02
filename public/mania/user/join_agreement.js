/*
 * @title		회원가입 약관동의/실명확인
 * @author		김보람
 * @date		2011.10.04
 * @update
 * @description
 */

$(function() {
    var frm = new _form_checker($('#reqCBAForm')),
        frm2 = new _form_checker($('#simpleForm')),
        frm3 = new _form_checker($('#frmRealname'));

    frm.add({
        custom: function() {
            if (fnCheck() == false) {
                return false;
            }

            if($('#foreigner').val() === '2') {
                if ($('#reqCBAForm').find('[name="foreign_agree"]').val() !== '1') {
                    alert('외국인 등록번호 처리에 동의를 하셔야 가입이 가능합니다.');
                    $('#foreign_agree_ipin').focus();
                    return false;
                }
            }

            return true;
        }
    });

    frm2.add({
        custom: function() {
            if (fnCheck() == false) {
                return false;
            }

            return true;
        }
    });

    frm3.add({
        custom: function() {
            if (fnCheck() == false) {
                return false;
            }
            if ($('#name').val().isEmpty()) {
                alert('이름을 입력해 주세요.');
                $('#name').focus();
                return false;
            }
            if ($('#jumin1').val().isEmpty()) {
                alert('외국인 등록번호를 입력해주세요.');
                $('#jumin1').focus();
                return false;
            }
            if ($('#jumin2').val().isEmpty()) {
                alert('외국인 등록번호를 입력해주세요.');
                $('#jumin2').focus();
                return false;
            }
            if ($('#jumin1').val().length != 6) {
                alert('외국인 등록번호 앞자리는 6자리로 입력해주세요.');
                $('#jumin1').val('').focus();
                return false;
            }
            if ($('#jumin2').val().length != 7) {
                alert('외국인 등록번호 뒷자리는 7자리로 입력해주세요.');
                $('#jumin2').val('').focus();
                return false;
            }
            if ($('#foreign_agree').prop('checked') === false) {
                alert('외국인 등록번호 처리에 동의를 하셔야 가입이 가능합니다.');
                $('#foreign_agree').focus();
                return false;
            }

            var userMsg = '',
                fgn_reg_no = $('#jumin1').val() + $('#jumin2').val();

            if ((fgn_reg_no.charAt(6) == '5') || (fgn_reg_no.charAt(6) == '6')) {
                birthYear = '19';
            }
            else if ((fgn_reg_no.charAt(6) == '7') || (fgn_reg_no.charAt(6) == '8')) {
                birthYear = '20';
            }
            else if ((fgn_reg_no.charAt(6) == '9') || (fgn_reg_no.charAt(6) == '0')) {
                birthYear = '18';
            }
            else {
                alert('외국인 등록번호에 오류가 있습니다. 다시 확인하십시오.');
                $('[name*=jumin]').val('');
                return false;
            }

            birthYear += fgn_reg_no.substr(0, 2);
            birthMonth = fgn_reg_no.substr(2, 2) - 1;
            birthDate = fgn_reg_no.substr(4, 2);
            birth = new Date(birthYear, birthMonth, birthDate);

            if (birth.getYear() % 100 != fgn_reg_no.substr(0, 2) || birth.getMonth() != birthMonth || birth.getDate() != birthDate) {
                alert('생년월일에 오류가 있습니다. 다시 확인하십시오.');
                $('[name*=jumin]').val('');

                return false;
            }

            var sum = 0,
                odd = 0;

            buf = new Array(13);

            for (i = 0; i < 13; i++) {
                buf[i] = parseInt(fgn_reg_no.charAt(i));
            }

            odd = buf[7] * 10 + buf[8];

            if (odd % 2 != 0) {
                alert('외국인 등록번호에 오류가 있습니다. 다시 확인하십시오.');
                return false;
            }

            multipliers = [2, 3, 4, 5, 6, 7, 8, 9, 2, 3, 4, 5];

            for (i = 0, sum = 0; i < 12; i++) {
                sum += (buf[i] *= multipliers[i]);
            }

            sum = 11 - (sum % 11);

            if (sum >= 10) {
                sum -= 10;
            }

            sum += 2;

            if (sum >= 10) {
                sum -= 10;
            }

            if (sum != buf[12]) {
                alert('외국인 등록번호에 오류가 있습니다. 다시 확인하십시오.');
                return false;
            }
            else {
                goIDCheck(userMsg);
            }
        }
    });

    _form.protect.number($('[name*=jumin]'));
    _form.autotab($('#jumin1'), $('#jumin2'));

    $('#agreement_all').on({
        click: function() {

            if ($(this)[0].checked) {
                $('#user_agreement6, #user_agreement7, #user_agreement8, #user_agreement9').prop('disabled', false);
                $('[name*="user_agreement"]').prop('checked', true);
                $('#user_service_use_agree').prop('checked', true);
            }
            else {
                $('#user_agreement6, #user_agreement7, #user_agreement8, #user_agreement9').prop('disabled', true);
                $('[name*="user_agreement"]').prop('checked', false);
                $('#user_service_use_agree').prop('checked', false);
            }
        }
    });

    $('[name*="user_agreement"]').click(function() {
        if ($('[type="checkbox"][name*="user_agreement"]:not(:checked)').length > 0) {
            $('#agreement_all').prop('checked', false);
        }
        else {
            $('#agreement_all').prop('checked', true);
        }
    });

    $('#user_agreement4').on({
        click: function() {
            var agreeList = $('#user_agreement8, #user_agreement9');
            agreeList.prop('checked', false);

            if (this.checked) {
                agreeList.prop('disabled', false);
            }
            else {
                agreeList.prop('disabled', true);
            }
        }
    });
    $('#user_agreement5').on({
        click: function() {
            var agreeList = $('#user_agreement6, #user_agreement7');
            agreeList.prop('checked', false);

            if (this.checked) {
                agreeList.prop('disabled', false);
            }
            else {
                agreeList.prop('disabled', true);
            }
        }
    });

    $('#portal_tab').click(function() {
        $('#portal_yak').show();
        $('#trade_yak').hide();
        $('#trade_tab')[0].className = '';
        this.className = 'on';
    });

    $('#trade_tab').click(function() {
        $('#trade_yak').show();
        $('#portal_yak').hide();
        $('#portal_tab')[0].className = '';
        this.className = 'on';
    });

    $('[name="ipin_cert"]').click(function() {
        $('#reqCBAForm').submit();
    });

    $('[name="phone_cert"]').click(function() {
        fnCheck('hp');
    });

    $('#foreign_agree_ipin').click(function() {
        if(this.checked === true) {
            $('#reqCBAForm').find('[name="foreign_agree"]').val(1);
        } else {
            $('#reqCBAForm').find('[name="foreign_agree"]').val('');
        }
    });
});

function fnCheck(_type) {
    var userAgreement = $('[name="user_agreement"]'),
        userAgreement1 = $('#user_agreement1'),
        userAgreement2 = $('#user_agreement2'),
        userAgreement3 = $('#user_agreement3'),
        user_service_use_agree = $('#user_service_use_agree'),
        user_service = $('[name="user_service"]'),
        userAgreement10	= $('#user_agreement10');
    // userAgreement4	= $('#user_agreement4'),
    // userAgreement5	= $('#user_agreement5'),
    // userAgreement6	= $('#user_agreement6'),
    // userAgreement7	= $('#user_agreement7'),
    // userAgreement8	= $('#user_agreement8'),
    // userAgreement9	= $('#user_agreement9');

    if (!userAgreement1[0].checked) {
        alert('서비스 약관에 동의하셔야 합니다');
        userAgreement1.focus();
        return false;
    }

    if (!userAgreement2[0].checked) {
        alert('개인정보 취급방침에 동의하셔야 합니다');
        userAgreement2.focus();
        return false;
    }

    user_service.val(0);
    if (user_service_use_agree[0].checked) {
        user_service.val(user_service_use_agree.val());
    }

    userAgreement10.val(0);
    if (userAgreement10[0].checked) {
        userAgreement10.val(10);
    }

    if (USER_TYPE == 'general') {
        /*if (userAgreement4[0].checked == true && userAgreement8[0].checked == false) {
            alert('가입권유 연락방식에서 전화를 선택해 주세요.');
            userAgreement8[0].focus();
            return false;
        }
        if (userAgreement5[0].checked == true && userAgreement6[0].checked == false) {
            alert('가입권유 연락방식에서 전화를 선택해 주세요.');
            userAgreement6[0].focus();
            return false;
        }
        */

        userAgreement.val(0);
        if (userAgreement3[0].checked) {
            userAgreement.val(Number(userAgreement.val()) + Number(userAgreement3.val()) + Number(userAgreement10.val()));
        }

        /*if(userAgreement4[0].checked && userAgreement8[0].checked) {
            userAgreement.val(Number(userAgreement.val()) + Number(userAgreement8.val()));
        }
        if(userAgreement4[0].checked && userAgreement9[0].checked) {
            userAgreement.val(Number(userAgreement.val()) + Number(userAgreement9.val()));
        }
        if(userAgreement5[0].checked && userAgreement6[0].checked) {
            userAgreement.val(Number(userAgreement.val()) + Number(userAgreement6.val()));
        }
        if(userAgreement5[0].checked && userAgreement7[0].checked) {
            userAgreement.val(Number(userAgreement.val()) + Number(userAgreement7.val()));
        }
        */
    } else {
        userAgreement.val(0);
        userAgreement.val(Number(userAgreement.val()) + Number(userAgreement1.val()) + Number(userAgreement10.val()));
        userAgreement.val(Number(userAgreement.val()) + Number(userAgreement2.val()));
    }

    if (_type == 'hp') {
        _window.open('hp_auth', '/portal/user/join_auth/user_certfy_form.html?user_agreement=' + userAgreement.val() + '&user_service_use_agree=' + user_service.val(), 420, 300);
    }
    else if (_type == 'safe') {
        _window.open('niceID_popup', '/portal/user/safe_check_request.php?join_type=' + USER_TYPE, 420, 300);
    }
    else if (_type == 'simple') {
        location.href = '/portal/user/join_simple.html';
    }

    return;
}

//한국신용정보 실명인증 관련
function goIDCheck(userMsg) {
    if (userMsg != '' && !confirm(userMsg)) {
        return false;
    }
    else {
        var strNm = $('input[name="name"]').val(),
            strNo = $('input[name="jumin1"]').val() + $('input[name="jumin2"]').val(),
            strRsn = $('input[name="inqRsn"]').val(),
            strForeigner = $('input[name="foreigner"]').val();

        $('input[name="SendInfo"]').val(makeSendInfo(strNm, strNo, strRsn, strForeigner));

        $('#frmRealname')[0].submit();
    }
}

function fnGoFocus(nIndex) {
    location.href = "#position" + nIndex;
}

function fnDisplayToggle(obj) {
    $('.' + obj).css('display', $('.' + obj).css('display') == 'none' ? 'list-item' : 'none');
}
