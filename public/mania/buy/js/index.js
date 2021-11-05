// 판매유형
var e_sale = {
    'general': '일반판매',
    'division': '분할판매'
};

// 판매유형 타입값
var e_sale_type = {
    'general': 0,
    'division': 1
};

var e_goods_text = {
    '': '게임머니',
    'money': '게임머니',
    'item': '아이템',
    'character': '캐릭터',
    'etc': '기타'
};

// 현재선택된 타입
var e_select = {
    sale: 'general',
    goods: ''
};

// 현재선택된 단위
var g_unit = '';

var e_use = {
    premium: 0,
    highlight: 0,
    quickIcon:0,
    rereg: 0
};

// 프리미엄 레이어 활성화
var bPremiumLayer = false;
if (history.state != null && history.state.back == true) {
    document.querySelector('[name="user_goods_type"]').checked = true;
}

var lastListEl = '';
var regGameServer;

function _init() {

    var regGameServerEl = document.getElementById('reg_gameserver');
    regGameServer = new GameServerList(document.getElementById('reg_gameserver_list'), {
        containerWrapper: regGameServerEl,
        toggleContainer: regGameServerEl.getElementsByClassName('initial_screen')[0],
        formElement: '#frmBuy',
        game: {
            autoComplete: '#searchRegGameServer',
            hidden_use: {
                code: '[name="game_code"]',
                text: '[name="game_code_text"]'
            },
            onCustomChange: function() {
                e_select.goods = '';

                $('.favorite_icon').removeClass('on');

                SafetyNumber();
                getFreeUse();
            }
        },
        server: {
            use: true,
            allView: false,
            hidden_use: {
                code: '[name="server_code"]',
                text: '[name="server_code_text"]'
            }
        },
        goods: {
            use: true,
            hidden_use: {
                code: '[name="user_goods"]',
                text: ''
            },
            onCustomChange: function(el, e) {

                $('.favorite_icon').removeClass('on');
                if (_myService.mySearchXml === null) {
                    _myService.getFavorite(mySearchListCheck);
                } else {
                    mySearchListCheck();
                }

                /** [ITM-10872] 캐릭터 거래 신규 서비스 삽니다 추가 by 20200720 KBR */
                if (this.getValue().code === 'character') {
                    if ($('#division').hasClass('g_hidden') === false) {
                        $('#division').addClass('g_hidden');
                    }
                } else {
                    $('#division').removeClass('g_hidden');
                }

                if (e_select.goods !== this.getValue().code) {
                    e_select.goods = this.getValue().code;
                    if (lastListEl == '') {
                        document.querySelectorAll('[name="user_goods_type"]')[0].checked = true;
                    }
                }

                changeTemplate();

                if (e !== undefined) {
                    var m = this;
                    setTimeout(function() {
                        m.onClose();
                    }, 100);
                }
            }
        }
    });

    // gameServer.onCustomCloseBefore = function() {
    // 	if (this.gameList.selected && !this.serverList.selected) {
    // 		alert('서버를 선택해주세요.');
    // 		return false;
    // 	}
    // 	return true;
    // };

    $('[name="user_goods_type"]').on('click', changeTemplate);
    // document.querySelectorAll('[name="user_goods_type"]').addEventListener('click', changeTemplate);

    // 물품기본값적용
    document.getElementById('fixed_trade_subject').addEventListener('click', function() {
        var strFixTag = document.getElementById('trade_sign_txt').innerHTML;
        if (strFixTag.isEmpty() === true) {
            if (confirm('물품제목 기본값으로 설정된 값이 없습니다. \r물품 제목 기본값을 설정하시겠습니까?')) {
                _window.open('fixed_title', '/sell/fixed_trade_subject', 500, 300);
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

    /* ▼ 상세설명 문구선택 */
    $("[name='text_select']").on('click', function() {
        var userTextObj = document.getElementById('user_text');

        if (this.value === '1') {
            userTextObj.value = '';
            userTextObj.readOnly = false;
        } else {
            setDefaultText();
        }
    });
    /* ▲ 상세설명 문구선택 */

    document.getElementById('d_template').addEventListener('click', function(e) {
        if (e.target.name === 'gamemoney_unit') {
            var unit = e.target.value;
            if (e.target.value === '1') {
                unit = '';
            }
            $('.unit').text(unit);
        }
    });

    // 즉시구매 등록
    if (document.getElementById('direct_reg_trade') !== null) {
        document.getElementById('direct_reg_trade').addEventListener('click', setDirectBuy);
    }

    // 프리미엄 등록
    document.getElementById('user_premium_time').addEventListener('change', function () {
        chargePremiumService();
        chargeServiceCalc();
    });
    document.getElementById('pop_user_premium_time').addEventListener('change', function () {
        $('#user_premium_time').val(this.value);
        chargePremiumService();
        chargeServiceCalc();
    });

    // 퀵아이콘 등록
    document.getElementById('user_quickicon_use').addEventListener('change', function() {
        chargePremiumService();
        chargeServiceCalc();
        //chargeServiceApply.call(this, 'f_blue1');
    });

    // 굵은체 등록
    document.getElementById('user_icon_use').addEventListener('change', function () {
        chargePremiumService();
        chargeServiceApply.call(this, 'f_bold');
    });

    // 녹색펜 등록
    document.getElementById('user_bluepen_use').addEventListener('change', function () {
        chargePremiumService();
        chargeServiceApply.call(this, 'f_green2');
    });

    // 자동재등록 등록
    // document.getElementById('rereg_count').addEventListener('change', function () {
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

    document.getElementById('premium_btn').addEventListener('click', premiumSet);

    if (document.getElementById('wideview') !== null) {
        document.getElementById('wideview').addEventListener('click', function() {
            var userText = document.getElementById('user_text');
            if (userText.classList.contains('wide') == true) {
                userText.classList.remove('wide');
                this.innerHTML = '열기▼';
            } else {
                userText.classList.add('wide');
                this.innerHTML = '닫기▲';
            }
        });
    }

    if (document.getElementById('myLastList') !== null) {
        document.getElementById('myLastList').addEventListener('click', myLastListCall);
    }

    if (document.getElementById('credit_benefit') !== null) {
        document.getElementById('credit_benefit').addEventListener('click', getCreditBenefit);
    }

    LayerControl({
        layer: document.getElementById('dvPopup'),
        close_btn: document.getElementById('dvPopup').querySelector('.close_w'),
        type: 'style'
    });

    if (document.getElementById('lastList') !== null) {
        LayerControl({
            layer: document.getElementById('lastList'),
            close_btn: document.getElementById('lastList').querySelector('.close'),
            mask: false,
            type: 'style'
        });
    }

    changeTemplateAddCheck();
}

function getFreeUse() {
    var gameCode = regGameServer.gameList.getValue().code;
    ajaxRequest({
        url: '/api/_include/_get_free_use',
        dataType: 'JSON',
        type: 'POST',
        data: {
            game_code:  gameCode,
            api_token:a_token
        },
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
 * 신용등급 혜택받기
 */
function getCreditBenefit() {

    ajaxRequest({
        url : '/myroom/myinfo/credit_rating_ok',
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

function changeTemplate() {
    if (regGameServer.gameList.selected) {
        g_unit = regGameServer.gameList.selectedData.U;
    }

    var userGoods = document.querySelector('[name="user_goods"]').value;
    var userGoodsType = document.querySelector('[name="user_goods_type"]:checked').value;
    var gameCode = regGameServer.gameList.getValue().code;
    var serverCode = regGameServer.serverList.getValue().code;
    var integrationServer = '';
    if (document.getElementById('integration_server') !== null) {
        integrationServer = document.getElementById('integration_server').value;
    }
    var last_alias  = $(".goods").find(".sel_on").text();
    e_select.goods = userGoods || 'money';
    e_select.sale = userGoodsType;
    $(".gs_list1").addClass('g_hidden')
    $(".initial_screen").removeClass('g_hidden')
    setDefaultText();

    ajaxRequest({
        url: '/api/buy/include/index_template',
        type: 'POST',
        data: {
            user_goods: userGoods,
            user_goods_type: userGoodsType,
            money: g_unit,
            game_code: gameCode,
            server_code: serverCode,
            integration_server: integrationServer,
            api_token: a_token,
            last_alias: last_alias
        },
        success: function(res) {
            /* 물품등록 알리미 */
            // ajaxRequest({
            //     url: '/myroom/goods_alarm/_ajax_process',
            //     type: 'post',
            //     dataType: 'json',
            //     data: {
            //         'mode':'game_check',
            //         'game_code':gameCode
            //     },
            //     success: function(res) {
            //
            //         var data = {
            //             type:userGoods,
            //             gameCode:gameCode,
            //             serverCode:serverCode
            //         };
            //
            //         if(res.DAT == 'Y' && userGoods =='character')
            //         {
            //             $('#alarm_line').show();
            //             getTagList(data);
            //         }
            //         else
            //         {
            //             $('#alarm_line').hide();
            //         }
            //     }
            // });

            history.pushState({back: true}, '', location.href);
            $('#d_template').html(res);
            $('[name="user_goods_type"]').on('click', changeTemplate);
            changeTemplateAddCheck();
            if (typeof(reRegSet) === 'function') {
                reRegSet();
            }
        }
    });
}

function setDefaultText() {
    var strGoods = e_goods_text[e_select.goods];
    if (e_select.goods === 'money' && g_unit.isEmpty() === false) {
        strGoods = g_unit;
    }

    var defaultText = strGoods + ' 삽니다.';
    var fixed_trade_subject = document.getElementById('fixed_trade_subject');
    var strFixTag = document.getElementById('trade_sign_txt').innerHTML;
    strFixTag += ' ';

    document.getElementById('user_title').value = defaultText;

    if (fixed_trade_subject.checked === true) {
        document.getElementById('user_title').value = strFixTag + defaultText;
    }

    if (document.querySelector('[name="text_select"]:checked').value === '0') {
        document.getElementById('user_text').value = defaultText;
        document.getElementById('user_text').readOnly = true;
    }
}

function changeTemplateAddCheck() {
    try {
        var frm = document.forms.frmBuy;
        if (frm.checker) {
            frm.checker.free();
        }
        var formCheck = new FormChecker('frmBuy');
        var userGoods = document.querySelector('[name="user_goods"]');
        var userGoodsType = document.querySelector('[name="user_goods_type"]:checked');
        var gameCode = regGameServer.gameList.getValue().code;

        formCheck.add({name: 'game_code', msg: '게임을 선택해주세요.', focus: '#searchRegGameServer'});
        formCheck.add({name: 'server_code', msg: '서버를 선택해주세요.', focus: '#searchRegGameServer'});
        formCheck.add({name: 'game_code_text', msg: '게임을 선택해주세요.', focus: '#searchRegGameServer'});
        formCheck.add({name: 'server_code_text', msg: '서버를 선택해주세요.', focus: '#searchRegGameServer'});
        formCheck.add({name: 'user_goods', msg: '물품종류를 선택해주세요.', focus: '#searchRegGameServer'});
        formCheck.add({name: 'user_goods_type', msg: '구매유형을 선택해주세요.'});

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
            /** [ITM-10872] 캐릭터 거래 신규 서비스 삽니다 추가 by 20200720 KBR */
        } else {

            /* ▼ 던전앤파이터 통합서버 처리 */
            var dfServer = document.getElementById('dfServer');
            var dfServerCode = document.getElementById('dfServerCode');
            var userCharacter = document.getElementById('user_character');
            if (gameCode === '281') {
                if (dfServerCode === null && document.getElementById('integration_server') === null) {
                    var strHtml = '<div id="dfServerCode" class="df_server_code"><input type="hidden" name="df_server_code"><input type="text" class="g_text" name="df_server_code_text" id="df_server_code_text" placeholder="서버검색" autocomplete="off"><div class="gs_list_area" id="dfServerList"></div></div> 물품을 전달하실 서버 |';
                    document.getElementById('dfServer').innerHTML = strHtml;
                }

                if(document.getElementById('dfServerList') !== null && document.getElementById('dfServerList').gameserver === undefined) {
                    new ServerList(document.getElementById('dfServerList'), {
                        autoComplete: '#df_server_code_text',
                        allView: false,
                        gameCode: '281',
                        hidden_use: {
                            code: '[name="df_server_code"]',
                            text: ''
                        }
                    });
                }

                dfServer.classList.remove('g_hidden');
                userCharacter.setAttribute('maxlength', 27);

                formCheck.add({
                    custom: function() {
                        /* ▼ 던전앤파이터 통합서버 처리 */
                        if (document.getElementById('dfServerList').serverList.getValue().code.isEmpty()) {
                            alert('물품을 전달 받으실 서버를 선택 해주세요.');
                            return false;
                        }
                        return true;
                        /* ▲ 던전앤파이터 통합서버 처리 */
                    }
                });
            } else {
                dfServer.classList.add('g_hidden');
                userCharacter.setAttribute('maxlength', 30);
            }
            /* ▲ 던전앤파이터 통합서버 처리 */

            formCheck.add({name: 'user_character', msg: '물품을 전달 받으실 캐릭터명을 입력해주세요.'});
        }

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

                if($('#tag_generator').val() != '' && $('#tag_generator').val().length < 2)
                {
                    alert('키워드는 2글자 이상 입력해주세요.')
                    return false;
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
                params.api_token = a_token
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
    } catch (e) {
    }
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
    var dvPopup = document.getElementById('dvPopup');
    var strLayerURL = '/api/buy/include/reg_info_character';

    if (frm.direct_reg_trade.checked == true) {
        g_fnSECURITY2();
        if (mileAuth !== 'PASS') {
            frm.onsubmit = null;

            _window.open('buy_direct', '', 650, 550);
            frm.target = 'buy_direct';
            frm.action = '/certify/payment/user_certify';
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

    var rgData = {
        game_code: frm.game_code.value,
        game_code_text: frm.game_code_text.value,
        server_code: frm.server_code.value,
        server_code_text: frm.server_code_text.value,
        user_goods: frm.user_goods.value,
        user_goods_type: frm.querySelector('[name="user_goods_type"]:checked').value,
        user_title: frm.user_title.value,
        unit: g_unit,
        e_sale: e_sale_type[e_select.sale]
    };

    if (rgData.user_goods_type === 'division') {
        rgData.user_quantity_min = frm.user_quantity_min.value;
        rgData.user_quantity_max = frm.user_quantity_max.value;
        rgData.user_division_unit = frm.user_division_unit.value;
        rgData.user_division_price = frm.user_division_price.value;

        if (frm.user_goods.value === 'money') {
            rgData.gamemoney_unit = frm.querySelector('[name="gamemoney_unit"]:checked').value;
        }

    } else {
        if (frm.user_goods.value === 'money') {
            rgData.gamemoney_unit = frm.querySelector('[name="gamemoney_unit"]:checked').value;
            rgData.user_quantity = frm.user_quantity.value;
        }
        /** [ITM-10872] 캐릭터 거래 신규 서비스 삽니다 추가 by 20200720 KBR */
        if (rgData.user_goods === 'character' && frm.account_type.value !== '1') {
            rgData.account_type = frm.account_type.value;
            rgData.purchase_type = frm.purchase_type.value;
            rgData.payment_existence = frm.payment_existence.value;
            rgData.multi_access = frm.multi_access.value;
        }
        rgData.user_price = frm.user_price.value;
    }

    if (document.getElementById('slt_item_info') !== null) {
        rgData.slt_item_info = $('#item_info_result').text().replace(/\(x\)/g, "");
    }

    if (document.getElementById('item_info_txt') !== null) {
        rgData.item_info_txt = document.getElementById('item_info_txt').innerHTML;
    }
    rgData.user_cell_num = frm.user_cell_num.value;
    rgData.seller_birth = frm.seller_birth.value;
    rgData.character_id = "";
    rgData.api_token=  a_token
    ajaxRequest({
        url: strLayerURL,
        type: 'POST',
        data: rgData,
        success: function(res) {
            $('#dvPopup').find('.cont').html(res);
            LayerControl.open({layer: dvPopup});

            /** [ITM-10872] 캐릭터 거래 신규 서비스 삽니다 추가 by 20200720 KBR */
            if (rgData.user_goods === 'character' && frm.account_type.value !== '1') {
                document.getElementById('dvPopup').classList.add('reg_info_character');
                document.getElementById('dvPopup').getElementsByClassName('title')[0].innerHTML = '전자계약서';
                document.getElementById('reg_submit').addEventListener('click', function() {
                    if ($("#user_without").val() == '6') {
                        if (!confirm('고객님은 현재 회원탈퇴 신청 진행중입니다.\n판매 등록 진행 시 신청하신 회원탈퇴 접수가 철회됩니다.\n계속 진행 하시겠습니까?')) {
                            return;
                        }
                    }

                    frm.target = '_self';
                    frm.action = '/addService';
                    frm.onsubmit = null;
                    frm.submit();
                });
            } else {
                document.getElementById('dvPopup').classList.remove('reg_info_character');
                document.getElementById('dvPopup').getElementsByClassName('title')[0].innerHTML = '물품등록정보';
                document.getElementById('reg_submit').addEventListener('click', function() {
                    frm.target = '_self';
                    frm.action = '/addService';
                    frm.onsubmit = null;
                    frm.submit();
                });
            }
            document.getElementById('cancel_submit').addEventListener('click', function() {
                LayerControl.close({layer: dvPopup});
            });
        }
    });
}

/* ▼ 나만의 검색메뉴 선택 */
function fnSearchSelect(game, gname, server, sname, goods, self) {
    var strGoods;

    switch (goods) {
        case '1' :
            strGoods = 'item';
            break;
        case '3' :
        default :
            strGoods = 'money';
            break;
        case '4' :
            strGoods = 'etc';
            break;
        case '6' :
            strGoods = 'character';
            break;
    }

    if (regGameServer.gameList.getValue().code == game && regGameServer.serverList.getValue().code == server && regGameServer.goodsList.getValue().code == strGoods) {
        if (self) {
            changeTemplate();
        }
        return;
    }

    regGameServer.gameList.gameCode = game;
    regGameServer.serverList.serverCode = server;
    regGameServer.goodsList.goodsCode = strGoods;

    regGameServer.changeAction = true;
    regGameServer.gameList.createList();
}
/* ▲ 나만의 검색메뉴 선택 */

/* ▼ 나만의 검색메뉴 추가 */
function fnSearchAdd() {
    var game_code = $('#game_code').val();
    var game_code_text = $('#game_code_text').val();
    var server_code = $('#server_code').val();
    var server_code_text = $('#server_code_text').val();
    var user_goods = $('#user_goods').val();

    var goods_text = "";
    var goods_code = 0;
    switch (user_goods) {
        case 'item' :
            goods_text = "아이템";
            goods_code = 1;
            break;
        case 'money' :
            goods_text = "게임머니";
            goods_code = 3;
            break;
        case 'character' :
            goods_text = "캐릭터";
            goods_code = 6;
            break;
        case 'etc' :
            goods_text = "기타";
            goods_code = 4;
            break;
    }

    if (game_code == "") {
        alert('게임을 선택해 주세요.');
        return;
    }

    if (server_code == "") {
        alert('서버를 선택해 주세요.');
        return;
    }

    if (user_goods == "") {
        alert('물품타입을 선택해 주세요.');
        return;
    }

    var addMessage = confirm("검색하신 게임을 나만의 게임에 추가하시겠습니까?");
    if (addMessage == true) {
        var rgData = {
            type: 'buy',
            game: game_code,
            game_text: game_code_text,
            server: server_code,
            server_text: server_code_text,
            goods: goods_code,
            goods_text: goods_text
        };

        _myService.addFavorite(rgData, function(res) {
            var mygame_id = res.mygameID;
            if (document.getElementById('mygame_info').children[0].classList.contains('empty') === true) {
                $('#mygame_info').html('');
            }
            var addMygame = "<li id=\"mygame_" + mygame_id + "\">" +
                "<a href=\"javascript:fnSearchSelect('" + game_code + "','" + game_code_text + "','" + server_code + "','" + server_code_text + "','" + goods_code + "')\">" + game_code_text + " > " + server_code_text + " > " + goods_text + "</a>" +
                "<span class=\"del_btn\" onclick=\"fnSearchDel('" + mygame_id + "')\"></span>" +
                "</li>";
            $('#mygame_info').append(addMygame);

            alert("해당 카테고리가 나만의검색메뉴에 추가되었습니다.");
            $('.favorite_icon').addClass('on');
            _myService.getFavorite();
        });
    }
}
/* ▲ 나만의 검색메뉴 추가 */

/* ▼ 나만의 검색메뉴 삭제 */
function fnSearchDel(id) {
    var delMessage = confirm("해당 카테고리를 삭제하시겠습니까?");
    if (delMessage == true) {
        _myService.deleteFavorite(id, function() {
            var mygame_id = "mygame_" + id;
            $('#' + mygame_id).remove();
            alert("해당 카테고리가 삭제되었습니다.");
            $('.favorite_icon').removeClass('on');
            _myService.getFavorite();

            if (document.getElementById('mygame_info').children[0] === undefined) {
                document.getElementById('mygame_info').innerHTML = '<li class="empty">게임서버 검색 후 우측 ★표를 클릭하시면 해당물품이 나만의검색메뉴로 등록됩니다.</li>';
            }
            _myService.getFavorite();
        });
    }
}
/* ▲ 나만의 검색메뉴 삭제 */

/* ▼ 나만의 검색메뉴 체크 */
function mySearchListCheck() {

    $('.favorite_icon').removeClass('on');

    if(_myService.mySearchXml === null) {
        return;
    }

    var rgItem = _xml.getElements(_myService.mySearchXml, 'item');
    var itemCount = rgItem.length;
    if (itemCount < 1) {
        return;
    }

    var gameCode = regGameServer.gameList.getValue().code;
    var serverCode = regGameServer.serverList.getValue().code;
    var goodsCode = regGameServer.goodsList.getValue().code;

    for (var i = 0; i < itemCount; i++) {
        var item = $(rgItem[i]);
        if (item.attr('type') !== 'buy') {
            continue;
        }

        var nodeGame = item.find('game');
        var nodeServer = item.find('server');
        var nodeGoodtype = item.find('goods_type');

        if (gameCode == nodeGame.attr('id') && serverCode == nodeServer.attr('id') && goodsCode == nodeGoodtype.attr('id')) {
            $('.favorite_icon').addClass('on');
            break;
        }
    }
}
/* ▲ 나만의 검색메뉴 체크 */

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
    if (e_sale[e_select.sale] == e_sale.division) {
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
        if (userPremiumTime > Number(e_use.premium)) {
            plusMile += (userPremiumTime - Number(e_use.premium)) * 100;
        }
    } else {
        userPremiumUseHidden.value = '';
    }

    // 퀵아이콘 등록
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
        alert('마일리지 잔액이 부족합니다.');
        return false;
    }

    if (userPremiumTime > 0 || highlightTotalTime > 0) {
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
    bPremiumLayer = true;
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

/* ▲ 유료등록 서비스 */

/* ▼ 즉시구매 */
function setDirectBuy() {
    var frm = document.forms.frmBuy;
    if (this.checked === true) {
        var useMileNum = useMileage.numeric();
        if (e_sale[e_select.sale] === e_sale.general) {
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

function myLastListCall() {

    var tbody = document.getElementById('lastListTbody');

    if (tbody.innerHTML != '') {
        document.getElementById('lastList').style.display = 'block';
        return;
    }

    ajaxRequest({
        url: '/buy/ajax_recent_list',
        type: 'POST',
        dataType: 'JSON',
        success: function(res) {

            if (res.result !== 'SUCCESS') {
                alert('등록한 물품을 불러오지 못하였습니다.');
                return;
            }

            var list = res.data;
            var len = list.length;
            var sHtml = '';
            if (len < 1) {
                var tr = document.createElement('tr');
                sHtml = '<tr><td colspan="5">최근에 등록하신 물품이 없습니다.</td></tr>';
                tr.innerHTML = sHtml;
                tbody.appendChild(tr);
            } else {
                for (var i = 0; i < len; i++) {

                    var cont = list[i];
                    var tr = document.createElement('tr');
                    var date = cont.trade_reg_date.replace(' ', '<br>');
                    var trade_money = '<span class="f_green2">' + cont.min_trade_money + '원</span>';
                    var ea_range = '';
                    if (cont.ea_range) {
                        ea_range = '<span class="f_green2">[' + cont.ea_range + ']</span><br>';
                    }
                    if (cont.ea_trade_money != '') {
                        trade_money = cont.ea_trade_money + '<br>' + trade_money + '';
                    }
                    var compen = (cont.trade_class == 'd') ? '<span class="f_green2">즉시구매</span>' : '-';
                    sHtml = '<td>' + date + '</td><td>' + cont.game_name + '<br>' + cont.server_name + '</td><td class="left">' + ea_range + '<div class="txt_ellipsis">' + cont.trade_subject + '</div></td><td class="right">' + trade_money + '</td><td>' + compen + '</td>';
                    tr.innerHTML = sHtml;
                    tbody.appendChild(tr);
                    $.data(tr, cont);
                    (function(i) {
                        tr.addEventListener('click', function() {
                            if (!confirm('해당 등록정보를 불러옵니다.\n' +
                                '등록정보는 확인 후 등록페이지에서 수정 가능합니다.')) {
                                return;
                            }
                            lastListEl = this;

                            if (list[i].trade_category == '1') {
                                document.querySelector('[name="user_goods_type"][value="general"]').checked = true;

                            } else if (list[i].trade_category == '2') {
                                document.querySelector('[name="user_goods_type"][value="division"]').checked = true;

                            } else if (list[i].trade_category == '3') {
                                document.querySelector('[name="user_goods_type"][value="bargain"]').checked = true;
                            }

                            fnSearchSelect(list[i].game_code, list[i].game_name, list[i].server_code, list[i].server_name, list[i].trade_kind, true);
                            document.getElementById('lastList').style.display = 'none';
                        }, false);
                    }(i));
                }
            }

            document.getElementById('lastList').style.display = 'block';
        },
        error: function() {

        }
    });
}

function reRegSet() {
    if (lastListEl == '') {
        return;
    }

    var data = $.data(lastListEl);
    var frm = document.forms.frmBuy;

    switch (data.trade_default_unit) {
        case '10000':
            var defaultUnit = '만';
            break;
        case '100000000':
            var defaultUnit = '억';
            break;
        default  :
            var defaultUnit = '1';
    }

    if (data.trade_default_unit == '0') {
        data.trade_default_unit = 1;
    }

    //trade_default_unit
    if (data.trade_category == '1') {
        if (data.trade_kind == '3') {
            document.querySelector('[name="gamemoney_unit"][value="' + defaultUnit + '"]').click();
            frm.user_quantity.value = (data.trade_quantity / data.trade_default_unit).currency();
        }
        frm.user_price.value = data.trade_money.currency();


    } else if (data.trade_category == '2') {
        if (data.trade_kind == '3') {
            document.querySelector('[name="gamemoney_unit"][value="' + defaultUnit + '"]').click();
        }
        frm.user_quantity_min.value = (data.min_quantity / data.trade_default_unit).currency();
        frm.user_quantity_max.value = (data.max_quantity / data.trade_default_unit).currency();
        frm.user_division_unit.value = (data.trade_quantity / data.trade_default_unit).currency();
        frm.user_division_price.value = data.trade_money.currency();
    }

    document.querySelector('[name="text_select"][value="1"]').click();
    frm.user_title.value = data.trade_subject;
    frm.user_text.value = data.trade_content;

    if (data.trade_class === 'd') {
        frm.direct_reg_trade.checked = true;
        var rt = setDirectBuy.call(frm.direct_reg_trade);
        if (rt !== false) {
            frm.direct_condition_credit.value = (data.direct_rank == '0') ? '1' : data.direct_rank;
            frm.direct_condition_hpp.value = (data.direct_hpp == '0') ? '' : data.direct_hpp;
            frm.direct_condition_acc.value = (data.direct_acc == '0') ? '' : data.direct_acc;
        }
    } else {
        frm.direct_reg_trade.checked = false;
        setDirectBuy.call(frm.direct_reg_trade);
        frm.direct_condition_credit.value = '1';
        frm.direct_condition_hpp.value = '';
        frm.direct_condition_acc.value = '';
    }

    lastListEl = '';

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

//ITM-11901 물품등록알리미 등록방식 추가
function getTagList(data){
    /* 물품등록 알리미 */
    ajaxRequest({
        url: '/myroom/goods_alarm/_ajax_process',
        type: 'post',
        dataType: 'json',
        data: {
            'mode':'keywords',
            'trade_type':2,
            'game_code':data.gameCode,
            'server_code':data.serverCode
        },
        success: function(res) {
            $('.tag_list').empty();
            if(res.RST)
            {
                if(res.DAT.length == 0 || res.DAT == undefined)
                {

                    $('.tag_list').append('<span class="no_keyword">등록된 알림키워드가 없습니다.</span>');
                    tagList=[]
                }
                else
                {
                    $('.tag_wrapper').show();
                    tagList = res.DAT
                }

                if(tagList.length>10)
                {
                    for(var i=0; i<10; i++)
                    {
                        $('.tag_list').append('<span class="tag" data-text="'+tagList[i]+'">#'+tagList[i]+'</span>');
                    }

                    $('.tag_list').append('<button id="tag_more" class="btn_white1" type="button">더보기</button>');

                    $('#tag_more').click(function(){
                        $(this).remove();
                        for(var i=10; i<tagList.length; i++)
                        {
                            $('.tag_list').append('<span class="tag" data-text="'+tagList[i]+'">#'+tagList[i]+'</span>');
                        }
                        tagAction()
                    })
                }
                else
                {
                    for(var i=0; i<tagList.length; i++)
                    {
                        $('.tag_list').append('<span class="tag" data-text="'+tagList[i]+'">#'+tagList[i]+'</span>');
                    }
                }

                tagAction()
            }
            else
            {
                $('.tag_wrapper').hide();
                alert(res.MSG)
            }
        },
    });
}

function tagAction(){
    $('.tag').click(function(){
        if($('input[name="noti_keyword"]').val() != $(this).attr('data-text'))
        {
            $('input[name="noti_keyword"]').val($(this).attr('data-text'))
        }
    })
}
