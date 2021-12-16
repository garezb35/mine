
var eventPromotion,
    eventDiscount;


function __init() {
    if(eventPromotion == true) {
        var basicPrice		= [],
            discountPrice	= [];

        for(var i=0; i<$('#choice_pay table tr').length; i++) {
            basicPrice[i]		= $('#choice_pay table th:eq(' + i + ')').html().replace(/[^0-9]/gi, '');
            discountPrice[i]	= basicPrice[i] - (basicPrice[i] * (eventDiscount / 100));

            $('#choice_pay table th:eq(' + i + ')').html('<span class="arrow_red">' + Number(basicPrice[i]).currency() + '</span>' + '<img src="'+IMG_DOMAIN2+'/images/icon/arrow_red.gif" width="15" height="11" style="margin:0px 4px">' + Number(discountPrice[i]).currency() + '원 권');
        }
    }
}

