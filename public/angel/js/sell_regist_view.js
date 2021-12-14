/*
 * @title		íŒë§¤ë“±ë¡ë¬¼í’ˆ
 * @author		ê¹€ë³´ëžŒ
 * @date		2012.02.20
 * @update		ìˆ˜ì •ë‚ ì§œ(ìˆ˜ì •ìž)
 * @description
 */

var e_use = {
    premium: 0,
    quickIcon:0,
    highlight: 0
};

var layerNode,
    gStrType = 'premium';

function _init() {
    $("#user_time").on('change', fnSelectChange);
    layerNode = g_nodeSleep;
    $.extend(layerNode, {
        OnOpen: function() {
            $("#user_time").change();
        }
    });

    $('#frmChargeService').submit(function() {
        switch (gStrType) {
            case 'premium':
                var strService = 'í”„ë¦¬ë¯¸ì—„ì„';
                break;
            case 'quickIcon':
                var strService = 'í€µì•„ì´ì½˜ì„';
                break;
            case 'textblue':
                var strService = 'íŒŒëž€íŽœì„';
                break;
            case 'texticon':
                var strService = 'êµµì€ì²´ë¥¼';
                break;
        }
        if (!confirm(strService + " " + $('#user_time').val() + " ì‹œê°„ ì—°ìž¥í•˜ê² ìŠµë‹ˆê¹Œ?")) {
            return false;
        }
        $('#service_type').val(gStrType);
        $(this).attr("action", "sell_regist_ok.php");
        return true;
    });
}

function fnChargeServiceLayer(strType) {
    if (gStrType != strType) {
        var oSelect = $('#user_time'),
            rgOptions = new Array();

        oSelect.find('option').remove();

        if (strType == 'premium') {
            var strService = 'í”„ë¦¬ë¯¸ì—„ ë“±ë¡';
            $('#title_img').attr({
                'src': IMG_DOMAIN3 + '/images/myroom/title/title_pre_add.gif',
                'width': '146',
                'alt': 'í”„ë¦¬ë¯¸ì—„ ê¸°ê°„ì—°ìž¥'
            });
            for (var i = 1; i <= 24; i++) {
                rgOptions.push('<option value="' + i + '">' + i + 'ì‹œê°„</option>');
            }
            $('.layer_title .title').text('í”„ë¦¬ë¯¸ì—„ ê¸°ê°„ì—°ìž¥');
            $('#premium').show();
        } else if(strType == 'quickIcon'){
            var strService = 'í€µì•„ì´ì½˜';
            $('#title_img').attr({
                'src': IMG_DOMAIN3 + '/images/myroom/title/title_pre_add.gif',
                'width': '146',
                'alt': 'í€µì•„ì´ì½˜ ê¸°ê°„ì—°ìž¥'
            });
            for (var i = 1; i <= 24; i++) {
                rgOptions.push('<option value="' + i + '">' + i + 'ì‹œê°„</option>');
            }
            $('.layer_title .title').text('í€µì•„ì´ì½˜ ê¸°ê°„ì—°ìž¥');
            $('#premium').show();
        } else {
            if (strType == 'texticon') {
                var strService = 'ì œëª© êµµì€ì²´';
                $('#title_img').attr({
                    'src': IMG_DOMAIN4 + '/images/myroom/title/titlep_bold_text_b.gif',
                    'width': '128',
                    'alt': 'êµµì€ì²´ ê¸°ê°„ì—°ìž¥'
                });
                $('.layer_title .title').text('ì œëª© êµµì€ì²´ ê¸°ê°„ì—°ìž¥');
            } else {
                var strService = 'ì œëª© íŒŒëž€íŽœ';
                $('#title_img').attr({
                    'src': IMG_DOMAIN2 + '/images/myroom/title/titlep_blue_text_b.gif',
                    'width': '128',
                    'alt': 'íŒŒëž€íŽœ ê¸°ê°„ì—°ìž¥'
                });
                $('.layer_title .title').text('íŒŒëž€íŽœ ê¸°ê°„ì—°ìž¥');
            }

            for (var i = 1; i <= 6; i++) {
                rgOptions.push('<option value="' + (i * 12) + '">' + (i * 12) + 'ì‹œê°„</option>');
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
            serviceTxt = 'í”„ë¦¬ë¯¸ì—„';
    } else if (gStrType == 'quickIcon') {
        var nPaymentTime = Number(oSelect.val()),

            freeTicket = e_use.quickIcon,
            freeTime = freeTicket,
            serviceTxt = 'í€µì•„ì´ì½˜';
    } else {
        var nPaymentTime = Number(oSelect.val()) / 12,
            freeTicket = e_use.highlight,
            freeTime = freeTicket * 12,
            serviceTxt = (gStrType == 'textblue') ? 'íŒŒëž€íŽœ' : 'êµµì€ì²´';
    }

    var paymentMoneySpan = $("#txtChargeMoney"),
        basicPrice = 100,
        paymentMoney = nPaymentTime * basicPrice,
        nFreeUse = 0;

    if (nPaymentTime < freeTicket) {
        nFreeUse = nPaymentTime * basicPrice;
    } else {
        nFreeUse = freeTicket * basicPrice;
    }

    var paymentText = (paymentMoney - nFreeUse).currency() + "ì›";
    if (nFreeUse > 0) {
        paymentText += '(ì´ìš©ë£Œ ' + paymentMoney.currency() + 'ì›<span class="g_red1">-' + serviceTxt + ' ë¬´ë£Œì´ìš© ' + freeTime + 'ì‹œê°„ ì‚¬ìš©</span>) ìž”ì—¬ ì‹œê°„:' + freeTime + 'ì‹œê°„';
    }
    paymentMoneySpan.html(paymentText);
}
