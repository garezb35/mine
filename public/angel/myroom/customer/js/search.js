// function _init() {
//     var frm = $('#frm_search');
//     if (frm.length > 0) {
//         var gameServerEl = document.getElementById('custom_gameserver');
//         existedAngelGameServer = new AngelGames(document.getElementById('custom_gameserver_list'), {
//             containerWrapper: gameServerEl,
//             toggleContainer: gameServerEl.getElementsByClassName('_34Cr45d_reacts')[0],
//             formElement: '#frm_search',
//             game: {
//                 autoComplete: '#searchRegGameServer',
//                 hidden_use: {
//                     code: '[name="game"]',
//                     text: '[name="game_text"]'
//                 }
//             },
//             server: {
//                 use: true,
//                 allView: false,
//                 hidden_use: {
//                     code: '[name="server"]',
//                     text: '[name="server_text"]'
//                 }
//             },
//             goods: {
//                 use: true,
//                 allView: true,
//                 hidden_use: {
//                     code: '',
//                     text: '[name="goods_text"]'
//                 },
//                 onCustomChange: function() {
//                     var goodsCode = '';
//                     if(this.selectedData) {
//                         switch (this.selectedData.C) {
//                             case 'money' :
//                                 goodsCode = '3';
//                                 break;
//                             case 'item' :
//                                 goodsCode = '1';
//                                 break;
//                             case 'etc' :
//                                 goodsCode = '4';
//                                 break;
//                             case 'character' :
//                                 goodsCode = '6';
//                                 break;
//                             default :
//                                 goodsCode = '0';
//                         }
//                     }
//                     document.getElementsByName('goods')[0].value = goodsCode;
//                 }
//             }
//         });
//
//         var checker = new _form_checker(frm);
//         checker.add({
//             custom: function() {
//                 if (frm.find('[name="type"]').val() == '') {
//                     alert('??????????????? ????????? ?????? ????????? ?????????');
//                     return false;
//                 }
//                 if (frm.find('[name="game"]').val() == '') {
//                     alert('????????? ????????? ?????????');
//                     return false;
//                 }
//                 if (frm.find('[name="server"]').val() == '' || frm.find('[name="server"]').val() == 0) {
//                     alert('????????? ????????? ?????????');
//                     return false;
//                 }
//                 return true;
//             }
//         });
//     }
//
//     $('img[class="move"]').click(function() {
//         var str = $(this).attr('alt');
//         var tr = $(this).parent().parent();
//         if (str == '??????') {
//             if (tr.index() > 1) {
//                 tr.insertBefore(tr.prev());
//             } else {
//                 alert('??????????????????.');
//             }
//         }
//         if (str == '?????????') {
//             if (tr.index() < $('#search_tb tr').length - 1) {
//                 tr.insertAfter(tr.next());
//             } else {
//                 alert('??????????????????.');
//             }
//         }
//     });
// }


function list_delete(node, id) {
    var text = $(node).data('text')
    var qa = confirm(text + '??? ?????????????????????????');
    if (!qa) {
        return;
    }
    window.location.href = 'search_delete?id=' + id;
}

function startpage_update(radio) {
    var get = '';
    if (arguments.length < 1) {
        var qa = confirm('?????? ???????????? ?????????????????????????');
        if (!qa) {
            return;
        }
    } else if (arguments.length > 0) {
        var qa = confirm('?????? ???????????? ?????????????????????????');
        if (!qa) {
            return;
        }
        get = '?id=' + radio.value;
    }
    window.location.href = 'search_startpage' + get;
}
