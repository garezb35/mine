/*
 * @title		[포탈] 회원가입 폼 스크립트
 * @author		이주원
 * @date		2007.10. 8
 * @update		2011.10.07 - 회원가입개선(김보람)
 * @description
 */

var frm = null,
    Ftcapslock = false,
    Ftshift = false,
    strEmail = '';

function _init() {

    frm = $('#frmInfo');

    var userPassword = $('#user_password');
    var userPasswordVali = $('#user_password_validate');
    var checker = new FormChecker('frmInfo');
    checker.add({name: 'user_id', type: 'userid', protect: true, msg: '아이디는 4~12자의 영문/영문,숫자조합으로 이루어져야 합니다.'});
    // 아이디 중복 검사 체크
    checker.add({
        custom: function() {
            if ($(this).find('[name="user_id_check"]').val() == "N") {
                alert('아이디 중복 확인을 해주세요.');
                $('#user_id').val('').focus();
                return false;
            }

            return true;
        }
    });
    checker.add({name: 'user_password', type: 'password', msg: '비밀번호는 10~16자의 영문+숫자 조합으로 이루어져야 합니다.'});
    checker.add({name: 'user_password', type: 'four_string', msg: '연속된 4글자는 비밀번호로 사용할 수 없습니다.'});
    checker.add({
        custom: function() {
            var userMobileB = $('#user_mobileB');
            var userMobileC = $('#user_mobileC');

            // 비밀번호 \ 입력제한
            if (userPassword.val().indexOf('\\') !== -1) {
                alert('\\는 비밀번호 사용이 불가능합니다.');
                userPassword.val('').focus();
                return false;
            }

            // 비밀번호 확인
            if (userPassword.val() != userPasswordVali.val()) {
                alert('비밀번호 확인이 비밀번호와 같지 않습니다.');
                userPasswordVali.val('').focus();
                return false;
            }

            // 연락처(휴대폰)
            if ($('#slctMobile_type')[0].value != "N") {
                if (userMobileB.val().trim().length < 3) {
                    alert('연락처를 입력해주세요.');
                    userMobileB.focus();
                    return false;
                }

                if (userMobileC.val().trim().length < 4) {
                    alert('연락처를 입력해주세요.');
                    userMobileC.focus();
                    return false;
                }
            }

            return true;
        }
    });
    // 이메일체크
    checker.add({name: 'user_email', type: 'string', msg: '이메일을 입력해 주세요.'});
    checker.add({name: 'user_email_host', msg: '이메일을 서비스 업체를 선택해 주세요.'});
    checker.add({
        custom: function() {
            var emailDirect = $('[name="user_email_direct"]');
            var userMobileA = $('#user_mobileA');
            var userMobileB = $('#user_mobileB');
            var userMobileC = $('#user_mobileC');

            // 이메일 호스트 체크
            if ($('#slctEmail_host')[0].value == "direct") {
                if (emailDirect.val().isEmpty()) {
                    alert('도메인을 입력해주세요.');
                    emailDirect.focus();
                    return false;
                }

                if (!_form.validator.domain(emailDirect.val())) {
                    alert('잘못된 도메인입니다');
                    emailDirect.val('').focus();
                    return false;
                }
            }

            if ($('#user_email_check').val() != 'Y') {
                alert('이메일 중복확인을 해주세요.');
                return false;
            }

            // 비밀번호로 사용할 수 없는 값
            var pw = userPassword.val();

            if (pw.indexOf($('#user_id').val()) > -1) {
                alert('아이디는 비밀번호로 사용할 수 없습니다.');
                userPassword.val('').focus();
                userPasswordVali.val('');
                return false;
            }

            if ($("#slctMobile_type")[0].value.isEmpty() === false && $("#slctMobile_type")[0].value != "N" && (pw.indexOf(userMobileA.val()) > -1 || pw.indexOf(userMobileB.val()) > -1 || pw.indexOf(userMobileC.val()) > -1)) {
                alert('연락처는 비밀번호로 사용할 수 없습니다.');
                userPassword.val('').focus();
                userPasswordVali.val('');
                return false;
            }

            var link = window.location.href;
            if(link.indexOf('https') === -1) {
                link = link.substring(0, link.lastIndexOf("/"));
                link = link.replace("http://", "https://");
                link += "/join_form_ok.html";
            } else {
                link = 'join_form_ok.html';
            }

            $('#frmInfo').attr({
                action: link,
                target: ''
            });

            if (frm.find('[name="ci_v"]').val() == '3') {
                $('#frmInfo')[0].onsubmit = null;
                $('#frmInfo').submit();
            }
            else {
                fnCheckContact();
            }

            return false;
        }
    });

    $.extend(_form.protect, {
        id_help: function(input) {
            this.set(input,
                function() {
                },
                function() {
                    if (_form.validator.userid($('#user_id').val()) === true) {
                        $('#idCheck').html('');
                    } else {
                        $('#idCheck').html("<span class=\"text-rock font-weight-bold\">아이디는 4~12자 영문/숫자/영문+숫자 조합이여야합니다.</span>");
                    }
                    if ($('#captcha_check').val() == 'Y' && $('#captcha_area').hasClass('d-none')) {
                        $('#captcha_area').removeClass('d-none');
                        frm.find('[name="user_id_check"]').val("N");
                        captchaResets();
                    }
                    this.value = this.value.alltrim().toLowerCase();
                },
                function() {
                    idCheck();
                }
            );

            $('#user_id').focus(function() {
                if ($(this).val().isEmpty()) {
                    $('#idCheck').html('아이디를 입력하세요.');
                }
                else {
                    // $('#idCheck').html('4자~12자 영문+숫자');
                }
            });
        },
        password_help: function(input) {
            this.set(input,
                function(Event) {
                    var keycode = _event.keycode(Event);

                    if (keycode == 16) {
                        Ftshift = true;
                    }
                },
                function(Event) {
                    passwordCheck(Event);
                },
                function(Event) {

                }
            );
        }
    });

    _form.protect.id_help($('#user_id'));
    _form.protect.password_help(frm.find('[name="user_password"]'));
    _form.protect.number(frm.find('[name="user_mobileB"]'));
    _form.protect.number(frm.find('[name="user_mobileC"]'));
    _form.protect.number(frm.find('[name="user_bank_account"]'));
    _form.autotab(frm.find('[name="user_mobileB"]'), frm.find('[name="user_mobileC"]'));

    userPassword.on({
        focus: function(e) {
            var strHtml = '10~16자 / 영문+숫자or특수문자 조합이여야 합니다.';
            $('#muser_password').html(strHtml);
            passwordCheck(e);
        },
        keypress: function(e) {
            var keycode = _event.keycode(e);

            Ftcapslock = false;

            if ((keycode >= 65 && keycode <= 90) && !Ftshift) {
                Ftcapslock = true;
            }
            else if ((keycode >= 97 && keycode <= 122) && Ftshift) {
                Ftcapslock = true;
            }
        }
    });

    userPasswordVali.on({
        keyup: function() {
            if (this.value !== $('#user_password').val()) {
                $(this).removeClass('blue').addClass('red');
                $('#password_help2').html('<span class="text-rock font-weight-bold">미일치</span>');
            } else {
                $(this).removeClass('red').addClass('blue');
                $('#password_help2').html('<span class="f_blue3 font-weight-bold">일치</span>');
            }

        }
    });

    frm.find('[name="user_email"]').on({
        keyup: function() {
            var userEmail = frm.find('[name="user_email"]').val() + '@' + frm.find('[name="user_email_direct"]').val();

            if (userEmail != strEmail) {
                strEmail = '';
                $('#user_email_check').val('');
            }
        }
    });

    $('#slctEmail_host').change(function() {
        setEmailMode(this.value);
    });

    $('#emailCheckBtn').click(fnCheckEmail);

    $('#slctMobile_type').change(function() {
        setMobileMode(this.value);
    })

    if (frm.find('[name="ci_v"]').val() == '3') {
        $('#slctMobile_type, #user_mobileA').off('click');
    }

    if ($('#captcha_check').val() == 'Y') {
        captchaCheckView();
    }
}

function nextmove(nLength, nodeNext) {
    if (!nodeNext || nodeNext.getAttribute("disabled")) {
        return;
    }

    if (this.value.length >= nLength) {
        nodeNext.focus();
    }
}

function setEmailMode(value) {
    var frm = $('#frmInfo');

    if (value == 'direct') {
        frm.find('[name="user_email_direct"]').attr('disabled', false).css('background-color', '#FFF').val('').focus();
    }
    else {
        frm.find('[name="user_email_direct"]').attr('disabled', true).css('background-color', '#EEE').val(value);
    }
}

function setMobileMode(value) {
    var frm = $('#frmInfo'),
        g_this = $('#user_mobileA')[0];

    if (value == 'N') {
        $('#user_mobileB').val('').attr('disabled', true);
        $('#user_mobileC').val('').attr('disabled', true);

        g_this.setText('');
        g_this.setValue('');

        $(g_this).css('background-color', '#EEE').off('click');
    }
    else {
        $('#user_mobileB').attr('disabled', false);
        $('#user_mobileC').attr('disabled', false);

        $(g_this).css('background-color', '#FFF').click(function() {
            g_this.fnClick();
        });

        g_this.nodeList.children()[0].click();
    }
}

function setContactMode(value) {
    var frm = $('#frmInfo');

    if (value == 'N') {
        $('#user_contactB').val('').attr('disabled', true);
        $('#user_contactC').val('').attr('disabled', true);
    }
    else {
        $('#user_contactB').attr('disabled', false);
        $('#user_contactC').attr('disabled', false);
    }
}

function idCheck() {
    var frm = $('#frmInfo');

    if (_form.validator.userid($('#user_id').val())) {
        var paramsValue = _http.encodeURI("user_id=" + $('#user_id').val());

        if (bIdCheckAx == true) {
            var captchaText = $('#captcha_text');
            if (captchaText.val().isEmpty()) {
                alert('자동입력 방지문자를 입력해주세요.');
                captchaText.focus();
                return;
            }
            paramsValue += '&' + _http.encodeURI('captcha_text=' + captchaText.val()) + '&' + _http.encodeURI('captcha_data=' + $('#captcha_data').val());
        }
        fnAjax('userid_check.php', 'text', 'post', paramsValue, {complete: OnLoadIdCheck});
    }
    else if ($('#user_id').val().isEmpty()) {
        return false;
    }
    else {
        frm.find('[name="user_id_check"]').val("N");
        $('#idCheck').html("<span class=\"text-rock font-weight-bold\">아이디는 4~12자 영문/숫자/영문+숫자 조합이여야합니다.</span>");
        $('#user_id').val("").focus();
        if (bIdCheckAx == true) {
            captchaResets();
        }
    }
}

var bIdCheckAx = false;

function OnLoadIdCheck(request) {

    var frm = $('#frmInfo'),
        returnData = request.split(";");

    $('#idCheck').html('');

    if (returnData[2] == "move") {
        captchaCheckView();
    }
    if (returnData[0] == "true") {
        frm.find('[name="user_id_check"]').val("Y");
        $('#idCheck').html("<span class=\"f_blue3 font-weight-bold\">사용 가능한 아이디 입니다.</span>");
        $('#captcha_area').addClass('d-none');
    }
    else {
        // console.log(2);
        frm.find('[name="user_id_check"]').val("N");
        $('#idCheck').html("<span class=\"text-rock font-weight-bold\">" + returnData[1] + "</span>");
    }

    if (bIdCheckAx == true) {
        captchaResets();
    }
}

function captchaCheckView() {
    if ($('#captcha_area').hasClass('d-none')) {
        bIdCheckAx = true;
        $('#captcha_check').val('Y');
        $('#captcha_area').removeClass('d-none');
        $('#user_id').off('blur').on('blur', function() {
            $('#id_help').hide();
        });
        $('#idCheckBtn').on('click', idCheck);
    }
}

function captchaResets() {
    document.getElementById('captcha_text').value = '';
    document.getElementById('captcha_image').src = '/images/captcha/captcha_images.php?t=' + new Date().getTime();
}

function passwordCheck(e) {
    var keycode = _event.keycode(e);

    if (keycode == 16) {
        Ftshift = false;
    }

    var userPassword = $('#user_password');
    var strHtml = '';
    var safeCheck = false;

    if (_form.validator.password(userPassword.val())) {
        safeCheck = true;
    }

    if (Ftcapslock) {
        safeCheck = false;
    }

    if (safeCheck === true) {
        strHtml = '';
        userPassword.removeClass('red').addClass('blue');
        $('#password_help').html('<span class="f_blue3 font-weight-bold">안전</span>');

    } else {
        if (userPassword.val().isEmpty() === false) {
            strHtml = '10~16자 / 영문+숫자or특수문자 조합이여야 합니다.';
            userPassword.removeClass('blue').addClass('red');
            $('#password_help').html('<span class="text-rock font-weight-bold">사용불가</span>');
        } else {
            userPassword.removeClass('blue red');
            $('#password_help').html('');
        }
    }

    if (Ftcapslock) {
        strHtml += ' 키보드에 <span class="text-rock">CapsLock</span>이 켜져있습니다.';
    }

    if (userPassword.val().isEmpty() === true) {
        strHtml = '';
    }

    $('#muser_password').html(strHtml);
}

/* ▼ 연락처 중복체크 */
function fnCheckContact() {
    var slctMobileType = $('#slctMobile_type')[0].value,
        params = {
            user_id: $('#user_id').val(),
            join_flag: 'Y',
            contact_yn: 'N',
            mobile_yn: (slctMobileType == 'N') ? 'N' : 'Y'
        };

    // if(params['contact_yn'] == 'Y') {
    // 	params['user_contactA'] = slctContact;
    // 	params['user_contactB'] = $('#user_contactB').val();
    // 	params['user_contactC'] = $('#user_contactC').val();
    // }
    if (params['mobile_yn'] == 'Y') {
        params['user_mobileA'] = $('#user_mobileA')[0].value;
        params['user_mobileB'] = $('#user_mobileB').val();
        params['user_mobileC'] = $('#user_mobileC').val();
    }

    if ($('#frmInfo').find('[name="user_name"]').length > 0) {
        $('#certifyForm').find('[name="user_name"]').val($('#frmInfo').find('[name="user_name"]').val());
    }

    fnAjax('/_include/_user_contact_restrict.php', 'text', 'POST', params, {
        complete: function(res) {
            var rgResult = res.split('|');

            switch (rgResult[0]) {
                case 'S':
                    $('#frmInfo')[0].onsubmit = null;
                    $('#frmInfo').submit();
                    break;
                case 'C':
                    if (confirm(rgResult[1])) {
                        var certifyForm = $('#certifyForm');

                        certifyForm.find('[name="user_mobile_type"]').val(slctMobileType);
                        certifyForm.find('[name="user_mobileA"]').val(params['user_mobileA']);
                        certifyForm.find('[name="user_mobileB"]').val(params['user_mobileB']);
                        certifyForm.find('[name="user_mobileC"]').val(params['user_mobileC']);

                        _window.open('hp_auth', '', 420, 300);

                        certifyForm.attr({
                            target: 'hp_auth',
                            action: '/certify/ini_hpp_contact/user_certify_form.html'
                        }).submit();
                    }
                    break;
                default:
                    alert(rgResult[1]);
            }

        },
        error: function() {
            alert('서비스가 원할하지 않습니다. 잠시후 이용해 주세요.');
        }
    });
}

/* ▲ 연락처 중복체크 */

/* ▼ 이메일 중복체크 */
function fnCheckEmail() {
    var frm = $('#frmInfo');

    if (frm.find('[name="user_email"]').val().isEmpty()) {
        return alert('이메일을 입력해주세요.');
    }

    // 이메일 호스트 체크
    if ($("#slctEmail_host")[0].value.isEmpty()) {
        return alert('이메일 서비스 업체를 선택해 주세요.');
    }
    else if ($('#slctEmail_host')[0].value == "direct") {
        if (frm.find('[name="user_email_direct"]').val().isEmpty()) {
            alert('도메인을 입력해주세요.');

            return frm.find('[name="user_email_direct"]').focus();
        }
    }

    var userEmail = frm.find('[name="user_email"]').val() + '@' + frm.find('[name="user_email_direct"]').val();

    if (!_form.validator.email(userEmail)) {
        return alert('잘못된 이메일입니다.');
    }

    strEmail = '';

    fnAjax('/portal/user/useremail_check.html', 'text', 'POST', 'user_email=' + userEmail, {
        complete: function(res) {
            var rgResult = res.split(';');

            alert(rgResult[1]);

            if (rgResult[0] == 'true') {
                strEmail = userEmail;

                $('#user_email_check').val('Y');
            }
            else {
                $('#user_email_check').val('');
            }
        },
        error: function() {
            alert('접속이 원활하지 않습니다. 잠시 후 다시 시도해주세요.');

            $('#user_email_check').val('');
        }
    });
}

/* ▲ 이메일 중복체크 */

$(document).on('click', '.s_report', function(){
    var allChecked = $(this).attr('id');
    if(allChecked === 'select_all'){
        if($(this).is(':checked')){
            for(var i = 0; i < $('input[name*="s_report"]').length; i++){
                $('input[name*="s_report"]')[i].checked = true;
            }
        }else{
            for(var i = 0; i < $('input[name*="s_report"]').length; i++){
                $('input[name*="s_report"]')[i].checked = false;
            }
        }
    }
});

/* ▲ myOtp 로그인 */
