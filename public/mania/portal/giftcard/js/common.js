$(function() {
    $('.faq_q').click(function() {
        var obj = $('.faq_q');
        var nIndex = obj.index($(this));

        if (obj.eq(nIndex).hasClass('on') === true) {
            obj.eq(nIndex).removeClass('on');
        } else {
            obj.eq(nIndex).addClass('on');
        }

        $('.faq_a').eq(nIndex).slideToggle(500);
    });
});

function fnTouchpay(code) {
    var touchpay = _window.open('touchpay', '', 500, 650);

    if (code == 'mania') {
        $('#type').val(code);
    }

    $('#frm').attr({
        target: 'touchpay',
        action: '/portal/giftcard_touchpay/touchpay_form'
    }).submit();
}
