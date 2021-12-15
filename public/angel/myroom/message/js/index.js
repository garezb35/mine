/*
 * @title		메시지 확인
 * @author		장원진
 * @date		2012.02.21
 * @update		수정날짜(수정자)
 * @description
 */
var g_node,
    g_mode,
    bNewRead = false;

function _init() {
    var frm		= $('#frmDeleteAll'),
        checker	= new _form_checker(frm);

    checker.add({
        custom : function () {
            var chkLen		= $('td:first-child > input[name="message_id[]"]:checked').length,
                msg			= '',
                procType	= $('#procType').val();

            if (chkLen < 1) {
                alert('메시지를 선택해주세요.');

                return false;
            }

            if (procType == 'delete') {
                frm.attr('action', 'delete_all');
                msg = '삭제';
            }
            else if (procType == 'save') {
                frm.attr('action', 'save_all');
                msg = '보관';
            }
            else {
                return;
            }

            if (confirm('선택된 메시지를 ' + msg + '하시겠습니까?')) {
                tdThis = $('td:first-child');

                tdThis.each(function() {
                    if ($(this).find('input[name="message_id[]"]:checked').length < 1) {
                        $(this).find('input[name="message_date[]"]').each(function() {
                            $(this).remove();
                        });
                        $(this).find('input[name="message_state[]"]').each(function() {
                            $(this).remove();
                        });
                    }
                });

                return true;
            }

            return false;
        }
    });

    splitButton.init();

    $(window).on('resize', function () {
        if (!$('#split_btn_layer').hasClass('d-none')) {
            $('#split_btn_layer').addClass('d-none');
        }
    });

    $.extend(g_nodeSleep, {
        OnOpen : function() {
            if (!$('#split_btn_layer').hasClass('d-none')) {
                $('#split_btn_layer').addClass('d-none');
            }
        },
        OnClose : function() {
            var nodeParent = g_node.parentNode;

            if (bNewRead) {
                nodeParent.removeChild(g_node);
            }

            if (g_node && $(nodeParent).children('tr').length <= 1) {
                window.location.reload();
            }
        }
    });
}

$.fnMessageAjax = function (node, mode) {
    g_node = node;
    g_mode = mode;

    $.fnAjax();
}

$.extend({
    fnnode : function() {
        if (!g_node) { return; }

        if (this.bNewRead) {
            this.g_node.parentNode.removeChild(this.g_node);
        }

        this.node = g_node;
        this.mode = g_mode;

        return $(this.node).find('td').eq(0).find('input');
    },
    fnAjax : function () {
        var rgInfo = $.fnnode();

        $.ajax({
            url			: '/api/myroom/message/view',
            dataType	: 'xml',
            type		: 'POST',
            data		: 'message_id=' + rgInfo[0].value + '&message_date=' + rgInfo[1].value + '&message_state=' + rgInfo[2].value+"&api_token="+a_token,
            success : function(xml) {
                $.fnView(xml);
            },
            error : function(error) {
                alert('메시지를 불러오지 못했습니다.\n\n다시 시도해 주세요.');
                window.location.reload();
            }
        });
    },
    fnView : function (xml) {
        if (!$(xml).find('message').attr('result')) {
            document.write(request.responseText);

            return;
        }
        else if ($(xml).find('message').attr('result') == 'fail') {
            alert($(xml).find('message').attr('result_msg'));
            window.location.reload();

            return;
        }

        var strType	= $(xml).find('type').text();
        $('#dvMessage_type').text(strType + ' 메시지');
        $('#dvMessage_date').text($(xml).find('date').text());
        $('#dvMessage_title').text($(xml).find('subject').text());
        $('#dvMessage_content').html($(xml).find('content').text());

        if (strType == '관리자' || strType == '보관') {
            $('#tr_none').css('display', 'none');
        }
        else {
            $('#dvMessage_id').text('#' + $(xml).find('trade_id').text());

            if ($(xml).find('price').text().length > 0) {
                $('#dvMessage_price').text(Number($(xml).find('price').text()).currency());
            }
            else {
                $('#dvMessage_price').text('');
            }

            $('#tr_none').css('display', '');
        }

        var nodeMove	= $('#dvMessage_move'),
            bar			= false;

        nodeMove.text('');

        if ($(g_node).parent().find('tr').eq(1)[0] != $(g_node)[0]) {
            bar = true;

            nodeMove.append('<strong><a href="#" id="pre">이전</a></strong>');
            nodeMove.find('#pre').bind({
                click : function() {
                    g_node = g_node.previousSibling.previousSibling;

                    $.fnAjax();
                }
            });
        }

        if (g_node.parentNode.childNodes[g_node.parentNode.childNodes.length -2] != g_node) {
            if (bar) {
                nodeMove.append(' | ');
            }

            nodeMove.append('<strong><a href="#" id="nex">다음</a></strong>');
            nodeMove.find('#nex').bind({
                click : function() {
                    g_node = g_node.nextSibling.nextSibling;

                    $.fnAjax();
                }
            });
        }

        bNewRead = false;

        var rgInfo = $(g_node).find('td').eq(0).find('input');

        if (rgInfo[2].value == 1) {
            if (g_mode == 'new') {
                bNewRead = true;
            }

            var img = $(g_node).find('td').eq(1).find('img').eq(0);

            if ($(img).attr('src').indexOf('ico_message_on.gif') != -1) {
                $(img).attr({
                    'src' : IMG_DOMAIN2 + '/images/icon/ico_message.gif',
                    'alt' : '읽음'
                });
            }

            if (g_mode == 'admin') {
                var rmTd_0		= $(g_node).find('td').eq(0),
                    selCross	= $(rmTd_0).find('span.bold_txt'),
                    rmTd_3		= $(g_node).find('td').eq(3),
                    newImg		= $(rmTd_3).find('img');

                selCross.remove();
                rgInfo[0].className = 'g_checkbox';

                if (newImg.length > 0) { // new 이미지 있을 때만 삭제 처리
                    newImg.remove();
                }
            }

            rgInfo[0].value = $(xml).find('message').attr('id');
            rgInfo[2].value = 2;
        }
        g_nodeSleep.enable($('#message_view'));
    },
    fnDelete : function () {
        if (!g_node) { return; }
        if (!confirm('이 메시지를 삭제하시겠습니까?')) { return; }

        var rgInfo = $(g_node).find('td').eq(0).find('input');

        $.ajax({
            url			: '/api/myroom/message/delete',
            dataType	: 'html',
            type		: 'POST',
            data		: 'message_id=' + rgInfo[0].value + '&message_date=' + rgInfo[1].value + '&message_state=' + rgInfo[2].value+"&api_token="+a_token,
            success : function(html) {
                $.fnNodeDelete();
            },
            error : function() {
                alert('메시지를 불러오지 못했습니다.\n\n다시 시도해 주세요.');
                window.location.reload();
            }
        });
    },
    fnNodeDelete : function () {
        if (!g_node) { return; }

        var nextNode = (g_node==g_node.parentNode.lastChild) ? ((g_node==g_node.parentNode.firstChild.nextSibling.nextSibling) ? null : g_node.previousSibling.previousSibling) : g_node.nextSibling.nextSibling;

        g_node.parentNode.removeChild(g_node);

        if (!nextNode) {
            window.location.reload();
        }
        else {
            g_node = nextNode;

            $.fnAjax();
        }
    }
});

var splitButton = {};

$.extend(splitButton, {
    init : function() {
        var btnAll		= $('#split_btn_all'),
            btnOptions	= $('#split_btn_options'),
            btnLayer	= $('#split_btn_layer');

        $.extend(btnLayer, _gui);
        $.extend(btnAll, _gui);

        // btnAll.toggle(
        // 	function() {
        // 		$('td.first>input[class=g_checkbox]').each(function() {
        // 			this.checked = true;
        // 		});
        // 	},
        // 	function() {
        // 		$('td.first>input[class=g_checkbox]').each(function() {
        // 			this.checked = false;
        // 		});
        // 	}
        // )
        // .css({
        // 	cursor : 'pointer'
        // });

        btnOptions.click(function() {
            btnLayer.toggleClass('d-none');

            var rgBound	= btnAll.getBound();

            btnLayer.setXY(rgBound.x, rgBound.y + rgBound.height);

        })
            .css({
                cursor : 'pointer'
            });

        btnLayer.bind({
            mouseleave : function() {
                btnLayer.toggleClass('d-none');
            }
        });
    },
    onSelAll : function() {
        $('td:first-child > input[class=g_checkbox]').each(function() {
            this.checked = true;
        });
    },
    onSelCancel : function() {
        $('td:first-child > input[class=g_checkbox]').each(function() {
            this.checked = false;
        });
    },
    onSelNread : function() {
        this.onSelCancel();

        $('td:first-child').each(function() {
            if ($(this).find('input[value=1]').length > 0) {
                $(this).find('input[class=g_checkbox]').each(function() {
                    this.checked = true;
                });
            }
        });
    },
    onSelRead : function() {
        this.onSelCancel();

        $('td:first-child').each(function() {
            if ($(this).find('input[value=2]').length > 0) {
                $(this).find('input[class=g_checkbox]').each(function() {
                    this.checked = true;
                });
            }
        });
    }
});

function switchForm(processType) {
    var frm = document.frmDeleteAll,
        msg = '';

    if (processType == 'delete') {
        frm.action	= 'delete_all';
        msg			= '삭제';
    }
    else if (processType == 'save') {
        frm.action	= 'save_all';
        msg			= '보관';
    }
    else {
        return;
    }

    if (confirm('선택된 메시지를 ' + msg + '하시겠습니까?')) {
        frm.submit();
    }
}
