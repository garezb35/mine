/*
 * @title		1:1 상담하기
 * @author		김보람
 * @date		2012.03.21
 * @update		수정날짜(수정자)
 * @description
 */

//var a_code;

function _init() {
    $('#category_tb').find('input[type="radio"]').click(function() {
        var nowAcode = $(this).parents('ul').attr('data-type');
        var locationHref = "";
        if(nowAcode == 'A1') {
            var cCode = (this.id == 'a10101') ? "01" : "02";
            locationHref = "/customer/trade/trade_ing_list.html?a_code=" + nowAcode + "&b_code=01&c_code=" + cCode;
        }
        else if(nowAcode == 'A2') {
            var returnUrl = "";
            var tType = "";
            switch(this.id) {
                case 'a20100' :
                    returnUrl = "sell_complete_list.html";
                    tType = 'sc';
                    break;
                case 'a20200' :
                    returnUrl = "trade_ing_list.html";
                    tType = 'ti';
                    break;
                case 'a20300' :
                    returnUrl = "trade_cancel_list.html";
                    tType = 'ti';
                    break;
                case 'a20400' :
                    returnUrl = "trade_etc.html";
                    break;
            }
            locationHref = "/customer/trade/" + returnUrl + "?a_code=" + nowAcode + "&b_code=" + $(this).val() + "&t_type=" + tType;
        }
        else {
            var nowAcode = $(this).attr('data-acode');
            // if(this.id == 'faulty') {
            //     locationHref = "/customer/faulty.html";
            // }
            // else
            {
                var typeAsk = $(this).attr('data-type');
                locationHref = "/customer/ask_guide?type=" + typeAsk;
                // locationHref = "/customer/report.html?a_code=" + nowAcode + "&b_code=" + $(this).val() + '#customer_report';
            }
        }
        location.href = locationHref;
    });

    $('.best_faq').find('.subject').click(function() {
        $(this).next().slideToggle('slow');
    });

    $('#top_faq').find('.sub_title').click(function() {
        var _index = $('div.sub_title').index($(this));
        // if($(this).css('background-image').indexOf('q_1.gif') != -1) {
        // 	$(this).css('background-image', 'url(' + IMG_DOMAIN3  + '/images/icon/q.gif)');
        // } else {
        // 	$(this).css('background-image', 'url(' + IMG_DOMAIN4  + '/images/icon/q_1.gif)');
        // }
        $('div.gray_box').eq(_index).slideToggle('slow');
    });

}
