// íŒë§¤ìœ í˜•
var e_sale = {
    'general': 'ì¼ë°˜íŒë§¤',
    'division': 'ë¶„í• íŒë§¤'
};

var e_goods_text = {
    'money': 'ê²Œìž„ë¨¸ë‹ˆ',
    'item': 'ì•„ì´í…œ',
    'character': 'ìºë¦­í„°',
    'etc': 'ê¸°íƒ€'
};

// í˜„ìž¬ì„ íƒëœ íƒ€ìž…
var e_select = {
    sale: 'general',
    goods: 'money'
};

// í˜„ìž¬ì„ íƒëœ ë‹¨ìœ„
var g_unit = '';

var e_use = {
    premium: 0,
    highlight: 0,
    quickIcon:0,
    rereg: 0
};

// í”„ë¦¬ë¯¸ì—„ ë ˆì´ì–´ í™œì„±í™”
var bPremiumLayer = false;

function _init() {

    // ë¬¼í’ˆê¸°ë³¸ê°’ì ìš©
    document.getElementById('fixed_trade_subject').addEventListener('click', function() {
        var strFixTag = document.getElementById('trade_sign_txt').innerHTML;
        if (strFixTag.isEmpty() === true) {
            if (confirm('ë¬¼í’ˆì œëª© ê¸°ë³¸ê°’ìœ¼ë¡œ ì„¤ì •ëœ ê°’ì´ ì—†ìŠµë‹ˆë‹¤. \rë¬¼í’ˆ ì œëª© ê¸°ë³¸ê°’ì„ ì„¤ì •í•˜ì‹œê² ìŠµë‹ˆê¹Œ?')) {
                _window.open('fixed_title', 'fixed_trade_subject.html', 500, 300);
            }
            this.checked = false;
            return;
        }
        strFixTag += ' ';
        if (this.checked === true) {
            document.getElementById('user_title').value = strFixTag + document.getElementById('user_title').value;
        } else {
            document.getElementById('user_title').value = document.getElementById('user_title').value.replace(strFixTag, '');
        }
    });

    document.getElementById('d_template').addEventListener('click', function(e) {
        if (e.target.name === 'gamemoney_unit') {
            var unit = e.target.value;
            if (e.target.value === '1') {
                unit = '';
            }
            $('.unit').text(unit);
        }
    });

    // ì¦‰ì‹œêµ¬ë§¤
    if (document.getElementById('direct_reg_trade') !== null) {
        document.getElementById('direct_reg_trade').addEventListener('click', setDirectBuy);
    }

    // í”„ë¦¬ë¯¸ì—„ ë“±ë¡
    document.getElementById('user_premium_time').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceCalc();
    });
    // êµµì€ì²´ ë“±ë¡
    document.getElementById('user_icon_use').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceApply.call(this, 'f_bold');
    });
    // ë…¹ìƒ‰íŽœ ë“±ë¡
    document.getElementById('user_bluepen_use').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceApply.call(this, 'f_green2');
    });
    // í€µì•„ì´ì½˜ ë“±ë¡
    document.getElementById('user_quickicon_use').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceCalc();
    });
    // document.getElementById('rereg_count').addEventListener('change', function() {
    // 	var result = chargeServiceCalc.call(this);
    // 	if (result === true) {
    // 		var setVal = ['0íšŒ', '0ë¶„'];
    // 		if (this.value.isEmpty() === false) {
    // 			setVal[0] = this.value + 'íšŒ';
    // 			setVal[1] = document.getElementById('rereg_time').value + 'ë¶„';
    // 		}
    // 		document.getElementById('rereg_cnt').innerHTML = setVal[0];
    // 		document.getElementById('minute').innerHTML = setVal[1];
    // 	}
    // });

    document.getElementById('premium_btn').addEventListener('click', premiumSet);

    if (document.getElementById('credit_benefit') !== null) {
        document.getElementById('credit_benefit').addEventListener('click', getCreditBenefit);
    }

    SafetyNumber();
    changeTemplateAddCheck();

    $('#tag_generator').keydown(function(e){
        if($('#tag_generator').is(':focus'))
        {

            if(e.keyCode == '13' )
            {
                var el = '<label>#<input type="hidden" name="alarm_keyword[]" value="'+this.value+'">'+this.value+'<span class="delete_keyword"></span></label>';

                if(this.value == '' || this.value.substr(0,1) == ' ' ||this.value.length <2)
                {
                    e.preventDefault();
                    return;
                }

                this.value = '';

                if($('.tag_wrapper').find('label').length < 3)
                {
                    $('.tag_wrapper').append(el)
                }
                else
                {
                    alert('ì•Œë¦¼ë“±ë¡ì€ ìµœëŒ€ 3ê°œê¹Œì§€ ê°€ëŠ¥í•©ë‹ˆë‹¤.')
                }
                $('.delete_keyword').click(function(e){
                    var idx = $('.delete_keyword').index(this);
                    $(this).parent()
                    $(this).parent().remove();
                });
                e.preventDefault();
            }
        }
    });
}

function getFreeUse() {
    var gameCode = document.querySelector('[name="game_code"]').value;
    ajaxRequest({
        url: '/_include/_get_free_use.php',
        dataType: 'JSON',
        type: 'POST',
        data: 'game_code=' + gameCode,
        success: function(res) {
            e_use.premium = res.premium;
            e_use.highlight = res.highlight;
            e_use.quickIcon = res.quickicon;
            $('#user_premium_time').val('');
            $('#user_icon_use').val('');
            $('#user_bluepen_use').val('');
            $('#user_quickicon_use').val('');
            chargeServiceCalc();
        }
    });
}

/**
 * ì‹ ìš©ë“±ê¸‰ í˜œíƒë°›ê¸°
 */
function getCreditBenefit() {

    ajaxRequest({
        url : '/myroom/myinfo/credit_rating_ok.php',
        type : 'post',
        data : 'type=1',
        success: function(data) {
            var returnData = data.split(";");
            switch (returnData[0]) {
                case "Empty" :
                    alert("ìž˜ëª»ëœ ì ‘ê·¼ìž…ë‹ˆë‹¤.");
                    break;
                case "CreditNo" :
                    alert("ì‹ ìš©ë“±ê¸‰ì„ ì—…ë°ì´íŠ¸í•˜ì§€ ëª»í–ˆìŠµë‹ˆë‹¤. ê´€ë¦¬ìžì—ê²Œ ë¬¸ì˜í•´ ì£¼ì„¸ìš”.");
                    break;
                case "CreditNo2" :
                    alert("ì‹ ìš©ë“±ê¸‰ì„ ê°€ì ¸ì˜¤ì§€ ëª»í–ˆìŠµë‹ˆë‹¤. ê´€ë¦¬ìžì—ê²Œ ë¬¸ì˜í•´ ì£¼ì„¸ìš”.");
                    break;
                case "Dberror" :
                    alert("ì„œë¹„ìŠ¤ê°€ ì›í• í•˜ì§€ ì•ŠìŠµë‹ˆë‹¤. ìž ì‹œ í›„ ì´ìš©í•´ì£¼ì„¸ìš”");
                    break;
                case "Overlap" :
                    if (returnData[1] == 1) {
                        alert("ì´ë¯¸ ë¬´ë£Œì´ìš©ê¶Œì„ ë°œê¸‰ ë°›ìœ¼ì…¨ìŠµë‹ˆë‹¤.");
                    } else {
                        alert("ì´ë¯¸ ì˜¥ì…˜ìž…ì°°ê¶Œì„ ë°œê¸‰ ë°›ìœ¼ì…¨ìŠµë‹ˆë‹¤");
                    }
                    break
                case "Rowerror" :
                    alert("í”„ë¦¬ë¯¸ì—„ ì´ìš©ê¶Œì„ ì§€ê¸‰í•˜ì§€ ëª»í–ˆìŠµë‹ˆë‹¤. ë‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.");
                    break;
                case "Rowerror2" :
                    alert("ë¬¼í’ˆê°•ì¡° ì´ìš©ê¶Œì„ ì§€ê¸‰í•˜ì§€ ëª»í–ˆìŠµë‹ˆë‹¤. ë‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.");
                    break;
                case "Rowerror3" :
                    alert("ì˜¥ì…˜ìž…ì°°ê¶Œì„ ì§€ê¸‰í•˜ì§€ ëª»í–ˆìŠµë‹ˆë‹¤. ë‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.");
                    break;
                case "Rowerror4" :
                    alert("ì¶œê¸ˆ ë¬´ë£Œì´ìš©ê¶Œì„ ì§€ê¸‰í•˜ì§€ ëª»í–ˆìŠµë‹ˆë‹¤. ë‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.");
                    break;
                case "Success" :
                    alert('ë¬´ë£Œì´ìš©ê¶Œì´ ë°œê¸‰ë˜ì—ˆìŠµë‹ˆë‹¤.\n[ë¬´ë£Œì´ìš©ê¶Œë³´ê¸°]ë¥¼ í™•ì¸í•´ì£¼ì„¸ìš”.');
                    getFreeUse();
                    break;
            }
        },
        error: function() {
            alert("ì‹œìŠ¤í…œ ì ê²€ì¤‘ìž…ë‹ˆë‹¤. ìž ì‹œ í›„ ì´ìš©í•´ ì£¼ì„¸ìš”.");
        }
    });
}

function setDefaultText() {
    var strGoods = e_goods_text[e_select.goods];
    if (e_select.goods === 'money' && g_unit.isEmpty() === false) {
        strGoods = g_unit;
    }

    var defaultText = strGoods + ' ì‚½ë‹ˆë‹¤.';

    document.getElementById('user_title').value = defaultText;

    if (document.querySelector('[name="text_select"]:checked').value === '0') {
        document.getElementById('user_text').value = defaultText;
    }
}

function changeTemplateAddCheck() {
    var frm = document.forms.frmBuy;
    if (frm.checker) {
        frm.checker.free();
    }
    var formCheck = new FormChecker('frmBuy');
    var userGoods = document.querySelector('[name="user_goods"]');
    var userGoodsType = document.querySelector('[name="user_goods_type"]');
    var gameCode = document.querySelector('[name="game_code"]').value;

    if (userGoodsType.value === 'division') {
        formCheck.add({name: 'user_quantity_min', msg: 'ìµœì†Œ êµ¬ë§¤ ìˆ˜ëŸ‰ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.', type: 'price', protect: true});
        formCheck.add({name: 'user_quantity_max', msg: 'ìµœëŒ€ êµ¬ë§¤ ìˆ˜ëŸ‰ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.', type: 'price', protect: true});
        formCheck.add({name: 'user_division_unit', msg: 'ë¶„í• ë‹¨ìœ„ë¥¼ ìž…ë ¥í•´ ì£¼ì„¸ìš”.', type: 'price', protect: true});
        formCheck.add({
            name: 'user_division_price',
            msg: 'ê±°ëž˜ê¸ˆì•¡ì€ 100ì› ì´ìƒìœ¼ë¡œ ìž…ë ¥í•´ ì£¼ì„¸ìš”',
            type: 'price',
            protect: true,
            range: {min: 100}
        });
        formCheck.add({
            custom: function() {
                if (frm.user_division_price.value.numeric() % 10 > 0) {
                    alert('ê±°ëž˜ê¸ˆì•¡ì— ì¼ì›ë‹¨ìœ„ëŠ” 0ì´ì™¸ì˜ ìˆ«ìžë¥¼ ìž…ë ¥í• ìˆ˜ ì—†ìŠµë‹ˆë‹¤.\n\nê±°ëž˜ê¸ˆì•¡ì„ ë‹¤ì‹œ ê¸°ìž¬í•´ ì£¼ì„¸ìš”.\n\nì˜ˆ) 12,345(ë¶ˆê°€ëŠ¥), 12,340(ê°€ëŠ¥)');
                    frm.user_division_price.value = '';
                    frm.user_division_price.focus();
                    return false;
                }

                var quaMin = document.getElementById('user_quantity_min');
                var quaMax = document.getElementById('user_quantity_max');
                var divUnit = document.getElementById('user_division_unit');
                var divPrice = document.getElementById('user_division_price');
                var quaMinVal = quaMin.value.numeric();
                var quaMaxVal = quaMax.value.numeric();
                var divUnitVal = divUnit.value.numeric();
                var divPriceVal = divPrice.value.numeric();

                if (divUnitVal > quaMinVal) {
                    alert('ë¶„í• ë‹¨ìœ„ê°€ ìµœì†Œìˆ˜ëŸ‰ë³´ë‹¤ í½ë‹ˆë‹¤.');
                    quaMin.value = '';
                    quaMin.onfocus();
                    return false;
                }

                if (quaMinVal > quaMaxVal) {
                    alert('ìµœì†Œìˆ˜ëŸ‰ì´ ìµœëŒ€ìˆ˜ëŸ‰ë³´ë‹¤ í½ë‹ˆë‹¤.');
                    quaMax.value = '';
                    quaMax.onfocus();
                    return false;
                }

                if (quaMinVal === quaMaxVal) {
                    alert('ìµœì†Œìˆ˜ëŸ‰ê³¼ ìµœëŒ€ìˆ˜ëŸ‰ì´ ê°™ìŠµë‹ˆë‹¤.\nìˆ˜ëŸ‰ì„ ë‹¤ì‹œ í™•ì¸í•´ì£¼ì„¸ìš”.');
                    quaMax.value = '';
                    quaMax.onfocus();
                    return false;
                }

                if (quaMinVal / divUnitVal * divPriceVal < 3000) {
                    alert('ìµœì†Œ êµ¬ë§¤ê¸ˆì•¡ì´ 3,000ì› ë¯¸ë§Œìž…ë‹ˆë‹¤.');
                    divPrice.value = '';
                    divPrice.focus();
                    return false;
                }

                return true;
            }
        });

        frm.user_division_price.onblur = checkPrice;

    } else {
        if (userGoods.value === '' || userGoods.value === 'money') {
            formCheck.add({name: 'user_quantity', msg: 'êµ¬ë§¤ ìˆ˜ëŸ‰ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.', type: 'price', protect: true});
        }
        formCheck.add({name: 'user_price', msg: 'êµ¬ë§¤ ê¸ˆì•¡ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.', type: 'price', protect: true});
        formCheck.add({
            custom: function() {
                if (frm.user_price.value.numeric() % 10 > 0) {
                    alert('ê±°ëž˜ê¸ˆì•¡ì— ì¼ì›ë‹¨ìœ„ëŠ” 0ì´ì™¸ì˜ ìˆ«ìžë¥¼ ìž…ë ¥í• ìˆ˜ ì—†ìŠµë‹ˆë‹¤.\nê±°ëž˜ê¸ˆì•¡ì„ ë‹¤ì‹œ ê¸°ìž¬í•´ ì£¼ì„¸ìš”.\nì˜ˆ) 12,345(ë¶ˆê°€ëŠ¥), 12,340(ê°€ëŠ¥)');
                    frm.user_price.value = '';
                    frm.user_price.focus();
                    return false;
                }
                return true;
            }
        });

        frm.user_price.onblur = checkPrice;

        $('#game_money').find('.g_txtbtn').on({
            click: function() {
                var userQuan = frm.user_quantity;
                var userQuanVal = userQuan.value.numeric();
                var clickVal = this.innerHTML.numeric();
                if (this.innerHTML.numeric() === 0) {
                    userQuan.value = '';
                } else {
                    var sellQuantity = parseInt(userQuanVal);
                    sellQuantity += clickVal;
                    if (sellQuantity >= 999999) sellQuantity = 999999;
                    userQuan.value = sellQuantity.currency();
                }
            }
        });
    }

    /** [ITM-10872] ìºë¦­í„° ê±°ëž˜ ì‹ ê·œ ì„œë¹„ìŠ¤ ì‚½ë‹ˆë‹¤ ì¶”ê°€ by 20200720 KBR */
    if (userGoods.value === 'character') {
        document.getElementById('account_type').addEventListener('change', function(ev) {
            if (this.value === '1') {
                frm.purchase_type.value = '';
                frm.payment_existence.value = '';
                frm.multi_access.value = '';
                frm.purchase_type.disabled = true;
                frm.payment_existence.disabled = true;
                frm.multi_access.disabled = true;
            } else {
                frm.purchase_type.disabled = false;
                frm.payment_existence.disabled = false;
                frm.multi_access.disabled = false;
            }
        });
        formCheck.add({name: 'account_type', msg: 'ìºë¦­í„° ì¢…ë¥˜ë¥¼ ì„ íƒí•´ì£¼ì„¸ìš”.'});
        formCheck.add({
            custom: function() {
                var account_type = frm.account_type.value;
                if (account_type !== '1') {
                    if (frm.purchase_type.value.isEmpty()) {
                        alert('ìºë¦­í„° ì •ë³´ë¥¼ ëª¨ë‘ ìž…ë ¥ í›„ ë“±ë¡ì´ ê°€ëŠ¥í•©ë‹ˆë‹¤.');
                        frm.purchase_type.focus();
                        return false;
                    }
                    if (frm.payment_existence.value.isEmpty()) {
                        alert('ìºë¦­í„° ì •ë³´ë¥¼ ëª¨ë‘ ìž…ë ¥ í›„ ë“±ë¡ì´ ê°€ëŠ¥í•©ë‹ˆë‹¤.');
                        frm.payment_existence.focus();
                        return false;
                    }
                    if (frm.multi_access.value.isEmpty()) {
                        alert('ìºë¦­í„° ì •ë³´ë¥¼ ëª¨ë‘ ìž…ë ¥ í›„ ë“±ë¡ì´ ê°€ëŠ¥í•©ë‹ˆë‹¤.');
                        frm.multi_access.focus();
                        return false;
                    }
                }
                return true;
            }
        });
        /** [ITM-10872] ìºë¦­í„° ê±°ëž˜ ì‹ ê·œ ì„œë¹„ìŠ¤ ì‚½ë‹ˆë‹¤ ì¶”ê°€ by 20200720 KBR */
    } else {
        /* â–¼ ë˜ì „ì•¤íŒŒì´í„° í†µí•©ì„œë²„ ì²˜ë¦¬ */
        var dfServer = document.getElementById('dfServer');
        var dfServerCode = document.getElementById('dfServerCode');
        var userCharacter = document.getElementById('user_character');
        if (gameCode === '281') {
            var dfServerList = new ServerList(document.getElementById('dfServerList'), {
                autoComplete: '#df_server_code_text',
                allView: false,
                gameCode: '281',
                hidden_use: {
                    code: '[name="df_server_code"]',
                    text: ''
                }
            });

            userCharacter.setAttribute('maxlength', 27);

            formCheck.add({
                custom: function() {
                    /* â–¼ ë˜ì „ì•¤íŒŒì´í„° í†µí•©ì„œë²„ ì²˜ë¦¬ */
                    if (document.getElementById('dfServerList').serverList.getValue().code.isEmpty()) {
                        alert('ë¬¼í’ˆì„ ì „ë‹¬ ë°›ìœ¼ì‹¤ ì„œë²„ë¥¼ ì„ íƒ í•´ì£¼ì„¸ìš”.');
                        return false;
                    }
                    return true;
                    /* â–² ë˜ì „ì•¤íŒŒì´í„° í†µí•©ì„œë²„ ì²˜ë¦¬ */
                }
            });
        }
        /* â–² ë˜ì „ì•¤íŒŒì´í„° í†µí•©ì„œë²„ ì²˜ë¦¬ */
        formCheck.add({name: 'user_character', msg: 'ë¬¼í’ˆì„ ì „ë‹¬ ë°›ìœ¼ì‹¤ ìºë¦­í„°ëª…ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.'});
    }

    formCheck.add({name: 'user_title', msg: 'ë¬¼í’ˆì œëª©ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.'});
    formCheck.add({name: 'user_text', msg: 'ìƒì„¸ì„¤ëª…ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.'});
    formCheck.add({
        custom: function() {

            /* â–¼ ì—°ë½ì²˜ ì¤‘ë³µì²´í¬ */
            var slctContact = $('#user_contactA').val();
            var slctMobileType = $('#slctMobile_type').val();
            var params = {
                user_id: $('#user_id').val(),
                trade_flag: 'Y',
                contact_yn: (slctContact === 'N') ? 'N' : 'Y',
                mobile_yn: (slctMobileType === 'N') ? 'N' : 'Y'
            };

            if (params.contact_yn === 'N' && params.mobile_yn === 'N') {
                alert('íœ´ëŒ€í° ë˜ëŠ” ìžíƒ ì—°ë½ì²˜ ì •ë³´ë¥¼ í†µí™” ê°€ëŠ¥í•œ ë²ˆí˜¸ë¡œ ìˆ˜ì • í›„ ì´ìš© ë°”ëžë‹ˆë‹¤.');
                return;
            }

            if (params.contact_yn === 'Y') {
                params.user_contactA = slctContact;
                params.user_contactB = $('#user_contactB').val();
                params.user_contactC = $('#user_contactC').val();
            }
            if (params.mobile_yn === 'Y') {
                params.user_mobileA = $('#user_mobileA').val();
                params.user_mobileB = $('#user_mobileB').val();
                params.user_mobileC = $('#user_mobileC').val();
            }

            ajaxRequest({
                url: '/_include/_user_contact_restrict.php',
                type: 'POST',
                data: params,
                success: function(res) {
                    var rgResult = res.split('|');
                    switch (rgResult[0]) {
                        case 'S':
                            createLayerContent();
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

            return false;
        }
    });
}


function premiumSet() {
    var dvPremium = document.getElementById('dvPremium');
    LayerControl.close({layer: dvPremium});
    createLayerContent(false);
}

function createLayerContent(b) {
    if (document.activeElement) {
        document.activeElement.blur();
    }

    var frm = document.forms.frmBuy;
    var direct = document.getElementById('direct_reg_trade');
    if (direct !== null && direct.checked == true) {
        if(document.getElementById('security_type').value !== 'PASS') {
            _window.open('buy_direct', '', 600, 400, '', true);
            frm.onsubmit = null;
            frm.target = 'buy_direct';
            frm.action = '/certify/payment/user_certify.html';
            frm.submit();

            changeTemplateAddCheck();
            return;
        }
    }

    if (b !== false) {
        var dvPremium = document.getElementById('dvPremium');
        var userMile = document.getElementById('txtCurrentMileage').innerHTML.numeric();
        if (userMile > 100) {
            if ($('#user_premium_time').val().isEmpty() === true) {
                LayerControl.open({layer: dvPremium});
                return;
            }
        }
    }

    frm.onsubmit = null;
    frm.target = '_self';
    frm.action = 'buy_re_reg_ok.php';
    frm.submit();
}

function checkPrice() {
    var val = this.value;
    if (val.isEmpty() || val == '0') {
        return false
    }
    var last = val.substring(val.length - 1, val.length);
    if (last != '0') {
        alert('ê±°ëž˜ê¸ˆì•¡ì— ì¼ì›ë‹¨ìœ„ëŠ” 0ì´ì™¸ì˜ ìˆ«ìžë¥¼ ìž…ë ¥í• ìˆ˜ ì—†ìŠµë‹ˆë‹¤.\n\nê±°ëž˜ê¸ˆì•¡ì„ ë‹¤ì‹œ ê¸°ìž¬í•´ ì£¼ì„¸ìš”.\n\nì˜ˆ) 12,345(ë¶ˆê°€ëŠ¥), 12,340(ê°€ëŠ¥)');
        this.value = '';
        this.focus();
        return false;
    }

    var nCheckPrice = 0;
    if (e_sale[e_select.sale] == e_sale.division) {
        nCheckPrice = 100;
    } else {
        nCheckPrice = 3000;
    }

    if ((arguments.length < 1 || arguments[0] !== true) && parseInt(val.replace(/[^0-9]/g, "")) < Number(nCheckPrice)) {
        alert('ê±°ëž˜ê¸ˆì•¡ì€ ' + Number(nCheckPrice).currency() + 'ì› ì´ìƒìœ¼ë¡œ ìž…ë ¥í•´ì£¼ì„¸ìš”.');
        this.value = '';
        this.focus();
        return false;
    }

    return true;
}

/* â–¼ ë§ˆì¼ë¦¬ì§€ ê²°ì œê¸ˆì•¡ */
function chargeServiceCalc() {
    var userPremiumUseHidden = document.getElementById('user_premium_use');
    var userQuickIconUseHidden = document.getElementById('user_quick_icon_use');
    var userPremiumTime = document.getElementById('user_premium_time').value.numeric();
    var userIconUse = document.getElementById('user_icon_use').value.numeric();
    var userBluepenUse = document.getElementById('user_bluepen_use').value.numeric();
    var userQuickIcon = document.getElementById('user_quickicon_use').value.numeric();
    // var reregCount = document.getElementById('rereg_count').value.numeric() / 3;
    var highlightTotalTime = (userIconUse + userBluepenUse) / 12;
    var currentMileage = document.getElementById('txtCurrentMileage').innerHTML.numeric();
    var plusMile = 0;

    // í”„ë¦¬ë¯¸ì—„ ë“±ë¡
    if (userPremiumTime > 0) {
        userPremiumUseHidden.value = '1';
        if (userPremiumTime > Number(e_use.premium)) {
            plusMile += (userPremiumTime - Number(e_use.premium)) * 100;
        }
    } else {
        userPremiumUseHidden.value = '';
    }

    // í€µì•„ì´ì½˜ ë“±ë¡
    if (userQuickIcon > 0) {
        userQuickIconUseHidden.value = '1';
        if (userQuickIcon > Number(e_use.quickIcon)) {
            plusMile += (userQuickIcon - Number(e_use.quickIcon)) * 100;
        }
    } else {
        userQuickIconUseHidden.value = '';
    }

    if (highlightTotalTime > Number(e_use.highlight)) {
        plusMile += (highlightTotalTime - Number(e_use.highlight)) * 100;
    }

    // plusMile += (reregCount * 100);

    if (currentMileage < plusMile) {
        alert('ë§ˆì¼ë¦¬ì§€ ìž”ì•¡ì´ ë¶€ì¡±í•©ë‹ˆë‹¤.');
        return false;
    }

    if (userPremiumTime > 0 || highlightTotalTime > 0 || userQuickIcon > 0) {
        document.getElementById('user_charge').value = '1';
    } else {
        document.getElementById('user_charge').value = '';
    }

    document.getElementById('total_charge_money').innerHTML = plusMile.currency() + 'ì›';
    return true;
}

/* â–² ë§ˆì¼ë¦¬ì§€ ê²°ì œê¸ˆì•¡ */

/* â–¼ ìœ ë£Œë“±ë¡ ì„œë¹„ìŠ¤ */
function chargeServiceApply(strClass) {
    var bCheck = chargeServiceCalc();
    if (bCheck === true) {
        var chargeApply = document.getElementById('charge_apply');
        if (this.value.isEmpty() === true && chargeApply.classList.contains(strClass) === true) {
            chargeApply.classList.remove(strClass);
        } else if (this.value.isEmpty() === false && chargeApply.classList.contains(strClass) === false) {
            chargeApply.classList.add(strClass);
        }
    }
}

function chargePremiumService() {
    if (bPremiumLayer == false) {
        LayerControl.open({
            layer: document.getElementById('premium_layer'),
            close_btn: document.getElementById('premium_layer').querySelector('.close'),
            mask: false,
            type: 'style'
        });

        document.getElementById('premium_close').addEventListener('click', function() {
            LayerControl.close({layer: document.getElementById('premium_layer')});
        });

        bPremiumLayer = true;
    }
}

/* â–² ìœ ë£Œë“±ë¡ ì„œë¹„ìŠ¤ */

/* â–¼ ì¦‰ì‹œêµ¬ë§¤ */
function setDirectBuy() {
    var frm = document.forms.frmBuy;
    if (this.checked === true) {
        var useMileNum = useMileage.numeric();
        if (e_sale[e_select.sale] === e_sale.general) {
            var userPrice = document.getElementById('user_price');
            var userPriceVal = userPrice.value.numeric();

            if (userPrice.value.isEmpty()) {
                alert('ê±°ëž˜ ê¸ˆì•¡ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.');
                this.checked = false;
                userPrice.focus();
                return false;
            } else if (useMileNum === 0 || userPriceVal > useMileNum) {
                alert('[ì¦‰ì‹œ êµ¬ë§¤ ë“±ë¡ ì•ˆë‚´]\nì¦‰ì‹œ êµ¬ë§¤ ì˜µì…˜ì€ ë§ˆì¼ë¦¬ì§€ë¥¼ ë³´ìœ í•œ ìƒíƒœì—ì„œë§Œ ì´ìš©ì´ ê°€ëŠ¥í•©ë‹ˆë‹¤.\në§ˆì¼ë¦¬ì§€ í™•ì¸ í›„ ì´ìš© ë°”ëžë‹ˆë‹¤.');
                this.checked = false;
                return false;
            }

            frm.direct_condition_credit.disabled = false;
            frm.direct_condition_hpp.disabled = false;
            frm.direct_condition_acc.disabled = false;
        } else {
            var divPrice = frm.user_division_price.value.numeric();
            var userMax = frm.user_quantity_max.value.numeric();
            var divUnit = frm.user_division_unit.value.numeric();
            var minTradeMoney = Math.round(divPrice * (userMax / divUnit));

            if (frm.user_division_price.value.isEmpty()) {
                alert('ê±°ëž˜ ê¸ˆì•¡ì„ ìž…ë ¥í•´ì£¼ì„¸ìš”.');
                this.checked = false;
                frm.user_division_price.focus();
                return false;
            } else if (useMileNum == 0 || Math.round(minTradeMoney) > useMileNum) {
                alert('[ì¦‰ì‹œ êµ¬ë§¤ ë“±ë¡ ì•ˆë‚´]\nì¦‰ì‹œ êµ¬ë§¤ ì˜µì…˜ì€ ë§ˆì¼ë¦¬ì§€ë¥¼ ë³´ìœ í•œ ìƒíƒœì—ì„œë§Œ ì´ìš©ì´ ê°€ëŠ¥í•©ë‹ˆë‹¤.\në§ˆì¼ë¦¬ì§€ í™•ì¸ í›„ ì´ìš© ë°”ëžë‹ˆë‹¤.');
                this.checked = false;
                return false;
            }

            frm.direct_condition_credit.disabled = false;
            frm.direct_condition_hpp.disabled = false;
            frm.direct_condition_acc.disabled = false;
        }
    } else {
        frm.direct_condition_credit.disabled = true;
        frm.direct_condition_hpp.disabled = true;
        frm.direct_condition_acc.disabled = true;
    }
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
