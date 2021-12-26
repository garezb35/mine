function fnMileGift(type, money, code) {
    var giftMoney,
        obj = $('[name=bill_' + type + ']'),
        nMoney = $('[name=' + type + ']').val(),
        strParam = '/portal/giftcard_touchpay/touchpay_form.html',
        bTouchpay = false;


    if (nMoney == undefined) {
        nMoney = 1000;
    }

    switch (type) {
        case 'kspay':
            bTouchpay = true;
            break;
        case 'happy':
            bTouchpay = true;
            break;
        case 'oncash':
            bTouchpay = true;
            strParam = '/portal/giftcard_mplanet/oncash/index.html?';
            break;
        case 'googlegift':
            strParam = 'googlegift/googlegift_form.html?';
            break;

    }

    giftMoney = nMoney * obj.val();

    if (giftMoney > parseInt(money)) {
        alert('ë§ˆì¼ë¦¬ì§€ê°€ ë¶€ì¡±í•©ë‹ˆë‹¤.');

        return;
    }

    if (bTouchpay) {
        var strPopName = (type == 'oncash') ? type : "touchpay",
            objForm = $('#frm'),
            touchpay = _window.open(strPopName, '', 500, 650);

        $('#code').val(code);
        $('#money').val(nMoney);
        $('#bill').val(obj.val());

        objForm.attr({
            target: strPopName,
            action: site_dns_s + strParam
        }).submit();
    }
    else {
        _window.open(type, site_dns_s + '/portal/giftcard/' + strParam + 'pmoney=' + nMoney + '&pbill=' + obj.val(), 440, 530);
    }
}
