searchList.ajaxUrl = '/api/ajax_list_search';
searchList.formSubmit = function() {
    $('#frm_search').attr('action', '/buy/list_search');
    $('#frm_search').submit();
};

$(".search__head_btn").click(function(){
    var v = $(this).data('value');
    $("#filtered_items").val(v);
    $("#frm_search").attr('src','/buy/list_search');
    $("#frm_search").submit()
})

function orderGameFromDays(tradeItem) {
    if (tradeItem == null) {
        return '';
    }

    var today = new Date();
    today.setHours(0, 0, 0, 0);

    var bluepen = tradeItem.blue_end_time.split(' ');
    var blueDate = bluepen[0].split('-');
    var boldpen = tradeItem.bold_end_time.split(' ');
    var boldDate = boldpen[0].split('-');
    var expression = {
        blue: (new Date(blueDate[1] + '/' + blueDate[2] + '/' + blueDate[0] + ' ' + bluepen[1]) > today),
        bold: (new Date(boldDate[1] + '/' + boldDate[2] + '/' + boldDate[0] + ' ' + boldpen[1]) > today)
    };

    var listHtml = '<li ' + (tradeItem.trade_state == 'p' ? 'class="link_block"' : '') + '>' +
        '               <div class="col_01"><img src="/angel/img/level/'+tradeItem.credit_img+'" width="36"/></div>';

    listHtml += '       <div class="col_02' + ((tradeItem.trade_state === 'a') ? ' active' : '') + '">';
    listHtml += '	        <a href="' + ((tradeItem.user_buyer === 'true') ? '/myroom/buy/buy_regist_view?id=' + tradeItem.trade_id : 'javascript:searchList.application(\'' + tradeItem.trade_id + '\',\'' + tradeItem.trade_state + '\')') + '">';
    listHtml += '	            <div class="mulline">';
    if (tradeItem.ea_range !== '' && tradeItem.ea_range !== null) {
        listHtml += '   		    <span class="unit">[' + tradeItem.ea_range + ']</span><br />';
    }
    if (tradeItem.trade_kind == '6') {
        listHtml += '   		    <span class="unit">' + tradeItem.character_subject + '</span><br />';
    }
    listHtml += '	    	        <span class="title' + (expression.blue ? ' title_green' : '') + (expression.bold ? ' font-weight-bold' : '') + '">' + tradeItem.trade_subject + '</span>' + (tradeItem.screenshot === 'Y' ? ' <span class="hasScreenshot"></span>' : '') +
        '	                    </div>';
    listHtml += '	        </a>';

    if (tradeItem.quickicon) {
        listHtml += '	        <div class="view_detail_quick" trade-id="' + tradeItem.trade_id + '"></div>';
    }

    listHtml += '	    </div>' +
        '               <div class="col_03">' +
        '	                <div class="mulline">';

    if (tradeItem.ea_trade_money !== '') {
        listHtml += '		    ' + tradeItem.ea_trade_money + '<br />';
    }

    listHtml += '   		    <span>' + (tradeItem.min_trade_money) + '???</span>' +
        '	                </div>' +
        '               </div>' +
        '               <div class="col_04">' +
        '	                <i class="list_sprite icon_good' + (tradeItem.trade_show_time === 'Y' ? ' active_icon' : '') + '">????????????</i>' +
        '	                <i class="list_sprite icon_direct' + (tradeItem.trade_class === 'd' ? ' active_icon' : '') + '">????????????</i>' +
        '               </div>' +
        '               <div class="col_05">' + (tradeItem.trade_state == 'p' ? '????????????' : tradeItem.reg_date) + '</div>' +
        '           </li>';
    return listHtml;
}

function listOptionClick() {
    var order = $(this).attr('data-type');
    if (order == '1') {
        $('[name="trade_state"][value="2"]').prop('checked', true);
    } else {
        $('[name="trade_state"][value="1"]').prop('checked', true);
    }
    $('#order').val(order);
    searchList.formSubmit();
}

function asyncRequestByAJ() {
    // $.ajax({
    //     url: '/_xml/gamemoney_avg.xml',
    //     dataType: 'xml',
    //     type: 'GET',
    //     timeout: 3000,
    //     data: 'gamecode=' + $('#filtered_game_id').val() + '&servercode=' + $('#filtered_child_id').val() + '&count=2',
    //     success: function(xml) {
    //         if ($(xml).find('quotation').attr('result') !== 'fail') {
    //
    //             $('#quotation').show();
    //
    //             if ($(xml).find('data').attr('amount_type') == 'up') {
    //                 var font_color = 'text-rock';
    //                 var icon = '???';
    //             } else if ($(xml).find('data').attr('amount_type') == 'down') {
    //                 var font_color = 'text-blue_modern';
    //                 var icon = '???';
    //             } else if ($(xml).find('data').attr('amount_type') == 'none') {
    //                 var font_color = 'black';
    //                 var icon = '-';
    //             }
    //
    //             $('#ag_quotation').append('???????????? <span class=\'' + font_color + '\'>' + addComma($(xml).find('data').attr('price')) + '</span>??? ( <span class=\'' + font_color + '\'>' + icon + ' ' + addComma($(xml).find('data').attr('amount')) + '</span> )');
    //             $('#ag_quotation').append('<span class=\'f_normal\'> (????????????/' + addComma($(xml).find('quotation').attr('multiple')) + ' ' + $(xml).find('quotation').attr('unit_trade') + '???)');
    //         }
    //     },
    //     error: function() {
    //         $('#quotation').hide();
    //     }
    // });
}

function addComma(values) {
    var str_values = '' + values + '';
    var values = str_values.replace(/,/gi, '');
    var pattern = /(-?[0-9]+)([0-9]{3})/;
    while (pattern.test(values)) {
        values = values.replace(pattern, '$1,$2');
    }
    return values;
}

function filteredGameMenuPressed() {
    var game_code = $('#filtered_game_id').val();
    var server_code = $('#filtered_child_id').val();
    var goods = $('#filtered_items').val();

    var goods_type = {
        all: 0,
        item: 1,
        money: 3,
        etc: 4
    };

    var rgData = {
        type: 'buy',
        game: game_code,
        server: server_code,
        goods: goods_type[goods],
        api_token: a_token
    };

    // ajaxRequest({
    //     url: '/api/myroom/customer/mySearchGame',
    //     type: 'POST',
    //     dataType: 'json',
    //     data: rgData,
    //     success: function(res) {
    //         if (res.result == 'SUCCESS') {
    //             if (res.status == 'on') {
    //                 $('#favorite').removeClass('offfav').addClass('onfav');
    //             } else if (res.status == 'off') {
    //                 $('#favorite').removeClass('onfav').addClass('offfav');
    //             }
    //         } else {
    //             alert(res.msg);
    //         }
    //     }
    // });
}

$(document).ready(function() {
    filteredGameMenuPressed();
    asyncRequestByAJ();
    $('#favorite').on('click', function() {
        var game_code = $('#filtered_game_id').val();
        var game_code_text = $('#filtered_game_alias').val();
        var server_code = $('#filtered_child_id').val();
        var server_code_text = $('#filtered_child_alias').val();
        var goods = $('#filtered_items').val();

        var angel_item_alias = {
            all: '????????????',
            item: '?????????',
            money: '????????????',
            character: '?????????',
            etc: '??????'
        };

        var goods_type = {
            all: 0,
            item: 1,
            money: 3,
            etc: 4
        };

        var rgData = {
            type: 'buy',
            game: game_code,
            game_text: game_code_text,
            server: server_code,
            server_text: server_code_text,
            goods: goods_type[goods],
            goods_text: angel_item_alias[goods]
        };

        ajaxRequest({
            url: '/myroom/customer/search_add',
            type: 'POST',
            dataType: 'json',
            data: rgData,
            success: function(res) {
                if (res.result == 'SUCCESS') {
                    alert('????????? ?????? ????????? ?????? ????????? ?????????????????????.');
                    $('#favorite').removeClass('offfav').addClass('onfav');
                } else {
                    alert(res.msg);
                }
            }
        });
    });
});
