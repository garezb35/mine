function fnBanner(code, url) {
    $.ajax({
        url: '/portal/banner/ajax_banner.php',
        dataType: 'html',
        type: 'POST',
        data: {b_code:code, url:url},
        success: function(data) {
            $('#frmbanner').attr({
                action: url,
                target: '_blank'
            }).submit();
        },
        error: function() {}
    });
}

$(function () {
    $.fn.extend({
        rollingMargin: function () {
            var objMarginBanner = $(this),
                nMarginBanner	= objMarginBanner.find("img").length,
                nCurrentBanner	= 0,
                nNextBanner		= 1;

            if (nMarginBanner < 2) {
                return;
            }

            setInterval(function(){
                if(nNextBanner == nMarginBanner - 1){
                    nCurrentBanner	= 0;
                }

                if(nCurrentBanner == nMarginBanner - 1){

                    nNextBanner	= 0;
                }

                objMarginBanner.find("img").eq(nCurrentBanner).hide();
                objMarginBanner.find("img").eq(nNextBanner).show();

                nCurrentBanner++;
                nNextBanner++;
            }, 3000);
        },
        rollingMarginBanner : function () {
            var objMarginBanner = $(this),
                nMarginBanner	= objMarginBanner.find("div.d-none").length,
                nRandom			= parseInt(Math.random() * nMarginBanner);

            objMarginBanner.find("div.d-none").eq(nRandom).show();
        }
    });

    $("#giftcard_left_banner").rollingMargin();
    $("#giftcard_right_banner").rollingMargin();
    $("#giftcard_right_banner2").rollingMargin();
    $("#external_game_info_banner").rollingMarginBanner();
});
