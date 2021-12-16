

function _init() {
    var frm = $("#frm_game");
    var checker = new _form_checker(frm);
    checker.add({
        custom: function() {
            if ($('input[name="game_name"]').val() == '게임명을 입력해 주세요.' || $('input[name="game_name"]').val() == '') {
                alert('게임명을 입력해 주세요.');
                $('input[name="game_name"]').focus();
                $('input[name="game_name"]').val('');
                return false;
            }
            if ($('input[name="game_text"]').val() == '게임검색' || $('input[name="game_text"]').val() == '') {
                alert('게임명을 선택해 주세요.');
                $('input[name="game_text"]').focus();
                return false;
            }
            if ($("input[name='server_name']:disabled").length < 1) {
                if ($('input[name="server_name"]').val() == '서버명을 입력해 주세요.' || $('input[name="server_name"]').val() == '') {
                    alert('서버명을 입력해 주세요.');
                    $('input[name="server_name"]').focus();
                    $('input[name="server_name"]').val('');
                    return false;
                }
            }
            if ($("input[name='game_url']:disabled").length < 1) {
                if ($('input[name="game_url"]').val() == '주소를 입력해 주세요.' || $('input[name="game_url"]').val() == '') {
                    alert('주소를 입력해 주세요.');
                    $('input[name="game_url"]').focus();
                    $('input[name="game_url"]').val('');
                    return false;
                }
            }
            if ($("input[name='gs_subject']").val() == '') {
                alert('제목을 입력해 주세요.');
                $("input[name='gs_subject']").focus();
                return false;
            }
            if ($("textarea[name='gs_content']").val() == '') {
                alert('내용을 입력해 주세요.');
                $("textarea[name='gs_content']").focus();
                return false;
            }
            return true;
        }
    });

    $('input[name="new_type"]').bind({
        click: function() {
            if ($(this).val() == 'g') {
                $('#game_th').text('게임명');
                $('#game_td').html('<input type="text" class="angel__text" name="game_name" value="게임명을 입력해 주세요." />');
                $('#server_th').text('서버명');
                $('#server_td').html('<input type="text" class="angel__text" name="server_name" disabled="disabled" />');
                $('input[name=server_name]').css("background", "#E0E0E0");
                $('#addr_tr').remove();
                $('table[class="table-primary"]').append('<tr id="addr_tr"><th>URL(주소)</th><td>http:// <input type="text" class="angel__text" name="game_url" value="주소를 입력해 주세요." /></td></tr>');
                fnReset();
            }
            if ($(this).val() == 's') {
                $('#game_th').text('게임명');
                $('#game_td').html('<div id="dvGame" name="game"></div>');
                $('#server_th').text('서버명');
                $('#server_td').html('<input type="text" class="angel__text" name="server_name" value="서버명을 입력해 주세요." />');
                $('#addr_tr').remove();
                $('table[class="table-primary"]').append('<tr id="addr_tr"><th>URL(주소)</th><td>http:// <input type="text" class="angel__text" name="game_url" disabled="disabled" /></td></tr>');
                $('input[name=game_url]').css("background", "#E0E0E0");
                var objGamelist = $.extend($('#dvGame'), _gamelist);
                objGamelist.initialize();
                fnReset();
            }
            if ($(this).val() == 'e') {
                $('#game_th').text('제목');
                $('#game_td').html('<input type="text" class="angel__text subject" name="gs_subject" />');
                $('#server_th').text('내용');
                $('#server_td').html('<textarea name="gs_content"></textarea>');
                $('#addr_tr').remove();
            }
        }
    });
    fnReset();
}

function fnReset() {
    $('table').find('input[class="angel__text"]').bind({
        blur: function() {
            if ($(this).attr('value') == '') {
                if ($(this).attr('name') == 'game_name') {
                    $(this).val('게임명을 입력해 주세요.');
                } else if ($(this).attr('name') == 'server_name') {
                    $(this).val('서버명을 입력해 주세요.');
                } else if ($(this).attr('name') == 'game_url') {
                    $(this).val('주소를 입력해 주세요.');
                }
            }
        },
        click: function() {
            if ($(this).val() == '' || $(this).val() == '게임명을 입력해 주세요.' || $(this).val() == '서버명을 입력해 주세요.' || $(this).val() == '주소를 입력해 주세요.') {
                $(this).val('');
            }
        }
    });
}
