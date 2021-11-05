/*
 * @title		구매등록물품
 * @author		김보람
 * @date		2012.01.27
 * @update		수정날짜(수정자)
 * @description
 */

var e_use = {
    premium: 0,
    quickIcon: 0,
    highlight: 0
};

var layerNode,
    gStrType = 'premium';

function _init() {
    $('#user_time').on('change', fnSelectChange);
    layerNode = g_nodeSleep;
    $.extend(layerNode, {
        OnOpen: function() {
            $('#user_time').change();
        }
    });

    $('#frmChargeService').submit(function() {
        switch (gStrType) {
            case 'premium':
                var strService = '프리미엄을';
                break;
            case 'quickIcon':
                var strService = '퀵아이콘을';
                break;
            case 'textblue':
                var strService = '녹색펜을';
                break;
            case 'texticon':
                var strService = '굵은체를';
                break;
        }
        if (!confirm(strService + ' ' + $('#user_time').val() + ' 시간 연장하겠습니까?')) {
            return false;
        }
        $('#service_type').val(gStrType);
        $(this).attr('action', 'buy_regist_ok.php');
        return true;
    });
}

function fnChargeServiceLayer(strType) {
    if (gStrType != strType) {
        var oSelect = $('#user_time'),
            rgOptions = new Array();

        oSelect.find('option').remove();

        if (strType == 'premium') {
            var strService = '프리미엄 등록';
            $('#title_txt').html('프리미엄 기간 연장');
            for (var i = 1; i <= 24; i++) {
                rgOptions.push('<option value="' + i + '">' + i + '시간</option>');
            }
            $('#premium').show();
        } else if (strType == 'quickIcon') {
            var strService = '퀵아이콘';
            $('#title_txt').html('퀵아이콘 기간연장');

            for (var i = 1; i <= 24; i++) {
                rgOptions.push('<option value="' + i + '">' + i + '시간</option>');
            }
            $('#premium').hide();
        } else {
            if (strType == 'texticon') {
                var strService = '제목 굵은체';
                $('#title_txt').html('굵은체 기간 연장');
            } else {
                var strService = '제목 녹색펜';
                $('#title_txt').html('녹색펜 기간 연장');
            }

            for (var i = 1; i <= 6; i++) {
                rgOptions.push('<option value="' + (i * 12) + '">' + (i * 12) + '시간</option>');
            }
            $('#premium').hide();
        }
        oSelect.append(rgOptions.join(''));

        var frm = $('#frmChargeService');
        $('#service_type').val(strType);
        $('#service_txt').text(strService);
        gStrType = strType;
    }

    $('#charge_service').find('.service_hide').hide();
    $('#' + strType).show();
    g_nodeSleep.enable($('#charge_service'));
}

function fnSelectChange() {
    var oSelect = $('#user_time');
    if (gStrType == 'premium') {
        var nPaymentTime = Number(oSelect.val()),
            freeTicket = e_use.premium,
            freeTime = freeTicket,
            serviceTxt = '프리미엄';
    }  else if (gStrType == 'quickIcon') {
        var nPaymentTime = Number(oSelect.val()),

            freeTicket = e_use.quickIcon,
            freeTime = freeTicket,
            serviceTxt = '퀵아이콘';
    } else {
        var nPaymentTime = Number(oSelect.val()) / 12,
            freeTicket = e_use.highlight,
            freeTime = freeTicket * 12,
            serviceTxt = (gStrType == 'textblue') ? '파란펜' : '굵은체';
    }

    var paymentMoneySpan = $('#txtChargeMoney'),
        basicPrice = 100,
        paymentMoney = nPaymentTime * basicPrice,
        nFreeUse = 0;

    if (nPaymentTime < freeTicket) {
        nFreeUse = nPaymentTime * basicPrice;
    } else {
        nFreeUse = freeTicket * basicPrice;
    }

    var paymentText = (paymentMoney - nFreeUse).currency() + '원';
    if (nFreeUse > 0) {
        paymentText += '(이용료 ' + paymentMoney.currency() + '원<span class="g_red1">-' + serviceTxt + ' 무료이용 ' + freeTime + '시간 사용</span>) 잔여 시간:' + freeTime + '시간';
    }
    paymentMoneySpan.html(paymentText);
}
