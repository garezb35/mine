function _init() {
    var frm = $('#frm_game');
    var checker = new _form_checker(frm);
    checker.add({
        custom: function() {
            if ($('input[name="game_name"]').val() == '') {
                alert('게임명을 입력해 주세요.');
                $('input[name="game_name"]').focus().val('');
                return false;
            }
            if ($('input[name="game_text"]').val() == '게임검색' || $('input[name="game_text"]').val() == '') {
                alert('게임명을 선택해 주세요.');
                $('input[name="game_text"]').focus();
                return false;
            }
            if ($('input[name="server_name"]:disabled').length < 1) {
                if ($('input[name="server_name"]').val() == '') {
                    alert('서버명을 입력해 주세요.');
                    $('input[name="server_name"]').focus();
                    $('input[name="server_name"]').val('');
                    return false;
                }
            }
            if ($('input[name=\'game_url\']:disabled').length < 1) {
                if ($('input[name="game_url"]').val() == '주소를 입력해 주세요.' || $('input[name="game_url"]').val() == '') {
                    alert('주소를 입력해 주세요.');
                    $('input[name="game_url"]').focus();
                    $('input[name="game_url"]').val('');
                    return false;
                }
            }
            if ($('input[name="gs_subject"]').val() == '') {
                alert('제목을 입력해 주세요.');
                $('input[name="gs_subject"]').focus();
                return false;
            }
            if ($('textarea[name="gs_content"]').val() == '') {
                alert('내용을 입력해 주세요.');
                $('textarea[name="gs_content"]').focus();
                return false;
            }
            return true;
        }
    });

    $('input[name="new_type"]').bind({
        click: function() {
            if ($(this).val() == 'g') {
                $('#game_label').text('게임명');
                $('#game_area').html('<input type="text" class="g_text" name="game_name" id="game_name" placeholder="게임명을 입력해 주세요." />');
                $('#server_label').text('서버명');
                $('#server_area').html('<input type="text" class="g_text" name="server_name" disabled="disabled" />');
                $('#filtered_game_id').html('').css('visibility', 'hidden');
                $('#addr_tr').show();
                $('input[name=\'game_url\']').prop('disabled', false);
                fnReset();
            }
            if ($(this).val() == 's') {
                $('#game_label').text('게임명');
                $('#game_area').html('<input type="text" class="g_text" name="game_name" id="game_name" placeholder="게임명을 입력해 주세요." />');
                $('#server_label').text('서버명');
                $('#server_area').html('<input type="text" class="g_text" name="server_name" placeholder="서버명을 입력해 주세요." />');
                $('#filtered_game_id').html('<div><div id="searchgame_list"></div></div>');
                var objGamelist = $.extend($('#game_name')[0], _GameList2, {
                    nodeList: $('#searchgame_list'),
                    onOpen: function() {
                        $('#filtered_game_id').css('visibility', 'visible');
                    },
                    onClose: function() {
                        $('#filtered_game_id').css('visibility', 'hidden');
                    }
                });
                // objGamelist.initialize();
                $('#game_name').focus(function() {
                    $('.tb_form .h_auto').show();
                });
                $('#addr_tr').hide();
                $('input[name=\'game_url\']').prop('disabled', true);
                fnReset();
            }
            if ($(this).val() == 'e') {
                $('#game_label').text('제목');
                $('#game_area').html('<input type="text" class="g_text subject" name="gs_subject" />');
                $('#server_label').text('내용');
                $('#server_area').html('<textarea name="gs_content" class="g_textarea"></textarea>');
                $('#filtered_game_id').html('').css('visibility', 'hidden');
                $('#addr_tr').hide();
                $('input[name=\'game_url\']').prop('disabled', true);
            }
        }
    });
    fnReset();
}

function fnReset() {
    $('table').find('input[class="g_text"]').bind({
        blur: function() {
            if ($(this).attr('value') == '') {
                if ($(this).attr('name') == 'game_name') {
                    $(this).val('게임명을 입력해 주세요.');
                } else if ($(this).attr('name') == 'server_name') {
                    $(this).val('서버명을 입력해 주세요.');
                }
            }
        }
    });
}
