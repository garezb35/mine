function _init() {
    var alarmBtn = document.querySelectorAll('.alarm_btn');
    var reregBtn = document.querySelectorAll('.rereg_pop');
    for(var i=0; i<alarmBtn.length; i++)
    {
        alarmBtn[i].addEventListener('click', function(e){
            stateChange(this)
        })
    }

    for(var i=0; i<reregBtn.length; i++)
    {
        reregBtn[i].addEventListener('click', function(e){
            reregAction(this)
        })
    }
}

function stateChange(el){
    var type = el.getAttribute('data-type');
    var seq = el.getAttribute('data-seq');

    switch (type) {
        case 'switch':
            var apply = el.getAttribute('data-apply');
            var apply_text = '';
            var modify_apply = '';

            if(apply == '1') {
                apply_text = 'Off';
                modify_apply = '2';
            } else {
                apply_text = 'Onìœ¼';
                modify_apply = '1';
            }

            if(confirm("ì•Œë¦¼ìƒíƒœë¥¼ "+ apply_text +"ë¡œ ë³€ê²½í•˜ì‹œê² ìŠµë‹ˆê¹Œ?")) {
                // el.classList.toggle('off');
                ajaxRequest({
                    url: '_ajax_process.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'mode': 'toggle',
                        'seq': seq,
                        'apply': modify_apply
                    },
                    async: false,
                    success: function (res) {
                        // ì„±ê³µ/ì‹¤íŒ¨ ë¬´ì¡°ê±´ alert
                        alert(res.MSG);
                        location.reload();
                    },
                    error: function (e) {
                        alert('ì„œë²„ì™€ì˜ ì ‘ì†ì´ ì›í™œí•˜ì§€ ì•ŠìŠµë‹ˆë‹¤.\nìž ì‹œí›„ ë‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.' + e.message);
                        return;
                    }
                });
            }
            break;
        case 'delete':
            if(confirm("ì•Œë¦¼ì„¤ì • ë¬¼í’ˆì„ ì‚­ì œí•˜ì‹œê² ìŠµë‹ˆê¹Œ?")) {
                ajaxRequest({
                    url: '_ajax_process.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'mode': 'delete',
                        'seq': seq
                    },
                    async: false,
                    success: function (res) {
                        // ì„±ê³µ/ì‹¤íŒ¨ ë¬´ì¡°ê±´ alert
                        alert(res.MSG);
                        location.reload();
                    },
                    error: function (e) {
                        alert('ì„œë²„ì™€ì˜ ì ‘ì†ì´ ì›í™œí•˜ì§€ ì•ŠìŠµë‹ˆë‹¤.\nìž ì‹œí›„ ë‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.' + e.message);
                        return;
                    }
                });
            }
            break;
        case 'view':
            ajaxRequest({
                url: '_ajax_process.php',
                type: 'post',
                dataType: 'json',
                data: {
                    'mode': 'confirm',
                    'seq': seq
                },
                async: false,
                success: function (res) {
                    if(res.DAT.TYPE == 'list') {
                        if(confirm("í•´ë‹¹ ë¬¼í’ˆì´ ì‚­ì œ ë˜ì—ˆê±°ë‚˜ ìž¬ë“±ë¡ ëœ ìƒíƒœìž…ë‹ˆë‹¤.\ní•´ë‹¹ ê²Œìž„/ì„œë²„ë¡œ ì´ë™í•˜ì‹œê² ìŠµë‹ˆê¹Œ?")) {
                            $("#trade_search_form [name='search_goods']").val(res.DAT.PARAM.goods);
                            $("#trade_search_form [name='search_game']").val(res.DAT.PARAM.game_code);
                            $("#trade_search_form [name='search_game_text']").val(res.DAT.PARAM.game_text);
                            $("#trade_search_form [name='search_server']").val(res.DAT.PARAM.server_code);
                            $("#trade_search_form [name='search_server_text']").val(res.DAT.PARAM.server_text);
                            $("#trade_search_form [name='srch_char_alarm']").val(res.DAT.PARAM.char_alarm);
                            $("#trade_search_form").attr('action', res.DAT.URL);
                            $("#trade_search_form").submit();
                        }
                    } else if(res.DAT.TYPE == 'view') {
                        location.href = res.DAT.URL;
                    }
                },
                error: function (e) {
                    alert('ì„œë²„ì™€ì˜ ì ‘ì†ì´ ì›í™œí•˜ì§€ ì•ŠìŠµë‹ˆë‹¤.\nìž ì‹œí›„ ë‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.' + e.message);
                    return;
                }
            });
            break;
    }
}

function reregAction(e){
    // var popup = document.getElementById('rereg_alarm');
    // popup

    ajaxRequest({
        url: '_ajax_process.php',
        type: 'post',
        dataType: 'json',
        data: {
            'mode': 'notice',
            'seq': e.getAttribute('data-seq')
        },
        async: false,
        success: function (res) {
            if(res.RST == true) {

                var rgKeyword = res.DAT.myword.split('|');
                var gs_name = res.DAT.gs_name.split('|');

                $("[name='seq']").val(res.DAT.seq);
                $("[name='game_code']").val(res.DAT.game_code);
                $("[name='game_code_text']").val(gs_name[0]);
                $("[name='server_code']").val(res.DAT.server_code);
                $("[name='server_code_text']").val(gs_name[1]);
                $('#game_text').text(gs_name[0]);
                $('#server_text').text(gs_name[1]);
                $("[name='user_goods_type']:radio[value='"+res.DAT.trade_type+"']").prop('checked', true);
                $("[name='credit_type']:radio[value='"+res.DAT.credit_rating+"']").prop('checked', true);
                $("[name='account_type']:radio[value='"+res.DAT.account_type+"']").prop('checked', true);
                $("[name='purchase_type']:radio[value='"+res.DAT.purchase_type+"']").prop('checked', true);
                $("[name='payment_existence']:radio[value='"+res.DAT.payment_existence+"']").prop('checked', true);
                $("[name='multi_access']:radio[value='"+res.DAT.multi_access+"']").prop('checked', true);
                $("[name='user_alarm_type']:radio[value='"+res.DAT.noti_type+"']").prop('checked', true);
                $("[name='subject[]']:eq(0)").val(rgKeyword[0]);
                $("[name='subject[]']:eq(1)").val(rgKeyword[1]);
                $("[name='subject[]']:eq(2)").val(rgKeyword[2]);

                if(res.DAT.option_200 == '2') {
                    $("[name='compen']").prop('checked', true);
                } else {
                    $("[name='compen']").prop('checked', false);
                }
                if(res.DAT.option_200buy == '2') {
                    $("[name='sell_compen']").prop('checked', true);
                } else {
                    $("[name='sell_compen']").prop('checked', false);
                }
                if(res.DAT.option_dscount == '2') {
                    $("[name='discont']").prop('checked', true);
                } else {
                    $("[name='discont']").prop('checked', false);
                }
                if(res.DAT.option_direct == '2') {
                    $("[name='direct']").prop('checked', true);
                } else {
                    $("[name='direct']").prop('checked', false);
                }
                if(res.DAT.option_good == '2') {
                    $("[name='excellent']").prop('checked', true);
                } else {
                    $("[name='excellent']").prop('checked', false);
                }

                switch (res.DAT.noti_type) {
                    case '1':
                        document.querySelectorAll('.character_noti')[2].textContent = '- ëª¨ë°”ì¼ì•± PUSHë¡œ ì•Œë¦¼ì„ ë°›ìœ¼ì‹œë ¤ë©´ ì•„ì´í…œë§¤ë‹ˆì•„ì•± ì„¤ì¹˜ ë° ë¡œê·¸ì¸ì´ ë˜ì–´ ìžˆì–´ì•¼ í•©ë‹ˆë‹¤.';
                        document.querySelectorAll('.character_noti')[3].textContent = '- ì•±PUSH ì•Œë¦¼ì€ ëª¨ë°”ì¼ì•± > í™˜ê²½ì„¤ì • > ë§ˆì¼€íŒ…ì •ë³´PUSHì•Œë¦¼ì—ì„œ ìˆ˜ì‹ ë™ì˜ ìƒíƒœì¼ë•Œë§Œ ë°œì†¡ë©ë‹ˆë‹¤.';
                        break;
                    case '2':
                        document.querySelectorAll('.character_noti')[2].textContent = '- SMSì•Œë¦¼ì€ ì•Œë¦¼ ì‹œì ì—ì„œì˜ ë“±ë¡ëœ ê³ ê°ë‹˜ íœ´ëŒ€í°ë²ˆí˜¸ë¡œ ë°œì†¡ë©ë‹ˆë‹¤.';
                        document.querySelectorAll('.character_noti')[3].textContent = '- SMSì•Œë¦¼ì€ ë§ˆì´ë£¸ > ê°œì¸ì •ë³´ìˆ˜ì • íŽ˜ì´ì§€ì—ì„œ â€˜ê´‘ê³ ì„±ì •ë³´ìˆ˜ì‹ ë™ì˜-SMSìˆ˜ì‹ ë™ì˜â€™ ìƒíƒœì¼ë•Œë§Œ ë°œì†¡ë©ë‹ˆë‹¤.';
                        break;
                }
            } else {
                alert(res.MSG);
            }
        },
        error: function (e) {
            alert('ì„œë²„ì™€ì˜ ì ‘ì†ì´ ì›í™œí•˜ì§€ ì•ŠìŠµë‹ˆë‹¤.\nìž ì‹œí›„ ë‹¤ì‹œ ì‹œë„í•´ì£¼ì„¸ìš”.' + e.message);
            return;
        }
    });

    g_nodeSleep.enable($("#rereg_alarm"));
    console.log(e.getAttribute('data-seq'));
}
