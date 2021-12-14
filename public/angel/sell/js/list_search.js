searchList.ajaxUrl = '/api/ajax_list_search';
searchList.formSubmit = function() {
    $('#frm_search').attr('action', '/sell/list_search');
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
    }

    var listHtml = '<li class="'+(tradeItem.premium === 'power' ? 'power_product':'')+' ' + ( tradeItem.trade_state == 'p' ? 'link_block' : '') + '">' +
        '               <div class="col_01"><img src="/angel/img/level/'+tradeItem.credit_img+'" width="36"/></div>';

    listHtml += '       <div class="col_02' + ((tradeItem.trade_state === 'a') ? " active" : "") + '">';
    listHtml += '	        <a href="' + ((tradeItem.user_seller === 'true') ? "/myroom/sell/sell_regist_view?id=" + tradeItem.trade_id : "javascript:searchList.view('" + tradeItem.trade_id + "','" + tradeItem.trade_state + "')") + '">';
    listHtml += '	            <div class="mulline">';
    if (tradeItem.ea_range !== '' && tradeItem.ea_range !== null) {
        listHtml += '   		    <span class="unit">[' + tradeItem.ea_range + ']</span><br />';
    }
    if (tradeItem.trade_category === '3') {
        listHtml += '               <span class="icon_bargain"></span>';
    }
    if(tradeItem.trade_kind == "6"){
        listHtml += '   		    <span class="unit">' + tradeItem.character_subject + '</span><br />';
    }
    if (tradeItem.trade_category === '3' && tradeItem.trade_kind != "6") {
        listHtml += '               <br>';
    }
    listHtml += '	    	        <span class="title' + (expression.blue ? ' title_blue' : '') + (expression.bold ? ' f_bold' : '') + '">' + tradeItem.trade_subject + '</span>' + (tradeItem.screenshot === 'Y' ? ' <span class="hasScreenshot"></span>' : '') +
        '	                    </div>';
    listHtml += '	        </a>';
    if(tradeItem.quickicon)
    {
        listHtml += '	        <div class="view_detail_quick '+(tradeItem.quickicon?'on':'')+'" trade-id="' + tradeItem.trade_id + '"></div>';
    }
    else
    {
        listHtml += '	        <div class="view_detail" trade-id="' + tradeItem.trade_id + '"></div>';
    }

    listHtml += ' 		</div>' +
        '               <div class="col_03">' +
        '	                <div class="mulline">';

    if (tradeItem.ea_trade_money !== '') {
        listHtml += '		    ' + tradeItem.ea_trade_money + '<br />';
    }

    listHtml += '   		    <span>' + (tradeItem.min_trade_money) + '원</span>' +
        '	                </div>' +
        '               </div>' +
        '               <div class="col_04">' +
        '	                <i class="list_sprite icon_good' + (tradeItem.trade_show_time === 'Y' ? ' active_icon' : '') + '">ìš°ìˆ˜ì¸ì¦</i>' +
        '	                <i class="list_sprite icon_dc' + (tradeItem.multidiscount_use === 'Y' ? ' active_icon' : '') + '">í• ì¸</i>' +
        '               </div>';
    if (tradeItem.premium == 'power') {
        listHtml += '               <div class="col_05"><span class="icon_power">íŒŒì›Œë¬¼í’ˆ</span></div>';
    } else {
        listHtml += '               <div class="col_05">' + (tradeItem.trade_state == 'p' ? 'ê±°ëž˜ì¢…ë£Œ' : tradeItem.reg_date) + '</div>';
    }
    listHtml += '           </li>';
    return listHtml;
}

function listOptionClick() {
    var order = $(this).attr('data-type');
    if (order == '1') {
        $('[name="trade_state"][value="2"]').prop('checked', true);
    } else {
        $('[name="trade_state"][value="1"]').prop('checked', true);
    }
    $("#order").val(order);
    searchList.formSubmit();
}

function fnajax_ag_quotation() {
    $.ajax({
        url: "/_xml/gamemoney_avg",
        dataType: "xml",
        type: "GET",
        timeout: 3000,
        data: "gamecode=" + $("#search_game").val() + "&servercode=" + $("#search_server").val() + "&count=2",
        success: function(xml) {

            if ($(xml).find("quotation").attr("result") !== "fail") {

                $("#quotation").show();

                if ($(xml).find("data").attr("amount_type") == "up") {
                    var font_color = "f_red1";
                    var icon = "â–²";
                } else if ($(xml).find("data").attr("amount_type") == "down") {
                    var font_color = "f_blue1";
                    var icon = "â–¼";
                } else if ($(xml).find("data").attr("amount_type") == "none") {
                    var font_color = "black";
                    var icon = "-";
                }

                $("#ag_quotation").append("<span class='" + font_color + "'>" + addComma($(xml).find("data").attr("price")) + "</span>ì› ( <span class='" + font_color + "'>" + icon + " " + addComma($(xml).find("data").attr("amount")) + "</span> )");
                $("#ag_quotation").append("<span class='f_normal'> (" + addComma($(xml).find("quotation").attr("multiple")) + " " + $(xml).find("quotation").attr("unit_trade") + "ë‹¹)");
            }
        },
        error: function() {
            // $("#quotation").hide();
        }
    });
}

function mySearch_menu_check() {
    var game_code = $('#search_game').val();
    var server_code = $('#search_server').val();
    var goods = $("#search_goods").val();

    var goods_type = {
        all: 0,
        compen200: 0,
        item: 1,
        money: 3,
        etc: 4
    };

    var rgData = {
        type: 'sell',
        game: game_code,
        server: server_code,
        goods: goods_type[goods],
        api_token: a_token
    };

    if (!server_code) {
        return false;
    }

    ajaxRequest({
        url: '/api/myroom/customer/mySearchGame',
        type: 'POST',
        dataType: "json",
        data: rgData,
        success: function(res) {
            if (res.result == "SUCCESS") {
                if (res.status == "on") {
                    $('#favorite').removeClass('offfav').addClass('onfav');
                } else if (res.status == "off") {
                    $('#favorite').removeClass('onfav').addClass('offfav');
                }
            } else {
                alert(res.msg);
            }
        }
    });
}

function addComma(values) {
    var str_values = "" + values + "";
    var values = str_values.replace(/,/gi, '');
    var pattern = /(-?[0-9]+)([0-9]{3})/;
    while (pattern.test(values)) {
        values = values.replace(pattern, "$1,$2");
    }
    return values;
}

$(document).ready(function() {

    if ($('#item_detail_search').length > 0) {
        //ë¦¬ë‹ˆì§€M ì•„ì´í…œ ìƒì„¸ ê²€ìƒ‰
        itemDetailSearchInit();
    }

    //ë‚˜ë§Œì˜ ê²€ìƒ‰ë©”ë‰´ ë“±ë¡ ì²´í¬
    mySearch_menu_check();

    //ì‹œì„¸ì •ë³´
    fnajax_ag_quotation();

    if ($('#item_detail_search2').length > 0) {
        $('#item_detail_search2').on('change', 'select', function() {
            if (this.id === 'depth1') {
                $('#srch_item_depth1').val(this.value);
                $('#srch_item_depth2').val('');

            } else if (this.id === 'depth2') {
                $('#srch_item_depth2').val(this.value);
            }
            searchList.formSubmit();
        });
    }

    /* â–¼ ë‚˜ë§Œì˜ ê²€ìƒ‰ë©”ë‰´ ì¶”ê°€ */
    $('#favorite').on('click', function() {
        var game_code = $('#search_game').val();
        var game_code_text = $('#search_game_text').val();
        var server_code = $('#search_server').val();
        var server_code_text = $('#search_server_text').val();
        var goods = $("#search_goods").val();

        var e_goods_text = {
            all: 'ë¬¼í’ˆì „ì²´',
            compen200: 'ë¬¼í’ˆì „ì²´',
            item: 'ì•„ì´í…œ',
            money: 'ê²Œìž„ë¨¸ë‹ˆ',
            etc: 'ê¸°íƒ€',
            character: 'ìºë¦­í„°'
        };

        var goods_type = {
            all: 0,
            compen200: 0,
            item: 1,
            money: 3,
            etc: 4,
            character: 6
        };

        var rgData = {
            type: 'sell',
            game: game_code,
            game_text: game_code_text,
            server: server_code,
            server_text: server_code_text,
            goods: goods_type[goods],
            goods_text: e_goods_text[goods]
        };

        ajaxRequest({
            url: '/myroom/customer/search_add.php',
            type: 'POST',
            dataType: "json",
            data: rgData,
            success: function(res) {
                if (res.result == "SUCCESS") {
                    alert("");
                    $('#favorite').removeClass('offfav').addClass('onfav');
                } else {
                    alert(res.msg);
                }
            }
        });

    });
    /* â–² ë‚˜ë§Œì˜ ê²€ìƒ‰ë©”ë‰´ ì¶”ê°€ */

});

(function($, undefined) {
    var detailItemInfo;

    function itemDetailSearchInit() {
        var item_detail_search = $('#item_detail_search');
        if (item_detail_search.length > 0) {

            item_detail_search.on('change', '#item_category, #item_kind', function() {
                itemDetailSearch(this);
            });

            item_detail_search.on('change', '#item_name', function() {
                var val = this.value;
                var category = $('#srch_item_depth1').val();

                $(this).next().addClass('hide');

                if (category != 'ìŠ¤í‚¬ë¶' && category != 'ê¸°íƒ€') {
                    setEnchantList.call(this);
                }

                $('#srch_item_depth3').val(val);
                $('#srch_item_depth4').val('');

            });

            item_detail_search.on('change', '#enchant', function() {
                var val = this.value;
                $('#srch_item_depth4').val(val);
            });

            $(document).on('click', '.detail_srh_btn', function() {
                searchList.formSubmit();
            });
        }
    }

    function itemDetailSearch(el) {
        var me = el;
        var _type = me.name;
        var _param = me.value;

        var container = $('#item_detail_search');

        if (_param.isEmpty()) {
            $(el).nextAll().addClass('hide');
            if (_type === 'category') {
                $('#srch_item_depth1').val('');
            }
            $('#srch_item_depth2').val('');
            $('#srch_item_depth3').val('');
            $('#srch_item_depth4').val('');
            return;
        } else {
            if (_type === 'category') {
                $('#item_name').addClass('hide');
                $('#item_name').children().remove();
            }
            $('#enchant').addClass('hide');
        }

        if (typeof detailItemInfo == 'undefined') {
            ajaxRequest({
                type: 'post',
                url: '/lineagem/_ajax_item_all.php',
                dataType: 'json',
                success: function(data) {
                    detailItemInfo = data;
                    if (_type === 'category') {
                        setKindList.call(me, container, _param);
                    }
                    else {
                        setItemList.call(me, container, _param);
                    }
                },
                error: function(res) {
                    alert('ê´€ë¦¬ìžì—ê²Œ ë¬¸ì˜í•´ì£¼ì„¸ìš”. status : ' + res.status);
                }
            });
        } else {
            if (_type === 'category') {
                setKindList.call(me, container, _param);
            }
            else {
                setItemList.call(me, container, _param);
            }
        }
    }

    function setKindList(container, _param) {
        var controlEl = $(this).next();
        var data = detailItemInfo['kind'][_param];
        var strHtml = '<option value="">ì „ì²´</option>';

        $.each(data, function() {
            strHtml += '<option value="' + this + '">' + this + '</option>';
        });

        controlEl.html(strHtml).removeClass('hide');

        $('#srch_item_depth1').val(_param);
        $('#srch_item_depth2').val('');
        $('#srch_item_depth3').val('');
        $('#srch_item_depth4').val('');
    }

    function setItemList(container, _param) {
        var controlEl = $(this).next();
        var data = detailItemInfo['item_name'][_param];
        var strHtml = '<option value="">ì „ì²´</option>';
        $.each(data, function() {
            strHtml += '<option value="' + this + '">' + this + '</option>';
        });
        controlEl.html(strHtml).removeClass('hide');

        $('#srch_item_depth2').val(_param);
        $('#srch_item_depth3').val('');
        $('#srch_item_depth4').val('');
    }

    function setEnchantList() {
        var controlEl = $(this).next();
        controlEl.removeClass('hide');
    }

    window.itemDetailSearchInit = itemDetailSearchInit;

})(jQuery);
