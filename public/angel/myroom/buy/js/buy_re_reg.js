// 판매유형
var fixed_trade_subject = true;
var angel_item_s_alias = {
    'general': '일반판매',
    'division': '분할판매'
};

var angel_item_alias = {
    'money': '게임머니',
    'item': '아이템',
    'character': '캐릭터',
    'etc': '기타'
};

// 현재선택된 타입
var angel_enable_type = {
    sale: 'general',
    goods: 'money'
};

// 현재선택된 단위
var angel_item_unit = '';

var angel_premiun_items = {
    premium: 0,
    highlight: 0,
    quickIcon:0,
    rereg: 0
};

// 프리미엄 레이어 활성화
var premiumService = false;

function _init() {

    // 물품기본값적용
    document.getElementById('trade_sign_txt').addEventListener('click', function() {
        var strFixTag = document.getElementById('trade_sign_txt').innerHTML;
        if (strFixTag.isEmpty() === true) {
            if (confirm('물품제목 기본값으로 설정된 값이 없습니다. \r물품 제목 기본값을 설정하시겠습니까?')) {
                _window.open('fixed_title', 'fixed_trade_subject.html', 500, 300);
            }
            fixed_trade_subject = false;
            return;
        }
        strFixTag += ' ';
        if (fixed_trade_subject === true) {
            document.getElementById('user_title').value = strFixTag + document.getElementById('user_title').value;
        } else {
            document.getElementById('user_title').value = document.getElementById('user_title').value.replace(strFixTag, '');
        }
        fixed_trade_subject = !fixed_trade_subject;
    });

    document.getElementById('sr-template').addEventListener('click', function(e) {
        if (e.target.name === 'gamemoney_unit') {
            var unit = e.target.value;
            if (e.target.value === '1') {
                unit = '';
            }
            $('.unit').text(unit);
        }
    });

    // 즉시구매
    if (document.getElementById('direct_reg_trade') !== null) {
        document.getElementById('direct_reg_trade').addEventListener('click', setDirectBuy);
    }

    // 프리미엄 등록
    document.getElementById('user_premium_time').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceCalc();
    });
    // 굵은체 등록
    document.getElementById('user_icon_use').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceApply.call(this, 'font-weight-bold');
    });
    // 녹색펜 등록
    document.getElementById('user_bluepen_use').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceApply.call(this, 'f_green2');
    });
    // 퀵아이콘 등록
    document.getElementById('user_quickicon_use').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceCalc();
    });
    // document.getElementById('rereg_count').addEventListener('change', function() {
    // 	var result = chargeServiceCalc.call(this);
    // 	if (result === true) {
    // 		var setVal = ['0회', '0분'];
    // 		if (this.value.isEmpty() === false) {
    // 			setVal[0] = this.value + '회';
    // 			setVal[1] = document.getElementById('rereg_time').value + '분';
    // 		}
    // 		document.getElementById('rereg_cnt').innerHTML = setVal[0];
    // 		document.getElementById('minute').innerHTML = setVal[1];
    // 	}
    // });

    document.getElementById('actionPremium').addEventListener('click', premiumSet);

    if (document.getElementById('credit_benefit') !== null) {
        document.getElementById('credit_benefit').addEventListener('click', getCreditBenefit);
    }

    SafetyNumber();
    alterConstructorAddCheck();

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
                    alert('알림등록은 최대 3개까지 가능합니다.')
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
        url: '/api/_include/_get_free_use',
        dataType: 'JSON',
        type: 'POST',
        data: {
            game_code: gameCode,
            api_token: a_token
        },
        success: function(res) {
            angel_premiun_items.premium = res.premium;
            angel_premiun_items.highlight = res.highlight;
            angel_premiun_items.quickIcon = res.quickicon;
            $('#user_premium_time').val('');
            $('#user_icon_use').val('');
            $('#user_bluepen_use').val('');
            $('#user_quickicon_use').val('');
            chargeServiceCalc();
        }
    });
}

/**
 * 신용등급 혜택받기
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
                    alert("잘못된 접근입니다.");
                    break;
                case "CreditNo" :
                    alert("신용등급을 업데이트하지 못했습니다. 관리자에게 문의해 주세요.");
                    break;
                case "CreditNo2" :
                    alert("신용등급을 가져오지 못했습니다. 관리자에게 문의해 주세요.");
                    break;
                case "Dberror" :
                    alert("서비스가 원할하지 않습니다. 잠시 후 이용해주세요");
                    break;
                case "Overlap" :
                    if (returnData[1] == 1) {
                        alert("이미 무료이용권을 발급 받으셨습니다.");
                    } else {
                        alert("이미 옥션입찰권을 발급 받으셨습니다");
                    }
                    break
                case "Rowerror" :
                    alert("프리미엄 이용권을 지급하지 못했습니다. 다시 시도해주세요.");
                    break;
                case "Rowerror2" :
                    alert("물품강조 이용권을 지급하지 못했습니다. 다시 시도해주세요.");
                    break;
                case "Rowerror3" :
                    alert("옥션입찰권을 지급하지 못했습니다. 다시 시도해주세요.");
                    break;
                case "Rowerror4" :
                    alert("출금 무료이용권을 지급하지 못했습니다. 다시 시도해주세요.");
                    break;
                case "Success" :
                    alert('무료이용권이 발급되었습니다.\n[무료이용권보기]를 확인해주세요.');
                    getFreeUse();
                    break;
            }
        },
        error: function() {
            alert("시스템 점검중입니다. 잠시 후 이용해 주세요.");
        }
    });
}

function setDefaultText() {
    var strGoods = angel_item_alias[angel_enable_type.goods];
    if (angel_enable_type.goods === 'money' && angel_item_unit.isEmpty() === false) {
        strGoods = angel_item_unit;
    }

    var defaultText = strGoods + ' 삽니다.';

    document.getElementById('user_title').value = defaultText;

    if (document.querySelector('[name="text_select"]:checked').value === '0') {
        document.getElementById('user_text').value = defaultText;
    }
}

function alterConstructorAddCheck() {
    var frm = document.forms.frmBuy;
    if (frm.checker) {
        frm.checker.free();
    }
    var formCheck = new FormChecker('frmBuy');
    var userGoods = document.querySelector('[name="user_goods"]');
    var userGoodsType = document.querySelector('[name="user_goods_type"]');
    var gameCode = document.querySelector('[name="game_code"]').value;

    if (userGoodsType.value === 'division') {
        formCheck.add({name: 'user_quantity_min', msg: '최소 구매 수량을 입력해주세요.', type: 'price', protect: true});
        formCheck.add({name: 'user_quantity_max', msg: '최대 구매 수량을 입력해주세요.', type: 'price', protect: true});
        formCheck.add({name: 'user_division_unit', msg: '분할단위를 입력해 주세요.', type: 'price', protect: true});
        formCheck.add({
            name: 'user_division_price',
            msg: '거래금액은 100원 이상으로 입력해 주세요',
            type: 'price',
            protect: true,
            range: {min: 100}
        });
        formCheck.add({
            custom: function() {
                if (frm.user_division_price.value.numeric() % 10 > 0) {
                    alert('거래금액에 일원단위는 0이외의 숫자를 입력할수 없습니다.\n\n거래금액을 다시 기재해 주세요.\n\n예) 12,345(불가능), 12,340(가능)');
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
                    alert('분할단위가 최소수량보다 큽니다.');
                    quaMin.value = '';
                    quaMin.onfocus();
                    return false;
                }

                if (quaMinVal > quaMaxVal) {
                    alert('최소수량이 최대수량보다 큽니다.');
                    quaMax.value = '';
                    quaMax.onfocus();
                    return false;
                }

                if (quaMinVal === quaMaxVal) {
                    alert('최소수량과 최대수량이 같습니다.\n수량을 다시 확인해주세요.');
                    quaMax.value = '';
                    quaMax.onfocus();
                    return false;
                }

                if (quaMinVal / divUnitVal * divPriceVal < 3000) {
                    alert('최소 구매금액이 3,000원 미만입니다.');
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
            formCheck.add({name: 'user_quantity', msg: '구매 수량을 입력해주세요.', type: 'price', protect: true});
        }
        formCheck.add({name: 'user_price', msg: '구매 금액을 입력해주세요.', type: 'price', protect: true});
        formCheck.add({
            custom: function() {
                if (frm.user_price.value.numeric() % 10 > 0) {
                    alert('거래금액에 일원단위는 0이외의 숫자를 입력할수 없습니다.\n거래금액을 다시 기재해 주세요.\n예) 12,345(불가능), 12,340(가능)');
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

    /** [ITM-10872] 캐릭터 거래 신규 서비스 삽니다 추가 by 20200720 KBR */
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
        formCheck.add({name: 'account_type', msg: '캐릭터 종류를 선택해주세요.'});
        formCheck.add({
            custom: function() {
                var account_type = frm.account_type.value;
                if (account_type !== '1') {
                    if (frm.purchase_type.value.isEmpty()) {
                        alert('캐릭터 정보를 모두 입력 후 등록이 가능합니다.');
                        frm.purchase_type.focus();
                        return false;
                    }
                    if (frm.payment_existence.value.isEmpty()) {
                        alert('캐릭터 정보를 모두 입력 후 등록이 가능합니다.');
                        frm.payment_existence.focus();
                        return false;
                    }
                    if (frm.multi_access.value.isEmpty()) {
                        alert('캐릭터 정보를 모두 입력 후 등록이 가능합니다.');
                        frm.multi_access.focus();
                        return false;
                    }
                }
                return true;
            }
        });
    } else {
        var dfServer = document.getElementById('dfServer');
        var dfServerCode = document.getElementById('dfServerCode');
        var userCharacter = document.getElementById('user_character');
        // if (gameCode === '281') {
        //     var dfServerList = new ServerList(document.getElementById('dfServerList'), {
        //         autoComplete: '#df_server_code_text',
        //         allView: false,
        //         gameCode: '281',
        //         hidden_use: {
        //             code: '[name="df_server_code"]',
        //             text: ''
        //         }
        //     });
        //
        //     userCharacter.setAttribute('maxlength', 27);
        //
        //     formCheck.add({
        //         custom: function() {
        //             /* ▼ 던전앤파이터 통합서버 처리 */
        //             if (document.getElementById('dfServerList').serverList.getValue().code.isEmpty()) {
        //                 alert('물품을 전달 받으실 서버를 선택 해주세요.');
        //                 return false;
        //             }
        //             return true;
        //             /* ▲ 던전앤파이터 통합서버 처리 */
        //         }
        //     });
        // }

        formCheck.add({name: 'user_character', msg: '물품을 전달 받으실 캐릭터명을 입력해주세요.'});
    }

    formCheck.add({name: 'user_title', msg: '물품제목을 입력해주세요.'});
    formCheck.add({name: 'user_text', msg: '상세설명을 입력해주세요.'});
    formCheck.add({
        custom: function() {

            var slctContact = $('#user_contactA').val();
            var slctMobileType = $('#slctMobile_type').val();
            var params = {
                user_id: $('#user_id').val(),
                trade_flag: 'Y',
                contact_yn: (slctContact === 'N') ? 'N' : 'Y',
                mobile_yn: (slctMobileType === 'N') ? 'N' : 'Y'
            };

            if (params.contact_yn === 'N' && params.mobile_yn === 'N') {
                alert('휴대폰 또는 자택 연락처 정보를 통화 가능한 번호로 수정 후 이용 바랍니다.');
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
            params.api_token = a_token;
            ajaxRequest({
                url: '/api/_include/_user_contact_restrict',
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
                    alert('서비스가 원할하지 않습니다. 잠시후 이용해 주세요.');
                }
            });
            /* ▲ 연락처 중복체크 */

            return false;
        }
    });
}


function premiumSet() {
    var premiumPart = document.getElementById('premiumPart');
    KeepAlivesRaw.close({layer: premiumPart});
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
            frm.action = '/certify/payment/user_certify';
            frm.submit();

            alterConstructorAddCheck();
            return;
        }
    }

    if (b !== false) {
        var premiumPart = document.getElementById('premiumPart');
        var userMile = document.getElementById('txtCurrentMileage').innerHTML.numeric();
        if (userMile > 100) {
            if ($('#user_premium_time').val().isEmpty() === true) {
                KeepAlivesRaw.open({layer: premiumPart});
                return;
            }
        }
    }

    frm.onsubmit = null;
    frm.target = '_self';
    frm.action = '/buy_re_reg_ok';
    frm.submit();
}

function checkPrice() {
    var val = this.value;
    if (val.isEmpty() || val == '0') {
        return false
    }
    var last = val.substring(val.length - 1, val.length);
    if (last != '0') {
        alert('거래금액에 일원단위는 0이외의 숫자를 입력할수 없습니다.\n\n거래금액을 다시 기재해 주세요.\n\n예) 12,345(불가능), 12,340(가능)');
        this.value = '';
        this.focus();
        return false;
    }

    var nCheckPrice = 0;
    if (angel_item_s_alias[angel_enable_type.sale] == angel_item_s_alias.division) {
        nCheckPrice = 100;
    } else {
        nCheckPrice = 3000;
    }

    if ((arguments.length < 1 || arguments[0] !== true) && parseInt(val.replace(/[^0-9]/g, "")) < Number(nCheckPrice)) {
        alert('거래금액은 ' + Number(nCheckPrice).currency() + '원 이상으로 입력해주세요.');
        this.value = '';
        this.focus();
        return false;
    }

    return true;
}

/* ▼ 마일리지 결제금액 */
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

    // 프리미엄 등록
    if (userPremiumTime > 0) {
        userPremiumUseHidden.value = '1';
        if (userPremiumTime > Number(angel_premiun_items.premium)) {
            plusMile += (userPremiumTime - Number(angel_premiun_items.premium)) * 100;
        }
    } else {
        userPremiumUseHidden.value = '';
    }

    // 퀵아이콘 등록
    if (userQuickIcon > 0) {
        userQuickIconUseHidden.value = '1';
        if (userQuickIcon > Number(angel_premiun_items.quickIcon)) {
            plusMile += (userQuickIcon - Number(angel_premiun_items.quickIcon)) * 100;
        }
    } else {
        userQuickIconUseHidden.value = '';
    }
    if (highlightTotalTime > Number(angel_premiun_items.highlight)) {
        plusMile += (highlightTotalTime - Number(angel_premiun_items.highlight)) * 100;
    }

    // plusMile += (reregCount * 100);

    if (currentMileage < plusMile) {
        alert('마일리지 잔액이 부족합니다.');
        return false;
    }

    if (userPremiumTime > 0 || highlightTotalTime > 0 || userQuickIcon > 0) {
        document.getElementById('user_charge').value = '1';
    } else {
        document.getElementById('user_charge').value = '';
    }

    document.getElementById('total_charge_money').innerHTML = plusMile.currency() + '원';
    return true;
}

/* ▲ 마일리지 결제금액 */

/* ▼ 유료등록 서비스 */
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
    premiumService = true;
    if (premiumService == false) {
        KeepAlivesRaw.open({
            layer: document.getElementById('premium_layer'),
            close_btn: document.getElementById('premium_layer').querySelector('.close'),
            mask: false,
            type: 'style'
        });

        document.getElementById('premium_close').addEventListener('click', function() {
            KeepAlivesRaw.close({layer: document.getElementById('premium_layer')});
        });

        premiumService = true;
    }
}

/* ▲ 유료등록 서비스 */

/* ▼ 즉시구매 */
function setDirectBuy() {
    var frm = document.forms.frmBuy;
    if (this.checked === true) {
        var useMileNum = useMileage.numeric();
        if (angel_item_s_alias[angel_enable_type.sale] === angel_item_s_alias.general) {
            var userPrice = document.getElementById('user_price');
            var userPriceVal = userPrice.value.numeric();

            if (userPrice.value.isEmpty()) {
                alert('거래 금액을 입력해주세요.');
                this.checked = false;
                userPrice.focus();
                return false;
            } else if (useMileNum === 0 || userPriceVal > useMileNum) {
                alert('[즉시 구매 등록 안내]\n즉시 구매 옵션은 마일리지를 보유한 상태에서만 이용이 가능합니다.\n마일리지 확인 후 이용 바랍니다.');
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
                alert('거래 금액을 입력해주세요.');
                this.checked = false;
                frm.user_division_price.focus();
                return false;
            } else if (useMileNum == 0 || Math.round(minTradeMoney) > useMileNum) {
                alert('[즉시 구매 등록 안내]\n즉시 구매 옵션은 마일리지를 보유한 상태에서만 이용이 가능합니다.\n마일리지 확인 후 이용 바랍니다.');
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
        url: '/api/_include/_SafetyNumber_Category_Check_AJAX',
        type: 'post',
        data: {
            gamecode: $('#game_code').val(),
            api_token:a_token
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

function setTit(title){
    $("#trade_sign_txt").text(title)
}
