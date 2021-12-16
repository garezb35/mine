// 판매유형
var angel_item_s_alias = {
    'general': '일반판매',
    'division': '분할판매',
    'bargain': '흥정판매'
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
    var bargain = $('#bargain');

    // 물품기본값적용
    document.getElementById('fixed_trade_subject').addEventListener('click', function() {
        var strFixTag = document.getElementById('trade_sign_txt').innerHTML;
        if (strFixTag.isEmpty() === true) {
            if (confirm('물품제목 기본값으로 설정된 값이 없습니다.\n물품 제목 기본값을 설정하시겠습니까?')) {
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

    document.getElementById('sr-template').addEventListener('click', function(e) {
        if (e.target.name === 'gamemoney_unit') {
            var unit = e.target.value;
            if (e.target.value === '1') {
                unit = '';
            }
            $('.unit').text(unit);
        }
    });

    document.getElementById('user_premium_time').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceCalc();
    });
    document.getElementById('rereg_count').addEventListener('change', function() {
        chargePremiumService();
        var result = chargeServiceCalc.call(this);
        if (result === true) {
            var setVal = ['0회', '0분'];
            if (this.value.isEmpty() === false) {
                setVal[0] = this.value + '회';
                setVal[1] = document.getElementById('rereg_time').value + '분';
            }
            document.getElementById('rereg_cnt').innerHTML = setVal[0];
            document.getElementById('minute').innerHTML = setVal[1];
        }
    });

    document.getElementById('user_icon_use').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceApply.call(this, 'font-weight-bold');
    });

    document.getElementById('user_bluepen_use').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceApply.call(this, 'text-blue_modern');
    });
    document.getElementById('user_quickicon_use').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceCalc();
        //chargeServiceApply.call(this, 'text-blue_modern');
    });
    document.getElementById('actionPremium').addEventListener('click', premiumSet);

    if (document.getElementById('discount_use') !== null) {
        if (document.getElementById('discount_use').checked === true) {
            ComplexDiscount();
        }
    }

    if (document.getElementById('compen_guide') !== null) {
        KeepAlivesRaw({
            el: document.getElementById('compen_guide'),
            layer: document.getElementById('compen_layer'),
            mask: false,
            type: 'style'
        });
    }

    document.addEventListener('click', function(e) {
        if (e.target.name === 'power_regist') {
            fnpoweruse.call(e.target);
        }
    });

    if (document.getElementById('credit_benefit') !== null) {
        document.getElementById('credit_benefit').addEventListener('click', getCreditBenefit);
    }

    KeepAlivesRaw({
        layer: document.getElementById('dialog_fade'),
        close_btn: document.getElementById('dialog_fade').querySelector('.fade__out'),
        type: 'style'
    });

    SafetyNumber();
    alterConstructorAddCheck();
    fnPower();

    new FileStyleVer2(document.querySelectorAll('[name="user_screen[]"]'));

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
            chargeServiceCalc();
        }
    });
}

/**
 * 신용등급 혜택받기
 */
function getCreditBenefit() {

    ajaxRequest({
        url: '/myroom/myinfo/credit_rating_ok',
        type: 'post',
        data: 'type=1',
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

function alterConstructorAddCheck() {
    var frm = document.forms.frmSell;
    if (frm.checker) {
        frm.checker.free();
    }
    var formCheck = new FormChecker('frmSell');
    var userGoods = document.querySelector('[name="user_goods"]');
    var userGoodsType = document.querySelector('[name="user_goods_type"]');
    var gameCode = document.querySelector('[name="game_code"]').value;
    if (userGoodsType.value === 'division') {
        KeepAlivesRaw({
            el: document.getElementById('discount_guide'),
            layer: document.getElementById('discount_layer'),
            mask: false,
            type: 'style'
        });

        formCheck.add({name: 'user_quantity_min', msg: '최소 판매 수량을 입력해주세요.', type: 'price', protect: true});
        formCheck.add({name: 'user_quantity_max', msg: '최대 판매 수량을 입력해주세요.', type: 'price', protect: true});
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
                var discountUse = document.querySelector('[name="discount_use"]');
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
                    alert('최소 판매금액이 3,000원 미만입니다.');
                    divPrice.value = '';
                    divPrice.focus();
                    return false;
                }

                if (discountUse.checked === true) {
                    var discountQnt = document.getElementById('discount_quantity');
                    var disQntCnt = document.getElementById('discount_quantity_cnt');
                    var disPrice = document.getElementById('discount_price');

                    if (discountQnt.value.isEmpty()) {
                        alert('할인적용 수량을 입력해 주세요.');
                        discountQnt.onfocus();
                        return false;
                    }
                    if (disPrice.value.isEmpty()) {
                        alert('할인금액은 100원 이상으로 입력해 주세요.');
                        disPrice.onfocus();
                        return false;
                    }
                    if (Math.ceil(quaMinVal / divUnitVal) > disQntCnt.value.numeric()) {
                        alert('할인적용은 ' + Math.ceil(quaMinVal / divUnitVal) + '번 이상 가능합니다.');
                        disQntCnt.value = Math.ceil(quaMinVal / divUnitVal);
                        disQntCnt.onfocus();
                        return false;
                    }
                    if (Math.floor(quaMaxVal / 2) < Number(disQntCnt.value.numeric() * discountQnt.value.numeric())) {
                        alert('할인적용은 ' + Math.floor(quaMaxVal / quaMinVal / 2) + '번 까지 가능합니다.');
                        disQntCnt.value = '';
                        disQntCnt.onfocus();
                        return false;
                    }
                    if (divPriceVal / 2 < disPrice.value.numeric()) {
                        alert('최대 할인금액을 초과하였습니다.');
                        disPrice.value = '';
                        disPrice.onfocus();
                        return false;
                    }
                }
                return true;
            }
        });

        frm.user_division_price.onblur = checkPrice;
        frm.user_quantity_min.onkeyup = function() {
            if (frm.discount_use.checked == true) {
                frm.discount_use.checked = false;
                ComplexDiscount();
            }
        };
        frm.user_division_unit.onkeyup = function() {
            if (frm.discount_use.checked == true) {
                frm.discount_use.checked = false;
                ComplexDiscount();
            }
        };

    } else {
        if (userGoods.value === '' || userGoods.value === 'money') {
            formCheck.add({name: 'user_quantity', msg: '판매 수량을 입력해주세요.', type: 'price', protect: true});
        }
        formCheck.add({name: 'user_price', msg: '판매 금액을 입력해주세요.', type: 'price', protect: true});
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

        document.getElementById('user_price').addEventListener('keyup', function() {
            commissionCalcu.call(this);
        });

        if (userGoodsType.value === 'bargain') {
            formCheck.add({
                custom: function() {
                    var userDenyUse = document.getElementById('user_deny_use');
                    if (userDenyUse.checked === true && frm.user_price_limit.value.isEmpty()) {
                        alert('최저 흥정 가격 설정금액을 입력해주세요.');
                        frm.user_price_limit.focus();
                        return false;
                    }
                    return true;
                }
            });

            document.getElementById('user_deny_use').addEventListener('click', function() {
                if (this.checked === true) {
                    document.getElementById('min_user_bargain').style.display = 'block';
                } else {
                    document.getElementById('min_user_bargain').style.display = 'none';
                    frm.user_price_limit.value = '';
                }
            });
            frm.user_price_limit.addEventListener('keyup', function() {
                commissionCalcu.call(this, '2');
            });

            Form.protect.price(frm.user_price_limit);
            frm.user_price_limit.onblur = getPriceLimit;
        }
    }

    if (document.getElementById('slt_item_info') !== null) {
        formCheck.add({
            custom: function() {
                var itemInfo = document.getElementById('iteminfo_use');
                if (itemInfo.checked === true && frm.slt_item_info.value.isEmpty() === true) {
                    alert('아이템정보를 입력해주세요.');
                    frm.iteminfo_dept1.focus();
                    return false;
                }
                return true;
            }
        });

        var iteminfoDept1 = document.getElementById('iteminfo_dept1');
        var rgItemInfo;
        ajaxRequest({
            url: '/_json/search_item.json',
            dataType: 'JSON',
            success: function(res) {
                rgItemInfo = res['650'];
                var list = rgItemInfo.list[0];
                var newOption = '';
                Object.keys(list.item).sort().forEach(function(t) {
                    newOption = document.createElement('option');
                    newOption.value = t;
                    newOption.text = list.item[t].name;
                    iteminfoDept1.appendChild(newOption);
                });
            }
        });
        $(iteminfoDept1).on('change', function() {
            var iteminfoDept2 = document.getElementById('iteminfo_dept2');
            var itemTitle = document.getElementById('item_title');
            var pName = rgItemInfo.list[0].item[this.value].p_name;
            var items = rgItemInfo.list[0].item[this.value].items;
            if (pName === undefined) {
                pName = '직업';
            }
            iteminfoDept2.innerHTML = '';

            var newOption = document.createElement('option');
            newOption.value = '';
            newOption.text = '선택';
            iteminfoDept2.appendChild(newOption);
            Object.keys(items).forEach(function(t) {
                newOption = document.createElement('option');
                newOption.value = items[t].code;
                newOption.text = items[t].name;
                iteminfoDept2.appendChild(newOption);
            });

            itemTitle.innerHTML = pName;
        });

        document.getElementById('item_add').addEventListener('click', fnSltItemAdd);
        document.getElementById('iteminfo_use').addEventListener('click', function() {
            if (this.checked === false) {
                var itemInfoResult = document.getElementById('item_info_result');
                if (itemInfoResult.classList.contains('text-rock') === false) {
                    itemInfoResult.innerHTML = '아이템 정보를 선택하시면 판매에 도움이 됩니다.';
                    itemInfoResult.classList.add('text-rock');
                }
                iteminfoDept1.options[0].selected = true;
                $(iteminfoDept1).trigger('change');
                frm.slt_item_info.value = '';
            }
        });
    }

    if (document.getElementById('item_detail_srh_service') !== null) {
        formCheck.add({
            custom: function() {
                var itemInfo = document.getElementById('iteminfo_use');
                if (itemInfo.checked === true && frm.iteminfo_use_complete.value === 'N') {
                    alert('아이템정보 입력 후 등록이 가능합니다.');
                    frm.iteminfo_use.focus();
                    return false;
                }
                return true;
            }
        });

        itemDetailSetting.checkItemData();
    }

    if (gameCode === '650') {
        document.getElementById('sub_text').innerHTML = ' [반드시 배틀태그를 입력해주세요.]';
    } else {
        if (userGoods.value != "character") {
            document.getElementById('sub_text').innerHTML = '';
        }
    }

    /* ▼ 던전앤파이터 통합서버 처리 */
    var userCharacter = document.getElementById('user_character');
    if (gameCode === '281') {
        var dfServerCode = document.querySelector('[name="df_server_code"]').value;
        var dfServerList = new ServerList(document.getElementById('dfServerList'), {
            autoComplete: '#df_server_code_text',
            allView: false,
            gameCode: '281',
            serverCode: dfServerCode,
            hidden_use: {
                code: '[name="df_server_code"]',
                text: ''
            }
        });
        userCharacter.setAttribute('maxlength', 27);

        formCheck.add({
            custom: function() {
                /* ▼ 던전앤파이터 통합서버 처리 */
                if (document.getElementById('dfServerList').serverList.getValue().code.isEmpty()) {
                    alert('물품을 전달 하실 서버를 선택 해주세요.');
                    return false;
                }
                return true;
                /* ▲ 던전앤파이터 통합서버 처리 */
            }
        });

        formCheck.add({name: 'user_character', msg: '물품을 전달 하실 캐릭터명을 입력해주세요.'});
    }
    /* ▲ 던전앤파이터 통합서버 처리 */
    formCheck.add({name: 'user_title', msg: '물품제목을 입력해주세요.'});
    formCheck.add({name: 'user_text', msg: '상세설명을 입력해주세요.'});
    formCheck.add({
        custom: function() {

            /* ▼ 연락처 중복체크 */
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

    var frm = document.forms.frmSell;
    var dialog_fade = document.getElementById('dialog_fade');

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
    frm.action = '/sell_re_reg_ok';
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
        commissionCalcu.call(this);
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

//자동거부 금액 체크
function getPriceLimit() {
    var val = this.value;
    if (val.isEmpty() || val == '0') {
        return false;
    }

    var objDenyUse = $("[name='user_deny_use']");
    var objPrice = $("#user_price");
    var objPriceLimit = $("[name='user_price_limit']");

    if (!objDenyUse || !objPrice || !objPriceLimit) {
        return
    }

    var nPrice = Number(objPrice.val().replace(/[^0-9]/g, ""));
    var nPriceLimit = Number(val.replace(/[^0-9]/g, ""));

    if (objDenyUse.val() == "1") {
        if (nPrice <= nPriceLimit) {
            alert("최저흥정가격은 즉시판매금액보다 작아야합니다.");
            this.value = '';
            this.focus();
            return false;
        }
    }

    var last = val.substring($(this).val().length - 1, $(this).val().length);
    if (last != '0') {
        alert('거래금액에 일원단위는 0이외의 숫자를 입력할수 없습니다.\n\n거래금액을 다시 기재해 주세요.\n\n예) 12,345(불가능), 12,340(가능)');
        this.value = '';
        this.focus();
        return false;
    }
    if ((arguments.length < 1 || arguments[0] !== true) && parseInt(val.replace(/[^0-9]/g, "")) < 3000) {
        alert('거래금액은 3,000원 이상으로 입력해주세요.');
        this.value = '';
        this.focus();
        return false;
    }
}

/* ▼ 수수료계산 */
function commissionCalcu(t) {
    // var comsArea = document.getElementById('coms_area');
    // if (t === '2') {
    //     comsArea = document.getElementById('coms_area2');
    // }
    //
    // if (this.value === '0' || this.value.isEmpty() === true) {
    //     comsArea.style.display = 'none';
    //     return;
    // }

    comsArea.style.display = 'block';

    var strPrice = this.value;
    var nPrice = Number(strPrice.replace(/[^0-9]/g, ''));
    var nCommission = 5;
    var nComPrice = 0;
    var nReceivePrice = 0;

    // 최대 수수료 변경
    var nMaxCommission = 29800;
    var dtCheckDate = new Date(2020, 4, 1, 0, 0, 0, 0);
    var dtDate = new Date();
    if (dtDate.getTime() >= dtCheckDate.getTime()) {
        nMaxCommission = 47000;
    }

    if (!strPrice.isEmpty() && nPrice >= 3000) {
        nComPrice = Math.floor(nPrice * nCommission / 100);

        if (nComPrice % 10 !== 0) {
            nComPrice -= (nComPrice % 10);
        }

        /* ▼ 최저/최대수수료 */
        if (nComPrice < 1000) {
            nComPrice = 1000;
        } else if (nComPrice > nMaxCommission) {
            nComPrice = nMaxCommission;
        }
        /* ▲ 최저/최대수수료 */

        nReceivePrice = nPrice - nComPrice;
    }

    if (t === '2') {
        $('#commission_price2').html(nComPrice.currency());
        $('#receive_price2').html(nReceivePrice.currency());
    } else {
        $('#commission_price').html(nComPrice.currency());
        $('#receive_price').html(nReceivePrice.currency());
    }
}

/* ▲ 수수료계산 */

/* ▼ 마일리지 결제금액 */
function chargeServiceCalc() {
    var userPremiumUseHidden = document.getElementById('user_premium_use');
    var userQuickIconUseHidden = document.getElementById('user_quick_icon_use');
    var userPremiumTime = document.getElementById('user_premium_time').value.numeric();
    var userIconUse = document.getElementById('user_icon_use').value.numeric();
    var userBluepenUse = document.getElementById('user_bluepen_use').value.numeric();
    var userQuickIcon = document.getElementById('user_quickicon_use').value.numeric();
    var reregCount = document.getElementById('rereg_count').value.numeric() / 3;
    var highlightTotalTime = (userIconUse + userBluepenUse) / 12;
    var currentMileage = document.getElementById('txtCurrentMileage').innerHTML.numeric();
    var plusMile = 0;
    var user_charge = false;

    if (userPremiumTime > 0) {
        userPremiumUseHidden.value = '1';
        if (userPremiumTime > Number(angel_premiun_items.premium)) {
            plusMile += (userPremiumTime - Number(angel_premiun_items.premium)) * 100;
        }
    } else {
        userPremiumUseHidden.value = '';
    }

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

    plusMile += (reregCount * 100);

    if (currentMileage < plusMile) {
        alert('마일리지 잔액이 부족합니다.');
        return false;
    }

    if (userPremiumTime > 0 || highlightTotalTime > 0 || reregCount > 0) {
        document.getElementById('user_charge').value = '1';
    } else {
        document.getElementById('user_charge').value = '';
    }

    document.getElementById('total_charge_money').innerHTML = plusMile.currency() + '원';
    return true;
}

/* ▲ 마일리지 결제금액 */

/* ▼ 유료등록 서비스 */
function fnChargeService(userCharge) {
    if (userCharge == '1') {
        document.getElementById('user_charge').value = '1';
    } else {
        document.getElementById('user_charge').value = '';
    }
}

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

var power_date_use, power_date;

/* ▼ 파워등록권 서비스 */
function fnpoweruse() {
    if (this.checked === true) {
        $("#power_use").html(power_date_use);
    } else {
        $("#power_use").html(power_date);
    }
}

function fnPower() {
    var game_code = $('#game_code').val();
    var server_code = $('#server_code').val();

    $("#angel_registration").html("");
    var paramsValue = "game_code=" + game_code + "&server_code=" + server_code + "&api_token=" + a_token;
    fnAjax('/api/power/_AJAX_power_check', 'html', 'post', paramsValue, {
        complete: function(request) {

            var returnData = request.split("|");
            if (returnData[0] == true) {

                power_date = '<span class="text-blue_modern">선택시 서비스 이용 가능합니다.</span>';
                power_date_use = '<span class="text-blue_modern">' + returnData[1] + ' ~ ' + returnData[2] + ' 까지 등록 가능합니다.</span>';

                var createDIV = '<div class="float-left"><label class="font-weight-bold"><input type="checkbox" name="power_regist" value="y" > 파워 등록 사용 </label></div>';
                var createtxt2 = '<div class="float-left" id="power_use"></div>';

                $('#angel_registration').removeClass('d-none').append(createDIV, createtxt2);
                $("#power_use").html(power_date);
            } else {
                $("#angel_registration").html("").addClass('d-none');
            }

            if ($("#inptType").val() == returnData[4]) {
                $('input[name="power_regist"]').prop('checked', true);
            }
        },
        error: function() {
            $("#angel_registration").addClass('d-none');
        }
    });
}

/* ▲ 파워등록권 서비스 */

/* ▼ 복수구매할인 */
function ComplexDiscount() {
    var bCharge = $("input[name='discount_use']")[0].checked;
    if (bCharge) {
        $("#reven_discount").find("input").prop("disabled", false);

        var divUnit = $('#user_division_unit');
        var quanMin = $('#user_quantity_min');
        var quanMax = $('#user_quantity_max');
        var divPrice = $('#user_division_price');

        if (quanMin.val().isEmpty()) {
            alert('최소수량을 입력해주세요.');
            $("#discount_use").prop("checked", false);
            $("#reven_discount").find("input").prop("disabled", true).val("");
            quanMin.focus();
            return;
        }

        if (quanMax.val().isEmpty()) {
            alert('최대수량을 입력해주세요.');
            $("#discount_use").prop("checked", false);
            $("#reven_discount").find("input").prop("disabled", true).val("");
            quanMax.focus();
            return;
        }

        if (divUnit.val().isEmpty()) {
            alert('분할단위를 입력해주세요.');
            $("#discount_use").prop("checked", false);
            $("#reven_discount").find("input").prop("disabled", true).val("");
            divUnit.focus();
            return;
        }

        if (divPrice.val().isEmpty()) {
            alert('판매금액을 입력해주세요.');
            $("#discount_use").prop("checked", false);
            $("#reven_discount").find("input").prop("disabled", true).val("");
            divPrice.focus();
            return;
        }

        var disQnt = $("#discount_quantity");
        var disQntCnt = $("#discount_quantity_cnt");
        var disPrice = $("#discount_price");

        $("#reven_discount").find("input").on('keyup', function() {
            divUnit.val(Number(divUnit.val().replace(/[^0-9]/g, "")));
            disQnt.val(Number(disQnt.val().replace(/[^0-9]/g, "")));
            disQntCnt.val(Number(disQntCnt.val().replace(/[^0-9]/g, "")));
            disPrice.val(Number(disPrice.val().replace(/[^0-9]/g, "")));
        });

        disPrice.on('blur', function() {
            var discount_price = Number($(this).val().replace(/[^0-9]/g, ""));
            var userDivPrice = $('#user_division_price').val();
            var user_div_price = Number(userDivPrice.replace(/[^0-9]/g, ""));
            var last = $(this).val().substring($(this).val().length - 1, $(this).val().length);
            if (discount_price > 0 && discount_price < 100) {
                alert("할인금액은 100원 이상으로 입력해주세요.");
                $(this).val('');
                $(this).focus();
                $(this).keyup();
                return;
            }

            if (discount_price > user_div_price / 2) {
                alert("최대 할인금액을 초과하였습니다.");
                $(this).val('');
                $(this).focus();
                $(this).keyup();
                return;
            }

            if (last != 0) {
                alert("할인금액은 10원단위로 입력이 가능합니다.");
                $(this).val('');
                $(this).focus();
                $(this).keyup();
                return;
            }
        });
        $("#reven_discount").find("input:disabled").prop("disabled", false);
        disQnt.val(divUnit.val());
        if (disQntCnt.val().isEmpty()) disQntCnt.val(Math.ceil(quanMin.val() / divUnit.val()));
        disQntCnt.keyup();
    } else {
        $("#reven_discount").find("input").prop("disabled", true).val("");
    }
}

/* ▲ 복수구매할인 */

// 아이템정보 추가
function fnSltItemAdd() {
    var rgIdept = [];
    var rgIdeptTxt = [];
    var itemInfo = document.getElementById('slt_item_info');
    var itemInfoResult = document.getElementById('item_info_result');
    if (itemInfo.value.isEmpty() === false) {
        var rgTmp = itemInfo.value.split(',');
        for (var i = 0; i < rgTmp.length; i++) {
            if (rgTmp[i].isEmpty() === false) {
                rgIdept.push(rgTmp[i]);
            }
        }

        if (rgIdept.length > 3) {
            alert('최대 설정 정보는 4개입니다.');
            return;
        }
    }

    var idept1 = document.getElementById('iteminfo_dept1');
    var idept2 = document.getElementById('iteminfo_dept2');
    if (idept1.value.isEmpty() === true || idept2.value.isEmpty() === true) {
        alert('아이템 정보를 선택하세요');
        return;
    }

    var idept1Txt = idept1.options[idept1.selectedIndex].text;
    var idept2Txt = idept2.options[idept2.selectedIndex].text;
    var idept = idept1.value + idept2.value;
    var ideptTxt = idept1Txt + '[' + idept2Txt + ']';
    if (rgIdept.join(',').indexOf(idept + '_' + ideptTxt) < 0) {
        rgIdept.push(idept + '_' + ideptTxt);
    }

    for (var i = 0; i < rgIdept.length; i++) {
        rgTmp = rgIdept[i].split('_');
        rgIdeptTxt.push("<a href='#' onclick=\"fnSltItemRm('" + rgIdept[i] + "')\">" + rgTmp[1] + '(x)</a>');
    }

    itemInfo.value = rgIdept.join(',');
    itemInfoResult.classList.remove('text-rock');
    itemInfoResult.innerHTML = rgIdeptTxt.join(',');
}

// 아이템정보 삭제
function fnSltItemRm(idept) {
    var rgIdeptTxt = [];
    var itemInfo = document.getElementById('slt_item_info');
    var itemInfoResult = document.getElementById('item_info_result');
    var rgIdept = itemInfo.value.replace(idept, '').split(',');
    for (var i = 0; i < rgIdept.length; i++) {
        if (rgIdept[i].isEmpty() === true) {
            continue;
        }
        var rgTmp = rgIdept[i].split('_');
        rgIdeptTxt.push("<a href='#' onclick=\"fnSltItemRm('" + rgIdept[i] + "')\">" + rgTmp[1] + '(x)</a>');
    }

    itemInfo.value = rgIdept.join(',');
    itemInfoResult.innerHTML = rgIdeptTxt.join(',');
    if (i < 2) {
        itemInfoResult.classList.add('text-rock');
        itemInfoResult.innerHTML = '아이템 정보를 선택하시면 판매에 도움이 됩니다.';
    }
}

var itemDetailSetting = {
    detailItemInfo: null,
    itemInfoTach: null,
    checkItemData: function() {
        if (this.detailItemInfo === null) {
            ajaxRequest({
                url: '/lineagem/_ajax_item_all.php',
                dataType: 'json',
                success: function(data) {
                    if (data.manage === false) {
                        return;
                    }

                    itemDetailSetting.detailItemInfo = data;
                    itemDetailSetting.setItemInfo();
                }
            });

            document.getElementById('suc_btn').addEventListener('click', function() {
                var check = itemDetailSetting.itemSelectCheck();
                if (check === false) {
                    return;
                }

                var item_name = $('#item_name').val();
                var enchant = $('#enchant').val();
                var state = $('#state').val();
                var attribute = $('#attribute').val();
                var attr_enchant = $('#attr_enchant').val();

                if (enchant === '' || enchant === '0') {
                    enchant = '';
                } else {
                    enchant = '+' + enchant;
                }

                if (attr_enchant.isEmpty() === false) {
                    attr_enchant += '단';
                }

                if (state.isEmpty() === false) {
                    state += '받은';
                }

                var rgGoods = [];
                rgGoods.push(state);
                rgGoods.push(attribute);
                rgGoods.push(attr_enchant);
                rgGoods.push(enchant);
                rgGoods.push(item_name);
                rgGoods = rgGoods.filter(function(s) {
                    return s != '';
                });

                var strGoods = rgGoods.join(' ');

                $('#item_can').removeClass('d-none');
                $('#item_suc, #item_detail_wrap, #add_detail_wrap').addClass('d-none');
                $('#item_info_txt').text(strGoods);
                $('#user_title').val('(' + strGoods + ') 팝니다.');

                ajaxRequest({
                    url: '/lineagem/_ajax_item_desc.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        category: $('#category').val(),
                        kind: $('#kind').val(),
                        item_name: $('#item_name').val()
                    },
                    success: function(res) {
                        if (res.FAIL === 'true') {
                            if (res.message) {
                                alert(res.message);
                            }
                            return;
                        }
                        $('#user_text').val(res.message);
                        $('#iteminfo_use_complete').val('Y');
                    }
                });
            });

            document.getElementById('can_btn').addEventListener('click', function() {
                $('#item_suc, #item_detail_wrap, #add_detail_wrap').removeClass('d-none');
                $('#item_can').addClass('d-none');
                $('#item_info_txt').text('');
                $('#iteminfo_use_complete').val('N');
                itemDetailSetting.detailItemInfoReset();
            });

            document.getElementById('iteminfo_use').addEventListener('click', function() {
                $('#rd_text_default').trigger('click');
                $('#item_can').find('a').trigger('click');
                itemDetailSetting.detailItemInfoReset(this.checked);
            });

            $('#item_detail_search select').on('change', function() {
                var closest = $(this).closest('li');
                if (this.id != 'enchant') {
                    closest.nextAll().find('select').prop('disabled', true).find('option[value=""]').prop('selected', true);
                    $('#add_detail_wrap select').prop('disabled', true).find('option[value=""]').prop('selected', true);
                }

                if (this.value.isEmpty() === true) {
                    return;
                }

                if (this.id === 'category' || this.id === 'kind') {
                    var nextEl = $(this).closest('li').next().find('select').prop('disabled', false)[0].id;
                    itemDetailSetting.changeItem('#' + nextEl, itemDetailSetting.detailItemInfo[nextEl][this.value]);
                } else if (this.id === 'item_name') {
                    var category = $('#category').val();
                    if (category != '스킬북' && category != '기타') {
                        closest.next().find('select').prop('disabled', false).find('option[value="0"]').prop('selected', true);
                    }

                    if (category === '무기') {
                        $('#add_detail_wrap').find('select').slice(0, 2).prop('disabled', false);
                    } else {
                        $('#add_detail_wrap').find('select').slice(0, 1).prop('disabled', false);
                    }
                } else if (this.id === 'enchant') {
                    if (closest.prev().find('select').val().isEmpty()) {
                        alert('아이템을 선택해주세요.');
                        $('#enchant').prop('disabled', false).find('option[value=""]').prop('selected', true);
                        $('#add_detail_wrap > select').prop('disabled', true).find('option[value=""]').prop('selected', true);
                        return;
                    }
                }
            });

            $('#add_detail_wrap select').on('change', function() {
                var closest = $(this).closest('li');
                if (this.id === 'attr_enchant' && closest.prev().find('select').val().isEmpty()) {
                    alert('속성을 선택해주세요.');
                    $('#attr_enchant').find('option[value=""]').prop('selected', true);
                    return;
                }
                if (this.id === 'attribute') {
                    if (this.value.isEmpty()) {
                        $('#attr_enchant').prop('disabled', true).find('option[value=""]').prop('selected', true);
                        return;
                    }
                    $('#attr_enchant').prop('disabled', false).find('option[value="1"]').prop('selected', true);
                }
            });
        } else {
            setItemInfo();
        }
    },
    setItemInfo: function() {
        if (this.detailItemInfo.manage.length < 1 || this.detailItemInfo.manage.visible != 'Y') {
            return;
        }

        this.detailItemInfoReset();

        var manage = this.detailItemInfo.manage;
        var rgEnchnt = [];

        $('#category').find('option:eq(0)').text('선택하세요');
        itemDetailSetting.changeItem('#category', this.detailItemInfo.category);

        for (var i = manage.enchant_min; i <= manage.enchant_max; i++) {
            rgEnchnt.push('<option value="' + i + '">+' + i + '</option>');
        }
        $('#enchant').append(rgEnchnt.join(''));

        rgEnchnt = [];
        for (var i = manage.attr_enchant_min; i <= manage.attr_enchant_max; i++) {
            rgEnchnt.push('<option value="' + i + '">' + i + '단</option>');
        }
        $('#attr_enchant').append(rgEnchnt.join(''));

        if (this.detailItemInfo.manage.attr_enchant_visible === 'Y') {
            $('#add_detail_wrap').removeClass('d-none');
        } else {
            $('#add_detail_wrap').addClass('d-none');
        }
    },
    changeItem: function(el, data) {
        $(el).find('option:gt(0)').remove();

        if (data === undefined || data.length < 1) {
            return;
        }
        var rgHtml = [];
        for (var i = 0, len = data.length; i < len; i++) {
            rgHtml.push('<option value="' + data[i] + '">' + data[i] + '</option>');
        }
        $(el).append(rgHtml.join(''));
    },
    detailItemInfoReset: function(use) {
        $('#item_detail_srh').find('option[value=""]').prop('selected', true);
        $('#category').trigger('change');
        $('#item_suc').removeClass('d-none');
        $('#item_can').addClass('d-none');
        if (use === false) {
            $('#item_detail_srh').addClass('d-none');
            $('#item_guide_txt, .item_detail_opts').removeClass('d-none');
            $('#user_title, #user_text').prop('readonly', false).val(angel_item_alias[angel_enable_type.goods] + ' 팝니다.');
        } else {
            $('#item_detail_srh').removeClass('d-none');
            $('#item_guide_txt, .item_detail_opts').addClass('d-none');
            $('#user_title, #user_text').prop('readonly', 'readonly').val(angel_item_alias[angel_enable_type.goods] + ' 팝니다.');
        }
    },
    itemSelectCheck: function() {
        var iteminfo_use = $('#iteminfo_use');
        if (iteminfo_use[0].checked === true) {
            var category = $('#category').val();
            var kind = $('#kind').val();
            var item_name = $('#item_name').val();
            var enchant = $('#enchant').val();
            var state = $('#state').val();
            var attribute = $('#attribute').val();
            var attr_enchant = $('#attr_enchant').val();

            if (category.isEmpty()) {
                alert('분류를 선택해주세요.');
                return false;
            }
            if (kind.isEmpty()) {
                alert('종류를 선택해주세요.');
                return false;
            }
            if (item_name.isEmpty()) {
                alert('아이템을 선택해주세요.');
                return false;
            }
            if ($('#enchant').prop('disabled') === false && enchant.isEmpty()) {
                alert('인챈트 상태를 선택해주세요.');
                return false;
            }

            if ($('#attr_enchant').prop('disabled') === false && attribute.isEmpty() === false && attr_enchant.isEmpty() === true) {
                alert('속성 인챈트를 선택해주세요.');
                return false;
            }
        }
        return true;
    }
};

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
