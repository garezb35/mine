/*
 * @title		마일리지 충전팝업
 * @author		김보람
 * @date		2011.07.11
 * @update		수정날짜(수정자)
 * @description
 */

function __init() {
    _window.resize(700, 950);
    _form.protect.number($('#price_custom'));
// 	g_fnSECURITY();

    // 배너를 콘텐츠안으로 밀어넣는코드 180831 나상권
    // /carsouel_plugin/mileage_charge.html

    if (document.getElementById('charge_banner') !== null) {
        document.getElementById('charge_main').appendChild(document.getElementById('charge_banner'));
    }
    if (document.getElementById('charge_banner2') !== null) {
        document.getElementById('charge_main').appendChild(document.getElementById('charge_banner2'));
    }

    rolling_height = $('#charge_notice').height();
    notice_obj_len = $('#charge_notice p').length;
    if (notice_obj_len > 1) {
        for (var i = 0; i < notice_obj_len; i++) {
            if (i == 0) {
                $('#charge_notice p').eq(i).css('top', 0);
            } else {
                $('#charge_notice p').eq(i).css('top', rolling_height);
            }
        }

        fn_notice_rolling();
    }

    $('#charge_notice p').on({
        mouseover: function() {
            var num = $('#charge_notice p').index($(this));
            var obj = $('#notice_layer_wrap').find('li').eq(num);

            setTimeout(function() {
                if ($(obj).hasClass('hide')) {
                    return;
                }

                if (notice_obj_len > 1) {
                    clearInterval(notice_rolling);
                }

                if (view_flag) {
                    return;
                }

                $('.view').hide();

                if ($(obj).height() > 500) {
                    $(obj).css('height', 500);
                } else {
                    $(obj).css('height', $(obj).height());
                }

                $('.arrow').show(500);
                $(obj).slideDown(300, function() {
                    view_flag = true;
                });
            }, 200);
        }
    });

    $('#charge_menu, #charge_main').on({
        mouseout: function() {
            if (notice_obj_len > 1) {
                clearInterval(notice_rolling);

                fn_notice_rolling();
            }

            if (!view_flag) {
                return;
            }

            view_flag = false;

            $('.arrow').hide(500);
            $('.view').slideUp(300);
        }
    });

    /* ▼ 좌측 메뉴 */
    $('#charge_main').height($('#charge_menu')[0].offsetHeight - 30);	// 좌측 메뉴 수에 컨텐츠 영역 높이 맞추기

    $('#charge_menu li').on({
        mouseover: function() {
            $(this).addClass('focus');
        },
        mouseout: function() {
            $(this).removeClass('focus');
        }
    });

    $('#all_gift_li').on({	// 상품권류
        click: function() {
            $('#all_gift').toggle();
        }
    });
    /* ▲ 좌측 메뉴 */
}

function fnInputClear() {
    if ($("#price_custom")) {
        $("#price_custom").val("직접입력");
    }
}

function fnCustomOut() {
    if ($("#price_custom").val() == "") {
        $("#price_custom").val("직접입력");
    }
}

function init_orderid() {
    $('[name="selectPrice"]').get(0).checked = true;
    selectedPrice($('[name="selectPrice"]').val());
}

function selectedPrice(v) {

    var fillRealMileage = $("#spnPrice");

    if ($("#priceD:checked").val() != 0) {
        $("#price_custom").val("직접입력");
    }

    if (v == "0" || v.length < 1) {
        $("#priceD").prop('checked', true);
        if ($("#price_custom").val() == "직접입력") {
            $("#price_custom").val("");
        }
        if ($("#price_custom").val() == "") {
            fillRealMileage.html("0");
        } else {
            var price = parseInt($("#price_custom").val()) + rgRate;
            fillRealMileage.html(Number(price).currency());
        }
    } else {
        fillRealMileage.html(Number(Number(v) - parseInt((Number(Number(v) / 100) * $("#charge_rate").val()))).currency());
    }

    $('input[name="price"]').val(v);

}


function onlynum(a) {
    var tmp = new Array();
    for (i = a.length - 1; i > -1; i--) {
        if ((a.charCodeAt(i) > 45 && a.charCodeAt(i) < 58)) {
            if (a.charAt(0) > 0) {
                tmp[i] = a.charAt(i);
            }
        }
    }
    str = tmp.join('');
    $("#price_custom").val(str);
}

function selectedPrice_pica(v) {
    $('#spnPrice').html(Number((Number(v) - (Math.round(Number(v) / 100) * 10))).currency());
}

function protectKey(Event) {
    var event = _event.event(Event);

    if (event.ctrlKey || event.keyCode == 16 || event.keyCode == 116) {
        try {
            event.keyCode = 0
        } catch (e) {
        }
        _event.stop(event);
        return false;
    }
}

function fnReceiptPopupOpen() {
    if ($('#dialog_fade').length > 0) {
        nodemonPopup.enable($('#dialog_fade'));
    }
}

function fnReceiptPopupClose() {
    nodemonPopup.disable();
}

/* ▼ 주민번호,사업자번호 숫자만입력 */
function ___init() {
    _form.protect.number($('[name*="user_phone"]'));
    _form.protect.number($('[name*="receipt_jumin"]'));

    _form.autotab($('#user_phone1'), $('#user_phone2'));
    _form.autotab($('#user_phone2'), $('#user_phone3'));
    _form.autotab($('#user_phone3'), $('#receipt_useremail'));
    _form.autotab($('#receipt_jumin1'), $('#receipt_jumin2'));
    _form.autotab($('#receipt_jumin2'), $('#receipt_useremail'));

    $('#juminnumber .g_radio').change(function() {
        $('.sub_div').hide();
        $('#' + $(this).attr('id') + '_div').show();
    });
}

/* ▲ 주민번호,사업자번호 숫자만입력 */
function fnPresentReceipt() {
    var f = $('#frmPopup');
    var receiptCheck = $("input[name='receipt_check']:checked").val();

    if (receiptCheck == "ok" && $("#user_foreigner").val() != "Y") {
        if ($('#receipt_username').val().isEmpty()) {
            alert('성명을 입력해주세요');
            $('#receipt_username').focus();
            return;
        }
        if ($('[name="member_info"]:checked').val() == 'p') {
            if ($('#user_phone1').val().isEmpty()) {
                alert('휴대폰 번호를 입력해주세요.');
                $('#user_phone1').focus();
                return;
            }
            if ($('#user_phone2').val().isEmpty()) {
                alert('휴대폰 번호를 입력해주세요.');
                $('#user_phone2').focus();
                return;
            }
            if ($('#user_phone3').val().isEmpty()) {
                alert('휴대폰 번호를 입력해주세요.');
                $('#user_phone3').focus();
                return;
            }
            if ($('[name*="user_phone"]').val().length < 3) {
                alert('올바른 휴대폰 번호가 아닙니다.');
                $('[name*="user_phone"]').val('');
                $('#user_phone1').focus();
                return;
            }
            if ($('#user_phone3').val().length < 4) {
                alert('올바른 휴대폰 번호가 아닙니다.');
                $('#user_phone3').val('');
                $('#user_phone3').focus();
                return;
            }
        } else {
            if ($('#receipt_jumin1').val().isEmpty() || $('#receipt_jumin2').val().isEmpty()) {
                alert('주민등록번호를 입력해 주세요.');
                $('#receipt_jumin1').focus();
                return;
            }

            try {
                var str = String($('#receipt_jumin1').val()) + String($('#receipt_jumin2').val());
                if (str.length != 13)
                    throw 'invalid';
                var strTmp = (str.substring(6, 7) <= 2) ? '19' : '20';

                if (!String(strTmp + str.substring(0, 2) + str.substring(2, 4) + str.substring(4, 6)).isDate())
                    throw 'invalid';

                var fCheckSum = 0;
                fCheckSum = str.substring(0, 1) * 2 + str.substring(1, 2) * 3 + str.substring(2, 3) * 4 + str.substring(3, 4) * 5;
                fCheckSum += str.substring(4, 5) * 6 + str.substring(5, 6) * 7;
                fCheckSum += str.substring(6, 7) * 8 + str.substring(7, 8) * 9 + str.substring(8, 9) * 2 + str.substring(9, 10) * 3;
                fCheckSum += str.substring(10, 11) * 4 + str.substring(11, 12) * 5;
                fCheckSum = (11 - (fCheckSum % 11)) % 10;
                if (fCheckSum == str.substring(12, 13)) {

                    fnReceiptSubmit();
                    return;
                } else {
                    throw 'invalid';
                }
            } catch (error) {
                alert('잘못된 주민등록번호입니다.');
                $('#receipt_jumin1').val("");
                $('#receipt_jumin2').val("");
                $('#receipt_jumin1').focus();
                return;
            }
        }

        if ($('#receipt_useremail').val().isEmpty()) {
            alert('이메일 주소를 입력하세요.');
            $('#receipt_useremail').focus();
            return;
        }

        if (!_form.validator.email($('#receipt_useremail').val())) {
            alert('잘못된 e-mail 형식입니다.');
            $('#receipt_useremail').val('').focus();
            return;
        }
    }

    fnReceiptSubmit();
}

/* ▼ 현금영수증팝업레이어 폼(frmPopup)->폼(ini)로 hidden값전송 */
function fnReceiptSubmit() {
    var Formini = $('#ini');
    $('#frmPopup').find("input").each(function() {
        if ((this.name == "receipt_check" || this.name == "receipt_type") && this.checked == false) {
            return;
        } else {
            $('[name="member_info"]').val($('[name="member_info"]:checked').val());

            receipt_input = $('<INPUT />');
            receipt_input.attr('type', 'hidden');
            receipt_input.attr('name', this.name);
            receipt_input.attr('id', this.id);
            receipt_input.attr('value', this.value);
            Formini.append(receipt_input);
        }
    });
    $("#btn_money_receipt").html('<span style=\"color:darkred;font-weight:bold\">마일리지 충전 진행 중입니다. 창을 닫지 마세요</span>');
// 	Formini.onsubmit();
    Formini.submit();
}

/* ▲ 현금영수증팝업레이어 폼(frmPopup)->폼(ini)로 hidden값전송 */

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

/* ▼ 오늘 하루 열지 않음 */
function newSetDeny(strName) {
    if (!$("#" + strName + "_inptDeny") && !$("#" + strName)) {
        return;
    }

    var check = $("#" + strName + "_inptDeny").prop('checked');

    if (check || check == "checked") {
        _cookie.add(strName, "deny", 1);
    } else {
        _cookie.remove(strName);
    }
}

/* ▲ 오늘 하루 열지 않음 */

/* ▼ 마일리지 충전 팝업 공지 */
var notice_obj_len = 0;
var current_notice_num = 0;
var notice_rolling;
var interval_time = 4250;
var rolling_time = 500;
var rolling_height = 0;
var view_flag = false;

function fn_notice_rolling() {
    var obj = $('#charge_notice p');

    notice_rolling = setInterval(function() {
        if (current_notice_num == notice_obj_len) {
            current_notice_num = 0;
        }

        $(obj).eq(current_notice_num).animate({'top': -1 * rolling_height}, rolling_time, function() {
            if (current_notice_num > notice_obj_len - 1) {
                $(obj).eq(current_notice_num - 1).css('top', rolling_height);
            }
        });

        var obj_next = current_notice_num + 1;
        if (obj_next == notice_obj_len) {
            obj_next = 0;
            $(obj).not($(obj).eq(current_notice_num)).css('top', rolling_height);
            $(obj).eq(0).animate({'top': 0}, rolling_time);
        } else {
            $(obj).eq(obj_next).animate({'top': 0}, rolling_time);
        }

        current_notice_num++;
    }, interval_time);
}

/* ▲ 마일리지 충전 팝업 공지 */
