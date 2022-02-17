var cardCode = '',
    currentPhonePG = 'galaxia',
    currentCardPG = 'galaxia2',
    currentCardLimit = false,
    select_cellcorp = 0,
    simpleTradeParams = null,
    currentCardCode = null;

var g_trade_info = {
    id: null,
    subject: null,
    price: null,
    coupon: null,
    coupon_price: null,
    node: null,
    nodePrice: null,
    trade_type: null,
    creditCode: null
};

function _init() {
    var screenshot = document.getElementsByClassName('screenshot');
    var scLen = screenshot.length;
    for(var i=0; i<scLen; i++) {
        screenshot[i].getElementsByTagName('a')[0].addEventListener('click', function(evt) {
            var idx = this.getAttribute('data-idx');
            var info = document.getElementById('screenshot_info').value;
            _window.open('imgview', '/myroom/sell/image_viewer.html?idx='+idx+'&info='+info, 2000, 1000,'scrollbars=yes');
        })
    }
}

function useMileage() {
    var frm = $('#frmPayment');

    var paymentPrice = 0;

    var useMileage = frm.find('#use_mileage').val();

    useMileage = useMileage.replace(/[,]+/g, "");

    if (useMileage >= g_trade_info.price) {
        alert("사용할 마일리지는 거래금액보다 작아야합니다.");
        frm.find('#use_mileage').val(0);
        frm.find('#use_mileage').focus();
        useMileage = 0;
    }

    paymentPrice = g_trade_info.price - useMileage;

    frm.find('input[name="use_creditcard"]').val(paymentPrice.currency());
}

function useMileageCheck(obj) {
    if (obj.val().isEmpty()) {
        obj.val(0);
        return;
    }

    var mileage = Number(obj.val().replace(/[,]+/g, ""));
    var nLen = mileage.toString().length;
    if (isNaN(mileage) || mileage < 10 || mileage.toString().substring(nLen - 1, nLen) != "0") {
        alert('마일리지는 일원단위로 사용하실 수 없습니다.');
        useMileage();
        obj.val('');
        obj.focus();
        return;
    }
}

function Payment() {
    var frm = $('#frmPayment');

    var useMileage = frm.find('#add_pay').text();
    useMileage = useMileage.replace(/[,]+/g, "");

    // if (Number(useMileage) >= 0) {
    //     alert("구매할 수 있는 마일리지가 부족합니다.");
    //     return;
    // }

    nodemonPopup.enable($("#dvGoodsInfo"));
}

function fnSubmit() {
    debugger
    var frm = $('#frmPayment');
    var securityType = $('#security_type').val();

    // if (securityType !== 'PASS') {
    //     var strUrl = '';
    //     if (securityType === 'MYPIN') {
    //         strUrl = site_dns_s + "/myroom/myinfo/my_pin_use.html";
    //     } else {
    //         strUrl = "/certify/payment/user_certify";
    //     }
    //
    //     var pop = _window.open('pay', '', 600, 400, '', true);
    //     frm.attr({
    //         target: "pay",
    //         action: strUrl
    //     });
    //
    //     $("#dvGoodsInfo").hide();
    //     $('#global_root').show();
    //     frm.submit();
    //
    //     var interval = setInterval(function() {
    //         if (pop.closed) {
    //             $('#global_root').hide();
    //             clearInterval(interval);
    //         }
    //     }, 500);
    // } else {
    //     frm.attr({
    //         target: "_self",
    //         action: "/myroom/buy/buy_pay_wait_ok"
    //     }).submit();
    // }
    frm.attr({
        target: "_self",
        action: "/myroom/buy/buy_pay_wait_ok"
    }).submit();
}

function PaymentCancel() {
    if (!confirm("결제를 취소하겠습니까?")) {
        return false;
    }

    var frmPayment = $('#frmPayment');
    frmPayment.attr('action', "/buy_pay_wait_cancel").submit();
}


function PaymentCancel_sell() {
    if (confirm("물품 구매를 취소하겠습니까?")) {
        var frmPayment = $('#frmPayment');
        frmPayment.attr('action', "/application_payWaitCancel?list=" + g_s_list).submit();
    }
}

var samsungpay_pop;
function samsunpay_pay(form) {

    // 휴대폰
    if (g_trade_info.creditCode == 'k') {
        var frm = $("#frmPayment");
        samsungpay_pop = window.open('', 'samsungpay_pop', 'width=500,height=660,status=yes,scrollbars=no,resizable=no,left=100,top=100');

        $('#use_mileage').removeAttr('disabled');
        frm.attr({
            target: 'samsungpay_pop',
            action: '/myroom/payment/samsungpay/Ready.php',
        }).submit();
    } else if (g_trade_info.creditCode == 's') { // 신용카드

        var frm = $("#frmPayment");
        samsungpay_pop = window.open('', 'samsungpay_pop', 'width=500,height=660,status=yes,scrollbars=no,resizable=no,left=100,top=100');

        $('#use_mileage').removeAttr('disabled');
        // frm.find('[name=creditCode]').val(g_trade_info.creditCode);
        frm.append("<input type='hidden' name='installment' value='" + form.find('[name="intrange"]').val() + "'>");
        frm.attr({
            target: 'samsungpay_pop',
            action: '/myroom/payment/samsungpay/Ready.php',
        }).submit();

    } else {
        return false;
    }

}

var ars_pop;

function Card(card_form) {
    if (card_form.find('[name="ini_onlycardcode"]').val().isEmpty()) {
        alert("카드를 선택하세요!");
        return;
    }

    CreditCardLimitCheck.request(card_form);

    if (currentCardLimit == true) {
        this.form = card_form[0];
        if (this.form.clickcontrol.value == "enable") {
            if (currentCardPG == "inicis" || currentCardPG == "inicis2") {
                // 플러그인 설치유무 체크
                if (document.INIpay == null || document.INIpay.object == null) {
                    if (_BROWSER.name == 'explorer') {
                        alert('\n이니페이 플러그인 128이 설치되지 않았습니다. \n\n안전한 결제를 위하여 이니페이 플러그인 128의 설치가 필요합니다. \n\n다시 설치하시려면 Ctrl + F5키를 누르시거나 메뉴의 [보기/새로고침]을 선택하여 주십시오.');
                    } else {
                        alert('선택하신 결제수단은 인터넷익스플로어(IE) 브라우저에서 지원됩니다.\n죄송하지만 다른 결제수단을 이용하거나 인터넷익스플로어(IE)에서 결제를 진행해 주시기 바랍니다.');
                    }

                    return false;
                } else {
                    if (currentCardPG == "inicis2") {
                        card_form.find('[name="dnum"]').val('4');

                        ars_pop = _window.open('card_payment', '', 500, 345, '', true);
                        card_form.attr({
                            'target': 'card_payment',
                            'action': '/payment/certify.html'
                        }).submit();
                    } else {
                        fnInicisMakePay();
                    }
                }
            } else if (currentCardPG == "danal") {
                Card_disable_click();

                card_form.find('[name="dnum"]').val('1');

                _window.open('card_payment', '', 500, 345);
                card_form.attr({
                    'target': 'card_payment',
                    'action': '/payment/certify.html'
                }).submit();
            } else if (currentCardPG == "danal2") {
                Card_disable_click();

                card_form.find('[name="dnum"]').val('2');

                _window.open('card_payment', '', 500, 345);
                card_form.attr({
                    'target': 'card_payment',
                    'action': '/payment/certify.html'
                }).submit();
            } else if (currentCardPG == "danal3") {
                Card_disable_click();

                card_form.find('[name="dnum"]').val('3');

                _window.open('card_payment', '', 695, 508);
                card_form.attr({
                    'target': 'card_payment',
                    'action': '/payment/certify.html'
                }).submit();
            } else if (currentCardPG == "lguplus") {
                Card_disable_click();

                card_form.find('[name="dnum"]').val('5');

                _window.open('card_payment', '', 695, 508);
                card_form.attr({
                    'target': 'card_payment',
                    'action': '/payment/certify.html'
                }).submit();
            } else if (currentCardPG == "galaxia" || currentCardPG == "galaxia2") {
                Card_disable_click();

                card_form.find('[name="dnum"]').val('6');

                _window.open('card_payment', '', 695, 508);
                card_form.attr({
                    'target': 'card_payment',
                    'action': '/payment/certify.html'
                }).submit();
            }
        }
    } else {
        return;
    }
}

function fnInicisMakePay() {
    if (ars_pop) {
        ars_pop.close();
    }

    setTimeout(function() {
        if (MakePayMessage(this.form)) {
            Card_disable_click();
            $(this.form).attr({
                'target': '_self',
                'action': '/myroom/payment/card/INIsecureresult.php'
            }).submit();
        }
    }, 100);
}

function Card_enable_click() {
    document.card_Form.clickcontrol.value = "enable";
}

function Card_disable_click() {
    document.card_Form.clickcontrol.value = "disable";
}

function Phone() {
    form = $('[name="phone_Form"]');
    form2 = $('[name="phone_Form2"]');
    form3 = $('[name="phone_Form3"]');
    form4 = $('[name="phone_Form4"]');
    form5 = $('[name="phone_Form5"]');
    form6 = $('[name="phone_Form6"]');

    pg_Name = currentPhonePG;


    if (pg_Name == 'inicis') {
        form2.find('[name="telno1"]').val(form.find('[name="telno1"]').val());
        form2.find('[name="telno2"]').val(form.find('[name="telno2"]').val());
        form2.find('[name="telno3"]').val(form.find('[name="telno3"]').val());
        form2.find('[name="telcorp"]').val(form.find('[name="telcorp"]').val());
        form2.find('[name="personalid1"]').val(form.find('[name="personalid1"]').val());
        form2.find('[name="personalid2"]').val(form.find('[name="personalid2"]').val());
        form2.find('[name="buyer_email"]').val(form.find('[name="buyer_email"]').val());
        sendMsg2();
    } else if (pg_Name == 'galaxia' || pg_Name == 'galaxia2') {

        form4.find('[name="galaxia_telno1"]').val(form.find('[name="telno1"]').val());
        form4.find('[name="galaxia_telno2"]').val(form.find('[name="telno2"]').val());
        form4.find('[name="galaxia_telno3"]').val(form.find('[name="telno3"]').val());
        form4.find('[name="galaxia_telcorp"]').val(form.find('[name="telcorp"]').val());
        form4.find('[name="galaxia_personalid1"]').val(form.find('[name="personalid1"]').val());
        form4.find('[name="galaxia_personalid2"]').val(form.find('[name="personalid2"]').val());
        form4.find('[name="buyer_email"]').val(form.find('[name="buyer_email"]').val());

        if (pg_Name == 'galaxia2') {
            sendMsg5();
        } else {
            sendMsg4();
        }

    } else if (pg_Name == 'mobil') {
        form5.find('[name="mobil_telno1"]').val(form.find('[name="telno1"]').val());
        form5.find('[name="mobil_telno2"]').val(form.find('[name="telno2"]').val());
        form5.find('[name="mobil_telno3"]').val(form.find('[name="telno3"]').val());
        form5.find('[name="mobil_personalid1"]').val(form.find('[name="personalid1"]').val());
        form5.find('[name="mobil_personalid2"]').val(form.find('[name="personalid2"]').val());
        form5.find('[name="buyer_email"]').val(form.find('[name="buyer_email"]').val());

        sendMsg6();

    } else if (pg_Name == 'danal') {
        form6.find('[name="danal_telno1"]').val(form.find('[name="telno1"]').val());
        form6.find('[name="danal_telno2"]').val(form.find('[name="telno2"]').val());
        form6.find('[name="danal_telno3"]').val(form.find('[name="telno3"]').val());
        form6.find('[name="danal_personalid1"]').val(form.find('[name="personalid1"]').val());
        form6.find('[name="danal_personalid2"]').val(form.find('[name="personalid2"]').val());
        form6.find('[name="buyer_email"]').val(form.find('[name="buyer_email"]').val());

        sendMsg7();
    }
}

// 파라미터 검사 및 결제요청(이니시스)
function sendMsg2() {
    form = $('[name="phone_Form2"]');

    // 휴대폰 번호
    if (form.find('[name="telno2"]').val().length < 3 || form.find('[name="telno3"]').val().length < 4) {
        alert("휴대폰 번호를 입력하세요!");
        $('[name="phone_Form2"]').find('[name="telno2"]').focus();
        return;
    }

    // 이메일 체크
    if (form.find('[name="buyer_email"]').val().length < 5) {
        alert("올바른 이메일주소를 입력하세요!!");
        $('[name="phone_Form2"]').find('[name="buyer_email"]').focus();
        return;
    }

    if (form.find('[name="authCheck"]').val() == "TRUE") {
        form.find('[name="authCheck"]').val("FALSE");
        form.attr({
            action: '/myroom/buy/phone/INIsecureHPP.php',
            target: 'hpp'
        }).submit();

        $('.btn-groups_angel').find('img').hide();

    } else {
        alert("인증 버튼을 두번 이상 클릭이 안됩니다.");
        return false;
    }
}

// 파라미터 검사 및 결제요청(겔럭시아컴즈)
function sendMsg4() {
    form = $('[name="phone_Form4"]');

    // 휴대폰 번호
    if (form.find('[name="galaxia_telno2"]').val().length < 3 || form.find('[name="galaxia_telno3"]').val().length < 4) {
        alert("휴대폰 번호를 입력하세요!");
        $('[name="phone_Form4"]').find('[name="telno2"]').focus();
        return;
    }

    // 이메일 체크
    if (form.find('[name="buyer_email"]').val().length < 5) {
        alert("올바른 이메일주소를 입력하세요!!");
        $('[name="phone_Form4"]').find('[name="buyer_email"]').focus();
        return;
    }

    if (form.find('[name="authCheck"]').val() == "TRUE") {
        form.find('[name="authCheck"]').val("FALSE");
        _window.open('openhpp', '', 500, 447);
        form.attr({
            action: '/myroom/buy/phone/galaxia_mobile/pay.php',
            target: 'openhpp'
        }).submit();

        $('.btn-groups_angel').find('img').hide();

    } else {
        alert("인증 버튼을 두번 이상 클릭이 안됩니다.");
        return false;
    }
}

// 파라미터 검사 및 결제요청(겔럭시아컴즈 2채널)
function sendMsg5() {

    form = $('[name="phone_Form4"]');

    // 휴대폰 번호
    if (form.find('[name="galaxia_telno2"]').val().length < 3 || form.find('[name="galaxia_telno3"]').val().length < 4) {
        alert("휴대폰 번호를 입력하세요!");
        $('[name="phone_Form4"]').find('[name="telno2"]').focus();
        return;
    }

    // 이메일 체크
    if (form.find('[name="buyer_email"]').val().length < 5) {
        alert("올바른 이메일주소를 입력하세요!!");
        $('[name="phone_Form4"]').find('[name="buyer_email"]').focus();
        return;
    }

    if (form.find('[name="authCheck"]').val() == "TRUE") {
        form.find('[name="authCheck"]').val("FALSE");
        _window.open('openhpp', '', 500, 447);
        form.attr({
            action: '/myroom/buy/phone/galaxia_two/twoChannelCertify.php',
            target: 'openhpp'
        }).submit();

        $('.btn-groups_angel').find('img').hide();

    } else {
        alert("인증 버튼을 두번 이상 클릭이 안됩니다.");
        return false;
    }
}

// 파라미터 검사 및 결제요청(모빌리언스)
function sendMsg6() {
    form = $('[name="phone_Form5"]');

    // 휴대폰 번호
    if (form.find('[name="mobil_telno2"]').val().length < 3 || form.find('[name="mobil_telno3"]').val().length < 4) {
        alert("휴대폰 번호를 입력하세요!");
        $('[name="phone_Form5"]').find('[name="telno2"]').focus();
        return;
    }

    // 이동통신사
    if (select_cellcorp < 1) {
        alert('이동통신사를 선택해주세요.');

        return false;
    }

    // 이메일 체크
    if (form.find('[name="buyer_email"]').val().length < 5) {
        alert("올바른 이메일주소를 입력하세요!!");
        $('[name="phone_Form5"]').find('[name="buyer_email"]').focus();
        return;
    }

    if (form.find('[name="authCheck"]').val() == "TRUE") {
        form.find('[name="authCheck"]').val("FALSE");
        _window.open('openhpp', '', 500, 447);
        form.attr({
            action: '/myroom/buy/phone/mobilians/mc_web.php',
            target: 'openhpp'
        }).submit();

        $('.btn-groups_angel').find('img').hide();

    } else {
        alert("인증 버튼을 두번 이상 클릭이 안됩니다.");
        return false;
    }
}

// 파라미터 검사 및 결제요청(다날)
function sendMsg7() {
    form = $('[name="phone_Form6"]');

    // 휴대폰 번호
    if (form.find('[name="danal_telno2"]').val().length < 3 || form.find('[name="danal_telno3"]').val().length < 4) {
        alert("휴대폰 번호를 입력하세요!");
        $('[name="phone_Form6"]').find('[name="telno2"]').focus();
        return;
    }

    // 이동통신사
    if (select_cellcorp < 1) {
        alert('이동통신사를 선택해주세요.');

        return false;
    }

    // 이메일 체크
    if (form.find('[name="buyer_email"]').val().length < 5) {
        alert("올바른 이메일주소를 입력하세요!!");
        $('[name="phone_Form6"]').find('[name="buyer_email"]').focus();
        return;
    }

    if (form.find('[name="authCheck"]').val() == "TRUE") {
        form.find('[name="authCheck"]').val("FALSE");
        _window.open('openhpp', '', 500, 447);
        form.attr({
            action: '/myroom/buy/phone/danal/Ready.php',
            target: 'openhpp'
        }).submit();

        $('.btn-groups_angel').find('img').hide();

    } else {
        alert("인증 버튼을 두번 이상 클릭이 안됩니다.");
        return false;
    }
}

function fnCreditViewCheck() {
    var infoId = $('#infoId').val();
    var params = 'id=' + infoId;

    ajaxRequest({
        url: '/user/credit_ajax.php?t=' + (new Date()).getTime(),
        type: 'POST',
        data: params,
        success: function(res) {
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


function cardChange(cardCode) {
}

var tcash_pop;
var tcash_interval;
var CPayment = {};
$.extend(CPayment, {

    xhr: null,
    xml: null,
    xsl: {creditcard: null, mobile: null},
    type: "",
    request: function(type) {
        var frm = $("#frmPayment");
        var params = "";

        if (g_trade_info.id.isEmpty() || g_trade_info.trade_type != "sell" || (type != "creditcard" && type != "mobile" && type != "creditcard_sell" && type != "mobile_sell" && type != 'tcash' && type != 'samsungpay'&& type != 'samsungpay_sell')) {
            alert('잘못된 페이지입니다.');
            window.location.href = "/";
            return;
        }
        this.type = type;

        cardCode = currentCardCode;

        if (this.type == "creditcard" || this.type == "creditcard_sell") {
            params = "id=" + g_trade_info.id + "&trade_type=" + g_trade_info.trade_type + "&price=" + g_trade_info.price + "&cardCode=" + cardCode;
            if (currentCardPG == "danal" || currentCardPG == "danal2" || currentCardPG == "danal3") {
                fnAjax("/payment/creditcard_danal.php", "xml", "post", params, {
                    self: this,
                    complete: this.OnXML,
                    error: this.OnError
                });
            } else if (currentCardPG == "inicis2") {
                fnAjax("/payment/creditcard_inicis2.php", "xml", "post", params, {
                    self: this,
                    complete: this.OnXML,
                    error: this.OnError
                });
            } else if (currentCardPG == "lguplus") {
                fnAjax("/payment/creditcard_lguplus.php", "xml", "post", params, {
                    self: this,
                    complete: this.OnXML,
                    error: this.OnError
                });
            } else if (currentCardPG == "galaxia" || currentCardPG == "galaxia2") {
                params = params + "&type=" + currentCardPG;
                fnAjax("/payment/creditcard_galaxia.php", "xml", "post", params, {
                    self: this,
                    complete: this.OnXML,
                    error: this.OnError
                });
            } else {
                fnAjax("/payment/creditcard.php", "xml", "post", params, {
                    self: this,
                    complete: this.OnXML,
                    error: this.OnError
                });
            }
        } else if (this.type == 'tcash') {
            tcash_pop = window.open('', 'tcash_pop', 'width=500,height=660,status=yes,scrollbars=no,resizable=no,left=100,top=100');

            $('#use_mileage').removeAttr('disabled');
            frm.find('[name=price]').val(g_trade_info.price);

            frm.attr({
                target: 'tcash_pop',
                action: '/myroom/payment/tcash/tcash_reg.html'
            }).submit();

            tcash_interval = setInterval(function() {
                if (tcash_pop.closed) {
                    if (typeof g_s_list == 'undefined') {
                        $('#frmPayment').attr('action', 'buy_pay_wait_cancel.php').removeAttr('target').submit();
                    } else {
                        $('#frmPayment').attr('action', 'application_payWaitCancel.php?list=' + g_s_list).removeAttr('target').submit();
                    }

                    clearInterval(tcash_interval);
                }
            }, 500);
        } else if (this.type == 'samsungpay_sell') {
            params = "id=" + g_trade_info.id + "&trade_type=" + g_trade_info.trade_type + "&price=" + g_trade_info.price + "&bankcode=" + g_trade_info.creditCode;
            ajaxRequest({
                url: '/payment/samsungpay_credit.php',
                dataType: 'xml',
                type: 'post',
                data: params,
                scope: this,
                success: this.OnXML,
                error: this.OnError
            });
        }  else if (this.type == 'samsungpay') {

        } else {

            params = 'id=' + g_trade_info.id + '&trade_type=' + g_trade_info.trade_type + '&price=' + g_trade_info.price + '&pg=' + currentPhonePG;
            ajaxRequest({
                url: '/payment/mobile.php',
                dataType: 'xml',
                type: 'post',
                data: params,
                scope: this,
                success: this.OnXML,
                error: this.OnError
            });
        }
    },
    OnXML: function(request) {
        this.xml = request;
        if (!this.xml) {
            alert('메세지를 불러오지 못했습니다.\n\n다시 시도해 주세요.');
            window.location.reload();
        }

        var paymentInfo = _xml.getElement(this.xml, "payment", 0);
        if (!paymentInfo) {
            document.write(request.responseText);
            return;
        } else if (paymentInfo.getAttribute("result") == "fail") {
            alert(paymentInfo.getAttribute("reason"));
            if ((this.type == "creditcard" || this.type == "creditcard_sell") && this.xsl[this.type] != null) {
                document.card_Form.ini_onlycardcode.selectedIndex = 0;
            }
            return;
        }

        if (this.xsl[this.type]) {
            this.parser();
            return;
        }

        if (this.type == "creditcard" || this.type == "creditcard_sell") {
            if (currentCardPG == "danal") {
                fnAjax("/payment/xslt/" + this.type + "_danal.xsl", "xml", "get", "key=20190108", {
                    self: this,
                    complete: this.OnXSLT,
                    error: this.OnError
                });
            } else if (currentCardPG == "danal2") {
                fnAjax("/payment/xslt/" + this.type + "_danal2.xsl", "xml", "get", "key=20190108", {
                    self: this,
                    complete: this.OnXSLT,
                    error: this.OnError
                });
            } else if (currentCardPG == "danal3") {
                fnAjax("/payment/xslt/" + this.type + "_danal3.xsl", "xml", "get", "key=20190108", {
                    self: this,
                    complete: this.OnXSLT,
                    error: this.OnError
                });
            } else if (currentCardPG == "lguplus") {
                fnAjax("/payment/xslt/" + this.type + "_lguplus.xsl", "xml", "get", "key=20190108", {
                    self: this,
                    complete: this.OnXSLT,
                    error: this.OnError
                });
            } else if (currentCardPG == "galaxia" || currentCardPG == "galaxia2") {
                fnAjax("/payment/xslt/" + this.type + "_galaxia.xsl", "xml", "get", "key=20190108", {
                    self: this,
                    complete: this.OnXSLT,
                    error: this.OnError
                });
            } else {
                fnAjax("/payment/xslt/" + this.type + ".xsl", "xml", "get", "key=20190108", {
                    self: this,
                    complete: this.OnXSLT,
                    error: this.OnError
                });
            }
        }
        // 삼성페이 xsl 가져오기
        else if (this.type == "samsungpay" || this.type == "samsungpay_sell") {
            // 휴대폰
            if (g_trade_info.creditCode == 'k') {
                fnAjax("/payment/xslt/" + this.type + "_phone.xsl", "xml", "get", "key=20190108", {
                    self: this,
                    complete: this.OnXSLT,
                    error: this.OnError
                });
            }
            // 신용카드
            else if (g_trade_info.creditCode == 's') {
                fnAjax("/payment/xslt/" + this.type + "_credit.xsl", "xml", "get", "key=20190108", {
                    self: this,
                    complete: this.OnXSLT,
                    error: this.OnError
                });
            }
        } else {
            fnAjax("/payment/xslt/" + this.type + ".xsl", "xml", "get", "key=20190108", {
                self: this,
                complete: this.OnXSLT,
                error: this.OnError
            });
        }
    },
    OnXSLT: function(request) {
        if (request) {
            this.xsl[this.type] = request;
            this.parser();

            if ((this.type == "creditcard" || this.type == "creditcard_sell") && cardCode && cardCode.length > 0) {
                for (var i = 0; i < document.card_Form.ini_onlycardcode.length; i++) {
                    if (document.card_Form.ini_onlycardcode[i].value == cardCode) {
                        document.card_Form.ini_onlycardcode[i].selected = true;
                    }
                }
            }

            $('#select_cellcorp').on({
                change: function() {
                    select_cellcorp = $(this).val();

                    $('input[name=mobil_telcorp]').val(select_cellcorp);
                    $('input[name=danal_telcorp]').val(select_cellcorp);

                    if (select_cellcorp == 0) {
                        $('ul.cell_ul li input.g_radio').attr({
                            checked: false,
                            disabled: false
                        });
                    } else {
                        $('ul.cell_ul li input.g_radio').attr({
                            checked: false,
                            disabled: true
                        });
                    }
                }
            });

            $('[name=cellcorp]').on({
                click: function() {
                    var cellcorp = $('[name=cellcorp]:checked');

                    select_cellcorp = cellcorp.val();

                    $('input[name=mobil_telcorp]').val(cellcorp.val());
                    $('input[name=danal_telcorp]').val(cellcorp.val());
                }
            });

            var params = 'pg=' + currentCardPG + '&code=' + cardCode;

            ajaxRequest({
                url: '/payment/creditcard_ajax.php',
                dataType: 'json',
                type: 'post',
                data: params,
                success: function(response) {
                    if (response === null) {
                        return;
                    }

                    var strLimit = '';

                    if (response.limit != '') {
                        strLimit = '결제한도 : ' + response.limit;
                    }

                    $('#card_limit').show();
                    $('#card_limit').parent().css('padding', '5px 0px 5px 10px');
                    $('#card_limit').css('margin-top', '3px');

                    if (response.certify != '') {
                        if (strLimit != '') {
                            strLimit += '<br />';
                        }

                        strLimit += '인증방식 : ' + response.certify;
                    }

                    $('#card_limit').html(strLimit);
                },
                error: function() {
                    $('#card_limit').hide();
                    $('#card_limit').html('');
                }
            });

//			$('[name="buyeremail"]').bind({
//				focus : function () {
//					rgTaboo = new Array(114,115,116,117,118,121,122);
//				},
//				blur : function () {
//					rgTaboo = new Array(114,115,116,117,118,121,122,8);
//				},
//				click : function () {
//					rgTaboo = new Array(114,115,116,117,118,121,122);
//				}
//			});
        }
    },
    OnError: function() {
        alert('서버와 연결중 에러가 발생하였습니다\n\n잠시 후 시도해 주세요');
        return;
    },
    parser: function() {
        if (!this.xml || !this.xsl[this.type]) {
            return;
        }

        $("#dialog_fade").children().remove();
        _xslt.parseXML($("#dialog_fade"), this.xml, this.xsl[this.type]);
        nodemonPopup.enable($("#dialog_fade"));

        $('select[name=ini_onlycardcode]').val(currentCardCode).trigger('change');

        $('select[name=ini_onlycardcode] option[value!=' + currentCardCode + ']').remove();
    }
});



var CreditCardLimitCheck = {};
$.extend(CreditCardLimitCheck, {
    xhr: null,
    form: null,
    request: function(card_form) {
        this.form = card_form[0];
        var frm = $('#frmPayment')[0];
        var use_creditcard = $('#frmPayment').find('input[name="use_creditcard"]').val().replace(/[,]+/g, "");
        var paramsValue = _http.encodeURI("cardCode=" + frm.bankCode.value + "&price=" + use_creditcard + "&pg=" + currentCardPG);

        fnAjax("/payment/_creditcard_limit_check_AJAX.php", "xml", "post", paramsValue, {
            self: this,
            complete: this.OnComplete,
            error: this.OnError
        }, false);
    },
    OnComplete: function(request) {
        var xml = request;
        var result = null;

        result = _xml.getElement(xml, "result", 0);
        if (result.getAttribute("type") == "success") {
            currentCardLimit = true;
        } else {
            alert(result.getAttribute("message").replace("\\n\\n", "\n\n"));
            return false;
        }
    },
    OnError: function() {
        alert('서버와 연결중 에러가 발생하였습니다\n\n잠시 후 시도해 주세요');
        return false;
    }
});
/* ▲ 한도체크 */

var rgTaboo = new Array(114, 115, 116, 117, 118, 121, 122, 8);

/* F3, F4, F5, F6, F7, F10, F11 , <- */
function fnSECURITY() {
    document.oncontextmenu = _DISABLE;
    document.ondragstart = _DISABLE;
    document.onselectstart = _DISABLE;
    $(document).on('mousedown', function(event) {
        event = _event.event(event);
        if (event.button != 2) {
            return true
        }
        _event.stop(event);
        return false;
    });
    $(document).on('keydown', function(event) {
        event = _event.event(event);
        var code = _event.keycode(event);
        code = parseInt(code);
        if (event.altKey || event.altLeft || event.ctrlKey || event.ctrlLeft) {
            try {
                event.keyCode = 0
            } catch (e) {
            }
            _event.stop(event);
            return false;
        }
        for (var i = 0; i < rgTaboo.length; i++)
            if (rgTaboo[i] == code) {
                try {
                    event.keyCode = 0;
                } catch (e) {
                }
                _event.stop(event);
                return false;
            }
        return true;
    });
}

var fnCheckDualPhone = {};
$.extend(fnCheckDualPhone, {
    xhr: null,
    form: null,
    request: function() {
        var paramsValue = _http.encodeURI("type=m");

        ajaxRequest({
            url: '/payment/_check_dual_payment_AJAX.php',
            dataType: 'xml',
            type: 'post',
            async: false,
            data: paramsValue,
            scope: this,
            success: this.OnComplete,
            error: this.OnError
        });
    },
    OnComplete: function(request) {

        var xml = request;
        var result = null;

        result = _xml.getElement(xml, "result", 0);

        if (result.getAttribute("type") == "success") {
            currentPhonePG = result.getAttribute("pg");
        }
    },
    OnError: function() {
    }
});

var fnCheckDualCard = {};
$.extend(fnCheckDualCard, {
    xhr: null,
    form: null,
    request: function() {
        var paramsValue = _http.encodeURI('type=c&code=' + g_trade_info.creditCode + '&price=' + $('#other_pay').val().replace(/[,]+/g, ""));

        ajaxRequest({
            url: '/payment/_check_dual_payment_AJAX.php',
            dataType: 'xml',
            type: 'post',
            async: false,
            data: paramsValue,
            scope: this,
            success: this.OnComplete,
            error: this.OnError
        });
    },
    OnComplete: function(request) {
        var xml = request,
            result = _xml.getElement(xml, 'result', 0);

        if (result.getAttribute('type') == 'success') {
            currentCardPG = result.getAttribute('pg');
            currentCardCode = result.getAttribute('code');
        }
    },
    OnError: function() {

    }
});

function fnTcash(msg, url, code) {
    clearInterval(tcash_interval);

    alert(msg);
    tcash_pop.close();

    if (code == '6') {
        location.reload();
    } else {
        location.href = url;
    }
}



