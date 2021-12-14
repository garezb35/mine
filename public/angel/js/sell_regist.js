/*
 * @title		íŒë§¤ë“±ë¡ë¬¼í’ˆ
 * @author		ê¹€ë³´ëžŒ
 * @date		2012.02.16
 * @update		ìˆ˜ì •ë‚ ì§œ(ìˆ˜ì •ìž)
 * @description
 */

/* â–¼ ë¬¼í’ˆ ì²˜ë¦¬ */
function tradeProcess(flag, tid) {

    var confirmMsg;
    if (flag == 'showSelect') {
        confirmMsg = 'ë¬¼í’ˆì„ ìˆ¨ê¹€í•´ì œ í•˜ì‹œê² ìŠµë‹ˆê¹Œ?';
    } else if(flag == "hideSelect"){
        confirmMsg = "ìˆ¨ê¹€ê¸°ëŠ¥ ì„¤ì • í›„ 24ì‹œê°„ë™ì•ˆ ìˆ¨ê¹€í•´ì œë¥¼ í•˜ì§€ ì•Šìœ¼ì‹œë©´ í•´ë‹¹ ë¬¼í’ˆì€ ìžë™ìœ¼ë¡œ ì‚­ì œë©ë‹ˆë‹¤.\në¬¼í’ˆì„ ìˆ¨ê¸°ì‹œê² ìŠµë‹ˆê¹Œ?";
    } else if (flag === 'deleteSelect') {
        confirmMsg = "í•´ë‹¹ ë¬¼í’ˆì„ ì‚­ì œí•˜ì‹œê² ìŠµë‹ˆê¹Œ?";
    } else if (flag === 'deleteSelectAll') {
        confirmMsg = "í˜„ìž¬ ë³´ì—¬ì§€ëŠ” íŽ˜ì´ì§€ì˜ ë¬¼í’ˆ (ìµœëŒ€ 10ê°œ, ìˆ¨ê¹€í¬í•¨) ì‚­ì œê°€ ê°€ëŠ¥í•©ë‹ˆë‹¤.\nì‚­ì œí•˜ì‹œê² ìŠµë‹ˆê¹Œ ?";
        flag = 'deleteSelect';
    }

    if (!confirm(confirmMsg)) {
        return false;
    }

    var frm = $("#frmList");
    if (tid) {
        frm.find("[name='trade_id']").val(tid);
    }
    frm.find("[name='process']").val(flag);
    frm.attr("action", "sell_regist.php");
    frm.submit();
}

/* â–² ë¬¼í’ˆ ì²˜ë¦¬ */

/* â–¼ ìž¬ë“±ë¡ */
function reInsert(tid) {
    if (confirm("ìž¬ë“±ë¡ í•˜ì‹œê² ìŠµë‹ˆê¹Œ?")) {
        var frm = $("#reInsertFrm");
        frm.find("[name='id']").val(tid);
        frm.attr("action", "sell_re_reg_auto_ok.php");
        frm.submit();
    }
}

/* â–² ìž¬ë“±ë¡ */
