/*
 * @title			나만의 검색 메뉴 수정 팝업
 * @author		김현진
 * @date			2012.02.13
 * @update		수정날짜(수정자)
 * @description
 */

function _init() {
    _window.resize(680, 420);
    var frm = $('#frmSearch');
    if (frm.length > 0) {
        var gameServerEl = document.getElementById('custom_gameserver');
        regGameServer = new GameServerList(document.getElementById('custom_gameserver_list'), {
            containerWrapper: gameServerEl,
            formElement: '#frmSearch',
            game: {
                autoComplete: '#searchRegGameServer',
                hidden_use: {
                    code: '[name="game"]',
                    text: '[name="game_text"]'
                }
            },
            server: {
                use: true,
                allView: false,
                hidden_use: {
                    code: '[name="server"]',
                    text: '[name="server_text"]'
                }
            },
            goods: {
                use: true,
                allView: true,
                hidden_use: {
                    code: '[name="goods_tmp"]',
                    text: '[name="goods_text"]'
                },
                onCustomChange: function() {
                    var goodsCode = '';
                    if(this.selectedData) {
                        switch (this.selectedData.C) {
                            case 'money' :
                                goodsCode = '3';
                                break;
                            case 'item' :
                                goodsCode = '1';
                                break;
                            case 'etc' :
                                goodsCode = '4';
                                break;
                            case 'character' :
                                goodsCode = '6';
                                break;
                            default :
                                goodsCode = '0';
                        }
                    }
                    document.getElementsByName('goods')[0].value = goodsCode;
                }
            }
        });

        var checker = new _form_checker(frm);
        checker.add({
            custom: function() {
                if (frm.find('[name="type"]').val() == '') {
                    alert('거래유형과 물품을 모두 선택해 주세요');
                    return false;
                }
                if (frm.find('[name="game"]').val() == '') {
                    alert('게임을 선택해 주세요');
                    return false;
                }
                if (frm.find('[name="server"]').val() == '' || frm.find('[name="server"]').val() == 0) {
                    alert('서버를 선택해 주세요');
                    return false;
                }
                return true;
            }
        });
    }
}
