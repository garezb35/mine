/*
 * @title			상품권몰
 * @author			[F/E] 김현진
 * @date			2015.08.24
 * @update
 * @description
 */
function _init() {
    $(window).scroll(function () {
        var scrollTop = $(window).scrollTop();
        var height = $(document).height();
        var height_win = $(window).height();
        var sideBanner = $('#side_banner');
        var footerHeight = $('#g_TAIL').height();
        // 스크롤 바닥에서 푸터를 뺀만큼 스크롤시 css 변경
        if (scrollTop >= ((height - height_win) - footerHeight)) {
            sideBanner.attr("class", "side_banner");
        } else {
            sideBanner.attr("class", "side_banner_fix");
        }
    });
    $(window).scroll();
}

function fnTouchpayOpenPop(frm, t) {
    _window.open('touchpay', '', 500, 750);
    var actionUrl = document[frm].actionUrl.value;
    if(t) {
        actionUrl += '?t='+t;
    }
    document[frm].target = 'touchpay';
    document[frm].action = actionUrl;
    document[frm].submit();
    return;
}

function fnMplanetOpenPop(frm) {
    _window.open('mplanet', '', 500, 750);
    document[frm].target = 'mplanet';
    document[frm].submit();

}
