var t_Address = {
    zipcode : '',
    zipcodeA : '',
    zipcodeB : '',
    addressA : '',
    addressB : ''
}

function _init() {

    var frm		= $('#frmInfo'),
        checker	= new _form_checker(frm),
        confmKey = "U01TX0FVVEgyMDIxMDUyODA5NTkyNzExMTIxNjQ=";

    t_Address.zipcode = frm.find('[name="user_zipcode"]');
    t_Address.zipcodeA = frm.find('[name="user_zipcodeA"]');
    t_Address.zipcodeB = frm.find('[name="user_zipcodeB"]');
    t_Address.addressA = frm.find('[name="user_addressA"]');
    t_Address.addressB = frm.find('[name="user_addressB"]');

    //checker.add({inputObj:$('#user_password_find_validate'), protect:true, strType:'string', message:'비밀번호 재발급 답변을 입력해 주세요'});
    checker.add({custom:function() {
            // 연락처(자택/직장)
            if($('#user_contactA')[0].getValue() != 'N') {
                if($('#user_contactB').val().trim().length < 3) {
                    alert('잘못된 연락처입니다');

                    $('#user_contactB').focus();

                    return false;
                }

                if($('#user_contactC').val().trim().length < 4) {
                    alert('잘못된 연락처입니다');

                    $('#user_contactC').focus();

                    return false;
                }
            }

            // 연락처(휴대폰)
            if(frm.find('[name=user_mobile_type]').val() != 'N') {
                if($('#user_mobileB').val().trim().length < 3) {
                    alert('잘못된 연락처입니다');

                    $('#user_mobileB').focus();

                    return false;
                }

                if($('#user_mobileC').val().trim().length < 4) {
                    alert('잘못된 연락처입니다');

                    $('#user_mobileC').focus();

                    return false;
                }
            }



            var link = window.location.href;
            link = link.substring(0,link.lastIndexOf('/'));
            link = link.replace('http://','https://');
            link+= '/myinfo_modify_ok';

            $('#frmInfo').attr({
                target: '',
                action: link
            });

            fnCheckContact();

            return false;
        }});

    _form.protect.number($('#user_contactB'));
    _form.protect.number($('#user_contactC'));
    _form.protect.number($('#user_mobileB'));
    _form.protect.number($('#user_mobileC'));

    _form.autotab($('#user_contactB'), $('#user_contactC'));
    _form.autotab($('#user_mobileB'), $('#user_mobileC'));

    /* ▼ 휴대폰 인증 */
    $('#cellphone_auth_pop').click(function(){
        if(frm.find('[name=user_mobile_type]').val().isEmpty() || frm.find('[name=user_mobile_type]').val() == 'N') {
            alert('이동통신사를 선택하세요.');

            return false;
        }

        if(frm.find('[name=user_mobileA]').val().isEmpty()){
            alert('휴대폰번호를 입력하세요.');

            return false;
        }

        if($('#user_mobileB').val().trim().length < 3) {
            alert('잘못된 연락처입니다');

            $('#user_mobileB').focus();

            return false;
        }

        if($('#user_mobileC').val().trim().length < 4) {
            alert('잘못된 연락처입니다');

            $('#user_mobileC').focus();

            return false;
        }


        _window.open('reg_phone_auth', '', 430, 300);
        $('#frmInfo').attr({
            target : 'reg_phone_auth',
            action : '/certify/ini_modi_authcenter/user_certify',
        }).off('submit').submit();

        var link = window.location.href;
        link = link.substring(0,link.lastIndexOf('/'));
        link = link.replace('http://','https://');
        link+= '/myinfo_modify_ok.html';
        $('#frmInfo').attr({
            target: '_self',
            action: link
        });
    });
    /* ▲ 휴대폰 인증 */

    $('#bankmodify_btn').click(function () {
        _window.open('bankaccount_modify', 'https://'+ document.domain +'/myroom/mileage/payment/popup/bankaccount_modify_ssl', 660, 400);
    });

    if($('#slctMobile_type')[0].getValue() == 'N') {
        setMobileMode($('#slctMobile_type')[0].getValue());
    }

    if($('#user_contactA')[0].getValue() == 'N') {
        setContactMode($('#user_contactA')[0].getValue());
    }

    $('#user_mobileA').width(55);

    /* 광고 정보 수신 동의 */
    $('#sms_agree').on('click', function(e){
        e.preventDefault();

        if ($('#bSmsAccept').val() == 1) {
            fnSMSProcess(1);
            $('#bSmsAccept').val("");
        } else {
            fnSMSProcess(2);
            //$('#bSmsAccept').val(1);
        }
    });
    /* 광고 정보 수신 동의 */

    // ajax이메일 인증
    $('.email_auth_btn').on({
        click:function() {
            if (confirm($('#user_emai_check').val() + '에 인증메일 발송 하시겠습니까?')) {
                fnAjax('/certify/email/sendmail', 'xml', 'POST', '', {
                    complete: function (res) {
                        if ($(res).find('result').attr('type') == 'fail') {
                            alert($(res).find('result').attr('message'));
                        } else if ($(res).find('result').attr('type') == 'success') {
                            _window.open('auth_mail', '/certify/email/sendmail_ok', 440, 260);
                        }
                    },
                    error: function () {
                        alert('시스템 점검중입니다. 잠시 후 이용해 주세요.');
                    }
                });
            }
        }
    });

    $('#find_address').on('click', function (){
        _window.open("find_address","https://www.juso.go.kr/addrlink/addrLinkUrl.do?confmKey="+ confmKey +"&returnUrl=https://"+ document.domain +"/myroom/myinfo/myinfo_send_address","660", "400");
    });
}

function setMobileMode(value){
    var frm		= $('#frmInfo'),
        g_this	= $('#user_mobileA')[0];

    if(value == 'N') {
        $('#user_mobileB').val('').attr('disabled', true);
        $('#user_mobileC').val('').attr('disabled', true);

        g_this.setText('');
        g_this.setValue('');

        $(g_this).css('background-color','#EEE').off('click');
    }
    else {
        $('#user_mobileB').attr('disabled', false);
        $('#user_mobileC').attr('disabled', false);

        $(g_this).css('background-color','#FFF').click(function() {
            g_this.fnClick();
        });

        g_this.nodeList.children()[0].click();
    }
}

function setContactMode(value){
    var frm = $('#frmInfo');

    if(value == 'N') {
        $('#user_contactB').val('').attr('disabled', true);
        $('#user_contactC').val('').attr('disabled', true);
    }
    else {
        $('#user_contactB').attr('disabled', false);
        $('#user_contactC').attr('disabled', false);
    }
}

/* ▼ 연락처 중복체크 */
function fnCheckContact() {
    var slctContact		= $('#user_contactA')[0].getValue(),
        slctMobileType	= $('#slctMobile_type')[0].getValue(),
        params			= {
            user_id: $('#user_id').val(),
            contact_yn: (slctContact == 'N') ? 'N' : 'Y',
            mobile_yn: (slctMobileType == 'N') ? 'N' : 'Y'
        };

    if(params['contact_yn'] == 'Y') {
        params['user_contactA'] = slctContact;
        params['user_contactB'] = $('#user_contactB').val();
        params['user_contactC'] = $('#user_contactC').val();
    }
    if(params['mobile_yn'] == 'Y') {
        params['user_mobileA'] = $('#user_mobileA')[0].getValue();
        params['user_mobileB'] = $('#user_mobileB').val();
        params['user_mobileC'] = $('#user_mobileC').val();
    }

    if($('#frmInfo').find('[name="user_name"]').length > 0) {
        $('#certifyForm').find('[name="user_name"]').val($('#frmInfo').find('[name="user_name"]').val());
    }
    params['api_token'] = a_token;
    fnAjax('/api/_include/_user_contact_restrict', 'text', 'POST', params, {
        complete: function(res) {
            var rgResult = res.split('|');

            switch(rgResult[0]) {
                case 'S':	$('#frmInfo').off('submit').submit();	break;
                case 'C':
                    if(confirm(rgResult[1])) {
                        var certifyForm = $('#certifyForm');

                        certifyForm.find('[name="user_mobile_type"]').val(slctMobileType);
                        certifyForm.find('[name="user_mobileA"]').val(params['user_mobileA']);
                        certifyForm.find('[name="user_mobileB"]').val(params['user_mobileB']);
                        certifyForm.find('[name="user_mobileC"]').val(params['user_mobileC']);

                        _window.open('hp_auth', '', 420, 300);

                        certifyForm.attr({
                            target: 'hp_auth',
                            action: '/certify/ini_hpp_contact/user_certify_form'
                        }).submit();
                    }

                    break;
                default:	alert(rgResult[1]);
            }

        },
        error: function() {
            alert('서비스가 원할하지 않습니다. 잠시후 이용해 주세요.');
        }
    });
}
/* ▲ 연락처 중복체크 */


/* 광고 정보 수신 동의 */

function fnAllAgree(states){
    if(states == 1){ //모두 수신 거부

        fnSMSProcess(1);
        fnAgreeStateChange(2);
        $('[name="email_agree"]').prop('checked', false);
        $('[name="naver_smart_alarm"]').prop('checked', false);
        $('#bSmsAccept').val("");
    }
    else if(states == 2){ //모두 수신 허용

        // if($('[name="sms_agree"]').prop('checked') == false && $('#cell_auth').val() == "0"){ //sms 인증 미동의 + 휴대폰 인증 미완료
        _window.open('certify', '/certify/payment/user_certify2?wis=SM', 500, 500);


        fnAgreeStateChange(1);
        $('[name="email_agree"]').prop('checked', true);
        $('[name="naver_smart_alarm"]').prop('checked', true);
        //$('#bSmsAccept').val(1);

    }
}

//광고 정보 수신 동의 버튼 상태 변경 함수
function fnAgreeStateChange(states){
    if(states == 1) {
        $('#agreeState').attr({
            'onclick'	: 'fnAllAgree(1)',
            'class'		: 'btn_gray1'
        }).text('모두 수신 거부');

    }
    else if(states == 2) {
        $('#agreeState').attr({
            'onclick'	: 'fnAllAgree(2)',
            'class'		: 'btn_blue1'
        }).text('모두 수신 허용');
    }
}

/* 광고 정보 수신 동의 */


/* SMS 수신 처리 */
function fnSMSProcess(tp){
    if(tp == 1) {
        var frm = document.frmInfo;
        var strPhone = frm.before_user_mobileA.value + '-' + frm.before_user_mobileB.value + '-' + frm.before_user_mobileC.value;
        if(confirm(strPhone + '번호를\nSMS 수신거부 하시겠습니까?')) {
            var params = $('#smsFrm').serialize();
            fnAjax('/portal/myzone/myinfo/myinfo_modify_sms_reject','text','POST',params,{
                complete: function(res) {
                    if(res == 'SUCC') {
                        alert(strPhone + ' 번호가\nSMS 수신 거부 처리되었습니다.');
                        fnSMSStateChange(2);
                    } else {
                        alert(res);
                    }
                }
            });
        }
    }
    else {
        //if($('#cell_auth').val() == "0") {
        _window.open('certify', '/certify/payment/user_certify2?wis=SM', 500, 500);

    }
}

/* SMS 수신 상태 변경 */
function fnSMSStateChange(tp){
    if(tp == 1) {
        $('#sms_agree').prop('checked', true);
        $('#bSmsAccept').val(1);
    }
    else if(tp == 2) {
        $('#sms_agree').prop('checked', false);
    }
}

function fnSMSStateChange_(tp){
    if(tp == 1) {
        $('#smsBtn').attr({
            'onclick'	: 'fnSMSProcess(1)',
            'class'		: 'btn_gray1'
        }).text('SMS 수신거부');
        $('#smsSate').text('수신가능');

    }
    else if(tp == 2) {
        $('#smsBtn').attr({
            'onclick'	: 'fnSMSProcess(2)',
            'class'		: 'btn_blue1'
        }).text('SMS 수신하기');
        $('#smsSate').text('수신안함');
    }
}
