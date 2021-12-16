
var angel_item_s_alias = {
    'general': 0,
    'division': 1,
    'bargain': 2
};

var e_goods = {
    'money': 0,
    'item': 1,
    'account': 2,
    'etc': 3,
    'character': 6
};

var g_trade_info = {
    goods: 'money',
    trade_money: 0,
    ba_deny_money: 0
};

var checker = null;

function _init() {
    /* ▼ 흥정 거래시 */
    var frm = $('#frmbaRequest');

    if (frm.length > 0) {
        checker = new _form_checker(frm);
        checker.add({
            inputObj: frm.find('input[name="ba_money"]'),
            strType: 'price',
            protect: true,
            message: '흥정신청금액을 입력해주세요'
        });
        checker.add({
            custom: function() {
                if ($('#user_without').val() == 6) {
                    if (!confirm('고객님은 현재 회원탈퇴 신청 진행중입니다.\n구매 신청 진행 시 신청하신 회원탈퇴 접수가 철회됩니다.\n계속 진행 하시겠습니까?')) {
                        return;
                    }
                }

                var ba_money = $(this).find('input[name="ba_money"]').val();
                ba_money = ba_money.replace(/[,]+/g, '');
                if (Number(ba_money) < 3000) {
                    alert('흥정신청금액을 3,000원 이상 입력해 주세요.');
                    $(this).find('input[name="ba_money"]').val('').focus();
                    return;
                }

                if (ba_money < parseInt($(this).find('input[name="ba_deny_money"]').val())) {
                    alert('최소 흥정가능 금액보다 큰 금액을 입력해주세요.');
                    $(this).find('input[name="ba_money"]').val('').focus();
                    return;
                }

                /* ▼ 던전앤파이터 통합서버 처리 */
                if ($('#dfServer').length > 0) {
                    if (document.getElementById('dfServerList').serverList.getValue().code.isEmpty()) {
                        alert('물품을 전달 받으실 서버를 선택 해주세요.');
                        return false;
                    }
                }
                /* ▲ 던전앤파이터 통합서버 처리 */

                if($('#trade_kind').val() != 6){
                    if ($('#user_character').val().isEmpty()) {
                        alert('물품을 전달 받으실 캐릭터명을 입력해주세요.');
                        $('#user_character').focus();
                        return false;
                    }
                }

                /* â–¼ ì—°ë½ì²˜ ì¤‘ë³µì²´í¬ */
                var slctContact = $('#user_contactA').val();
                var slctMobileType = $('#slctMobile_type').val();
                var params = {
                    user_id: $('#user_id').val(),
                    trade_flag: 'Y',
                    contact_yn: (slctContact == 'N') ? 'N' : 'Y',
                    mobile_yn: (slctMobileType == 'N') ? 'N' : 'Y'
                };

                if (params.contact_yn == 'Y') {
                    params.user_contactA = slctContact;
                    params.user_contactB = $('#user_contactB').val();
                    params.user_contactC = $('#user_contactC').val();
                }
                if (params.mobile_yn == 'Y') {
                    params.user_mobileA = $('#user_mobileA').val();
                    params.user_mobileB = $('#user_mobileB').val();
                    params.user_mobileC = $('#user_mobileC').val();
                }
                params.api_token = a_token;
                fnAjax('/api/_include/_user_contact_restrict', 'text', 'POST', params, {
                    complete: function(res) {
                        var rgResult = res.split('|');
                        switch (rgResult[0]) {
                            case 'S':
                                if (!confirm('흥정거래를 신청하겠습니까?')) {
                                    return;
                                }
                                $('#frmbaRequest').off('submit').submit();
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
        });

        frm.find('input[name="ba_money"]').bind('blur', checkBaMoney);
        /* ▼ 던전앤파이터 통합서버 처리 */
        var userCharacter = document.getElementById('user_character');
        if ($('#dfServer').length > 0) {
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
        }
        /* ▲ 던전앤파이터 통합서버 처리 */
    }
    /* ▲ 흥정 거래시 */

    $('#trade_fraud').find('a').click(function() {
        $('#fraud_result').find('.result').attr('class', 'result');

        var strType = $(this).attr('data-type');
        var nTrade_id = $('#FraudTrade_id').val();
        var nSearchNumber = $('#srh_txt').val();

        ajaxRequest({
            url: 'thecheat_api.php',
            type: 'post',
            dataType: 'json',
            data: {
                strType: strType,
                searchNumber: nSearchNumber,
                trade_id: nTrade_id
            },
            success: function(res) {
                if (res.result == 'SUCCESS') {
                    // res.data : Y - 피해사례 있음 / N - 없음
                    if (res.data == 'Y') {
                        $('#fraud_result').find('.result').addClass('warn');
                    } else {
                        $('#fraud_result').find('.result').addClass('none');
                    }
                    nodemonPopup.enable($('#fraud_result'));
                } else {
                    alert(res.msg);
                }
            },
            error: function(res) {
                alert('서버와의 접속이 원활하지 않습니다.\n잠시후 다시 시도해주세요.');
                return;
            }
        });
    });

    document.getElementById('wideview').addEventListener('click', function() {
        var detail = document.getElementById('detail_info');
        if (detail.classList.contains('wide') == true) {
            detail.classList.remove('wide');
            this.innerHTML = '열기 <i class="fa fa-angle-down"></i>';
        } else {
            detail.classList.add('wide');
            this.innerHTML = '닫기 <i class="fa fa-angle-top"></i>';
        }
    });

    var screenshot = document.getElementsByClassName('screenshot');
    var scLen = screenshot.length;
    for (var i = 0; i < scLen; i++) {
        screenshot[i].getElementsByTagName('a')[0].addEventListener('click', function(evt) {
            var idx = this.getAttribute('data-idx');
            var info = document.getElementById('screenshot_info').value;
            _window.open('imgview', '/myroom/sell/image_viewer.html?idx=' + idx + '&info=' + info, 2000, 1000, 'scrollbars=yes');
        })
    }

    _form.protect.number($('#srh_txt'));
}

function checkBaMoney() {
    var frm = $('#frmbaRequest');

    var ba_money = frm.find('input[name="ba_money"]').val().replace(/[,]+/g, '');

    if (ba_money.isEmpty()) {
        return;
    }

    var last = ba_money.substring(ba_money.length - 2, ba_money.length);
    if (last != '00') {
        alert('흥정신청금액에 십원단위와 일원단위는 0이외의 숫자를 입력할수 없습니다.\n\n흥정신청금액을 다시 기재해 주세요.\n\n예) 12,345(불가능), 12,300(가능)');
        frm.find('input[name="ba_money"]').val('').focus();
        return false;
    }

    if (g_trade_info.trade_money <= ba_money) {
        alert('즉시판매금액 보다 작은 금액을 입력해주세요.');
        frm.find('input[name="ba_money"]').val('').focus();
        return;
    }

    if (g_trade_info.ba_deny_money > 0) {
        if (g_trade_info.ba_deny_money > ba_money) {
            alert('최소흥정 가능금액 보다 큰 금액을 입력해주세요.');
            frm.find('input[name="ba_money"]').val('').focus();
            return;
        }
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
