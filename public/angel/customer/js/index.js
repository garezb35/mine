/*
 * @title		고객감동센터
 * @author		김현진
 * @date		2012.03.26
 * @update		수정날짜(수정자)
 * @description
 */

function __init() {
    $('div.sub_title').click(function() {
        var _index = $('div.sub_title').index($(this));
        // if($(this).css('background-image').indexOf('q_1.gif') != -1) {
        // 	$(this).css('background-image', 'url(' + IMG_DOMAIN3  + '/images/icon/q.gif)');
        // } else {
        // 	$(this).css('background-image', 'url(' + IMG_DOMAIN4  + '/images/icon/q_1.gif)');
        // }
        $('div.gray_box').eq(_index).slideToggle('slow');
    });
}
