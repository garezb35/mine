

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

    /* ▼ 던전앤파이터 통합서버 처리 */
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
    /* ▲ 던전앤파이터 통합서버 처리 */

    if (g_trade_info.sale == 'division') {
        $('#sell_quantity').val(g_trade_info.quantity);
        sellQuantity();
    }

    $('#frmSell').submit(function() {
        if(submit_condition == 0){
            alert('판매조건에 만족되지 않습니다.');
            return false;
        }
        if ($("#user_without").val() == '6') {
            if (!confirm('고객님은 현재 회원탈퇴 신청 진행중입니다.\n판매 신청 진행 시 신청하신 회원탈퇴 접수가 철회됩니다.\n계속 진행 하시겠습니까?')) {
                return false;
            }
        }
        return true;
    });

    document.getElementById('wideview').addEventListener('click', function() {
        var detail = document.getElementById('detail_info');
        if (detail.classList.contains('wide') == true) {
            detail.classList.remove('wide');
            this.innerHTML = '열기▼';
        } else {
            detail.classList.add('wide');
            this.innerHTML = '닫기▲';
        }
    });

    /** [ITM-10872] 캐릭터 거래 신규 서비스 삽니다 추가 by 20200720 KBR */
    if (document.getElementById('elt_contract') !== null) {
        document.getElementById('sign_btn').addEventListener('click', function(ev) {
            var strConfirmMsg = '전자 서명을 하시겠습니까?\n' +
                '전자 서명 완료 시 판매신청이 완료 됩니다.\n';
            if (!confirm(strConfirmMsg)) {
                return;
            }

            var frm = document.getElementById('frmSell');
            _window.open('contract', '', 650, 550);
            frm.target = 'contract';
            frm.action = '/certify/payment/user_certify';
            frm.submit();
        });
    }

    //안심번호, 안심번호 플러스
    SafetyNumber();
}

function fnCheckSimpleSubmit() {
    if (simpleTradeParams != null && simpleTradeParams.refer_type == 'simple') {
        fnFormChecker();
    }
}

function fnFormChecker() {
    var frm = $('#frmSell');

    /* ▼ 던전앤파이터 통합서버 처리 */
    if ($('#dfServer').length > 0) {
        if ($('[name="df_server_code"]').val().isEmpty()) {
            alert('물품을 전달 하실 서버를 선택 해주세요.');
            return false;
        }
        if ($('#user_character').val().isEmpty()) {
            alert('물품을 전달 하실 캐릭터명을 입력해주세요.');
            $('#user_character').focus();
            return false;
        }

    }
    /* ▲ 던전앤파이터 통합서버 처리 */

    /** [ITM-10872] 캐릭터 거래 신규 서비스 삽니다 추가 by 20200720 KBR */
    if(document.getElementById('character_id') !== null) {
        if(document.getElementById('character_id').value.isEmpty() === true) {
            alert('캐릭터 ID 입력 후 판매신청이 가능합니다.');
            document.getElementById('character_id').focus();
            return false;
        }
    }

    if (g_trade_info.sale == "division") {
        if (checkForm() == false) return false;

        $("#layer_quantity").text($("#spnQuantity_total").text());
        $("#layer_money").text($("#trade_money").text());
    }

    /* ▼ 안심번호 서비스 */
    if ($("#safety_using_flag").val() == "true") {
        if ($("#user_safety_type").val() == "1" && $("#using_safety_number").val() == "on") {
            if ($("#user_cell_auth").val() == '0') {
                alert("안심번호 서비스는 휴대폰 인증을 받으셔야 사용이 가능합니다.\n\n마이룸 > 내 개인정보 > 개인정보 수정에서 휴대폰 인증 후 사용하시기 바랍니다.\n\n사용을 원하지 않으시면 안심번호 사용안함으로 선택 후 등록하시기 바랍니다.");
                return false;
            }
        }
    }
    /* ▲ 안심번호 서비스 */

    /* ▼ 연락처 중복체크 */
    var slctContact = $('#user_contactA').val();
    var slctMobileType = $('#slctMobile_type').val();
    var params = {
        user_id: $('#user_id').val(),
        trade_flag: 'Y',
        contact_yn: (slctContact == 'N') ? 'N' : 'Y',
        mobile_yn: (slctMobileType == 'N') ? 'N' : 'Y'
    };

    if (params['contact_yn'] == 'N' && params['mobile_yn'] == 'N') {
        alert('휴대폰 또는 자택 연락처 정보를 통화 가능한 번호로 수정 후 이용 바랍니다.');
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
    params.api_token = a_token;
    fnAjax('/api/_include/_user_contact_restrict', 'text', 'POST', params, {
        complete: function(res) {
            var rgResult = res.split('|');
            switch (rgResult[0]) {
                case 'S':
                    /** [ITM-10872] 캐릭터 거래 신규 서비스 삽니다 추가 by 20200720 KBR */
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
            alert('서비스가 원할하지 않습니다. 잠시후 이용해 주세요.');
        }
    });
    /* ▲ 연락처 중복체크 */
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
        alert("최대 구매수량을 초과하였습니다!");
        frm.find('input[name="sell_quantity"]').val(g_trade_info.max_quantity.currency());
        sellQuantity = g_trade_info.max_quantity;
    }

    var sellGameMoney = sellQuantity * g_trade_info.div_unit;
    var sellGameMoney_2 = sellGameMoney;

    if (g_trade_info.trade_kind == "money") {

        var rgUnit = new Array("만", "억", "조");
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
    var unitString = new Array("", "만", "억", "조", "경");
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
        alert("판매수량을 입력해주세요.");
        frm.find('input[name="sell_quantity"]').focus();
        return false;
    }

    sellQuantity = Number(sellQuantity.replace(/[,]+/g, ""));

    if ((sellQuantity * g_trade_info.div_unit) > g_trade_info.curr_unit) {
        alert("판매수량이 현재 구매 수량보다 많습니다.\n판매수량을 다시 입력해주세요.");
        frm.find('input[name="sell_quantity"]').focus();
        return false;
    }

    if (sellQuantity < g_trade_info.min_quantity) {
        alert("최소판매수량(" + g_trade_info.min_quantity + "번) 미만의 물품은 신청할 수 없습니다.");
        frm.find('input[name="sell_quantity"]').focus();
        return false;

    } else if (sellQuantity > g_trade_info.max_quantity) {
        alert("최대판매수량(" + g_trade_info.max_quantity + "번) 초과의 물품은 신청할 수 없습니다.");
        frm.find('input[name="sell_quantity"]').focus();
        return false;
    }

    var tradePrice = $('#trade_money').text();
    tradePrice = tradePrice.replace(/[,]+/g, "");

    if (tradePrice < 3000) {
        alert("거래는 3,000원 이상부터 가능합니다.");
        frm.find('input[name="sell_quantity"]').focus();
        return false;
    }

    return true;

}

function fnCreditViewCheck() {
    var infoId = $('#infoId').val();
    var params = {
        id: infoId,
        api_token:a_token
    };

    ajaxRequest({
        url: '/api/user/credit_ajax?t=' + (new Date()).getTime(),
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
                    'action': '/api/user/credit_view'
                }).submit();
            } else {
                alert(rgResult[1]);
            }
        }
    });
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


function changeP(){
    var buy_quantity  = $("#buy_quantity").val()
    if(buy_quantity * user_division_unit < user_quantity_min){
        alert("최소판매수량보다 작을수 없습니다");
        return;
    }

    var s = $("#buy_quantity").val() * user_division_unit;
    s = $("#buy_quantity").val() * user_division_price;
    $("#use_creditcard").val(s)
    $(".trade_money1").text(s)
}
