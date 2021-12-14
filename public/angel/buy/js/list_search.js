searchList.ajaxUrl = '/api/ajax_list_search';
searchList.formSubmit = function() {
    $('#frm_search').attr('action', '/buy/list_search');
    $('#frm_search').submit();
};

function elementFromListData(tradeItem) {
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
    listHtml += '	    	        <span class="title' + (expression.blue ? ' title_green' : '') + (expression.bold ? ' f_bold' : '') + '">' + tradeItem.trade_subject + '</span>' + (tradeItem.screenshot === 'Y' ? ' <span class="hasScreenshot"></span>' : '') +
        '	                    </div>';
    listHtml += '	        </a>';

    // 퀵아이콘 등록
    if (tradeItem.quickicon) {
        listHtml += '	        <div class="view_detail_quick" trade-id="' + tradeItem.trade_id + '"></div>';
    }

    listHtml += '	    </div>' +
        '               <div class="col_03">' +
        '	                <div class="mulline">';

    if (tradeItem.ea_trade_money !== '') {
        listHtml += '		    ' + tradeItem.ea_trade_money + '<br />';
    }

    listHtml += '   		    <span>' + (tradeItem.min_trade_money) + '원</span>' +
        '	                </div>' +
        '               </div>' +
        '               <div class="col_04">' +
        '	                <i class="list_sprite icon_good' + (tradeItem.trade_show_time === 'Y' ? ' active_icon' : '') + '">우수인증</i>' +
        '	                <i class="list_sprite icon_direct' + (tradeItem.trade_class === 'd' ? ' active_icon' : '') + '">즉시구매</i>' +
        '               </div>' +
        '               <div class="col_05">' + (tradeItem.trade_state == 'p' ? '거래종료' : tradeItem.reg_date) + '</div>' +
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

function fnajax_ag_quotation() {
    $.ajax({
        url: '/_xml/gamemoney_avg.xml',
        dataType: 'xml',
        type: 'GET',
        timeout: 3000,
        data: 'gamecode=' + $('#search_game').val() + '&servercode=' + $('#search_server').val() + '&count=2',
        success: function(xml) {
            if ($(xml).find('quotation').attr('result') !== 'fail') {

                $('#quotation').show();

                if ($(xml).find('data').attr('amount_type') == 'up') {
                    var font_color = 'f_red1';
                    var icon = '▲';
                } else if ($(xml).find('data').attr('amount_type') == 'down') {
                    var font_color = 'f_blue1';
                    var icon = '▼';
                } else if ($(xml).find('data').attr('amount_type') == 'none') {
                    var font_color = 'black';
                    var icon = '-';
                }

                $('#ag_quotation').append('평균시세 <span class=\'' + font_color + '\'>' + addComma($(xml).find('data').attr('price')) + '</span>원 ( <span class=\'' + font_color + '\'>' + icon + ' ' + addComma($(xml).find('data').attr('amount')) + '</span> )');
                $('#ag_quotation').append('<span class=\'f_normal\'> (전일기준/' + addComma($(xml).find('quotation').attr('multiple')) + ' ' + $(xml).find('quotation').attr('unit_trade') + '당)');
            }
        },
        error: function() {
            $('#quotation').hide();
        }
    });
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

function mySearch_menu_check() {
    var game_code = $('#search_game').val();
    var server_code = $('#search_server').val();
    var goods = $('#search_goods').val();

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
        goods: goods_type[goods]
    };

    ajaxRequest({
        url: '/myroom/customer/mySearchGame',
        type: 'POST',
        dataType: 'json',
        data: rgData,
        success: function(res) {
            if (res.result == 'SUCCESS') {
                if (res.status == 'on') {
                    $('#favorite').removeClass('offfav').addClass('onfav');
                } else if (res.status == 'off') {
                    $('#favorite').removeClass('onfav').addClass('offfav');
                }
            } else {
                alert(res.msg);
            }
        }
    });
}

$(document).ready(function() {

    //나만의 검색메뉴 등록 체크
    mySearch_menu_check();

    //시세정보
    fnajax_ag_quotation();

    /* ▼ 나만의 검색메뉴 추가 */
    $('#favorite').on('click', function() {
        var game_code = $('#search_game').val();
        var game_code_text = $('#search_game_text').val();
        var server_code = $('#search_server').val();
        var server_code_text = $('#search_server_text').val();
        var goods = $('#search_goods').val();

        var e_goods_text = {
            all: '물품전체',
            item: '아이템',
            money: '게임머니',
            character: '캐릭터',
            etc: '기타'
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
            goods_text: e_goods_text[goods]
        };

        ajaxRequest({
            url: '/myroom/customer/search_add',
            type: 'POST',
            dataType: 'json',
            data: rgData,
            success: function(res) {
                if (res.result == 'SUCCESS') {
                    alert('나만의 게임 메뉴에 해당 게임이 추가되었습니다.');
                    $('#favorite').removeClass('offfav').addClass('onfav');
                } else {
                    alert(res.msg);
                }
            }
        });
    });
    /* ▲ 나만의 검색메뉴 추가 */
});
