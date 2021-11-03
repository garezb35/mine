
var e_sale = {
    'general': 0,
    'division': 1,
    'bargain': 2
};

var g_trade_info = {
    id: null,
    sale: 'general',
    subject: null,
    price: null,
    trade_kind: null,
    trade_money: null,
    div_loop: 0,
    div_default: 0,
    div_unit: null,
    min_unit: null,
    max_unit: null,
    curr_unit: null,
    min_quantity: null,
    max_quantity: null
};

var simpleTradeParams = null;

function _init() {
    _form.protect.price($('#sell_quantity'));

    /* â–¼ ë˜ì „ì•¤íŒŒì´í„° í†µí•©ì„œë²„ ì²˜ë¦¬ */
    if ($('#dfServer').length > 0) {
        new ServerList(document.getElementById('dfServerList'), {
            autoComplete: '#df_server_code_text',
            allView: false,
            gameCode: '281',
            exceptCode: ['12189'],
            hidden_use: {
                code: '[name="df_server_code"]',
                text: ''
            }
        });
        $('#user_character').attr('maxlength', 27);
    } else {
        fnCheckSimpleSubmit();
    }
    /* â–² ë˜ì „ì•¤íŒŒì´í„° í†µí•©ì„œë²„ ì²˜ë¦¬ */

    if (g_trade_info.sale == 'division') {
        $('#sell_quantity').val(g_trade_info.quantity);
        sellQuantity();
    }

    $('#frmSell').submit(function() {
        if ($("#user_without").val() == '6') {
            if (!confirm('ê³ ê°ë‹˜ì€ í˜„ìž¬ íšŒì›íƒˆí‡´ ì‹ ì²­ ì§„í–‰ì¤‘ìž…ë‹ˆë‹¤.\níŒë§¤ ì‹ ì²­ ì§„í–‰ ì‹œ ì‹ ì²­í•˜ì‹  íšŒì›íƒˆí‡´ ì ‘ìˆ˜ê°€ ì² íšŒë©ë‹ˆë‹¤.\nê³„ì† ì§„í–‰ í•˜ì‹œê² ìŠµë‹ˆê¹Œ?')) {
                return false;
            }
        }
        return true;
    });

    document.getElementById('wideview').addEventListener('click', function() {
        var detail = document.getElementById('detail_info');
        if (detail.classList.contains('wide') == true) {
            detail.classList.remove('wide');
            this.innerHTML = 'íŽ¼ì³ë³´ê¸°â–¼';
        } else {
            detail.classList.add('wide');
            this.innerHTML = 'íŽ¼ì¹¨ë‹«ê¸°â–²';
        }
    });

    /** [ITM-10872] ìºë¦­í„° ê±°ëž˜ ì‹ ê·œ ì„œë¹„ìŠ¤ ì‚½ë‹ˆë‹¤ ì¶”ê°€ by 20200720 KBR */
    if (document.getElementById('elt_contract') !== null) {
        document.getElementById('sign_btn').addEventListener('click', function(ev) {
            var strConfirmMsg = 'ì „ìž ì„œëª…ì„ í•˜ì‹œê² ìŠµë‹ˆê¹Œ?\n' +
                'ì „ìž ì„œëª… ì™„ë£Œ ì‹œ íŒë§¤ì‹ ì²­ì´ ì™„ë£Œ ë©ë‹ˆë‹¤.\n';
            if (!confirm(strConfirmMsg)) {
                return;
            }

            var frm = document.getElementById('frmSell');
            _window.open('contract', '', 650, 550);
            frm.target = 'contract';
            frm.action = '/certify/payment/user_certify.html';
            frm.submit();
        });
    }

    //ì•ˆì‹¬ë²ˆí˜¸, ì•ˆì‹¬ë²ˆí˜¸ í”ŒëŸ¬ìŠ¤
    SafetyNumber();
}

function fnCheckSimpleSubmit() {
    if (simpleTradeParams != null && simpleTradeParams.refer_type == 'simple') {
        fnFormChecker();
    }
}

function fnFormChecker() {
    var frm = $('#frmSell');

    /* â–¼ ë˜ì „ì•¤íŒŒì´í„° í†µí•©ì„œë²„ ì²˜ë¦¬ */
    if ($('#dfServer').length > 0) {
        if ($('[name="df_server_code"]').val().isEmpty()) {
            alert('ë¬¼í’ˆì„ ì „ë‹¬ í•˜ì‹¤ ì„œë²„ë¥¼ ì„ íƒ í•´ì£¼ì„¸ìš”.');
            return false;
        }
        if ($('#user_character').val().isEmpty()) {
            alert('ë¬¼í’ˆì„ ì „ë‹¬ í•˜ì‹¤ ìºë¦­í„°ëª…ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.');
            $('#user_character').focus();
            return false;
        }

    }
    /* â–² ë˜ì „ì•¤íŒŒì´í„° í†µí•©ì„œë²„ ì²˜ë¦¬ */

    /** [ITM-10872] ìºë¦­í„° ê±°ëž˜ ì‹ ê·œ ì„œë¹„ìŠ¤ ì‚½ë‹ˆë‹¤ ì¶”ê°€ by 20200720 KBR */
    if(document.getElementById('character_id') !== null) {
        if(document.getElementById('character_id').value.isEmpty() === true) {
            alert('ìºë¦­í„° ID ìž…ë ¥ í›„ íŒë§¤ì‹ ì²­ì´ ê°€ëŠ¥í•©ë‹ˆë‹¤.');
            document.getElementById('character_id').focus();
            return false;
        }
    }

    if (g_trade_info.sale == "division") {
        if (checkForm() == false) return false;

        $("#layer_quantity").text($("#spnQuantity_total").text());
        $("#layer_money").text($("#trade_money").text());
    }

    /* â–¼ ì•ˆì‹¬ë²ˆí˜¸ ì„œë¹„ìŠ¤ */
    if ($("#safety_using_flag").val() == "true") {
        if ($("#user_safety_type").val() == "1" && $("#using_safety_number").val() == "on") {
            if ($("#user_cell_auth").val() == '0') {
                alert("ì•ˆì‹¬ë²ˆí˜¸ ì„œë¹„ìŠ¤ëŠ” íœ´ëŒ€í° ì¸ì¦ì„ ë°›ìœ¼ì…”ì•¼ ì‚¬ìš©ì´ ê°€ëŠ¥í•©ë‹ˆë‹¤.\n\në§ˆì´ë£¸ > ë‚´ ê°œì¸ì •ë³´ > ê°œì¸ì •ë³´ ìˆ˜ì •ì—ì„œ íœ´ëŒ€í° ì¸ì¦ í›„ ì‚¬ìš©í•˜ì‹œê¸° ë°”ëžë‹ˆë‹¤.\n\nì‚¬ìš©ì„ ì›í•˜ì§€ ì•Šìœ¼ì‹œë©´ ì•ˆì‹¬ë²ˆí˜¸ ì‚¬ìš©ì•ˆí•¨ìœ¼ë¡œ ì„ íƒ í›„ ë“±ë¡í•˜ì‹œê¸° ë°”ëžë‹ˆë‹¤.");
                return false;
            }
        }
    }
    /* â–² ì•ˆì‹¬ë²ˆí˜¸ ì„œë¹„ìŠ¤ */

    /* â–¼ ì—°ë½ì²˜ ì¤‘ë³µì²´í¬ */
    var slctContact = $('#user_contactA').val();
    var slctMobileType = $('#slctMobile_type').val();
    var params = {
        user_id: $('#user_id').val(),
        trade_flag: 'Y',
        contact_yn: (slctContact == 'N') ? 'N' : 'Y',
        mobile_yn: (slctMobileType == 'N') ? 'N' : 'Y'
    };

    if (params['contact_yn'] == 'N' && params['mobile_yn'] == 'N') {
        alert('íœ´ëŒ€í° ë˜ëŠ” ìžíƒ ì—°ë½ì²˜ ì •ë³´ë¥¼ í†µí™” ê°€ëŠ¥í•œ ë²ˆí˜¸ë¡œ ìˆ˜ì • í›„ ì´ìš© ë°”ëžë‹ˆë‹¤.');
        return;
    }

    if (params['contact_yn'] == 'Y') {
        params['user_contactA'] = slctContact;
        params['user_contactB'] = $('#user_contactB').val();
        params['user_contactC'] = $('#user_contactC').val();
    }
    if (params['mobile_yn'] == 'Y') {
        params['user_mobileA'] = $('#user_mobileA').val();
        params['user_mobileB'] = $('#user_mobileB').val();
        params['user_mobileC'] = $('#user_mobileC').val();
    }

    fnAjax('/_include/_user_contact_restrict.php', 'text', 'POST', params, {
        complete: function(res) {
            var rgResult = res.split('|');
            switch (rgResult[0]) {
                case 'S':
                    /** [ITM-10872] ìºë¦­í„° ê±°ëž˜ ì‹ ê·œ ì„œë¹„ìŠ¤ ì‚½ë‹ˆë‹¤ ì¶”ê°€ by 20200720 KBR */
                    if (document.getElementById('elt_contract') !== null) {
                        document.getElementById('tmp_character_id').innerHTML = document.getElementById('character_id').value;
                        g_nodeSleep.enable($('#elt_contract'));
                    } else {
                        $('#layer_character').text($('input[name="user_character"]').val());
                        g_nodeSleep.enable($("#dvGoodsInfo"));
                    }
                    break;
                default:
                    alert(rgResult[1]);
            }
        },
        error: function() {
            alert('ì„œë¹„ìŠ¤ê°€ ì›í• í•˜ì§€ ì•ŠìŠµë‹ˆë‹¤. ìž ì‹œí›„ ì´ìš©í•´ ì£¼ì„¸ìš”.');
        }
    });
    /* â–² ì—°ë½ì²˜ ì¤‘ë³µì²´í¬ */
}

function sellQuantity() {
    var frm = $('#frmSell');

    var tradeMoney = 0;
    var paymentPrice = 0;
    var discountPrice = 0;
    var sellQuantity = 0;

    sellQuantity = frm.find('input[name="sell_quantity"]').val().replace(/[^0-9]/g, "");
    frm.find('input[name="sell_quantity"]').val(Number(sellQuantity).currency());

    if (sellQuantity.isEmpty()) return;

    sellQuantity = Number(sellQuantity);

    if (sellQuantity == 0) return;

    if (g_trade_info.max_quantity < sellQuantity) {
        alert("ìµœëŒ€ êµ¬ë§¤ìˆ˜ëŸ‰ì„ ì´ˆê³¼í•˜ì˜€ìŠµë‹ˆë‹¤!");
        frm.find('input[name="sell_quantity"]').val(g_trade_info.max_quantity.currency());
        sellQuantity = g_trade_info.max_quantity;
    }

    var sellGameMoney = sellQuantity * g_trade_info.div_unit;
    var sellGameMoney_2 = sellGameMoney;

    if (g_trade_info.trade_kind == "money") {

        var rgUnit = new Array("ë§Œ", "ì–µ", "ì¡°");
        var rgDefaultUnit = new Array(10000, 100000000, 1000000000000);
        var iUnit = 0;

        var nLoop = 0;
        if (g_trade_info.div_loop >= 0 && g_trade_info.div_loop < 3) {
            sellGameMoney = sellGameMoney.currency() + rgUnit[g_trade_info.div_loop];
        } else {
            sellGameMoney = sellGameMoney.currency();
        }

    }

    $('#spnQuantity').text(sellQuantity.currency());
    $('#spnQuantity_total').text(moneyUnitChange(sellGameMoney_2));

    tradeMoney = (g_trade_info.trade_money * sellQuantity);

    paymentPrice = tradeMoney;

    $('#trade_money').text(tradeMoney.currency());

    g_trade_info.price = paymentPrice;

    return true;

}

function moneyUnitChange(money) {
    var money = "" + money;
    var reTuenMoney = "";
    var moneyString = new Array(money.length);
    var unitString = new Array("", "ë§Œ", "ì–µ", "ì¡°", "ê²½");
    var tmpNumber = '';

    if (money.length > 4) {
        for (var i = 0; i < money.length; i++) {
            moneyString[i] = money.substr(i, 1);
        }

        var x = 1;
        var y = 0;
        for (i = money.length; i > 0; i--) {

            tmpNumber = moneyString[i - 1] + tmpNumber;

            if (x % 4 == 0) {
                if (Number(tmpNumber) > 0) {
                    reTuenMoney = (Number(tmpNumber).currency()) + unitString[y] + reTuenMoney;
                }
                tmpNumber = "";
                y++;
            }
            x++;
        }

        if (tmpNumber.length > 0) {
            reTuenMoney = (Number(tmpNumber).currency()) + unitString[y] + reTuenMoney;
        }

    } else {
        reTuenMoney = Number(money).currency();
    }

    return reTuenMoney;
}

function checkForm() {
    var frm = $('#frmSell');

    var sellQuantity = 0;

    sellQuantity = frm.find('input[name="sell_quantity"]').val();

    if (sellQuantity.isEmpty()) {
        alert("íŒë§¤ìˆ˜ëŸ‰ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.");
        frm.find('input[name="sell_quantity"]').focus();
        return false;
    }

    sellQuantity = Number(sellQuantity.replace(/[,]+/g, ""));

    if ((sellQuantity * g_trade_info.div_unit) > g_trade_info.curr_unit) {
        alert("íŒë§¤ìˆ˜ëŸ‰ì´ í˜„ìž¬ êµ¬ë§¤ ìˆ˜ëŸ‰ë³´ë‹¤ ë§ŽìŠµë‹ˆë‹¤.\níŒë§¤ìˆ˜ëŸ‰ì„ ë‹¤ì‹œ ìž…ë ¥í•´ì£¼ì„¸ìš”.");
        frm.find('input[name="sell_quantity"]').focus();
        return false;
    }

    if (sellQuantity < g_trade_info.min_quantity) {
        alert("ìµœì†ŒíŒë§¤ìˆ˜ëŸ‰(" + g_trade_info.min_quantity + "ë²ˆ) ë¯¸ë§Œì˜ ë¬¼í’ˆì€ ì‹ ì²­í•  ìˆ˜ ì—†ìŠµë‹ˆë‹¤.");
        frm.find('input[name="sell_quantity"]').focus();
        return false;

    } else if (sellQuantity > g_trade_info.max_quantity) {
        alert("ìµœëŒ€íŒë§¤ìˆ˜ëŸ‰(" + g_trade_info.max_quantity + "ë²ˆ) ì´ˆê³¼ì˜ ë¬¼í’ˆì€ ì‹ ì²­í•  ìˆ˜ ì—†ìŠµë‹ˆë‹¤.");
        frm.find('input[name="sell_quantity"]').focus();
        return false;
    }

    var tradePrice = $('#trade_money').text();
    tradePrice = tradePrice.replace(/[,]+/g, "");

    if (tradePrice < 3000) {
        alert("ê±°ëž˜ëŠ” 3,000ì› ì´ìƒë¶€í„° ê°€ëŠ¥í•©ë‹ˆë‹¤.");
        frm.find('input[name="sell_quantity"]').focus();
        return false;
    }

    return true;

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

function SafetyNumber(){
    ajaxRequest({
        url: '/_include/_SafetyNumber_Category_Check_AJAX.html',
        type: 'post',
        data: {
            gamecode: $('#game_code').val(),
        },
        success: function(res) {
            if (res === 'true') {
                $('.SafetyNumber_plus').show();
                $('.SafetyNumber').hide();
            } else{
                $('.SafetyNumber_plus').hide();
                $('.SafetyNumber').show();
            }

        }
    });
}
