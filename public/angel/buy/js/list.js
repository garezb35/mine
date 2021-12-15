// 리스트 초기값
var nListPage = 1;
var searchList = {
    ajaxUrl: '/api/ajax_list',
    detailView: function(tid) {

        $('#kind').html('');
        $('#tid').html('');
        $('#money').html('');
        $('#credit_name').html('');
        $('#credit_point').html('');

        $('#cell_auth').removeClass("");
        $('#public_auth').removeClass("");
        $('#email_auth').removeClass("");
        $('#account_auth').removeClass("");

        ajaxRequest({
            url: "/_include/_list_search",
            dataType: "json",
            type: "POST",
            data: "trade_id=" + tid + "&strTradeType=buy",
            success: function(res) {
                if (res.bExists == false) {
                    alert('해당 물품이 재등록 되거나 삭제되었습니다.\n[확인] 버튼 클릭 시 물품리스트를 다시 불러옵니다.');
                    location.reload();
                    return;
                }

                $('#kind').html(res.trade_kind_txt);
                $("#tid").html('#' + tid);
                $('#money').html((res.trade_money).currency() + '원');
                $('#credit_info').html('<span class="credit_mark _xsm ' + (res.credit_name_en) + '"></span> <span class="seller_rank ' + (res.credit_name_en) + '_txt">' + (res.credit_name) + '회원</span>');
                $('#credit_point').html(res.credit_point + '점');

                if (res.cell_auth === '1') {
                    $('#cell_auth').addClass('on');
                }
                if (res.public_auth === '1') {
                    $('#public_auth').addClass('on');
                }
                if (res.email_auth === '1') {
                    $('#email_auth').addClass('on');
                }
                if (res.account_auth === '1') {
                    $('#account_auth').addClass('on');
                }

                $('#appBtn').attr('href', 'application?id=' + tid + '&pinit=' + $('#pinit').val() + $('#continue').val());
                // $('#detailBtn').attr('href', 'view.html?id=' + tid + '&pinit=' + $('#pinit').val() + $('#continue').val());

                $('.item_regInfo').addClass('layer_active');
            },
            error: function() {
                alert('불러오지 못했습니다.\n다시 시도해 주세요.');
                $('.item_regInfo').removeClass('layer_active');
            }
        });
    },
    application: function(tid, state) {
        if (state !== 'a') {
            return;
        }
        location.href = 'application?id=' + tid + '&pinit=' + nListPage + $('#continue').val();
    },
    formSubmit: function() {
        $('#frm_search').attr('action', '/buy/list');
        $('#frm_search').submit();
    },
    serverSearch: function(server, sever_name, kind) {
        $('#filtered_child_id').val(server);
        $('#filtered_child_alias').val(sever_name);
        $('#filtered_items').val(kind);

        $('#frm_search').attr('action', '/buy/list_search');
        $('#frm_search').submit();
    }
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
    var rgGameServer = tradeItem.gs_name.split('|');

    var listHtml = '<li ' + (tradeItem.trade_state == 'p' ? 'class="link_block"' : '') + '>' +
        '               <div class="col_01"><a href="javascript:searchList.serverSearch(\'' + tradeItem.server_code + '\', \'' + rgGameServer[1] + '\', \'' + tradeItem.trade_kind + '\')">' + rgGameServer[1] + '</a></div>';

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
    $('[name="goods_type"]').val($(this).attr('data-type'));
    searchList.formSubmit();
}

$(document).ready(function() {

    function listLoad(append) {
        append = append + '&pinit=' + nListPage+"&api_token="+a_token+"&type=buy";

        if (whileReloading) {
            return;
        }

        var searchListPremium = $('.item_filtered__premium');
        var searchListNormal = $('.item_filtered__average');
        ajaxRequest({
            type: 'post',
            url: searchList.ajaxUrl,
            dataType: 'json',
            data: append,
            beforeSend: function() {
                whileReloading = true;
            },
            success: function(res) {
                if (res.result === 'SUCCESS') {
                    $('.loading').addClass('d-none');

                    if (res.data.p && res.data.p.length > 0) {
                        searchListPremium.html((res.data.p).map(function(e) {
                            return elementFromListData(e);
                        }).filter(function(q) {
                            return q !== null;
                        }).join('\n'));
                    } else {
                        searchListPremium.html('<li class="empty"><div>검색된 물품이 없습니다.</div></li>');
                    }

                    if (res.data.g && res.data.g.length > 0) {
                        searchListNormal.html(searchListNormal.html() + (res.data.g).map(function(e) {
                            return elementFromListData(e);
                        }).filter(function(e) {
                            return e !== null;
                        }).join('\n'));

                    } else {
                        if (nListPage === 1) {
                            searchListNormal.html('<li class="empty"><div>검색된 물품이 없습니다.</div></li>');
                        } else {
                            alert('마지막 물품입니다.');
                        }
                        $('.load_more').hide();
                    }

                    nListPage++;
                } else if (res.result === 'BLOCK') {
                    alert(res.message);
                    location.href = ROOT_DOMAIN;
                    return;
                } else if (res.message !== undefined) {
                    alert(res.message);
                    return;
                }
            },
            complete: function() {
                whileReloading = false;
            }
        });
    }

    var whileReloading = false;
    var frmSearch = $('#frm_search');
    var append = frmSearch.serialize();
    var $listInfo = $('#list_info');

    listLoad(append);

    $('.react_nav_tab').children('[value]').on('click', function() {
        $('#filtered_items').val($(this).attr('value'));
        $('#search_word').val('');
        $('#goods_type').attr('value', '');
        searchList.formSubmit();
    });

    var word = $('#word');
    $('.btn_search').on('click', function() {
        if (word.val().isEmpty()) {
            alert('물품제목을 입력해주세요.');
            word.focus();
            return false;
        }
        if (word.val().trim().length < 2) {
            alert('2글자 이상 5글자 이하만 검색이 가능합니다.');
            word.focus();
            return false;
        }
        $('#search_word').val(word.val());
        searchList.formSubmit();
    });

    word.on('keyup', function(e) {
        if (_event.keycode(e) === 13) {
            $('.btn_search').click();
            return;
        }
    });

    $('#opt_list li').click(listOptionClick);

    /*  begin 물품정보 안내 */
    $listInfo.find('i.icon_info').on('click', function() {
        $listInfo.find('.info_layer').toggleClass('active');
    });

    $listInfo.find('.info_layer > .il_close').on('click', function() {
        $(this).parent().removeClass('active');
    });
    /*  end 물품정보 안내 */

    $('#item_regInfo').find('a.fade__out').on('click', function() {
        $('#item_regInfo').removeClass('layer_active');
    });

    $('#detail_search div.toggleer').on('click', function() {
        $('#detail_search div.navtabs__react').slideToggle();
        $(this).toggleClass('down');
    });

    /* begin 리스트 새로고침 */
    $('.icon_refresh').on('click', function() {
        $('.item_filtered__premium').html('');
        $('.item_filtered__average').html('');
        $('.load_more').show();

        nListPage = 1;
        listLoad(append);
    });
    /* end 리스트 새로고침 */

    /* ▼ 리스트 추가 로드 */
    $('.load_more').on('click', function() {
        var filtered_items = $('#filtered_items').val();
        if (filtered_items != 'character') {
            if (nListPage == 11) {
                $('.item_filtered__premium').html('');
                $('.item_filtered__average').html('');

                nListPage = 1;
            }
        }
        listLoad(append);
    });
    /* ▲ 리스트 추가 로드 */

    $(document).on('click', '[trade-id]', function() {
        $(this).parents('li').addClass('on');
        searchList.detailView($(this).attr('trade-id'));
    });

    $('#goods input, #state input, #credit input, #etc input, #account_type input, #purchase_type input, #payment_existence input, #multi_access input').on('click', function() {
        searchList.formSubmit();
    });

    $('.search_reset').on('click', function() {
        frmSearch.find('[class="angel__text"]').val('');
        frmSearch.find('[class="g_checkbox"]').prop('checked', false);
        frmSearch.find('ul li:first-child [type="radio"]').prop('checked', true);
        searchList.formSubmit();
    });

    $('#btn_game_money').click(function() {
        _window.open('game_money', '/game_info/money/index?win=pop&gamecode=' + $('#filtered_game_id').val() + '&servercode=' + $('#filtered_child_id').val(), 800, 900);
    });

    $('#alarm_float').click(function(){
        if(confirm("물품등록알리미 페이지로\n이동하시겠습니까?")) {
            location.href = '/myroom/goods_alarm/alarm_buy_list'
        }
    })
});
